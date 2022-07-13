<?php
function view($path = ""){
	require __DIR__ . "/views/${path}.php";
}
$request = isset($_SERVER['REDIRECT_URL']) ? trim($_SERVER['REDIRECT_URL'], "/") : trim($_SERVER['REQUEST_URI'], "/");
$routes = [
	"add" => "campaign_add",
	"login" => "login",
];

if (isset($routes[$request])) {
	if(in_array($routes[$request], ["add"])){
		if(isset($_SESSION["login"]) && $_SESSION["login"] === true){
			view($routes[$request]);
		}else{
			view("login");
		}
	}else{
		view($routes[$request]);
	}
} else {
	http_response_code(404);
	view("404");
}
