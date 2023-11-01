<?php

$_TEMPLATE['TITLE'] = 'Cadastro de produtos';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

$data = $_POST;
if($data){
    $return = $productsTable->insertEditProduct($data); 

    if($return){
        $smarty->assign('return_message', $return);
    }
}

if(isset($_GET['editar']) && !empty($_GET['editar'])){
    $id = $_GET['editar'];
    $product = $productsTable->getProductById($id);
    $smarty->assign('activeChecked', $product['active'] == 1 ? 'checked="checked"' : false);
}

$smarty->assign('product', $product ?? []);