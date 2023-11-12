<?php
namespace App;
use App\Configs\Database\DatabaseConfig;
use App\Uploader;
use App\Http\Database\Database;
use App\Http\Controllers\IndexController;

class App{
    public static function run(){
        session_start();
        //Конфиг базы данных
        $config = new DatabaseConfig;
        //Базы данных
        $db = new Database($config);
        //Загрузчик данных, использует Базу данных
        $uploader = new Uploader($db);

        //Функция для загрузки постов
        $uploader->uploadePosts();
        //Функция для загрузки комментариев
        $uploader->uploadComments();
        //Функция для вывода сообщения
        $uploader->echoMessage();

        $controller = new IndexController($db);
        $controller->index();
    }
}