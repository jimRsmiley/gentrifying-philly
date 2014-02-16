
TRUNCATE TABLE neighborhood_location_count;

INSERT INTO neighborhood_location_count(neighborhood_name,neighborhood_polygon,y2012,y2013) (
    select n.listname as name, n.polygon,y2012, y2013

FROM

(
    SELECT name,listname, wkb_geometry as polygon FROM neighborhoods_philadelphia
) as n

LEFT JOIN

( 
    SELECT listname,COUNT(*) as y2013 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2013-01-01') AND DATE('2013-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as a

ON n.listname = a.listname

LEFT JOIN

 (
    SELECT listname,COUNT(*) as y2012 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2012-01-01') AND DATE('2012-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as b

ON a.listname = b.listname

);

