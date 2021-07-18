<?php
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$dates = $_POST['dates'];
$person = $_POST['person'];
$child = $_POST['child'];
$comment = $_POST['comment'];

if (!empty($name) || !empty($email) || !empty($phone)  || !empty($dates) || !empty($person) || !empty($child) || !empty($comment) ) {
 $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbname = "youtube";
    //create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
     die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    } else {
     $SELECT = "SELECT email From register Where email = ? Limit 1";
     $INSERT = "INSERT Into account2 (name, email, phone, dates,  person, child, comment) values(?, ?, ?,  ?, ?, ?, ?)";
     //Prepare statement
     $stmt = $conn->prepare($SELECT);
     
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $stmt->store_result();
     $stmt->fetch();
     $rnum = $stmt->num_rows;
     if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sssssss", $name, $email, $phone, $dates,  $person, $child, $comment);
      $stmt->execute();
      echo "reservation successfully";
     } 
     else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>