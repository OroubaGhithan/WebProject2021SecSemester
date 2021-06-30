<?php
 session_start();
 include('includes/config.php');
 include('functions.php') ;
 error_reporting(0);

    if (isset( $_POST['updateprofile']))
    {
        $fname = $_POST['fullname'] ;
        $email = $_POST['emailid'] ;
        $mobile = $_POST['mobileno'] ;
        $_telephone = $_POST['telephone'];
        $dayOfBirth = $_POST['birth'] ;
        $address = $_POST['address'] ; 
        $ID = $_POST['idnum'] ;

        $formErrors = array() ;

        //Password trick 
        $password = '' ;
        $newPass = $_POST['newpassword'] ; 
        if (empty($_POST['newpassword']))
        {
            $password = $_POST['oldpassword'] ;
        }

        else 
        {
                if (strlen($_POST['newpassword']) < 6 ) 
                {
                    $formErrors [] = 'Password Can\'t be Less than 6 Characters' ;
                    $password = $_POST['oldpassword'] ;
                }
                if (strlen($_POST['newpassword']) > 15 )
                {
                    $formErrors[] = 'Password Can\'t be More than 15 Characters' ;
                    $password = $_POST['oldpassword'] ;
        
                }

                if ( !is_numeric(  $newPass[0]  ) ) 
                {
                    $formErrors [] = 'First character must be a Digit' ;
                }
                if ( !ctype_lower(  (  $newPass[strlen($newPass)-1] ) ) )
                {
                    $formErrors [] = ' Last character must be Lower case letter' ;
                }
        }
        if ( strlen ($ID) != 9 && is_numeric ($ID) ) 
        {
            $formErrors[] = 'Id side must be  9 digits ' ;
        }
        if ( $_POST['newpassword'] !=  $_POST['newconfirmpassword'] ) 
        {
            $formErrors[] = 'No matches between passwords' ;
        }
        else 
            $password = sha1 ($_POST['newpassword']) ;
        //echo $ID  . ' test ' . $fname . ' '; 
        //Validate the form info

        // if (strlen($pasword)) 
        if (strlen($fname) < 3 ) $formErrors []= 'Username Can\'t be Less than 3 Characters' ;
        if ( strlen($fname) > 20 ) $formErrors[] = 'Username Can\'t be More than 20 Characters';
        if (empty($fname)) $formErrors [] ='Username Can\'t Be Empty' ;
        if (empty($email)) $formErrors []= 'Email Can\'t Be Empty ' ;
        if (empty($mobile)) $formErrors [] = 'Mobile Can\'t Be Empty ' ;
        if (empty($_telephone)) $formErrors [] = 'Telephone Can\'t Be Empty ' ;
        if (empty($address)) $formErrors []= 'Address Can\'t Be Empty ' ;

        // if there is no errors update 
        if (empty($formErrors)) 
        {
            // Update the data base 
            $stmt = $dbh -> prepare( "UPDATE users SET FullName = ? ,  DateOfBirth = ? , Mobile = ? , Telephone = ?, Password = ? , Address = ? WHERE ID = ? ") ;
            
            $stmt -> execute( array ($fname , $dayOfBirth , $mobile , $_telephone ,  $password , $address , $ID));
            echo $stmt -> rowCount() ; 
            
        }
        // else {
        //      foreach ( $formErrors as $error ) echo $error . '<br>' ;
        // }

    }


?>

