SELECT row_to_json( fc ) as geojson
FROM ( SELECT 'FeatureCollection' as type, array_to_json(array_agg(f)) as features
FROM( SELECT 'Feature' as type
    , ST_AsGeoJSON( neighborhood_location_count.neighborhood_polygon)::json AS geometry
    , row_to_json( (SELECT l FROM ( SELECT neighborhood_name,y2007,y2008,y2009,y2010,y2011,y2012,y2013, ((((cast(y2007 as float)+y2008+y2009+y2010+y2011)/5)-((y2012+y2013)/2))/(y2007+y2008+y2009+y2010+y2011)/5)*100 as gentrifyer ) AS l
    )) AS properties
FROM neighborhood_location_count ) as f ) as fc