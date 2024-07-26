<?php
if(isset($_GET['id'])){
    $conn=new mysqli("localhost","root","","crud");
    if($conn->connect_error){
        die("connecton failed:".$conn->connect_error);
        } 
        $id=($_GET['id']);
        $sql=("DELETE  FROM users WHERE id=$id");
        $result=$conn->query($sql);
        if($result){
            echo "successfully deleted";
            exit();
        }
        else {
            "error";
        }
        $conn->close();
}

?>
