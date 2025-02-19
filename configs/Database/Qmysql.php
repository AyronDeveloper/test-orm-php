<?php
namespace configs\Database;

use configs\Database\Query;
use PDO;

class Qmysql extends Query{

    protected $table;
    protected $connection;

    protected function __construct(){
        $mysql=new PDO("mysql:host=$_ENV[MYSQL_HOST]; dbname=$_ENV[MYSQL_DBNAME]; ",$_ENV["MYSQL_USER"], $_ENV["MYSQL_PASSWORD"]);
        $mysql->exec("SET NAMES 'utf8'");
        
        $this->connection=$mysql;
    }
}
?>