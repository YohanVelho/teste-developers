<?php

use form\form;

$_TEMPLATE['TITLE'] = 'Cadastro de produtos';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

$data = [];

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
    }
}

$smarty->assign('product', $product ?? []);

$form = new form();

$form->addField('id',[
    'type' => 'hidden',
    'required' => true,
]);
$form->addField('code',[
    'label' => 'Código',
    'placeholder' => 'Código',
    'type' => 'text',
    'required' => true,
]);
$form->addField('category',[
    'label' => 'Categoria',
    'placeholder' => 'Categoria',
    'type' => 'text',
    'required' => true,
]);
$form->addField('name',[
    'label' => 'Nome',
    'placeholder' => 'Nome',
    'type' => 'text',
    'required' => true,
]);
$form->addField('value',[
    'label' => 'Preço',
    'placeholder' => 'Preço',
    'type' => 'decimal',
    'required' => true,
]);

$smarty->assign('form', $form);