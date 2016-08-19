<?php
/*
 * Загружаем контент страницы
 */
function loadPage($index, &$pages)
{
    $page = isset($pages[$index]) ? $pages[$index] : false;
    isValid($page); // Проверка валидности страницы
    if (isset($page['isCustom']) && $page['isCustom']) {
        return loadCustomPage($index, $pages); // Отображаем страницу с генерируемым контентом
    } else {
        // Показываем обычную страницу
        return [
            'title' => $page['title'],
            'content' => $page['description']
        ];
    }
}

define('ERROR_NOT_FOUND' ,'ERROR - FILE NOT FOUND');

//Функция генерирования страницы по шаблону

function renderPage($file, $variables = array())
{
    $file = TPL_DIR . '/' . $file . '.html';
    if (!realpath($file)) {
        return ERROR_NOT_FOUND;
    }
    $content = file_get_contents($file);
    foreach ($variables as $key => $value) {
        $key = '{{' . $key . '}}';
        $content = str_replace($key, $value, $content);
    }
    return $content;
}

/*
 * Создаём меню навигации
 */
function generateMenu($currentPage, $pages)
{
    $menu = '';
    foreach ($pages as $url => $data) {
        if ($url !== $currentPage) {
            $link = '<a href="?page=' . $url . '">' . $data['title'] . '</a>';
        } else {
            $link = $data['title'];
        }
        $menu .= '<li>' . $link . '</li>' . "\n";
    }
    return $menu;
}

//Проверка валидности страницы

function isValid($page)
{
    // Если массив пуст или передан не массив - ошибка
    if (!is_array($page) || empty($page)) {
        error404();
    }
}

/*
 * Загружаем страницу из функции
 */
function loadCustomPage($index, &$pages)
{
    $page_function = 'page_' . $index;
    // Если такая функция существует
    if (function_exists($page_function)) {
        // Возвращаем результат её работы
        return $page_function($pages[$index]);
    }
    // Иначе ошибка
     error404();
}

/*
 * Отображаем HTTP-код ошибки
 */
function error404()
{
    header('HTTP/1.0 404 Not Found');
    echo 'Страница не найдена';
    exit;
}

function page_shop($data)
{
    return [
        'title' => $data['title'],
        'content' => 'Здесь будет меню магазина!'
    ];
}


?>
