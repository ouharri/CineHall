<?php
session_start();

use Dotenv\Dotenv;

const DS = DIRECTORY_SEPARATOR;

define("ROOT_PATH", dirname(__DIR__) . DS);
const APP = ROOT_PATH . 'APP' . DS;

const CORE = APP . 'Core' . DS;
const CONFIG = APP . 'Config' . DS;
const CONTROLLERS = APP . 'Controllers' . DS;

const MODELS = APP . 'Models' . DS;
const VIEWS = APP . 'Views' . DS;
const LIBS = APP . 'Libs' . DS;
const VENDOR = APP . 'vendor' . DS;
const PUBLIC_ = ROOT_PATH . 'public' . DS;
const UPLOADS = PUBLIC_ . DS . 'uploads' . DS;

// require configuration & used files
require_once LIBS . 'autoload.php';
require_once CONFIG . 'config.php';
require_once CONFIG . 'healpers.php';
require_once VENDOR . 'autoload.php';

$dotenv = Dotenv::createImmutable(APP);

$dotenv->load();

$modules = [ROOT_PATH, APP, CORE, VIEWS, CONTROLLERS, MODELS, CONFIG, LIBS, VENDOR, UPLOADS];

set_include_path(get_include_path() . PATH_SEPARATOR . implode(PATH_SEPARATOR, $modules));

spl_autoload_register('spl_autoload');

new app();

