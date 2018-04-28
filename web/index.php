<?php

if(!session_status()) {
    session_start();
}

require "../vendor/autoload.php";

use App\QueryBuilder;
use App\Auth;

$db = new QueryBuilder;
$auth = new Auth($db);


//ТУТ ИДЕТ РОУТИНГ!
$url = $_SERVER['REQUEST_URI']; //asdasdasdsdad M V C

// Front Controller
if($url == '/awdawd') {
   require "../awdawdawdhp"; exit;
} elseif($url == '/awdawd') {
    echo "подключен файл contact.php"; exit;
}

echo "404 | ERROR ";

//  Routing example.com/about-us
    // Dispatcher
//  View / header footer section
//  MVC Structure / C
// DB ?
// Aura.sqlQuery  packagist.org
//



// delight-im/Auth packagist.org

//Cart
    // add
    // remove
    // total

// Auth
    //register
    //login
    //...

// Post
    //add(title,description, image)
//        title = $_POST
//        description = $_POST
//        image = $manager->upload($image) 'uploads/image.png';
        // ImageManager
            // uploads($image) return 'uploads/image.png';
    //remove
    //edit
