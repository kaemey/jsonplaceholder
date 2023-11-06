<?php

class jsonplaceholder{

    private $users;
    private $posts;

    public function get($url, $params = array()){
        // $params = array(
        //     'userId'  => '1',
        // );
         
        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        var_dump($response);
        return $response;
    }

    public function put($url, $postFields = array(), $params = array()){

        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, ['Content-Type: application/json; charset=UTF-8']);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function patch($url, $postFields = array(), $params = array()){

        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postFields));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, ['Content-Type: application/json; charset=UTF-8']);
        $response = curl_exec($ch);
        curl_close($ch);
    
        return $response;
    } 

    public function delete($url, $params = array()){         
        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    public function getAllUsers(){
        $data = $this->get("users/");
        $data = json_decode($data, true);
        return $data;
    }

    public function getPostsOfUser($id){
        $data = $this->get("users/$id/posts");
        $data = json_decode($data, true);
        return $data;
    }
    public function getTodosOfUser($id){
        $data = $this->get("users/$id/todos");
        $data = json_decode($data, true);
        return $data;
    }

    public function editPost($id, $postFields){
        $data = $this->put("posts/$id", $postFields);
        return $data;
    }

    public function addPost($id, $postFields){
        $data = $this->patch("posts/$id", $postFields);
        return $data;
    }

    public function deletePost($id){
        $data = $this->delete("posts/$id");
    }

}

$obj = new jsonplaceholder();

echo 'var_dump($obj->getAllUsers());<br>';
var_dump($obj->getAllUsers());
echo "<br>";
echo "<br>";
echo 'var_dump($obj->getPostsOfUser(1));<br>';
var_dump($obj->getPostsOfUser(1));
echo "<br>";
echo "<br>";
echo 'var_dump($obj->getTodosOfUser(1));<br>';
var_dump($obj->getTodosOfUser(1));
echo "<br>";
echo "<br>";
echo 'var_dump($obj->editPost(1,["id"=>1,"title"=>"foo","body"=>"bar","userId"=>1]));<br>';
var_dump($obj->editPost(1,["id"=>1,"title"=>"foo","body"=>"bar","userId"=>1]));
echo "<br>";
echo "<br>";
echo 'var_dump($obj->addPost(1,["id"=>1,"title"=>"foo","body"=>"bar","userId"=>1]));<br>';
var_dump($obj->addPost(1,["id"=>1,"title"=>"foo","body"=>"bar","userId"=>1]));
echo "<br>";
echo "<br>";