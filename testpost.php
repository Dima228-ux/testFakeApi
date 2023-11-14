<?php
namespace testFakeApi;

include "Api\ApiPosts.php";

use testFakeApi\Api\ApiPosts as ApiPosts;

// примеры вызовов
getPost();
updatePost('100','titleTest','bodyTest','5');
addPost('titleTest','bodyTest','5');
deletePost(4);

/**
 * @param null $id
 */
function deletePost($id=null){
    $posts = new ApiPosts();

    $result=$posts->deletePost($id);

    if (!$result) {
        echo('error id!!!');
        exit();
    }

    echo "Post id: " . $id . ' successful deleted'. "\n";


}

/**
 * @param null $id
 * @param null $title
 * @param null $body
 * @param int $user_id
 */
function updatePost($id=null,$title=null,$body=null,$user_id=0){
    if(empty(trim($title))||empty(trim($body))||empty(trim($user_id))||empty(trim($id)) ){
        echo('empty data!!!');
        exit();
    }
    if(!is_numeric($user_id)||!is_numeric($id)){
        echo('error user id or id !!!');
        exit();
    }

    $posts = new ApiPosts();
    $posts->title =$title ;
    $posts->body = $body;
    $posts->user_id =$user_id;
    $posts->id=$id;

    $result=$posts->updatePost();

    if (!$result) {
        echo('error response!!!');
        exit();
    }

    echo "Post id: " . $result['id'] . ' successful updated'. "\n";


}

/**
 * @param null $title
 * @param null $body
 * @param int $user_id
 */
function addPost($title=null,$body=null,$user_id=0)
{
    if(empty(trim($title))||empty(trim($body))||empty(trim($user_id)) ){
        echo('empty data!!!');
        exit();
    }
    if(!is_numeric($user_id)){
        echo('error user id !!!');
        exit();
    }
    $posts = new ApiPosts();
    $posts->title =$title ;
    $posts->body = $body;
    $posts->user_id =$user_id;

    $result = $posts->addPost();

    if (!$result) {
        echo('error response!!!');
        exit();
    }

    echo "New post id: " . $result['id'] . ' successful created'. "\n";

}


function getPost()
{
    $posts = new ApiPosts();
    $result = $posts->get();

    if (!$result) {
        echo('error response!!!');
        exit();
    }

    foreach ($result as $item) {
        echo "\n" . 'User id: ' . $item['userId'] . "\n" . 'Id: ' . $item['id'] . "\n" . 'Title: ' . $item['title'] . "\n" . 'Body: ' . $item['body'] . "\n";
    }

}