<?php
if(isset($_GET['id'])){
    $conn=new mysqli("localhost","root","","crud");
    if($conn->connect_error){
        die("connection failed:".$conn->connect_error);
    }
    $id=($_GET['id']);
    $sql=("SELECT * FROM users WHERE id=$id");
    $result=$conn->query($sql);
    $checkedOptions=[];
    if($result->num_rows>0){
        $row=$result->fetch_assoc();
        $checkedOptions=explode(",",$row['age']);
    }
    else{
        echo "connection error";
    }
    $conn->close();

}
if($_SERVER['REQUEST_METHOD']=="POST"){
if(isset($_GET['id'])){
    $id=$_GET['id'];
    $name=$_POST['name'];
    $email=$_POST['email'];
    $dept=$_POST['dept'];
    $age=isset($_POST['age'])? implode(",",$_POST['age']):'';
    $skill=isset($_POST['skill'])? implode(",",$_POST['skill']):'';

    $conn=new mysqli("localhost","root","","crud");
    if($conn->connect_error){
        die("connection failed:".$conn->connect_error);
    }
    $stmt=$conn->prepare("UPDATE users SET name=?,email=?,dept=?,age=?,skill=? WHERE id=?");
    $stmt->bind_param("sssssi",$name,$email,$dept,$age,$skill,$id);
    if($stmt->execute()){
        echo "connection sucessfull";
    }
    else{
        echo "error";
    }
    $stmt->close();
    $conn->close();



}}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            margin: 10px;
        }
    </style>
</head>
<body>
    <form  method =POST action="edit.php? id=<?php echo $_GET['id'];?>">
        <label for="name">NAME:</label>
        <input type="text" placeholder="NAME" name="name" id="name" value ="<?php echo $row['name']?>"><br>
        <label for="email">EMAIL:</label>
        <input type="text" name="email" id="email" placeholder="EMAIL" value="<?php echo $row['email']?>"><br>
        <label for="dept">DEPT:</label>
        <select name="dept" id="dept" >
            <option value="ECE" <?php echo $row['dept']=='ECE'? 'selected':'';?>>ECE</option>
            <option value="CSE" <?php echo $row['dept']=='CSE'? 'selected':'';?>>CSE</option>
            <option value="MECH" <?php echo $row['dept']=='MECH'?'selected':'';?>>MECH</option>
        </select><br>
        <label for="">AGE:</label>
        <input 
        type="checkbox"
         name="age[]" 
         value="20" <?php if(in_array("20",$checkedOptions)) echo "checked";?>>20
        <input
         type="checkbox"
         name="age[]" 
         value="22" <?php if(in_array("22",$checkedOptions)) echo "checked";?>>>22
        <input 
        type="checkbox" 
        name="age[]" 
        value="25" <?php if(in_array("25",$checkedOptions)) echo "checked";?>>25 <br>
        <label for="skill">SKILLs:</label>
        <select name="skill[]" id="skill" multiple>
            <option value="PHP" <?php echo $row['skill']=='PHP'?'selected':'';?>>PHP</option>
            <option value="CSS"  <?php echo $row['skill']=='CSS'?'selected':'';?>>CSS</option>
            <option value="HTML"  <?php echo $row['skill']=='HTML'?'selected':'';?>>HTML</option>
            <option value="JS" <?php echo $row['skill']=='JS'?'selected':'';?>>JS</option>

        </select>
        <input type="submit" name="submit" value="submit">
    </form>
</body>
</html>
