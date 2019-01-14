<?php

$version = API_VERSION_STRING;

$routes = [
	"{$version}/notify/push/all" => "notify/fire-console/push-all",
	
	"{$version}/notify/push/<id:[0-9]+>" => "notify/fire-console/push",
	"{$version}/routes" => "notify/fire-console/routes",
];
return $routes;