USE otter

CREATE TABLE IF NOT EXISTS wobjects (
    id INT NOT NULL AUTO_INCREMENT,
    scientificname VARCHAR(255) NOT NULL,
    latitude DECIMAL(10 , 2 ) NOT NULL,
    longitude DECIMAL(10 , 2 ) NOT NULL,
    PRIMARY KEY (id)
);

LOAD DATA LOCAL INFILE '/var/lib/mysql-files/otters.tsv' REPLACE INTO TABLE otter.wobjects(scientificname, latitude, longitude);

