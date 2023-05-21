<?php

$request = $_SERVER['REQUEST_URI'];

switch($request) {
  case '/':
    require __DIR__ . '/main.php';
    break;
}

?>