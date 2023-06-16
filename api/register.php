<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../objects/users.php';

$database = new Database();
$db = $database->getConnection();

$user = new Users($db);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(!empty($data->email) && !empty($data->username) && !empty($data->name) && !empty($data->password)) {
  $user->username = $data->username;
  $user->name = $data->name;
  $user->password = $data->password;
  $user->email = $data->email;
  $user->created_date = date('Y-m-d H:i:s');
  $user->created_by = 'SYSTEM';
  $cekusername = $user->readByUsername();

  if($cekusername->rowCount() > 0)
  {
    http_response_code(201);
    echo json_encode(array("message" => "Username sudah ada, harap gunakan username lain"));
  }
  else
  {
    if($user->create()){
      http_response_code(201);
      echo json_encode(array("message" => "User berhasil didaftarkan"));
    }
    else{
      http_response_code(503);
      echo json_encode(array("message" => "Unable to register user."));
    }
  }
}

else{
  http_response_code(400);
  echo json_encode(array("message" => "Unable to register user. Data is incomplete."));
}
?>
