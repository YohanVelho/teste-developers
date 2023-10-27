<?php
/* 
 * ESTE ARQUIVO DE SCRIPT É INCLUÍDO EM TODAS AS PÁGINAS, 
 * E POSTERIORMENTE É INCLUÍDO OS SCRIPTS ESPECÍFICOS DE PÁGINAS (home.php, empresa.php)
 * 
 */
 
/*
 * ALGUMAS VARIÁVEIS QUE VOCÊ PODE ALTERAR 
 * 
$_TEMPLATE['nomedavardetemplate'] = 'valor,array,etc';
// variáveis pré definidas (constantes)
$_TEMPLATE['TITLE'] = 'Insira aqui o título do seu site';
$_TEMPLATE['DESCRIPTION'] = 'Insira aqui a descrição do seu site que vai na metatag description';
$_METATAGS = Array(
    'nomedametatag' => 'valor da metatag', 
);
 * 
 */

use App\Connection;
use App\Models\Categories;
use App\Models\Products;

$pdo = new Connection();
$productsTable = new Products($pdo::getDb());
$categoriesTable = new Categories($pdo::getDb());