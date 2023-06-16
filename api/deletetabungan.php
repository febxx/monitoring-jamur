<?php

// required headersheader("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// database connection will be here
// include database and object files
include_once '../config/database.php';
include_once '../objects/savings.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$saving = new Savings($db);

// read products will be here
// query products
// get posted data
$data = json_decode(file_get_contents("php://input"));
$saving->user_id = $data->user_id;
// make sure data is not empty
if(!empty($data->user_id))
{
  $stmt = $saving->delete();

  http_response_code(200);

  echo json_encode(
  array("message" => "berhasil")
  );
}
else {
  http_response_code(404);
  echo json_encode(
    array("message" => "gagal")
  );
}
?>