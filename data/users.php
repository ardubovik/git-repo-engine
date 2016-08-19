<?php
$users = [
    [
        'name' => 'Alex',
        'email' => 'alex@domain.com',
        'age' => 35
    ],
    [
        'name' => 'George',
        'age' => 18,
        'additional' => 'Hello, world!',
    ],
    [
        'name' => 'Kate',
        'age' => 25,
        'email' => 'kate@example.com',
        'additional' => 'I like geekbrains!'
    ]
];

function addUser($data, &$users)
{
    // Имя должно быть обязательно!
    if (isset($data['name'])) {
        $user = [
            'name' => $data['name']
        ];
        if (isset($data['age'])) {
            $user['age'] = $data['age'];
        }
        if (isset($data['email'])) {
            $user['email'] = $data['email'];
        }
        if (isset($data['additional'])) {
            $user['additional'] = $data['additional'];
        }
        $users[] = $user;
    }
}

function getVarAlias($key)
{
    $aliases = [];
    $aliases['name'] = 'Имя';
    $aliases['email'] = 'Электропочта';
    $aliases['age'] = 'Возраст';
    $aliases['additional'] = 'Дополнительно';

    return isset($aliases[$key]) ? $aliases[$key] : false;
}

function getUserInfo(&$user)
{
    if (!is_array($user) || empty($user)) {
        return false;
    }
    $output = '<ul>';
    foreach ($user as $key => $value) {
        if (($varAlias = getVarAlias($key)) != false) {
            $output .= '<li>' . $varAlias . ': ' . $value . '</li>';
        }
    }
    $output .= '</ul>';
    return $output;
}

?>