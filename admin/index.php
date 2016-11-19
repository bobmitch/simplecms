<?php

// this file solely exists to bootstrap the CMS when /admin is called without /admin/home
	
ini_set('display_errors', 1); error_reporting(E_ALL); ini_set('error_reporting', E_ALL);	

// line below only works in php 7
//define ("CMSPATH", realpath(dirname(__FILE__, -2))); // note -2- gives level up from directory - admin should always be sub folder of main cms 
define ("CMSPATH", dirname(__DIR__)); // this works in all versions of php
define ("ADMINPATH", realpath(dirname(__FILE__))); 
define('DS',DIRECTORY_SEPARATOR);

require_once (CMSPATH . DS . "core/cms.php");

$CMS = CMS::Instance();

$CMS->render();