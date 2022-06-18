<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
   


    //Check that the table exists or not and create a table if not exists one.
   $sql0= "CREATE TABLE IF NOT EXISTS students ( `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, `full_names` VARCHAR(100) NOT NULL , 
   `country` VARCHAR(50) NOT NULL ,
   `email` VARCHAR(100)  ,
    `gender` VARCHAR(10) NOT NULL , 
    `dob` DATE NULL DEFAULT NULL ,
     `password` VARCHAR(200) NOT NULL ) ";
    $result0 = $conn->query($sql0);
    if(!$result0){
        die($conn->error);
    }


    //check if user with this email already exist in the 
   $sql = "SELECT email FROM students where email = '$email' ";
    $result = $conn->query($sql);
   if ($result){
        if ($result->num_rows>0){
            //user already exist
            echo "user already exist";
        }else{
            $sql1= "INSERT INTO `Students` ( `full_names`, `country`, `email`, `gender`, `password`) VALUES('$fullnames', '$country','$email', '$gender', '$password')";
            $result2 = $conn->query($sql1);
            if ($result2){
                echo ' New user created successfully';
            }else{
                echo $conn->error;
            }
        }
   }else{
    echo $conn->error;
   }


}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    $sql = "SELECT email,full_names, password FROM students where email = '$email' and password = '$password'";
    $result= $conn->query ($sql);
    if( $result){
        if($result->num_rows==1){
            while($row = mysqli_fetch_assoc($result)) {          
                  //if true then set user session for the user and redirect to the dasbboard 
                session_start(); 
                $_SESSION['username'] =$row["full_names"] ;
                $_SESSION['email'] = $row["email"];

                header('Location: ../dashboard.php');
            } 
           
            echo '<br> user logged in successfuly';
        }else {
            echo '<div style="background: #ff4c1631; border-width:medium; border-color :red; padding :20px; border-radius:10px; ">
            <h1 style="color: red; text-align:center;  font-family: `Franklin Gothic Medium`, `Arial Narrow , Arial, sans-serif;" >Unknown username or password </h1>
            </div>';
        }
        

    }else{
        echo $conn->error;
    }

 

    // close connection
db_close($conn);
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    
    //open connection to the database and check if username exist in the database
    $sql = "SELECT email, password FROM students where email = '$email'";
    $result= $conn->query ($sql);
    if($result){
         //if it does, replace the password with $password given
        if ($result->num_rows == 1 ){
                $sql1= "UPDATE students set
            password = '$password' where email ='$email' "; 
            $result2 =$conn->query($sql);
            if($result2){
                echo "Password changed successfully";
            }else{
                echo $conn->error;
            }
         }else{
            echo 'Unknow user ';
        }
    }else{
    echo $conn->error;
    }
       
       
// close connection
db_close($conn);
   
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     //delete user with the given id from the database
     $sql = "DELETE FROM students where id ='$id'";
     $result = $conn->query($sql);
     if($result){
        echo ' user has been deletes successfully';
     }else{
        echo $conn->error;
     }
 }


// added new function to close dbconn

function db_close($conn){
    mysqli_close($conn);
}