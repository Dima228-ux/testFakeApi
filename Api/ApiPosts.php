<?php


namespace testFakeApi\Api;

include 'Api.php';

/**
 * Class ApiPosts
 * @package testFakeApi\Api
 */
class ApiPosts extends Api
{
    const BASE_URL = 'https://jsonplaceholder.typicode.com/posts';

    public $body;
    public $title;
    public $user_id;
    public $id;

    /**
     * @return false|mixed
     */
    public function get()
    {

        $ch = curl_init(self::BASE_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch)['http_code'];
        curl_close($ch);

        if ($status == 200) {
            return json_decode($result, true);
        }
        return false;
    }

    /**
     * @return false|mixed
     */
    public function addPost()
    {
        $post = array(
            'body' => $this->body,
            'title' => $this->title,
            'userId' => $this->user_id,
        );

        $ch = curl_init(self::BASE_URL);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post, JSON_UNESCAPED_UNICODE));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch)['http_code'];
        curl_close($ch);


        if ($status == 201) {
            return json_decode($result, true);
        }
        return false;
    }

    /**
     * @return false|mixed
     */
    public function updatePost()
    {
        $post = array(
            'body' => $this->body,
            'title' => $this->title,
            'userId' => $this->user_id,
            'id' => $this->id,
        );

        $ch = curl_init(self::BASE_URL . '/' . $this->user_id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post, '', '&'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        $status = curl_getinfo($ch)['http_code'];
        curl_close($ch);

        if ($status == 200) {
            return json_decode($result, true);
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function deletePost($id)
    {
         if(!is_numeric($id)){
             return false;
         }

        $ch = curl_init(self::BASE_URL.'/'.$id);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_close($ch);

        return true;
    }

}