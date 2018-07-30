<?php

require_once('DB_driver.php');

if (!isset($query_builder) OR $query_builder === TRUE) {
	require_once('DB_query_builder.php');
	if (!class_exists('CI_DB', FALSE)) {
		class CI_DB extends CI_DB_query_builder { }
	}
}
elseif (!class_exists('CI_DB', FALSE)) {
	class CI_DB extends CI_DB_driver { }
}

function &DB($params) {
	$dbdriver = $params['dbdriver'];
	require_once($dbdriver . '/' . $dbdriver .'_driver.php');
	$driver = 'CI_DB_' . $dbdriver . '_driver';
	$db = new $driver($params);
	$db->initialize();
	return $db;
}

function is_php($version)
{
	static $_is_php;
	$version = (string) $version;

	if ( ! isset($_is_php[$version]))
	{
		$_is_php[$version] = version_compare(PHP_VERSION, $version, '>=');
	}

	return $_is_php[$version];
}
