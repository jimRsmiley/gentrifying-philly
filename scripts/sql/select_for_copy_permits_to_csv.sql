SELECT name,listname,permit.* 
FROM permit
INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
WHERE
	DATE(issueddatetime) BETWEEN DATE('2012-01-01') AND DATE('2013-12-31')
ORDER BY issueddatetime