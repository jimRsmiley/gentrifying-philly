SELECT ST_AsGeoJson(ST_Collect( polygon ) ) AS geojson FROM user_polygon as a

UNION

SELECT ST_AsText(ST_Envelope(ST_Collect( polygon ) )) AS envelope_from_text FROM user_polygon as b

UNION

SELECT ST_AsGeoJson(ST_Envelope(ST_Collect( polygon ) )) AS envelope_from_text FROM user_polygon as b