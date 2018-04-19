<?php
if(!session_status()) {
    session_start();
}

require '../database/QueryBuilder.php';
require '../Components/Auth.php';

$db = new QueryBuilder;
// example.com/index.php
// example.com/about.php
// example.com/aboutme
// example.com/contact.php



//КОМПОНЕНТ Auth
$auth = new Auth($db);
//$auth->register('user2@example.com', 'asd');

$auth->login('user2@example.com', 'asd');
$user = $auth->currentUser();
$auth->fullName();

//ТУТ ИДЕТ РОУТИНГ!
$url = $_SERVER['REQUEST_URI']; //aboutme

if($url == '/list') {
   require "../index.php"; exit;
} elseif($url == '/contact') {
    echo "подключен файл contact.php"; exit;
}

echo "404 | ERROR ";
