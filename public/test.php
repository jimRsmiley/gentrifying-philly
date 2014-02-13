<!DOCTYPE html><html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Philly Gentrification Heat Map </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
                <!--
            jQuery
        --------------------------------->
        <script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
        <script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <!--
            Twitter Bootstrap
        --------------------------------->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">

        <!-- Optional theme -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap-theme.min.css">

        <!-- Latest compiled and minified JavaScript -->
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        
        <!--
            Google Maps API
        --------------------------------->
        <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?libraries=visualization&key=AIzaSyBHgfiI48ic7ckYO-qNVfxvu1usxq7x0wU&sensor=true">
        </script>
        
        <!-- 
            Scripts 
        ----------------------------------->
        <script type="text/javascript" src="/js/phillygentrificationmap.js"></script>
        <!--
            My stylesheet
        ----------------------------------->
        <link rel="stylesheet" href="/css/style.css">

</head>
    <body>
        
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Philly Gentrification Heatmap</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="/about">About</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Map Options <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">About</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>

    </div><!-- /.navbar-collapse -->
</nav>
        <script>
    // Adding 500 Data Points
var map, pointarray, heatmap;
  /*
var taxiData = [
                      new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.260304944564,39.887005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.260304944564,39.967005396941), -0.14285714285714),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.260304944564,39.977005396941), 0.12408759124088),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.260304944564,40.057005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.877005396941), -1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.887005396941), -0.052631578947368),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.897005396941), 0.078947368421053),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.907005396941), 0.072463768115942),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.967005396941), -0.03448275862069),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.977005396941), 0.125),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,39.987005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,40.047005396941), 0.038461538461538),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,40.057005396941), 1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.250304944564,40.067005396941), 0.85714285714286),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.877005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.887005396941), -0.33333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.897005396941), 0.31818181818182),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.907005396941), 0.13559322033898),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.917005396941), -0.041509433962264),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.927005396941), -0.046632124352332),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.947005396941), 0.089219330855019),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.957005396941), 0.12557077625571),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.967005396941), 0.089908256880734),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.977005396941), 0.0038167938931298),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,39.987005396941), 0.04932735426009),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,40.037005396941), 0.26530612244898),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,40.047005396941), -0.048543689320388),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,40.057005396941), -0.28888888888889),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.240304944564,40.067005396941), 0.089430894308943),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.270304944564,39.977005396941), -0.2987012987013),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.260304944564,39.877005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.877005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.887005396941), -0.47368421052632),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.897005396941), 0.22171945701357),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.907005396941), 0.14583333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.917005396941), 0.079365079365079),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.927005396941), 0.16509433962264),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.937005396941), 0.044943820224719),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.947005396941), 0.080724876441516),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.957005396941), -0.13636363636364),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.967005396941), -0.051063829787234),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.977005396941), -0.044198895027624),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.987005396941), 0.068493150684932),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,39.997005396941), 0.23270440251572),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,40.037005396941), 0.11439114391144),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,40.047005396941), -0.12863070539419),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,40.057005396941), -0.038461538461538),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,40.067005396941), 0.19354838709677),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.230304944564,40.077005396941), -0.33333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.877005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.887005396941), -0.42857142857143),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.897005396941), 0.66666666666667),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.907005396941), 0.20754716981132),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.917005396941), 0.056603773584906),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.927005396941), -0.42408376963351),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.937005396941), 0.024038461538462),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.947005396941), 0.066959385290889),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.957005396941), -0.069016152716593),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.967005396941), 0.046454767726161),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.977005396941), -0.13939393939394),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.987005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,39.997005396941), 0.094736842105263),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.027005396941), -0.094674556213018),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.037005396941), -0.064039408866995),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.047005396941), -0.47107438016529),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.057005396941), -0.44444444444444),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.067005396941), -0.44827586206897),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.077005396941), 0.18367346938776),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.220304944564,40.087005396941), 0.1219512195122),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.877005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.887005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.897005396941), 0.2),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.907005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.917005396941), 0.13333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.927005396941), -0.97530864197531),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.937005396941), 0.051282051282051),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.947005396941), 0.061855670103093),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.957005396941), -0.049267643142477),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.967005396941), -0.088082901554404),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.977005396941), -0.023696682464455),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.987005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,39.997005396941), -0.061224489795918),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.007005396941), -0.068493150684932),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.017005396941), 0.20149253731343),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.027005396941), 0.19672131147541),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.037005396941), 0.21076233183857),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.047005396941), 0.93333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.057005396941), 0.1063829787234),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.067005396941), -0.17857142857143),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.210304944564,40.077005396941), -0.076923076923077),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.877005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.887005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.897005396941), 0.33333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.907005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.917005396941), 0.83333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.927005396941), 0.21739130434783),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.937005396941), 0.13253012048193),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.947005396941), 0.01949860724234),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.957005396941), 0.058555133079848),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.967005396941), -0.13539967373573),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.977005396941), -0.093167701863354),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.987005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,39.997005396941), -0.27272727272727),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.007005396941), 0.10869565217391),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.017005396941), -0.0098039215686275),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.027005396941), 0.041666666666667),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.037005396941), 0.23809523809524),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.047005396941), 0.14649681528662),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.057005396941), 0.28571428571429),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.067005396941), -0.13432835820896),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.200304944564,40.077005396941), -0.088339222614841),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.887005396941), -1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.897005396941), 0.6),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.907005396941), -0.064102564102564),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.917005396941), -0.067615658362989),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.927005396941), -0.16065573770492),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.937005396941), -0.1090573012939),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.947005396941), 0.012429378531073),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.957005396941), 0.043706293706294),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.967005396941), 0.044776119402985),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.977005396941), 0.3),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.987005396941), 0.40119760479042),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,39.997005396941), -0.081967213114754),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.007005396941), -0.014218009478673),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.017005396941), 0.10483870967742),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.027005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.037005396941), 0.08433734939759),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.047005396941), 0.18674698795181),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.057005396941), 0.015730337078652),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.190304944564,40.067005396941), -0.076305220883534),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.887005396941), 0.076923076923077),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.897005396941), -1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.907005396941), -0.094339622641509),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.917005396941), -0.0075757575757576),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.927005396941), -0.012847965738758),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.937005396941), 0.048414023372287),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.947005396941), 0.060894386298763),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.957005396941), 0.11864406779661),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.967005396941), 0.092307692307692),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.977005396941), 0.182156133829),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.987005396941), -0.0072992700729927),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,39.997005396941), 0.026490066225166),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.007005396941), 0.37674418604651),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.017005396941), -0.03030303030303),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.027005396941), -0.081967213114754),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.037005396941), 0.017964071856287),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.047005396941), 0.18224299065421),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.057005396941), 0.16151202749141),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.067005396941), 0.18681318681319),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.180304944564,40.077005396941), -0.095890410958904),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.887005396941), 0.27433628318584),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.897005396941), 0.11737089201878),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.907005396941), -0.046296296296296),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.917005396941), 0.098901098901099),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.927005396941), 0.064768683274021),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.937005396941), 0.022176022176022),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.947005396941), -0.037070730043211),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.957005396941), 0.02884289107567),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.967005396941), 0.01556420233463),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.977005396941), -0.17347865576748),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.987005396941), -0.035993740219092),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,39.997005396941), 0.015075376884422),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.007005396941), 0.1417004048583),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.017005396941), -0.10236220472441),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.027005396941), 0.0033444816053512),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.037005396941), -0.14391143911439),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.047005396941), 0.022058823529412),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.057005396941), 0.039301310043668),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.067005396941), -0.056),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.170304944564,40.077005396941), -0.090909090909091),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.887005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.897005396941), -0.38095238095238),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.907005396941), -0.084745762711864),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.917005396941), 0.066273932253314),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.927005396941), 0.082887700534759),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.937005396941), 0.031613976705491),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.947005396941), 0.017172086225795),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.957005396941), -0.00063653723742839),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.967005396941), 0.017804154302671),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.977005396941), -0.080183276059565),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.987005396941), -0.0034924330616997),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,39.997005396941), 0.0087976539589443),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.007005396941), 0.2289156626506),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.017005396941), 0.036674816625917),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.027005396941), 0.119825708061),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.037005396941), 0.12612612612613),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.047005396941), 0.15324675324675),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.057005396941), -0.037037037037037),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.160304944564,40.067005396941), -0.12578616352201),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.887005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.897005396941), -0.22222222222222),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.907005396941), -0.015873015873016),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.917005396941), 0.1685393258427),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.927005396941), 0.10543989254533),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.937005396941), -0.03943661971831),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.947005396941), 0.041095890410959),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.957005396941), 0.080459770114943),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.967005396941), 0.21715328467153),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.977005396941), 0.12359550561798),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.987005396941), -0.063469675599436),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,39.997005396941), -0.1623246492986),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.007005396941), -0.080684596577017),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.017005396941), -0.025089605734767),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.027005396941), -0.12131147540984),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.037005396941), 0.020746887966805),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.047005396941), -0.0098039215686275),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.057005396941), -0.025641025641026),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.150304944564,40.067005396941), -0.052631578947368),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.887005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.897005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.907005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.917005396941), -0.14285714285714),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.927005396941), -0.24324324324324),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.937005396941), -0.070796460176991),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.947005396941), 0.19754977029096),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.957005396941), 0.18486486486486),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.967005396941), 0.16622691292876),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.977005396941), 0.13235294117647),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.987005396941), -0.013084112149533),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,39.997005396941), -0.15973741794311),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,40.007005396941), 0.029333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,40.017005396941), -0.2183908045977),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,40.027005396941), -0.16949152542373),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,40.037005396941), 0.029508196721311),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,40.047005396941), -0.02092050209205),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.140304944564,40.057005396941), 0.10697674418605),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,39.907005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,39.917005396941), 0.46666666666667),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,39.967005396941), 0.056117755289788),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,39.977005396941), 0.040625),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,39.987005396941), 0.078313253012048),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,39.997005396941), -0.13775510204082),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,40.007005396941), 0.11851851851852),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,40.017005396941), -0.23674911660777),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,40.027005396941), -0.049723756906077),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,40.037005396941), 0.053380782918149),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,40.047005396941), -0.057692307692308),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.130304944564,40.057005396941), -0.17647058823529),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,39.967005396941), -0.022222222222222),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,39.977005396941), 0.21462945139557),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,39.987005396941), 0.095709570957096),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,39.997005396941), -0.026634382566586),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,40.007005396941), 0.043478260869565),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,40.017005396941), 0.14124293785311),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,40.027005396941), -0.075697211155378),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,40.037005396941), -0.10483870967742),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.120304944564,40.047005396941), -0.16037735849057),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,39.977005396941), 0.18694362017804),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,39.987005396941), -0.015822784810127),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,39.997005396941), -0.056433408577878),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,40.007005396941), -0.24096385542169),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,40.017005396941), -0.20588235294118),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,40.027005396941), -0.11627906976744),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.110304944564,40.037005396941), -0.0060606060606061),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,39.977005396941), -0.26530612244898),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,39.987005396941), 0.070175438596491),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,39.997005396941), -0.1030303030303),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,40.007005396941), 0.016181229773463),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,40.017005396941), 0.25),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,40.027005396941), 0.13253012048193),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,40.037005396941), -0.014354066985646),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.100304944564,40.047005396941), -0.23380281690141),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,39.977005396941), 0.33333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,39.987005396941), 0.13513513513514),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,39.997005396941), -0.2),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.007005396941), 0.14285714285714),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.017005396941), 0.13091922005571),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.027005396941), 0.077519379844961),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.037005396941), -0.16161616161616),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.047005396941), -0.13615023474178),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.057005396941), 0.095890410958904),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.090304944564,40.067005396941), 0.11320754716981),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,39.977005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,39.987005396941), -0.076923076923077),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,39.997005396941), -0.057471264367816),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.007005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.017005396941), -0.066037735849057),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.027005396941), 0.029850746268657),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.037005396941), -0.18548387096774),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.047005396941), -0.34653465346535),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.057005396941), 0.017543859649123),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.067005396941), 0.0042918454935622),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.080304944564,40.077005396941), -0.18478260869565),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,39.987005396941), 1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,39.997005396941), 0.1171875),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.007005396941), 0.13861386138614),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.017005396941), -0.26599326599327),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.027005396941), -0.19745222929936),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.037005396941), -0.14615384615385),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.047005396941), -0.19428571428571),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.057005396941), 0.11731843575419),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.067005396941), 0.3037037037037),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.077005396941), -0.41496598639456),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.070304944564,40.087005396941), -0.76666666666667),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,39.997005396941), 0.39393939393939),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.007005396941), -0.2),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.017005396941), -0.084507042253521),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.027005396941), -0.067846607669617),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.037005396941), -0.08502024291498),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.047005396941), -0.095588235294118),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.057005396941), -0.068493150684932),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.067005396941), 0.1027027027027),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.077005396941), -0.2),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.087005396941), -0.21052631578947),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.060304944564,40.097005396941), 0.074626865671642),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.007005396941), -1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.017005396941), 0.021276595744681),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.027005396941), -0.045317220543807),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.037005396941), 0.069090909090909),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.047005396941), -0.0096153846153846),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.057005396941), -0.20179372197309),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.067005396941), 0.068965517241379),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.077005396941), 0.047619047619048),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.087005396941), 0.2),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.097005396941), 0.016393442622951),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.050304944564,40.107005396941), -0.18518518518519),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.017005396941), -0.26666666666667),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.027005396941), -0.087248322147651),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.037005396941), -0.12707182320442),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.047005396941), -0.23333333333333),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.057005396941), -0.12698412698413),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.067005396941), 0.19298245614035),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.077005396941), 0.20634920634921),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.087005396941), 0.023622047244094),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.097005396941), 0.069444444444444),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.107005396941), 0.19540229885057),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.040304944564,40.117005396941), -0.027027027027027),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.017005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.027005396941), -0.22167487684729),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.037005396941), -0.11409395973154),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.047005396941), -0.082706766917293),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.057005396941), -0.17073170731707),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.067005396941), -0.086206896551724),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.077005396941), -0.31117824773414),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.087005396941), -0.20212765957447),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.097005396941), -0.014285714285714),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.107005396941), -0.047058823529412),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.030304944564,40.117005396941), -0.16417910447761),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.027005396941), 0.1304347826087),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.037005396941), -0.28),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.047005396941), 0.045454545454545),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.057005396941), -0.18181818181818),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.067005396941), -0.18072289156627),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.077005396941), -0.39823008849558),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.087005396941), -0.022727272727273),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.097005396941), -0.072164948453608),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.107005396941), -0.075862068965517),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.117005396941), 0.15),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.020304944564,40.127005396941), 0.12068965517241),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.027005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.037005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.047005396941), 0.042857142857143),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.057005396941), -0.10924369747899),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.067005396941), -0.071428571428571),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.077005396941), 0.15789473684211),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.087005396941), -0.081081081081081),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.097005396941), -0.061538461538462),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.107005396941), 0.011764705882353),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.117005396941), -0.22105263157895),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.010304944564,40.127005396941), -0.051948051948052),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.037005396941), -1),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.047005396941), -0.35555555555556),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.057005396941), -0.25547445255474),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.067005396941), 0.032967032967033),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.077005396941), -0.10843373493976),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.087005396941), -0.04),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.097005396941), 0.09375),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.107005396941), -0.19047619047619),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.117005396941), -0.375),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-75.000304944564,40.127005396941), -0.015873015873016),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.037005396941), -0.30769230769231),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.047005396941), -0.076923076923077),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.057005396941), -0.2972972972973),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.067005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.077005396941), -0.20212765957447),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.087005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.097005396941), 0.015873015873016),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.107005396941), 0.022222222222222),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.990304944564,40.117005396941), 0.097643097643098),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.047005396941), 0.15384615384615),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.067005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.077005396941), -0.12162162162162),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.087005396941), -0.31707317073171),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.097005396941), -0.20441988950276),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.107005396941), -0.1304347826087),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.980304944564,40.117005396941), 0),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.970304944564,40.077005396941), 0.078947368421053),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.970304944564,40.087005396941), -0.14285714285714),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.970304944564,40.097005396941), -0.16256157635468),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.970304944564,40.107005396941), 0.045454545454545),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.970304944564,40.117005396941), -0.2),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.960304944564,40.087005396941), 0.049382716049383),
                        new google.maps.visualization.WeightedLocation( new google.maps.LatLng(-74.960304944564,40.097005396941), -0.16129032258065),
    ];
*/
function initialize() {
  var mapOptions = {
    zoom: 13,
    center: new google.maps.LatLng(39.967005396941,-75.250304944564),
    mapTypeId: google.maps.MapTypeId.SATELLITE
  };

  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  var pointArray = new google.maps.MVCArray(taxiData);

console.log( google.maps.visualization );
//console.log( new google.maps.visualization.HeatMapLayer() );
  heatmap = new google.maps.visualization.HeatmapLayer({
    data: pointArray
  });

  heatmap.setMap(map);
}

function toggleHeatmap() {
  heatmap.setMap(heatmap.getMap() ? null : map);
}

function changeGradient() {
  var gradient = [
    'rgba(0, 255, 255, 0)',
    'rgba(0, 255, 255, 1)',
    'rgba(0, 191, 255, 1)',
    'rgba(0, 127, 255, 1)',
    'rgba(0, 63, 255, 1)',
    'rgba(0, 0, 255, 1)',
    'rgba(0, 0, 223, 1)',
    'rgba(0, 0, 191, 1)',
    'rgba(0, 0, 159, 1)',
    'rgba(0, 0, 127, 1)',
    'rgba(63, 0, 91, 1)',
    'rgba(127, 0, 63, 1)',
    'rgba(191, 0, 31, 1)',
    'rgba(255, 0, 0, 1)'
  ]
  heatmap.set('gradient', heatmap.get('gradient') ? null : gradient);
}

function changeRadius() {
  heatmap.set('radius', heatmap.get('radius') ? null : 20);
}

function changeOpacity() {
  heatmap.set('opacity', heatmap.get('opacity') ? null : 0.2);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>            
<div>
    
<div id="map-canvas"></div>
</body>
</html>
