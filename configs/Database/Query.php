<?php
namespace configs\Database;

use PDO;
use PDOException;

class Query{

    protected $table;
    protected $query;
    protected $values=[];
    protected $connection;


    public static function select(){

        $self=new static();


        $calledClass=get_called_class();
        $self->table=(new $calledClass())->table;


        $num_args=func_num_args();
        $setSelect="";


        if($num_args>0){
            $get_args=implode(", ",func_get_args());
            $setSelect=$get_args;
        }else{
            $setSelect="*";
        }

        $self->query="SELECT ".$setSelect." FROM $self->table";

        return $self;

    }


    public function join($table,$oneColumn,$compardador,$twoColumn){

        $this->query.=" JOIN $table ON $oneColumn $compardador $twoColumn ";

        return $this;
    }

    public function leftJoin(){

    }
    
    
    private function verifyWhere(){
        return strpos($this->query,"WHERE")!==false?" AND ":" WHERE ";
    }


    public function where($column,$condicion,$adicional=null){
 
        $setWhere="";

        if($adicional!=null || $adicional!=""){

            array_push($this->values,$adicional);

            $setWhere="$column $condicion ? ";
        }else{

            array_push($this->values,$condicion);

            $setWhere="$column = ? ";
        }


        $this->query.=$this->verifyWhere().$setWhere;

        return $this;
    }


    public function whereIn($column,$values){

        $setWhere="";

        if(is_array($values)){

            $len=count($values);
            $count=0;

            $setWhere="$column IN( ";
            foreach($values as $val){
                $count++;
                $setWhere.=" '$val'";
                if($len>$count){
                    $setWhere.=",";
                }
            }
            $setWhere.=" )";

        }else{
            $setWhere="$column IN( $values )";
        }

        $this->query.=$this->verifyWhere().$setWhere;

        return $this;
    }


    public function whereNotIn($column,$values){

        $setWhere="";

        if(is_array($values)){

            $len=count($values);
            $count=0;

            $setWhere="$column NOT IN( ";
            foreach($values as $val){
                $count++;
                $setWhere.=" '$val'";
                if($len>$count){
                    $setWhere.=",";
                }
            }
            $setWhere.=" )";

        }else{
            $setWhere="$column NOT IN( $values )";
        }

        $this->query.=$this->verifyWhere().$setWhere;

        return $this;
    }


    public function whereBetween($column,$value1,$value2){

        $setWhere="$column BETWEEN '$value1' AND '$value2' ";

        $this->query.=$this->verifyWhere().$setWhere;

        return $this;
    }


    public function whereNotBetween($column,$value1,$value2){

        $setWhere="$column NOT BETWEEN '$value1' AND '$value2' ";

        $this->query.=$this->verifyWhere().$setWhere;

        return $this;
    }


    public function orderBy($column,$order=null){
        return $this;
    }


    public function groupBy($column){
        return $this;
    }


    public static function insert($values){

        $self=new static();

        $calledClass=get_called_class();
        $self->table=(new $calledClass())->table;


        $assoc="";
        $columns=array_keys($values);

        if(!array_is_list($values)){
            $assoc="(".implode(", ",$columns).")";
        }

        $placeholders=implode(", ",array_fill(0,count($values),"?"));


        $self->query="INSERT INTO {$self->table} $assoc VALUES ($placeholders)";

        $self->values=array_map(fn($val)=>$val===null?null:$val,array_values($values));

        return $self;
    }

    public static function update($values){

        $self=new static();

        $calledClass=get_called_class();
        $self->table=(new $calledClass())->table;


        $columns=array_keys($values);
        $set=implode(", ",array_map(fn($col)=>"$col = ?",$columns));


        $self->query="UPDATE {$self->table} SET $set";

        $self->values=array_values($values);


        return $self;
    }


    public function get($query=null){

        if($query=="query"){
            return $this->query;
        }else{
            $dataQuery=$this->connection->prepare($this->query);

            foreach($this->values as $key=>$value){
                $dataQuery->bindValue($key+1,$value,$value===null?PDO::PARAM_NULL:PDO::PARAM_STMT);
            }
            
            $dataQuery->execute();
    
            $data=$dataQuery->fetchAll(PDO::FETCH_ASSOC);
    
    
            return $data;
        }
    }

    public function first($query=null){

        if($query=="query"){
            return $this->query;
        }else{

            $dataQuery=$this->connection->prepare($this->query);

            foreach($this->values as $key=>$value){
                $dataQuery->bindValue($key+1,$value,$value===null?PDO::PARAM_NULL:PDO::PARAM_STMT);
            }

            $dataQuery->execute();
    
            $data=$dataQuery->fetch(PDO::FETCH_ASSOC);
    
    
            return $data;
        }
    }

    public function run($query=null){

        if($query=="query"){
            return $this->query;
        }else{

            try{
                $result=$this->connection->prepare($this->query);
    
                foreach($this->values as $key=>$value){
                    $result->bindValue($key+1,$value,$value===null?PDO::PARAM_NULL:PDO::PARAM_STMT);
                }
                
                return $result->execute();
            }catch(PDOException $e){
                error_log("Error: ".$e->getMessage());
                return false;
            }
        }
    }

}
?>