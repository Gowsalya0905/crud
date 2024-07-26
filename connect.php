<?php
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $dept=$_POST['dept'];
    $age=isset($_POST['age'])? implode(",",$_POST['age']):'';
    $skill=isset($_POST['skill'])? implode(",",$_POST['skill']):'';
    
    $conn= new mysqli("localhost","root","","crud");
    if($conn->connect_error){
        die("connection failed:".$conn->connect_error);
    }
    $stmt=$conn->prepare("INSERT INTO users(name,email,dept,age,skill) values (?,?,?,?,?)" );
    $stmt->bind_param("sssss",$name,$email,$dept,$age,$skill);
    if($stmt->execute()){
        echo "connection successfull";
        header("location:display.php");
        exit();
    }
    else{
        echo "not connected to the database";
    }
    $stmt->close();
    $conn->close();
}

?>