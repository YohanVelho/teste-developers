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
}
if(!empty($_FILES)){
    $file = $_FILES;
}

if($data || $file){

    $return = $productsTable->insertEditProduct($data, $file); 

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


$smarty->assign('product', $product);