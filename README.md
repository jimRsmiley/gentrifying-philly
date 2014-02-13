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

3. scripts/create_test_points.php was run to generate evenly spaced test points to query for permit numbers around

4. scripts/create_heat_map_points.php was run to generate the heat map data points using the test points

Useful SQL queries
==================



SELECT ST_AsGeoJSON(ST_Collect(test_point.point)) FROM test_point WHERE set_num = 2
will pull back geoJSON of the test points, go to 