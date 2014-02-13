Heat mapping Philadelphia building permits over time
---------------

Premise
=======
By mapping the change in applications for building permits over time, we can see which areas are seeing revitilazation

Data
====

wget 'http://services.phila.gov/PhillyApi/Data/v1.0/permits?orderby=permit_type_name&$expand=locations&$format=json' -O all-permits.json

## Data Creation

Test Points

Philadelphia needed to divided into a series of buffered points to query PostGIS
to find the count of permits per area.

UPDATE test_point SET bufferedgeom = ST_Buffer( test_point.point, .0071 ) WEHRE set_num = 4;

So we have test points, their geometry buffer, and the permits that are inside of them, we need to count those permits, in two dates.




Creating The Data
=================

1. scripts/get_permits_from_phlapi.php was run to query the phlAPI to pull down all of L&I's permits

2. scripts/load_permits_to_postgis.php was run to import them all into PostGIS

<pre><code>
TRUNCATE TABLE neighborhood_location_count;

INSERT INTO neighborhood_location_count (

select a.name, a.polygon, y2007, y2008, y2009, y2010, y2011, y2012, y2013

FROM

( 
    SELECT name,polygon,COUNT(*) as y2013 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2013-01-01') AND DATE('2013-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name,polygon
) as a

LEFT JOIN

(
    SELECT name,COUNT(*) as y2012 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2012-01-01') AND DATE('2012-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name
) as b

ON a.name = b.name

LEFT JOIN

(
    SELECT name,COUNT(*) as y2011 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2011-01-01') AND DATE('2011-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name
) as c

ON a.name = c.name

LEFT JOIN

(
    SELECT name,COUNT(*) as y2010 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2010-01-01') AND DATE('2010-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name
) as d

ON a.name = d.name

LEFT JOIN

(
    SELECT name,COUNT(*) as y2009 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2009-01-01') AND DATE('2009-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name
) as e

ON a.name = e.name

LEFT JOIN

(
    SELECT name,COUNT(*) as y2008 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2008-01-01') AND DATE('2008-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name
) as f

ON a.name = f.name

LEFT JOIN

(
    SELECT name,COUNT(*) as y2007 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2007-01-01') AND DATE('2007-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name
) as g
ON a.name = g.name


);
</code></pre>


Useful SQL queries
==================



SELECT ST_AsGeoJSON(ST_Collect(test_point.point)) FROM test_point WHERE set_num = 2
will pull back geoJSON of the test points, go to 