<?php
    if (isset ($_SESSION['login'])) 
    {
        $Email =$_SESSION['login'] ;
    

        $stmt = $dbh -> prepare ("SELECT * FROM users WHERE Email = ? LIMIT 1") ;
        
        $stmt -> execute(array($Email));
        $row= $stmt -> fetch ();
        $count = $stmt -> rowCount();
        //echo $count ; 
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
   
    <title>Car Rental | My Profile </title>
</head>
<body>
    <!--Header-->
    <?php 
    $pageName = 'editprofile' ;
    include('includes/header.php');?>
    <!-- /Header --> 

    <div class="content">
            <div class="container">
                    <form class = "reg-form" method = "POST" action ="">
                    <div class="head-form">Your Profile Information </div>
                    <div class="reg-date">
                        <label for=""> Registration Date : <?php echo $row['RegDate'] ;?> </label> <br> <br>
                        <label for=""> Updation Date : <?php echo $row['UpdationDate'] ;?> </label>
                    </div>

                    <div class = "is-updated">
                            <label for="">
                                 
                            <?php 
                                if ( !empty($formErrors))
                                {
                                    echo '______________________________________________________' . '<br> <br>'  ; 
                                    echo 'Error Messeges: ' . '<br><br>' ; 
                                    foreach ( $formErrors as $error ) echo  '- ' . $error . '<br>' ;
                                    echo '______________________________________________________' . '<br> <br>'  ; 
                                }
                                else if ( empty($formErrors) && isset( $_POST['updateprofile'])  )
                                {
                                    echo '______________________________________________________' . '<br> <br>'  ; 
                                    echo 'Your Profile Info Updated Successfully ! ' . '<br><br>' ; 
                                  
                                    echo '______________________________________________________' . '<br> <br>'  ; 
                                }
                                

                            ?>

                            </label>
                        </div>
                        <div class="first">
                            <label for="first">Full Name:</label>
                            <div class="clear"></div>
                            <input type="text" name="fullname" id="first" value = " <?php echo $row['FullName'] ; ?>  "   required  >
                        </div>
                        <div class="last">
                            <label for="last">ID Number:</label>
                            <div class="clear"></div>
                            <input type="text" name="idnum" id="last"  value = "<?php echo $row['ID']?>"   readonly   >
                        </div>
                        <div class="email">
                            <label for="email">e-mail:</label>
                            <div class="clear"></div>
                            <input  autocomplete ="off"   type="email" name="emailid"  id="email"  value = "<?php echo $row['Email']?>"  required  >
                        </div>
                        <div class="pass">
                            <label for="pass">password:</label>
                            <div class="clear"></div>
                            <input type="hidden"   name="oldpassword"  value = "<?php echo $row['Password']?>"  >
                            <input type="password"  name="newpassword" id="pass"  autocomplete="off"  placeholder="Password first char is a digit and last char ia a lower-case char"  >
                        </div>
                        <div class="cpass">
                            <label for="Cpass">confirm password:</label>
                            <div class="clear"></div>
                            <input type="hidden" name="oldconfirmpassword"   >
                            <input type="password" name="newconfirmpassword" id="Cpass" placeholder="enter again password"      >
                        </div>

                        <div class="date-birth">
                            <label for="date-birth">Date Of Birth</label>
                            <div class="clear"></div>
                            <input type="date" name = "birth"   id = "date-birth"   value = "<?php echo $row['DateOfBirth']?>"   required   >
                        </div>
                        
                        <div class="mobile">
                            <label for="mobile">Your mobile Number </label>
                            <div class="clear"></div>
                            <input type="text" name="mobileno"   id = "mobile" placeholder="Enter Your mobile number"   value = "<?php echo $row['Mobile']?>"  required  >
                        </div>

                        <div class="telephone">
                            <label for="telephone">Your Telephone Number </label>
                            <div class="clear"></div>
                            <input type="text" name="telephone"  id ="telephone"  placeholder="Enter Your telephone number"  value = "<?php echo $row['Telephone']?>" required   >
                        </div>


                        <div class="address">
                            <label for="address">Your Address</label>
                            <div class="clear"></div>
                            <textarea name="address"  id ="address" cols="40" rows="10" placeholder="Enter Your Address"       required > <?php echo $row['Address']?> </textarea>
                        </div>

                        

                        <div class="submit">
                            <input type="submit" value="Update Changes" name = "updateprofile">
                           
                        </div>

                    </form>
            </div>
        </div>
        <div style="min-height: 200vh" class="container"></div>

        <script src= "js/jquery.min.js"></script>
        <script src= "js/backend.js"></script>


        <?php include('includes/footer.php');?> 


</body>
</html>