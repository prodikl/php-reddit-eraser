<?php
/**
 * Created by PhpStorm.
 * User: KeithDesktop
 * Date: 9/20/2017
 * Time: 6:37 PM
 */

require("./vendor/autoload.php");

session_start();

$username = "prodikl";
$clientId = "7TStDThwNM4XuQ";
$clientSecret = "Q8QbRXOUdBslK6pUPgt-86LfbuM";
$callbackUrl = "http://localhost/php-reddit-eraser";

$reddit = new RedditPhp($clientId, $clientSecret);
if(!$reddit->isAuthorized($callbackUrl)){
    $reddit->login($callbackUrl);
} else {
    $comments = $reddit->getHistory($username, "comments");
    var_dump($comments);
}


