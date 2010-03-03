<?php 

/**
 * 	Inclusion
 */
set_include_path(get_include_path() . ':./Couchdb');

/**
 * 	Setting up Zend Framework Autoloading
 */
require_once 'Zend/Loader/Autoloader.php';
$singleton = Zend_Loader_Autoloader::getInstance();

/**
 * 	Registering the Namespace
 */
$singleton->registerNamespace('Couchdb_');

/**
 * 	Setting up the Configuration to the CouchAccess, its just local TestData ;)
 */
$config = new Couchdb_Config;
$config->setHost('localhost')
	   ->setPort(5984)
	   ->setUsername('subroot')
	   ->setPassword('lalalala');

/**
 * 	Instanciating the Adapter Class with its Configuration
 */
$connection = new Couchdb_Adapter($config);

/**
 * 	Getting / Displaying some dummy Document
 */
$article = $connection->getFromUri('asdf/a87b6ffb6bfc378c2e6b9c2a0ea67fb2');

var_dump($article);

/**
 * 	Getting / Displaying some dummy Document in a certain revision Number
 */
$article = $connection->getFromUri('asdf/a87b6ffb6bfc378c2e6b9c2a0ea67fb2', 
								   '1-1e46414eef8a42378aff8fe4ee2b5191');

var_dump($article);