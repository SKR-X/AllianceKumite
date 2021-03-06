<?php

/** 
 * Github: https://github.com/SKR-X
 * Project: MVC_PHP
 * Version: V1.0
*/

session_start();

require_once '../config/Config.php';

require_once ROOT.'/vendor/composer/autoload_classmap.php';

require_once ROOT.'/vendor/autoload.php';

// require_once ROOT.'/app/components/router.php';

use App\Components\Router as Router;

// Обращаемся к Роутеру

Router::run();

?>