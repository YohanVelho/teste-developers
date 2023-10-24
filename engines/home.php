<?php

/*
 * este é um script php que será incluído
 * este script especificamente será incluído na página principal (home)
 * crie scripts com o nome da página: minhapagina.php
 * que automaticamente será incluído na página determinada
 * 
 * há a possibilidade de criar um script global, qeu é incluído em todas as páginas: global .php
 * 
 */

use App\Connection;
use App\Models\Products;

$smarty = new Smarty();

$_TEMPLATE['TITLE'] = 'Home';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);


$smarty->assign('products', $productsTable->getProducts());