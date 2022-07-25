/* CREATE DATABASE campaigns DEFAULT CHARSET = utf8mb4 DEFAULT COLLATE = utf8mb4_unicode_ci; */
USE campaigns;

CREATE TABLE wp_campaigns (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Campaign unique id',
  title VARCHAR(128) NOT NULL DEFAULT '' COMMENT 'Campaign title',
  slug VARCHAR(128) NOT NULL DEFAULT '' COMMENT 'Campaign slug',
  summery VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'Campaign summery',
  image_url VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'Campaign Image URL',
  page_url VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'Campaign webpage URL',
  bitly_url VARCHAR(128) NOT NULL DEFAULT '' COMMENT 'Webpage Bitly URL',
  is_adult TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'is this campaign have adult content',
  create_time DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP() COMMENT 'Time when this campaign added',
  PRIMARY KEY (id)
);

CREATE TABLE wp_images (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique unique id',
  image_url VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'URL of image',
  is_adult TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'is this image have adult visuals',
  PRIMARY KEY (id)
);

CREATE TABLE wp_pages (
  id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique id',
  page_name VARCHAR(128) NOT NULL DEFAULT '' COMMENT 'URL of image',
  page_url VARCHAR(512) NOT NULL DEFAULT '' COMMENT 'URL of image',
  bitly_url VARCHAR(128) NOT NULL DEFAULT '' COMMENT 'Webpage Bitly URL',
  priority TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Priority to redirect this link',
  PRIMARY KEY (id)
);

SELECT * FROM wp_pages ORDER BY Priority DESC, RAND() LIMIT 5;
