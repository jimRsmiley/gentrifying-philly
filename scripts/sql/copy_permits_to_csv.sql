Copy (
    SELECT listname as neighborhood_name, 
        streetnumber||' '||streetname||' '||streetsuffix as street,
        encode(workdescription,'escape') as work_description,
        permit.* 
	FROM permit
	INNER JOIN neighborhoods_philadelphia ON ST_Contains(wkb_geometry,point)
	WHERE DATE(issueddatetime) BETWEEN DATE('2012-01-01') AND DATE('2013-12-31')
	ORDER BY issueddatetime
) To '/tmp/permits.csv' With CSV HEADER
;