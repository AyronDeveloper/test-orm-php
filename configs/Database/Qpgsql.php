<?php
namespace configs\Database;

use configs\Database\Query;
use PDO;

class Qpgsql extends Query{

    protected $table;
    protected $connection;

    protected function __construct(){
        $pgsql=new PDO("pgsql:host=$_ENV[PG_HOST];port=$_ENV[PG_PORT];dbname=$_ENV[PG_DBNAME];",$_ENV["PG_USER"], $_ENV["PG_PASSWORD"]);
        $pgsql->exec("SET NAMES 'utf8'");
        
        $this->connection=$pgsql;
    }
}
?>