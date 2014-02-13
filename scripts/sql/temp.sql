TRUNCATE TABLE neighborhood_location_count;

INSERT INTO neighborhood_location_count (
select a.name, a.polygon, y2007, y2008, y2009, y2010, y2011, y2012, y2013

FROM

( 
    SELECT name,polygon,COUNT(*) as y2013 FROM (
        SELECT locationid, listname as name,wkb_geometry as polygon
        FROM permit 
        INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2013-01-01') AND DATE('2013-12-31')
        GROUP BY listname,wkb_geometry,locationid
        ORDER BY locationid
    ) as a GROUP BY name,polygon
) as a

inner join 

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

inner join
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

inner join
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

inner join
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

inner join
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

inner join
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

