
TRUNCATE TABLE neighborhood_location_count;

INSERT INTO neighborhood_location_count(neighborhood_name,neighborhood_polygon,y2007,y2008,y2009,y2010,y2011,y2012,y2013) (
    select n.listname as name, n.polygon,y2007,y2008,y2009,y2010,y2011,y2012,y2013

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

ON n.listname = b.listname

LEFT JOIN

 (
    SELECT listname,COUNT(*) as y2011 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2011-01-01') AND DATE('2011-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as c

ON n.listname = c.listname

LEFT JOIN

 (
    SELECT listname,COUNT(*) as y2010 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2010-01-01') AND DATE('2010-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as d

ON n.listname = d.listname

LEFT JOIN

 (
    SELECT listname,COUNT(*) as y2009 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2009-01-01') AND DATE('2009-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as e

ON n.listname = e.listname

LEFT JOIN

 (
    SELECT listname,COUNT(*) as y2008 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2008-01-01') AND DATE('2008-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as f

ON n.listname = f.listname

LEFT JOIN

 (
    SELECT listname,COUNT(*) as y2007 FROM (
        SELECT locationid, listname
        FROM neighborhoods_philadelphia 
        INNER JOIN permit ON ST_Contains(wkb_geometry,point)
        WHERE DATE(issueddatetime) BETWEEN DATE('2007-01-01') AND DATE('2007-12-31')
        GROUP BY listname,locationid
    ) as a GROUP BY listname
) as g

ON n.listname = g.listname
);

