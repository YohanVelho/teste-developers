<?php

use form\form;

$_TEMPLATE['TITLE'] = 'Cadastro de produtos';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

$data = [];
$file = [];
$product = [
    'id' => 0,
    'code' => '',
    'name' => '',
    'value' => 0,
];

if(!empty($_POST)){
    $data = $_POST;
    print_r($_POST);
}
if(!empty($_FILES)){
    $file = $_FILES;
}

if($data || $file){
    if($data['id']){
        $return = $productsTable->editProduct($pdo, $data, $file); 
    }else{
        $return = $productsTable->insertProduct($pdo, $data, $file); 
    }
    if($return){
        //TODO: Mensagem de retorno
    }
}

if(isset($_GET['editar'])){
    $id = $_GET['editar'];

    if($id){
        $product = $productsTable->getProductById($id);
    }
}

if(isset($_GET['excluir'])){
    $id = $_GET['excluir'];

    if($id){
        $product = $productsTable->deleteQuery('products', $id);
    }
}

$smarty->assign('product', $product);