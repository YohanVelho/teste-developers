<?php

$_TEMPLATE['TITLE'] = 'Cadastro de produtos';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

if($_POST){
    $return = $productsTable->insertEditProduct($_POST); 

    if($return){
        $smarty->assign('return_message', $return);
    }
    header("refresh:2;url=/?friendlyUrl=cadastro_produtos");
}

if(isset($_GET['editar']) && !empty($_GET['editar'])){
    $id = $_GET['editar'];
    $product = $productsTable->getProductById($id);
    $smarty->assign('activeChecked', $product['active'] == 1 ? 'checked="checked"' : false);
}

$smarty->assign('product', $product ?? []);