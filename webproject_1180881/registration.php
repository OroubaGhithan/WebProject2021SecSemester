<?php 
 session_start();
 include('includes/config.php');
 include('functions.php') ;
 error_reporting(0);

if ( isset($_POST['signup']))
{
    $fname = $_POST['fullname'] ;
    $email = $_POST['emailid'] ;
    $ID = $_POST['idnum'] ;
    $mobile = $_POST['mobileno'] ;
    $_telephone = $_POST['telephone'];
    $configPass = $_POST['confirmpassword'] ; 
    $dayOfBirth = $_POST['birth'] ;
    $address = $_POST['address'] ; 
    
    $newPass = $_POST['password'] ;
    //Validate the form info
    $formErrors = array() ; 

    if (empty($_POST['password'])) $formErrors [] = 'Password Can\'t be Empty ';

    else
    {
        if (strlen($_POST['password']) < 6 ) 
        {
            $formErrors [] = 'Password Can\'t be Less than 6 Characters' ;
        }
        if (strlen($_POST['password']) > 15 )
        {
            $formErrors[] = 'Password Can\'t be More than 15 Characters' ;
        }

        if ( !is_numeric( $newPass[0] ) ) 
        {
            $formErrors [] = 'First character in password must be a Digit.' ;
        }
        if ( !ctype_lower(  (  $newPass[strlen($newPass)-1] ) ) )
        {
            $formErrors [] = ' Last character in password must be Lower case letter.';
        }
    } 
    

    if ( strlen ($ID) != 9 && is_numeric ($ID) ) 
    {
        $formErrors[] = 'Id side must be  9 digits ' ;
    }
    if ( $_POST['password'] !=  $_POST['confirmpassword'] ) 
    {
        $formErrors[] = 'No matches between passwords.' ;
    }
    else 
        $password = sha1 ($_POST['password']) ;

    if (!is_numeric ($mobile) )
    {
        $formErrors[] = 'Mobile Number must be integer value. ' ;
    }
    if (strlen ($mobile) != 10 )
    {
        $formErrors[] = 'Mobile Number must be 10 Digits. ' ;
    }
    if (strlen ($_telephone) != 10 )
    {
        $formErrors[] = 'Telephone Number must be 10 Digits. ' ;
    }
    if (!is_numeric ($_telephone) )
    {
        $formErrors[] = 'Telephone Number must be integer value. ' ;
    }

    //Validate the form info

    if (strlen($fname) < 3 ) $formErrors []= 'Username Can\'t be Less than 3 Characters' ;
    if ( strlen($fname) > 20 ) $formErrors[] = 'Username Can\'t be More than 20 Characters';
    if (empty($fname)) $formErrors [] ='Username Can\'t Be Empty' ;
    if (empty($email)) $formErrors []= 'Email Can\'t Be Empty ' ;
    if (empty($mobile)) $formErrors [] = 'Mobile Can\'t Be Empty ' ;
    if (empty($_telephone)) $formErrors [] = 'Telephone Can\'t Be Empty ' ;
    if (empty($address)) $formErrors []= 'Address Can\'t Be Empty ' ;


    $isExistInDB = array() ; 
    $ch1 = checkItem( "Email" , "users" , $email);
    $ch2 = checkItem("ID" , "users" , $ID);
    if ($ch1 == 1 ) 
    {
        $isExistInDB [] = 'Email is already EXISTS !, Email addess must be unique.' ;
    }
    elseif ($ch2 == 1)
    {
        $isExistInDB [] = 'ID Number is already EXISTS !, ID Number must be unique.' ;
    }


    if (empty($formErrors) && empty($isExistInDB)) 
    {
        // check if item in database or not. 
        

        // Insert the data base 
        $stmt = $dbh ->  prepare  ("INSERT INTO users 
        
                                    (ID  , Password , FullName , Email, Address , DateOfBirth , Mobile , Telephone )
                                    
                                    values (:zid , :zpass , :zfullname , :zemail , :zaddress ,:zDate , :zmobile , :ztele) ");
        
        $stmt -> execute( array ( 'zid' => $ID , 'zpass' =>  $password   , 'zfullname' =>  $fname , 'zemail' =>  $email , 'zaddress' =>  $address , 'zDate' =>  $dayOfBirth , 'zmobile' => $mobile , 'ztele'  => $_telephone  ));
        echo $stmt -> rowCount() ; 
        
    }



 }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href= "images/logo.png">
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="css/style.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <title>Car Rental | Registration </title>
</head>
<body>
        <!--Header-->
        <?php
        $pageName = 'reg' ; 
        include('includes/header.php');?>  
        <!-- /Header --> 

        
 
        <div class="content">
            <div class="container">
                    <form class = "reg-form" method = "POST"  >
                    <div class="head-form">Registration Form </div>

                    <div class = "is-updated">
                            <label for="">
                                 
                            <?php 

                            if(empty($isExistInDB))
                            {
                                if ( !empty($formErrors))
                                {
                                    echo '______________________________________________________' . '<br> <br>'  ; 
                                    echo 'Error Messeges: ' . '<br><br>' ; 
                                    foreach ( $formErrors as $error ) echo  '- ' . $error . '<br>' ;
                                    echo '______________________________________________________' . '<br> <br>'  ; 
                                }
                                else if (empty($formErrors) && isset ( $_POST['signup'] ) )
                                {
                                    // echo "<script>alert('confirmation message: \\n UserName : $fname \\n ID : $ID '); </script>";
    
                                    // "<script>
                                    //     var txt;
                                    //     var r = confirm("Press a button!");
                                    //     if (r == true) {
                                    //         txt = "You pressed OK!";
                                    //     } else {
                                    //         txt = "You pressed Cancel!";
                                    //     }
                                    //     document.getElementById("demo").innerHTML = txt;
                                   
                                    // </script>"
    
                                    echo '<script>'; 
                                    echo "alert('Registered successfully. Please login now \\n confirmation message: \\n UserName : $fname \\n Email Address : $email \\n ID Number : $ID ' );"; 
                                    echo 'window.location.href = "login.php";';
                                    echo '</script>';
    
                                }

                            }
                            elseif (!empty($isExistInDB))
                            {
                                echo '______________________________________________________' . '<br> <br>'  ; 
                                echo 'Error Messeges: ' . '<br><br>' ; 
                                foreach ( $isExistInDB as $error ) echo  '- ' . $error . '<br>' ;
                                echo '______________________________________________________' . '<br> <br>'  ; 
                            }


                                

                            ?>

                            </label>
                        </div>


                        <div class="first">
                            <label for="first">Full Name:</label>
                            <div class="clear"></div>
                            <input type="text" name="fullname" id="first" placeholder="Enter Full name,length must be in range(3-20) char" required>
                        </div>
                        <div class="last">
                            <label for="last">ID Number: </label>
                            <div class="clear"></div>
                            <input type="text" name="idnum" id="last" placeholder="Enter ID Number,9 Digit Only *" required>
                        </div>
                        <div class="email">
                            <label for="email">e-mail:</label>
                            <div class="clear"></div>
                            <input  autocomplete ="off"  type="email" name="emailid" id="email" placeholder="Enter email" required>
                        </div>
                        <div class="pass">
                            <label for="pass">password:</label>
                            <div class="clear"></div>
                            <input type="password"  autocomplete="new-password" name="password" id="pass" placeholder="Start with a digit end with a lower-case char, length in range(6-15)" required>
                        </div>
                        <div class="cpass">
                            <label for="Cpass">confirm password:</label>
                            <div class="clear"></div>
                            <input type="password" name="confirmpassword" id="Cpass" placeholder="Enter again password" required>
                        </div>

                        <div class="date-birth">
                            <label for="date-birth">Date Of Birth</label>
                            <div class="clear"></div>
                            <input type="date" name = "birth"   id = "date-birth" required>
                        </div>
                        
                        <div class="mobile">
                            <label for="mobile">Your mobile Number </label>
                            <div class="clear"></div>
                            <input type="text" name="mobileno"   id = "mobile" placeholder="Enter Your mobile number" required >
                        </div>

                        <div class="telephone">
                            <label for="telephone">Your telephone Number </label>
                            <div class="clear"></div>
                            <input type="text" name="telephone"  id ="telephone"  placeholder="Enter Your telephone number" required >
                        </div>


                        <div class="address">
                            <label for="address">Your Address</label>
                            <div class="clear"></div>
                            <textarea name="address"  id ="address" cols="40" rows="10" placeholder="Enter Your Address" required ></textarea>

                        </div>
                        <div class ="terms_agree" >
                        <input type="checkbox" id="terms_agree" required="required" checked="">
                        <label for="terms_agree">I Agree with <a href="#">Terms and Conditions</a></label>
                        </div>


                        <div class="submit">
                            <input type="submit" value="sign up" name = "signup">
                            <input type="reset" value="Reset" />
                        </div>

                        <div class = "ready">
                        <a href="login.php">Already Have an account ?</a>
                        </div> 

                    </form>
            </div>
        </div>
        <div style="min-height: 220vh" class="container"></div>

        <?php include('includes/footer.php');?> 



</body>
</html>