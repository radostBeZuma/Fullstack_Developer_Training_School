<?php

session_start();
ini_set('error_reporting', E_ALL);

// ini_set('upload_max_filesize', '10M');
// ini_set('post_max_size', '10M');

define("ROOT", $_SERVER['DOCUMENT_ROOT']);
define("CONTROLLER_PATH", ROOT. "/controllers/");
define("MODEL_PATH", ROOT. "/models/");
define("VIEW_PATH", ROOT. "/views/");

require_once("db.php");
require_once("route.php");

require_once CONTROLLER_PATH. 'Controller.php';
require_once MODEL_PATH. 'Model.php';
require_once VIEW_PATH. 'View.php';


Routing::buildRoute();