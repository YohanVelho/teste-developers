<?php

use App\Migrations\Migrations;
use App\Connection;
use App\Models\AppModel;
use App\Models\Products;

require_once(__DIR__.'/config.php');
require_once(__DIR__.'/functions.php');
require_once(__DIR__.'/plugins/form/form.php');
require_once(__DIR__.'/plugins/smarty/libs/Smarty.class.php');
require_once(__DIR__.'/session.php');

// conexão com o banco
require_once(__DIR__.'/app/Connection.php');
$pdo = new Connection();

// migrations
if($_SERVER['REQUEST_URI'] === '/migrate'){
    require_once(__DIR__.'/app/Migrations/Migrations.php');
    $migration = new Migrations();
}

//Models
require_once(__DIR__.'/app/Models/AppModel.php');
$appModel = new AppModel($pdo->getDb());

require_once(__DIR__.'/app/Models/Products.php');
$productsTable = new Products($pdo->getDb());

ini_set('register_globals', 0);
ini_set('display_errors', DISPLAY_ERRORS);
ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");
error_reporting(E_ALL);
setlocale(LC_ALL, 'pt_BR');
date_default_timezone_set('America/Sao_Paulo');
// error_reporting(~E_DEPRECATED);

// TRATAMENTO DE URL AMIGÁVEL
if(isset($_GET['friendlyUrl'])){
    $friendlyUrl = explode('/',$_GET['friendlyUrl'],10);
    $_GET = array_merge($_GET,$friendlyUrl);
    unset($_GET['friendlyUrl']);
}

// converter parametros de entrada para utf-8
$_GET = utf8_converter($_GET);
$_POST = utf8_converter($_POST);
$_REQUEST = utf8_converter($_REQUEST);
$_PAGE = (isset($_GET[0]) && $_GET[0])? $_GET[0] : 'home';
$_TEMPLATE = Array();
$_TEMPLATE['BASE_DIR'] = getExistentUrlPath();
$_TEMPLATE['URL_VARS'] = parse_url(currentURL());
$_TEMPLATE['TITLE'] = TAGNAME;
$_TEMPLATE['DESCRIPTION'] = TAGNAME;

// METATAGS
$_METATAGS = Array(
    'keywords' => '',
);

$smarty = new Smarty();
// ENGINE
if(file_exists('engines/global.php')){
    include_once('engines/global.php');
}
if(file_exists('engines/'.$_PAGE.'.php')){
    include_once('engines/'.$_PAGE.'.php');
}

// TEMPLATE
$_TEMPLATE['GET'] = $_GET;//retorna o get pro template
$_TEMPLATE['POST'] = $_POST;//retorna o post pro template
$_TEMPLATE['REQUEST'] = $_REQUEST;//retorna o post pro template
$_TEMPLATE['URL'] = currentURL();
$_TEMPLATE['URL_ENCODED'] = urlencode(urlencode(currentURL()));
$_TEMPLATE['PAGE'] = $_PAGE;
$_TEMPLATE['TITLE'] = (isset($TITLE))? $TITLE : $_TEMPLATE['TITLE'];
$_TEMPLATE['METATAGS'] = (isset($_METATAGS))? $_METATAGS : false;
$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates/compiled/';
$smarty->registerPlugin('modifier', 'seoText', 'generateSeoName');
$smarty->registerPlugin('modifier', 'removeQueryString', 'removeQueryString');
// assimilar variáveis do template
if(isset($_TEMPLATE) && $_TEMPLATE){
    foreach ($_TEMPLATE as $key => $value) {
        $smarty->assign($key,$value);
    }
}
// incluir página do template
if($_PAGE && file_exists('templates/'.$_PAGE.'.html')){
    $smarty->display($_PAGE.'.html');
}else{
    header('HTTP/1.0 404 Not Found');
    if(file_exists('engines/404.php')){
        include_once('engines/404.php');
    }
    if(file_exists('templates/404.html')){
        $smarty->display('templates/404.html');
    }else{
        echo "<h1>404 Not Found</h1>";
    }
}
