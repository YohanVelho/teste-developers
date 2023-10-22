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
$smarty = new Smarty();

$_TEMPLATE['TITLE'] = 'Home';
$_TEMPLATE['DESCRIPTION'] = 'Insira aqui a descrição do seu site que vai na metatag description';
$_METATAGS = array(
    'nomedametatag' => 'valor da metatag',
);


$data = [
    [
        'nome' => 'Produto 1',
        'preco' => '1.000,00 R$',
        'imagem' => 'Produto sem imagem'
    ]
];

$smarty->assign('data', $data);
