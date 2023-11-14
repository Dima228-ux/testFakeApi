<?php
include "Api\ApiUser.php";

use testFakeApi\Api\ApiUser as ApiUser;

getUser();

function getUser()
{
    $user=new ApiUser();
    $result=$user->get();

    if (!$result) {
        echo('error response!!!');
        exit();
    }

    foreach ($result as $item) {
        echo "\n" . 'User id: ' . $item['id'] . "\n" . 'Name: ' . $item['name'] . "\n" . 'Username: ' . $item['username'] . "\n" . 'Email: ' . $item['email']. "\n" . 'Phone: ' . $item['phone'] . "\n";
    }
    exit();
}