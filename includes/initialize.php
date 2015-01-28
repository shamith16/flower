<?php

// Define the core paths
// Define them as absolute paths to make sure that require_once works as expected

// DIRECTORY_SEPARATOR is a PHP pre-defined constant
// (\ for Windows, / for Unix)
defined('DS')?null:define('DS',DIRECTORY_SEPARATOR);
defined('PO')?null:define('PO','/');
defined('SITE_ROOT')?null:define('SITE_ROOT',realpath(dirname(__FILE__) . '/..').DS);
defined('LIB_PATH')?null:define('LIB_PATH',SITE_ROOT.'includes'.DS);


// load config file first
require_once(LIB_PATH.'config.php');

// load basic functions next so that everything after can use them
require_once(LIB_PATH.DS.'functions.php');

// load core objects
require_once(LIB_PATH.'session.php');
require_once(LIB_PATH.'database.php');
require_once(LIB_PATH.'database_object.php');
require_once(LIB_PATH.'pagination.php');
require_once(LIB_PATH."phpMailer".DS."class.phpmailer.php");
//require_once(LIB_PATH."phpMailer".DS."class.smtp.php");
require_once(LIB_PATH."phpMailer".DS."language".DS."phpmailer.lang-en.php");

// load database-related classes
require_once(LIB_PATH.'user.php');
require_once(LIB_PATH.'photograph.php');
require_once(LIB_PATH.'comment.php');
require_once(LIB_PATH.'category.php');
require_once(LIB_PATH.'catalog.php');
require_once(LIB_PATH.'procatalog.php');

?>