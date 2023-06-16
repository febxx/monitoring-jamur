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
if(!empty($data->username) && !empty($data->password)) {

  // set product property values
  $user->username = $data->username;
  $user->password = $data->password;

  $login = $user->login();
  // create the product
  if($login->rowCount() > 0) {
    while ($row = $login->fetch(PDO::FETCH_ASSOC)){
      // extract row
      // this will make $row['name'] to
      // just $name only
      extract($row);

      $user_item=array(
      "message" => "berhasil",
      "username" => $username,
      "name" => $name,
      "email" => $email,
      "is_admin" => $is_admin,
      );

    }
    // set response code - 201 created
    http_response_code(201);

    // tell the user
    echo json_encode($user_item);
  }

  // if unable to create the product, tell the user
  else {

    // set response code - 503 service unavailable
    http_response_code(503);

    // tell the user
    echo json_encode(array("message" => "username atau 
    password salah."));
  }
}

// tell the user data is incomplete
else{

  // set response code - 400 bad request
  http_response_code(400);

  // tell the user
  echo json_encode(array("message" => "Unable to register user. 
  Data is incomplete."));
}
?>