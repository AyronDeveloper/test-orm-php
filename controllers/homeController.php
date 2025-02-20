<?php
namespace controllers;

use configs\Database\Qmysql;
use configs\Handle\Request;
use models\Usuario;

class homeController{

    public function index(){

        $usuarios=Usuario::select()->get();

        require_once("./views/homeView/index.php");
    }


    public function testeando(){

        var_dump(Usuario::select()->orderBy("usuario","desc")->get("query"));
        echo "<hr>";
        echo json_encode(Usuario::select()->orderBy("usuario","desc")->get());
    }


    public function createView(){
        require_once("./views/homeView/create.php");
    }


    public function insert(){
        date_default_timezone_set('America/Lima');


        $usuario=Request::post("usuario");
        $email=Request::post("email");
        $password=Request::post("password");
        $date_create=date("Y-m-d H:i:s");
        $date_update=date("Y-m-d H:i:s");

        
        $insert=Usuario::insert(["DEFAULT",$usuario,$email,$password,null,$date_create,$date_update])->run();

        if($insert){
            header("Location: ".url("test"));
        }else{
            header("Location: ".url());
        }
    }

    public function updateView($id_usuario){

        $usuario=Usuario::select()->where("id_usuario",$id_usuario)->first();

        require_once("./views/homeView/update.php");
    }

    public function update($id_usuario){
        date_default_timezone_set('America/Lima');

        $update=Usuario::update([
            "usuario"=>Request::put("usuario"),
            "email"=>Request::put("email"),
            "password"=>Request::put("password"),
            "date_update"=>date("Y-m-d H:i:s")
        ])
        ->where("id_usuario",$id_usuario)->run();

        if($update){
            header("Location: ".url(""));
        }else{
            header("Location: ".url("update/$id_usuario"));
        }

    }

    public function delete($id_usuario){


        $delete=Usuario::delete()->where("id_usuario",$id_usuario)->run();


        if($delete){
            header("Location: ".url());
        }else{
            header("Location: ".url("test"));
        }
    }

}
?>