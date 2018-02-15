<?php

define('DSN', 'mysql:host=localhost;dbname=poll');
define('DB_USERNAME', 'dbuser');
define('DB_PASSWORD', 'pass');

session_start();

require_once(__DIR__ . '/functions.php');