<?php


namespace testFakeApi\Api;

include 'Api.php';

/**
 * Class ApiTodos
 * @package testFakeApi\Api
 */
class ApiTodos extends Api
{
    const BASE_URL = 'https://jsonplaceholder.typicode.com/todos';

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
}