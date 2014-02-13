SELECT row_to_json( fc )
FROM ( SELECT 'FeatureCollection' as type, array_to_json(array_agg(f)) as features
FROM( SELECT 'Feature' as type
    , ST_AsGeoJSON( neighborhood_permit_counts.neighborhood_polygon)::json AS geometry
    , row_to_json( (SELECT l FROM ( SELECT id,neighborhood_name,y2007,y2008,y2009,y2010,y2011,y2012,y2013) AS l
    )) AS properties
FROM neighborhood_permit_counts ) as f ) as fc;