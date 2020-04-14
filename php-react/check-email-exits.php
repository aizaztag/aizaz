    <?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: access");
    header("Access-Control-Allow-Methods: POST");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

    require 'db_connection.php';

    // POST DATA
    $data = json_decode(file_get_contents("php://input"));

    if (!empty(trim($data->user_email))) {
        $useremail = mysqli_real_escape_string($db_conn, trim($data->user_email));
        if (filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            $emailexits = mysqli_query($db_conn, "SELECT *  FROM `users` WHERE user_email='$useremail'");
            if(mysqli_num_rows($emailexits) > 0){
                    echo json_encode(["success" => 1, "msg" => "User Email Exits."]);
            }else{
              //  echo json_encode(["success" => 0, "msg" => "SELECT * from `users` WHERE user_email='$useremail'"]);
            }


        } else {
            echo json_encode(["success" => 0, "msg" => "Invalid Email Address!"]);
        }
    } else {
        echo json_encode(["success" => 0, "msg" => "Please fill all the required fields!"]);
    }