<?php
//Массив меню
$pages = [];
$pages['index'] = [
    'title' => 'Главная',
    'description' => 'Опиание главной страницы'
];
$pages['about'] = [
    'title' => 'О сайте',
    'description' => 'Информация о сайте и рабработке'
];
$pages['shop'] = [
    'title' => 'Магазин',
    'isCustom' => true
];

function page_users($data)
{
    require_once('users.php');
    // $users у нас подключена прямо в функции (выше)

    addUser([
        'name' => 'Will'
    ], $users);
    addUser([
        'name' => 'John',
        'additional' => 'I love PHP'
    ], $users);
    $content = '<ul>';

    foreach ($users as $user) {
        $userInfo = getUserInfo($user);
        if ($userInfo) { // Если удалось получить информацию о пользователе
            $content .= '<li>' . $userInfo . '</li>';
        }
    }
    $content .= '</ul>';
    return [
        'title' => $data['title'],
        'content' => $content
    ];
}
/*
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
];*/




?>