<?php

$dbfile = dirname(__FILE__)."/var/guestbook.sqlite3";
if(!file_exists($dbfile)){
	touch($dbfile);
}

if(!is_writable(dirname($dbfile))){
	echo 'DB file folder should be writeable '. dirname($dbfile);
	exit();
}
else if(!is_writable($dbfile)){
	echo 'DB file should be writeable '. $dbfile;
	exit();
}

if (version_compare(phpversion(), '5.3.0', '<')) {
	echo 'PHP version should be older than 5.3.0';
	exit();
}

$filestorage = new \PDO("sqlite:".$dbfile);
$filestorage->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//unset($_SESSION);
//$filestorage->exec("DROP TABLE person;");
//$filestorage->exec("DROP TABLE message;");
$filestorage->exec(
	"CREATE TABLE IF NOT EXISTS `person` (
              `id` INTEGER PRIMARY KEY,
              first_name TEXT,
              last_name TEXT,
              email TEXT,
              password TEXT,
              created INTEGER)"
);

$refFix= "REFERENCES person(id)";
$filestorage->exec(
	"CREATE TABLE IF NOT EXISTS `message` (
              `id` INTEGER PRIMARY KEY,
              `text` TEXT,
              `person_id` INTEGER $refFix,
              `created` INTEGER);"
);