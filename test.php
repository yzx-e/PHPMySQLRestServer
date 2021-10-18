<?php

include_once 'app/PropertiesDB.php';

$properties = new PropertiesDB();

$records = $properties->getProperties();

$json_data = json_encode($records);

header('Content-Type:application/json');

echo $json_data;

//echo "<h1>Welcome to REST server home page</h1>";