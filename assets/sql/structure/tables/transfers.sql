CREATE TABLE IF NOT EXISTS transfers (
  id int(11) NOT NULL AUTO_INCREMENT,
  sid int(9) NOT NULL,
  inst_id varchar(15) NOT NULL,
  date_entered date NOT NULL,
  received tinyint(1) NOT NULL,
  receiver varchar(255) NOT NULL,
  PRIMARY KEY (id,sid)
);
