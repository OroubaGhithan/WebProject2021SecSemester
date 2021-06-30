<?php 
    session_start();
    include('includes/config.php');
    include('functions.php') ;
    if (isset($_SESSION['login']))
    {
      //redirectHome('back') ;
      header('Location: 1180881.php'); // 
      //header('Location: ' . $_SERVER['HTTP_REFERER']); // last page
    }
    

    if ( $_SERVER['REQUEST_METHOD'] == 'POST'  && isset ($_POST['login'])  ) 
    {
      $username = $_POST ['username'] ;
      $password = $_POST ['password'] ;
      $hashPass = sha1($password) ;
      $stmt = $dbh -> prepare ('SELECT ID ,FullName , Email , Password from users where Email= ?  and Password= ?') ; 
      $stmt -> execute(array($username , $hashPass)); 
      $row = $stmt ->fetch() ;
      $count = $stmt -> rowCount () ;
      
      
        // if count > 0 data base contain a record with this username
        if ( $count > 0 )
        {
           $_SESSION['login'] = $username ; // register SESSION name 
           
            // header('Location: ' . $_SERVER['HTTP_REFERER']);  // direct to dashboard page
           // header("location:javascript://history.go(-1)");

           $_SESSION['ID'] = $row['ID'] ;
           $_SESSION['fullname'] = $row['FullName'] ;
           //redirectHome('back') ;
           header('Location: 1180881.php');

            
        }
        else {

             echo "<script>alert('Invalid Details\\n Username and password does not Match !!');</script>";
        

    }
  }

?>



<!-- ///////////////////////////////////////////////////////////////////////////////// -->




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
    <title>Login-page </title>
</head>
<body>
    <!--Header-->
    <?php
    $pageName = 'login' ;
    include('includes/header.php');?>  
  <!-- /Header --> 
  <div style="min-height: 100vh" class="container">
      <p>wellcome to home page</p>
    </div>
  <div class= "login-back">

 
  <div  class="container">
    <div class="login-page">
      <h3>LOGIN FORM</h3>
      <div class="form">
        <form class="login-form" name="login-form"  method ="POST" action ="<?php echo $_SERVER['PHP_SELF'] ;?>"   >
          <input type= "text" placeholder="Enter your Email"  name ="username" autocomplete="off" >
          <input type="password" placeholder="password"  name = "password" />
          <input type = "submit" class="btn" value="Sign in"  name ="login" >
          <!-- <button  type= "submit" class="btn" value="Sign in"  name ="login"  >login</button> -->
          <p class="message">Not registered? <a href="registration.php">Create an account</a></p>
        </form>
    </div>
</div>
    
  </div> 
</div>
  <!-- end form -->


  <!-- Go to previous page  -->
  <!-- $previousPage = $_SERVER['HTTP_REFERER']; -->


     <!-- footer -->
     <!-- Scripts --> 
<script src= "js/jquery.min.js"></script>
<script src= "js/backend.js"></script>

     <?php include 'includes/footer.php'; ?> 
  
</body>
</html>