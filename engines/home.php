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

$_TEMPLATE['TITLE'] = 'Home - Listagem de produtos';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

if(isset($_GET['excluir'])){
    $id = $_GET['excluir'];

    if($id){
        $return = $productsTable->deleteQuery('products', ['id' => $id]);
        if($return){
            $smarty->assign('return_message', $return);
        }
    }
}

$products = $productsTable->getProducts();
foreach($products as $key => $product){
    /**
     * Trata os campos active e category para exibir corretamente.
     */
    $products[$key]['active'] = $product['active'] == 1 ? 'Produto ativo' : 'Produto inativo';
    $products[$key]['category'] = ucfirst( str_replace('-', ' ', $product['category'])) ?: '-';
}

$smarty->assign('products', $products);