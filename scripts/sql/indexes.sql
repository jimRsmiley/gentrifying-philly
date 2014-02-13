CREATE INDEX IF NOT EXISTS permit_issueddatetime_idx ON permit(DATE(issueddatetime));
CREATE INDEX IF NOT EXISTS phila_neighborhoods_idx ON phila_neighborhoods USING GIST(polygon);
CREATE UNIQUE INDEX permit_number_idx ON permit(permitnumber);