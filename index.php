<?php
/**
 * OpenGuestBook - a simple, self built, partial ORM-based & MVC layered guestbook application
 * Uses SqlLite3 filesystem database in var/guestbook.sqlite3
 *
 * @author Artjom Kurapov <artkurapov@gmail.com>
 * @copyright Artjom Kurapov <artkurapov@gmail.com>
 */
error_reporting(E_ALL);
date_default_timezone_set('UTC');
session_start();

require_once 'install.php';

//todo add autloading here
require_once 'controller.php';
require_once 'storage/storage.php';
require_once 'storage/storablemodel.php';
require_once 'storage/sqlite3genericmodel.php';
require_once 'storage/filestorage.php';
require_once 'entity.php';
require_once 'entity/message.php';
require_once 'entity/person.php';

$filestorage = new \PDO("sqlite:" . $dbfile);
$filestorage->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$controllerName = isset($_GET['c']) ? $_GET['c'] : 'guestbook';
$method         = isset($_GET['m']) ? $_GET['m'] : 'index';

if(in_array($controllerName, array('guestbook', 'user'))) {
	require_once 'controller/' . $controllerName . '.php';
	$controllerClass = '\OGB\Controller\\' . ucfirst($controllerName);

	/**
	 * @var \OGB\Controller $controller
	 */
	$controller = new $controllerClass();
	$controller->useStorage($filestorage);


	if(method_exists($controller, $method)) {
		$controller->$method();
	}
	else {
		header('HTTP/1.0 404 Not Found');
	}
}
else {
	header('HTTP/1.0 404 Not Found');
}