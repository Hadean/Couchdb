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
 * 	Getting / Displaying my first Article ;)
 */
$article = $connection->getFromUri('articles/Forms-in-ZF-without-Zend-Form');

echo '<h1>' . $article->topic . '</h1>';
echo $article->content;
echo '<h2>Tags:</h2><ul>';
	foreach($article->tags as $tag)
	{
		echo '<li>' . $tag . '</li>';
	}

echo '</ul><h2>Links:</h2><ul>';
	foreach($article->links as $label => $link)
	{
		echo '<li><a href="' . $link . '">' . $label . '</a></li>';
	}
echo '</ul>';