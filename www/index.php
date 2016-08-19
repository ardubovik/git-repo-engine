<?php

require_once('../config.php');
require_once('../data/pages.php');

$page = isset($_GET['page']) ? $_GET['page'] : key($pages);
$content = loadPage($page, $pages);

//$data['MENU'] = generateMenu($page, $pages);

echo renderPage('index', $content);


//Разбор массива меню
$menu ='';
foreach ($pages as $url => $data) {
    $vars = [
        'URL' => $url,
        'TITLE' => $data['title']
    ];
    $menu .= renderPage('menu_item', $vars);
}

//Массив контента(шапка, контент, меню)
$data = [
    'TITLE' => $title,
    'CONTENT' => $content,
    'MENU' => $menu
];


/*Доделать данный вариант - переделать меню, разобраться с сылками, сделать кэширование страниц...*/

?>
