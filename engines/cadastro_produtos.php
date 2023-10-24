<?php 

$data = [];
$file = [];

if(!empty($_POST)){
    $data = $_POST;
    print_r($_POST);
}
if(!empty($_FILES)){
    $file = $_FILES;
}

if($data || $file){
    $return = $productsTable->insertProduct($pdo, $data, $file); 
    if($return){
        //TODO: Mensagem de retorno
    }
}

if(!empty($_GET)){

    $id = $_GET['product_id'];

}