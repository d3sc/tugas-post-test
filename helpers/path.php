<?php

// currentPath
$requestUri = $_SERVER['REQUEST_URI'];
$currentPath = dirname($requestUri);

// basePath
$parts = explode('/', $_SERVER['REQUEST_URI']);
$basePath = isset($parts[1]) ? "/" . $parts[1] : null;
