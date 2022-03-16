<?php

require_once './functions.php';
require_once './Plant.php';

headersWithMethod('GET');

if (isset($_GET['id']) && !empty($_GET['id']) && is_numeric((int) $_GET['id'])) {
    $plant = Plant::find((int) $_GET['id']);
    json(200,'Planta recibida',false, array('plant' => $plant));      
    exit();
}

$plants = [];

if (isset($_GET['limit']) && isset($_GET['offset'])) {
    $plants = Plant::findAllPaged(false, (int) $_GET['limit'], (int) $_GET['offset']);
    json(200, 'Se recibieron las plantas de forma correcta', false, $plants);
} else {
    $plants = Plant::findAll();
}

if (!isset($plants) || empty($plants)) {
    json(404, 'No se encontraron plantas', true);
}

json(200, 'Se recibieron las plantas de forma correcta', false, array('plants' => $plants));
