CREATE TABLE IF NOT EXISTS students (
  id int(11) unsigned NOT NULL AUTO_INCREMENT,
  sid int(9) unsigned NOT NULL,
  first_name varchar(25) NOT NULL,
  last_name varchar(25) NOT NULL,
  work_phone bigint(11) NOT NULL,
  gender enum('m','f') DEFAULT NULL,
  address varchar(20) NOT NULL,
  city varchar(20) NOT NULL,
  state varchar(2) NOT NULL,
  zip bigint(9) NOT NULL,
  PRIMARY KEY (id,sid)
);
