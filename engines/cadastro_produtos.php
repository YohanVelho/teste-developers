<?php

$_TEMPLATE['TITLE'] = 'Cadastro de produtos';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

$data = [];
$product = [
    'id' => 0,
    'active' => 0,
    'code' => '',
    'name' => '',
    'value' => 0,
];

if(!empty($_POST)){
    $data = $_POST;
}

if($data){
    $return = $productsTable->insertEditProduct($data); 

    if($return){
        $smarty->assign('return_message', $return);
    }
}

if(isset($_GET['editar'])){
    $id = $_GET['editar'];

    if($id){
        $product = $productsTable->getProductById($id);
        $checked = $product['active'] === 1 ? 'checked' : '';
        $smarty->assign('checked', $checked);
    }
}

$smarty->assign('product', $product);