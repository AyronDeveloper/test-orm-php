<?php
use configs\Router\Route;
use controllers\homeController;

Route::controller(homeController::class)->group(function(){
    Route::get("","index");
    Route::get("test","testeando");
    Route::get("create","createView");
    Route::post("insert","insert");
    Route::get("update/:id_usuario","updateView");
    Route::put("update/:id_usuario","update");
    Route::get("delete/:id_usuario","delete");
});
?>