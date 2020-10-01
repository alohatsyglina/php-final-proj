<?php if(isset($_REQUEST['reg'])){
    $fname=mysqli_real_escape_string($connection,$_REQUEST['firstname']);
    $lname=mysqli_real_escape_string($connection,$_REQUEST['lastname']);
    $email=mysqli_real_escape_string($connection,$_REQUEST['email']);
    $phone=mysqli_real_escape_string($connection,$_REQUEST['phone']);
    $password=mysqli_real_escape_string($connection,$_REQUEST['password']);

    $call=mysqli_query($connection, 
    "CALL insertdata('$fname','$lname','$email','$phone','$password')");
}