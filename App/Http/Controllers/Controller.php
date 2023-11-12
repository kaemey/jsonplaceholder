<?php
namespace App\Http\Controllers;
use App\Http\Database\Database;

class Controller{
    protected Database $db;
    public function __construct($db){
       $this->db = $db;
    }
}