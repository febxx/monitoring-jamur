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
$saving->username = $data->username;
// make sure data is not empty
if(!empty($data->username))
{
  $stmt = $saving->readByUsername();
  $num = $stmt->rowCount();
  // check if more than 0 record found
  if($num>0){
    
    // products array
    $savings_arr=array();
    $savings_arr["records"]=array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    // extract row
    // this will make $row['name'] to
    // just $name only
    extract($row);
    
    $saving_item=array(
    "trans_id" => $trans_id,
    "user_id" => $user_id,
    "amount" => $amount,
    "trans_date" => $trans_date
    );
    
    array_push($savings_arr["records"], 
    $saving_item);
    }
    
    http_response_code(200);
    echo json_encode($savings_arr);
  }
  
  else{
    http_response_code(404);
    echo json_encode(
    array("message" => "Tidak ada tabungan")
    );
  }
}
?>