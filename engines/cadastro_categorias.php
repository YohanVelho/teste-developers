<?php

$_TEMPLATE['TITLE'] = 'Cadastro de categorias';
$_TEMPLATE['DESCRIPTION'] = '';
$_METATAGS = array(
    'nomedametatag' => '',
);

$data = [];
$file = [];
$category = [
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

    $return = $categorysTable->insertEditCategory($data, $file); 

    if($return){
        //TODO: Mensagem de retorno
    }
}

if(isset($_GET['editar'])){
    $id = $_GET['editar'];

    if($id){
        $category = $categorysTable->getCategoryById($id);
    }
}


$smarty->assign('category', $category);