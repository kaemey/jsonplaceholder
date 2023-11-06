<?php

class jsonplaceholder{

    private $users;
    private $posts;

    private function get($url, $params = array()){
        // $params = array(
        //     'userId'  => '1',
        // );
         
        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    private function put($url, $postFields = array(), $params = array()){

        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

    private function patch($url, $postFields = array(), $params = array()){

        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
    
        return $response;
    } 

    private function delete($url, $params = array()){         
        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
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
        $data = json_decode($data, true);
        return $data;
    }

    public function addPost($id, $postFields){
        $data = $this->patch("posts/$id", $postFields);
        $data = json_decode($data, true);
        return $data;
    }

    public function deletePost($id){
        $data = $this->delete("posts/$id");
    }

}

$obj = new jsonplaceholder();

echo '<h2>foreach($obj->getAllUsers() as $user)</h2>';
foreach($obj->getAllUsers() as $user){
    echo "<p>";
    var_dump($user);
    echo "</p>";
}
echo '<h2>foreach($obj->getPostsOfUser(1) as $post)</h2>';
foreach($obj->getPostsOfUser(1) as $post){
    echo "<p>";
    var_dump($post);
    echo "</p>";
}

echo '<h2>foreach($obj->getTodosOfUser(1) as $todo)</h2>';
foreach($obj->getTodosOfUser(1) as $todo){
    echo "<p>";
    var_dump($todo);
    echo "</p>";
}
echo '<h2>var_dump($obj->editPost(1,["id"=>1,"title"=>"foo","body"=>"bar","userId"=>1]));</h2>';
echo "<p>";
var_dump($obj->editPost(1,["id"=>1,"title"=>"foo","body"=>"bar","userId"=>1]));
echo "</p>";
echo "<p>";
echo '<h2>var_dump($obj->addPost(1,["id"=>1,"title"=>"jsonplaceholder","body"=>"jsonplaceholder","userId"=>1]));</h2>';
var_dump($obj->addPost(1,["id"=>'1',"title"=>"jsonplaceholder","body"=>"jsonplaceholder","userId"=>1]));
echo "</p>";