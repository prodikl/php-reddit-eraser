<?php
/**
 * Created by PhpStorm.
 * User: KeithDesktop
 * Date: 9/20/2017
 * Time: 6:37 PM
 */

require("./vendor/autoload.php");

//phpinfo(); die;

session_start();

$username = "prodikl";
$clientId = "UIuSqvijmHRmOQ";
$clientSecret = "zXHqrSzmj62SuQcemEyeM4u_wFY";
$callbackUrl = "http://localhost/php-reddit-eraser";

$reddit = new RedditPhp($clientId, $clientSecret);
if(!$reddit->isAuthorized($callbackUrl)){
    $reddit->login($callbackUrl);
} else {
    $user = $reddit->getUser();

    echo $user;
    //print_r($user);
    //var_dump($user);

    //$comments = $reddit->getHistory($username, "overview");
    //var_dump($comments);
}


