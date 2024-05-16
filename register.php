<?php
    include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="registerstyle.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <div class="registerForm">
        <h1 class="registerh1">Register</h1>
        <form class="forminput" method="post">

            <div class="text-input">
                <input type="text" placeholder="First Name" id="firstname" name="txtfirstname">
            </div>

            <div class="text-input">
                <input type="text" placeholder="Last Name" id="lastname" name="txtlastname">
            </div>

            <div class="text-input">
                <input type="text" placeholder="Gender" id="gender" name="txtgender">
            </div>

            <div class="text-input">
                <input type="text" placeholder="Email" id="username" name="txtemail">
            </div>

            <div class="text-input">
                <input type="text" placeholder="Username" id="lastname" name="txtusername">
            </div>

            <div class="text-input">
                <input type="text" placeholder="Password" id="password" name="txtpassword">
            </div>
            
            <button type="submit" class="Register" name="btnRegister">Register</button>

            <p class="login-link" >Already have an account? <a href="login.php">Log in here</a>.</p>
        </form>
        
        <?php	
                if(isset($_POST['btnRegister'])){		
                    //retrieve data from form and save the value to a variable
                    //for tbluserprofile
                    $fname=$_POST['txtfirstname'];		
                    $lname=$_POST['txtlastname'];
                    $gender=$_POST['txtgender'];
                    
                    //for tbluseraccount
                    $email=$_POST['txtemail'];		
                    $uname=$_POST['txtusername'];
                    $pword=$_POST['txtpassword'];
                    
                    //save data to tbluserprofile			
                    $sql1 ="Insert into tbluserprofile(firstname,lastname,gender) values('".$fname."','".$lname."','".$gender."')";    
                    mysqli_query($connection,$sql1);
                    
                    //Check tbluseraccount if username is already existing. Save info if false. Prompt msg if true.
                    $sql2 ="Select * from tbluseraccount where username='".$uname."'";
                    $result = mysqli_query($connection,$sql2);
                    $row = mysqli_num_rows($result);
                    if($row == 0){
                        $sql ="Insert into tbluseraccount(emailadd,username,password) values('".$email."','".$uname."','".$pword."')";
                        mysqli_query($connection,$sql);
                            echo "<p style='color:green;'>New record saved.</p> <br>";
                        //header("location: index.php");
                    }else{
                            echo "<p style='color:red;'>Username already exists.</p> <br>";
                    }
                }   
            ?>
</body>