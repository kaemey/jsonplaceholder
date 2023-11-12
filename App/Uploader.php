<?php
namespace App;
use App\Http\Database\Database;

class Uploader{
    protected Database $db;
    protected string $message;

    public function __construct(Database $db){
        $this->message = "";
        $this->db = $db;
    }
    private function get(string $url, $params = array()){

        // $params = array(
        //     'userId'  => '1',
        // );
        
        $ch = curl_init("https://jsonplaceholder.typicode.com/".$url. http_build_query($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public function getPosts(){
        return self::get("posts");
    }

    public function getComments(){
        return self::get("comments");
    }

    public function  uploadePosts(){
        $postsCont = 0;
        $posts = self::getPosts();
        //Перебираем все посты с jsonplaceholder и по одному грузим в базу
        foreach($posts as $post){
            $data = [
                'userId' => $post['userId'],
                'title' => $post['title'],
                'body' => $post['body'],
            ];
            if ($this->db->insert("posts", $data)){
                $postsCont++;
            }
        }
        $this->message .= "Загружено $postsCont записей<br>";
    }

    public function  uploadComments(){
        $commentsCont = 0;
        $comments = self::getComments();
        //Перебираем все комментарии с jsonplaceholder и по одному грузим в базу
        foreach($comments as $comment){
            $data = [
                'postId' => $comment['postId'],
                'name' => $comment['name'],
                'email' => $comment['email'],
                'body' => $comment['body'],
            ];
            
            if ($this->db->insert("comments", $data)){
                $commentsCont++;
            }
        }
        $this->message .= "Загружено $commentsCont комментариев<br>";
    }

	public function echoMessage(): void {
		echo $this->message;
	}
}