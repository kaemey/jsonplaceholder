<?php
namespace App\Http\Controllers;

class IndexController extends Controller{
    public function index(){
        
        if(isset($_POST['body']) && strlen($_POST['body']) > 3){
            $data = $this->db->find('comments', ['body' => '%'.$_POST['body'].'%']);
        }

        foreach($data as $comment){
            echo "<h3>".$comment['name']."</h3>";
            echo "<h4>".$comment['body']."</h4>";
        }

    }

}