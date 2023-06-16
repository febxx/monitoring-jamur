<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$user = new Users($db);
$user->RFIDLogout();
http_response_code(200);
echo json_encode(array("message" => "Berhasil logout."));
?>