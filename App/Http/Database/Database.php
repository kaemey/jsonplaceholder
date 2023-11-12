<?php
namespace App\Http\Database;
use PDO;
use App\Configs\Database\DatabaseConfig;
use PDOException;

class Database{

    private PDO $connection;
    public function __construct(DatabaseConfig $config){
        //Подключаемся к БД
        $this->connection = new PDO("mysql:dbname=".$config->getDbname().";host=".$config->getHost(), $config->getLogin(), $config->getPass());
    }

    public function insert(string $table, array $data): bool{
        //Разбиваем на ключи data
        $fields = array_keys($data);
        //Делаем колонки
        $colums = implode(', ',$fields);
        //Делаем бинды
        $binds =  implode(', ', array_map(fn ($field) => ":$field", $fields));
        //Объединяем в SQL запрос
        $sql = "INSERT INTO ".$table." ($colums) VALUES ($binds)";
        
        $stmt = $this->connection->prepare($sql);

        try {
            $stmt->execute($data);
        } catch (PDOException $error) {
            echo $error."<br>";
            return false;
        }
        
        return true;
        
    }

    public function find(string $table, array $data){
        $fields = array_keys($data);
        //Делаем колонки
        $binds =  implode(' AND ', array_map(fn ($field) => "$field LIKE :$field", $fields));
        $sql = "SELECT * FROM ".$table." WHERE $binds";
        $stmt = $this->connection->prepare($sql);
        $result = null;

        try {
            $stmt->execute($data);
            $result = $stmt->fetchAll();
        } catch (PDOException $error) {
            echo $error;
        }
        
        return $result;
    }
    
}