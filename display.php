<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>NAME</td>
                <td>EMAIL</td>
                <td>DEPT</td>
                <td>AGE</td>
                <td>SKILLS</td>
            </tr>
        </thead>
        <tbody>
            <?php
            $conn=new mysqli("localhost","root","","crud");
            if($conn->connect_error){
                die("connectin failed:".$conn->connect_error);
            }
            $sql="SELECT id, name,email,dept,age,skill FROM users";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                 echo "<tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['email']."</td>
                <td>".$row['dept']."</td>
                <td>".$row['age']."</td>
                <td>".$row['skill']."</td>
                <td><a href='edit.php? id=".$row['id']."' target=_blank>EDIT</a></td>
                <td><a href='delete.php? id=".$row['id']."' target=_blank>delete</a></td>
                 </tr>";
              }
              
            }
            else{
                echo "connection failed";
            }
            $conn->close();
            
            ?>
        </tbody>
    </table>
</body>
</html>