-- @author Matthew McNaney <mcnaney at gmail dot com>
-- @version $Id: install.sql 5919 2008-06-04 15:44:22Z matt $

CREATE TABLE webpage_volume (
  id int NOT NULL default 0,
  key_id int NOT NULL default 0,
  title varchar(255) NOT NULL,
  summary text,
  date_created int NOT NULL default 0,
  date_updated int NOT NULL default 0,
  create_user_id int NOT NULL default 0,
  created_user varchar(40) NOT NULL,
  update_user_id int NOT NULL default 0,
  updated_user varchar(40) NOT NULL,
  frontpage smallint NOT NULL default 0,
  approved smallint NOT NULL default 0,
  active smallint NOT NULL default 0,
  PRIMARY KEY  (id)
);

CREATE INDEX webpagevolume_idx on webpage_volume(key_id);

CREATE TABLE webpage_page (
  id int NOT NULL default 0,
  volume_id int NOT NULL default 0,
  title varchar(255) NULL,
  content text NOT NULL,
  page_number smallint NOT NULL default 0,
  template varchar(40) NOT NULL,
  approved smallint NOT NULL default 0,
  image_id int NOT NULL default 0,
  PRIMARY KEY  (id)
);

CREATE INDEX webpagepage_idx on webpage_page(volume_id);

CREATE TABLE webpage_featured (
  id int NOT NULL default 0,
  vol_order int NOT NULL default 0
);
