<?php
namespace App\Configs\Database;

class DatabaseConfig {
    protected $dbname;
    protected $host;
    protected $login;
    protected $pass;
    public function __construct() {
        $config = require_once("Data.php");
        $this->dbname = $config["dbname"];
        $this->host = $config["host"];
        $this->login = $config["login"];
        $this->pass = $config["pass"];
    }

	/**
	 * @return mixed
	 */
	public function getDbname() {
		return $this->dbname;
	}

	/**
	 * @return mixed
	 */
	public function getHost() {
		return $this->host;
	}

	/**
	 * @return mixed
	 */
	public function getLogin() {
		return $this->login;
	}

	/**
	 * @return mixed
	 */
	public function getPass() {
		return $this->pass;
	}
}