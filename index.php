<?php

ob_start();
session_start();


require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
$router = new Router(site());
$router->namespace("Source\Controllers");


/**
 * WEB -  DIRECIONANDO ROTAS DE ARQUIVOS PHP
 */
$router->group(null);
$router->get("/", "web:login","web.login");
$router->get("/cadastrar", "Web:register","web.register");
$router->get("/recuperar", "Web:forget","web.forget");
$router->get("/senha/{email}/{forget}", "Web:reset","web.reset");
/*
 * AUTH - ROTAS P/ AUTENTICAÇÃO DE USUÁRIO "MÉTODO INCOMPLETO, SERÁ CONCLUIDO NA PROX. ARE"
 */
$router->group(null);
$router->post("/login", "Auth:login","auth.login");
$router->post("/register", "Auth:register","auth.register");

/*
 * AUTH SOCIAL
 */

/*
 * PROFILE
 */

/*
 * ERROS - ROTAS DE ERROS 
 */
$router->group("ops");
$router->get("/{errcode}", "Web:error","web.error");


/*
 * ROUTE PROCESS
 */

$router->dispatch();

/*
 * ERROS PROCESS
 */

if($router->error()){
    $router->redirect("web.error",["errcode" => $router->error()]);
}

ob_end_flush();
