<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

if(! isset($main_folder)) $main_folder = '';

/**
 * Inclure toutes les classes utilisées
 * @param $folder
 */
function requireByFolder($folder){
    global $main_folder;
    $skip = ['.', '..', 'PHPMailer'];
    $classes = scandir($main_folder.$folder);
    foreach ($classes as $class){
        if (in_array($class,  $skip)) continue;
        require_once $main_folder."$folder/" . $class .'';
    }
}

requireByFolder('vendor');
requireByFolder('models');

// middleware pour sécurité
if(in_array(Request::requestPage(), ['config', 'header', 'footer']))
    Router::redirect('login');

// configuration des constantes
define("APP_NAME", "ConfApp");
define("APP_ID", "context_id");
define("APP_ADMIN_ID", 'context_admin_id');
define("APP_URL", "http://localhost/conference");
define("COPYRIGHT", "Bouchra NECHCHACH");
define("DATABASE", "database");
define("DATABASE.ADMIN", DATABASE . "/admins");
define("DATABASE.GUEST", DATABASE . "/guests");
