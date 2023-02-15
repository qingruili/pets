<?php
header('content-type:text/html;charset=utf-8');
$host = "localhost";
$user = "root";
$password = "root";
$db = "pethealthsystem";


$mysqli = new mysqli($host, $user, $password, $db); 
if ($mysqli->connect_errno) {
    die($mysqli->connect_error);
}
$mysqli->set_charset('utf8'); 
session_start();

getUser($mysqli);
$mysqli->close();

function getUser($mysqli){
    $sql = "SELECT Address FROM hospital WHERE Address = ? and password = ? ";
    $mysqli_stmt = $mysqli->prepare($sql);

    $Address = $_POST['Address'];
    
    $password = $_POST['password'];

    $mysqli_stmt->bind_param('ss', $Address, $password);

    if ($mysqli_stmt->execute()) {
        $_SESSION['hosadd']=$Address;
        echo "<script>alert('Successful!');window.location.href='../../pets/html/hospital.html'</script>";
    }

    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
?>


