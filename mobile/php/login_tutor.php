<?php
if (!isset($_POST)) {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
    die();
}

include_once("dbconnect.php");
$email = $_POST['email'];
$pass = sha1($_POST['pass']);
$sqllogin = "SELECT * FROM tbl_tutor WHERE tutor_email = '$email' AND tutor_pass = '$pass'";
$result = $conn->query($sqllogin);
$numrow = $result->num_rows;

if ($numrow > 0) {
    while ($row = $result->fetch_assoc()) {
        $tutor['id'] = $row['tutor_id'];
        $tutor['name'] = $row['tutor_name'];
        $tutor['email'] = $row['tutor_email'];
        $tutor['phoneNo'] = $row['tutor_phoneNo'];
        $tutor['address'] = $row['tutor_address'];
        $tutor['pass'] = $row['tutor_pass'];
        $tutor['datereg'] = $row['tutor_datereg'];
    }
    $response = array('status' => 'success', 'data' => $tutor);
    sendJsonResponse($response);
} else {
    $response = array('status' => 'failed', 'data' => null);
    sendJsonResponse($response);
}

function sendJsonResponse($sentArray)
{
    header('Content-Type: application/json');
    echo json_encode($sentArray);
}

?>