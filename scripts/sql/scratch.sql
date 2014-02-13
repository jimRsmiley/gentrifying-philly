
select neighborhoods_philadelphia.name, COUNT(*) 
FROM neighborhoods_philadelphia 
INNER JOIN permit ON ST_Contains( ST_Transform( wkb_geometry, 4326 ), permit.point )
WHERE name = 'Frankford'
GROUP BY neighborhoods_philadelphia.name;


 ST_AsGeoJson( ST_Collect( ST_Transform(wkb_geometry,4326) ) ) From neighborhoods_philadelphia;

select name,ST_Transform( wkb_geometry,4326 ) FROM neighborhoods_philadelphia;

CREATE TABLE neighborhood (
    id serial PRIMARY KEY,
    name varchar(255),
    polygon geometry
);

insert into neighborhood( name, polygon ) ( select name,ST_Transform( wkb_geometry,4326 ) FROM neighborhoods_philadelphia );

CREATE UNIQUE INDEX neighborhood_name_idx ON neighborhood(name);
CREATE INDEX polygon_idx ON neighborhood USING GIST(polygon);

CREATE TABLE neighborhood_permit_counts (
    id serial primary key,
    neighborhood_name varchar,
    neighborhood_polygon geometry,
    y2007 integer,
    y2008 integer,
    y2009 integer,
    y2010 integer,
    y2011 integer,
    y2012 integer,
    y2013 integer
);

COPY permit(workdescription,permittypecode,permittypename,applicationtype,
applicationdescription,status,issueddatetime,pricontacttype,
pricontactcompanyname,pricontactlastname,pricontactfirstname,
pricontactaddress1,pricontactaddress2,pricontactcity,pricontactstate,
pricontactzip,x,y,locationid,streetnumber,streetname,streetsuffix,city,
state,zip,censustract,councildistrict,condounit,unitnumber,censusblock,
ward,permitnumber,lat,lng,updateddatetime) 
FROM '/tmp/permits.csv' DELIMITER ',' CSV HEADER;
