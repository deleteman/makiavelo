<?php

$_ROUTES = array();


$_ROUTES[] = array("root_path" => array("url" => "/", "controller" => "Home", "action" => "index"));
$_ROUTES[] = array(
	"login" => array("url" => "/login", "controller" => "Login", "action" => "index"),
	"sign_in" => array("url" => "/login/sign_in", "controller" => "Login", "action" => "signIn", "via" => "post"),
	"sign_out" => array("url" => "/login/sign_out", "controller" => "Login", "action" => "signOut", "via" => "post")
	);

$_ROUTES[] = array(
	"list" => array("url" => "/post/", "controller" => "Post", "action" => "index"),
	"create" => array("url" => "/post/create", "controller" => "Post", "action" => "create", "via" => "post", "role" => "user"),
	"new" => array("url" => "/post/new", "controller" => "Post", "action" => "new", "role" => "user"),
	"retrieve" => array("url" => "/post/:id", "controller" => "Post", "action" => "show", "via" => "get", "role" => "user" ),
	"update" => array("url" => "/post/:id/edit", "controller" => "Post", "action" => "edit", "role" => "user"),
	"delete" => array("url" => "/post/:id/delete", "controller" => "Post", "action" => "delete", "via" => "post", "role" => "user")
	); 

$_ROUTES[] = array(
	"list" => array("url" => "/user/", "controller" => "User", "action" => "index"),
	"create" => array("url" => "/user/create", "controller" => "User", "action" => "create", "via" => "post"),
	"new" => array("url" => "/user/new", "controller" => "User", "action" => "new"),
	"retrieve" => array("url" => "/user/:id", "controller" => "User", "action" => "show", "via" => "get"),
	"update" => array("url" => "/user/:id/edit", "controller" => "User", "action" => "edit"),
	"delete" => array("url" => "/user/:id/delete", "controller" => "User", "action" => "delete", "via" => "post")
	); ?>
