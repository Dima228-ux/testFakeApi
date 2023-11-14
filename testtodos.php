<?php
include "Api\ApiTodos.php";

use testFakeApi\Api\ApiTodos as ApiTodos;

getTodos();

function getTodos()
{
    $todos=new ApiTodos();
    $result=$todos->get();

    if (!$result) {
        echo('error response!!!');
        exit();
    }

    foreach ($result as $item) {
        $complete=$item['completed']>0 ? 'true':'false';
        echo "\n" . 'User id: ' . $item['userId'] . "\n" . 'Id: ' . $item['id'] . "\n" . 'Completed: ' . $complete . "\n";
    }
    exit();
}