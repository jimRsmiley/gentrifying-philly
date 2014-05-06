$( document ).ready( function() {
    $(".btn-minimize").click(function(){
        $(this).toggleClass('btn-plus');
        $(".project-description").slideToggle();
    });
    $( ".draggable" ).draggable();
});


var spinner;

var startYear;
var endYear;





var geoJson;
var geoJsonLayer;


    
    
    
    
  
var ChangingPhlMap = L.Map.extend( {
      
    addStreetsLayer : function() {
        
        this.setView([39.95058520078959, -75.14893589832354], 11);

        //map.addMapboxLayer();
        //map.loadData();
        L.tileLayer('https://{s}.tiles.mapbox.com/v3/{id}/{z}/{x}/{y}.png', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors | ' +
                    '<a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a> | ' +
                    'Imagery © <a href="http://mapbox.com">Mapbox</a> | ' +
                    'Neighborhood borders provided by <a href="http://www.azavea.com/blogs/newsletter/v8i2/philly-neighborhoods-map/">Azavea</a>',
                id: 'jimrsmiley.i5pbfdje'
        }).addTo(this);
    }
} );

var YearlyChangeMap = ChangingPhlMap.extend( {

    locationCountsUrl : "/permit-heat-mapper/neighborhood-permit-count/location-counts-by-neighborhood-as-geojson",
    
    loadDataM : function() {
        self = this;
        
        self.spin(true, self.getSpinnerOptions() );

        $.ajax({
            url: self.locationCountsUrl,
            context: document.body,
            success: function( data ) {
                geoJson = data;
                console.log( 'loaded data from: ' + window.location.origin + self.locationCountsUrl );
                self.loadData(self,2012,2013);
            }
        });

        $("select").change( function() {
            var selectedOptions = $( "select option:selected" );
            console.log('they want to change years');
            json = JSON.parse(selectedOptions[0].value);
            console.log( json );
            loadData(self,json.start,json.end);
            self.spin(false, self.getSpinnerOptions() );
        });
    },

    getSpinnerOptions : function() {
        return {
            lines: 17, // The number of lines to draw
            length: 40, // The length of each line
            width: 30, // The line thickness
            radius: 60, // The radius of the inner circle
            corners: 1, // Corner roundness (0..1)
            rotate: 48, // The rotation offset
            direction: 1, // 1: clockwise, -1: counterclockwise
            color: '#000', // #rgb or #rrggbb or array of colors
            speed: 0.8, // Rounds per second
            trail: 60, // Afterglow percentage
            shadow: true, // Whether to render a shadow
            hwaccel: false, // Whether to use hardware acceleration
            className: 'spinner', // The CSS class to assign to the spinner
            zIndex: 2e9, // The z-index (defaults to 2000000000)
            top: 'auto', // Top position relative to parent in px
            left: 'auto' // Left position relative to parent in px
        };
    },
    
    loadData : function(map,start,end) {

        if( typeof geoJsonLayer !== 'undefined' ) {
            map.removeLayer( geoJsonLayer );
        }
        
        startYear = start;
        endYear = end;

        jQuery.each( geoJson.features, function(i, val) {
            startYearCount = val.properties['y'+start];
            val.properties['y'+start] = ( startYearCount === null ? 0 : startYearCount );

            endYearCount = val.properties['y'+end];
            val.properties['y'+end] = ( endYearCount === null ? 0 : endYearCount );
            percentChange = ( endYearCount-startYearCount ) / ( startYearCount ) *100;
            percentChange = percentChange.toFixed(1);

            if( percentChange === 'Infinity' ) {
                percentChange = 'n/a';
            }

            val.properties.percentChange = percentChange;
        });

        update = function (props) {

            $('.neighborhood-info').html( function() {
                return (props ? '<b><h3 class="neighborhood-name">' + props.neighborhood_name + '</h3></b>'
                +'<div class="neighborhood-info">'
                + 'number of locations issued permits<br/>'
                + startYear + ': ' + props["y"+startYear] + '<br/>'
                + endYear + ': ' + props["y"+endYear] + '<br/>'
                + '<span class="percent-info">percent change: <b>' + props.percentChange + '&#37;</b></span>'
                +'<div>'
                : '<b>Hover over a neighborhood</b>');
                });
        };

        // get color depending on population density value
        function getColor(percentChange) {
            return percentChange === 'n/a' ? "#FFF" :
                   percentChange > 30  ? '#e31a1c' :
                   percentChange > 20  ? '#fd8d3c' :
                   percentChange > 10  ? '#fecc5c' :
                   percentChange > 0   ? '#ffffb2' :

                   percentChange < -30 ? '#0570b0' :
                   percentChange < -20 ? '#74a9cf' :
                   percentChange < -10 ? '#bdc9e1' :
                   percentChange < 0   ? '#f1eef6' :

                '#FFF';
        }

        function style(feature) {
            return {
                weight: 2,
                opacity: 1,
                color: 'white',
                dashArray: '3',
                fillOpacity: 1,
                fillColor: getColor(feature.properties.percentChange)
            };
        }

        function highlightFeature(e) {
            var layer = e.target;

            layer.setStyle({
                weight: 5,
                color: '#666',
                dashArray: '',
                fillOpacity: 0.7
            });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

            update(layer.feature.properties);
        }

        var geojson;

        function resetHighlight(e) {
            geoJsonLayer.resetStyle(e.target);
            update();
        }

        function onEachFeature(feature, layer) {
            layer.on({
                mouseover: highlightFeature,
                mouseout: resetHighlight,
            });
        }

        geoJsonLayer = L.geoJson(geoJson, {
            style: style,
            onEachFeature: onEachFeature
        }).addTo(map);

        map.fitBounds( geoJsonLayer, { padding: [0,0] } );
        map.spin(false);
    }
} );