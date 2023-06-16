<?php

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/datajamur.php';

$database = new Database();
$db = $database->getConnection();

$datajamur = new DataJamur($db);

$data = json_decode(file_get_contents("php://input"));
$datajamur->suhu = $data->suhu;
$datajamur->kelembapan = $data->kelembapan;
$datajamur->tanggal = date("Y-n-j");
$datajamur->jam = date("H:i");

$id_data = $datajamur->create();
$jamur = $datajamur->readById($id_data);
echo json_encode(array("data" => $jamur, "message" => "Berhasil"));