<?php 
    session_start();
    include('../includes/config.php');
    include ('../functions.php') ;
    if (isset($_SESSION['Username']))
    {
        header('Location: dashboard.php');
    }
    

    if ( $_SERVER['REQUEST_METHOD'] == 'POST'  && isset ($_POST['login'])  ) 
    {
        $username = $_POST ['username'] ;
        $password = $_POST ['password'] ;
        $hashPass = sha1($password) ;

        $stmt = $dbh -> prepare ('SELECT UserName , Password from admin where UserName= ?  and Password= ?') ; 
        $stmt -> execute(array($username , $hashPass)); 
        $count = $stmt -> rowCount () ;


        echo $username . ' ' . $hashPass ;
        // if count > 0 data base contain a record with this username
        if ( $count > 0 )
        {
            $_SESSION['Username'] = $username ; // register SESSION name 
            header('Location: dashboard.php');  // direct to dashboard page
            exit();
            // echo "<script type='text/javascript'> document.location = 'dashbord.php'; </script>";

            
        }
        else {
            echo "<script>alert('Invalid Details');</script>";
        }

    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo.png">
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="../css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <!-- Main Template CSS File -->
    <link rel="stylesheet" href="../css/adminstyle.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />

    <title> Car Rental | Admin Login </title>
</head>
<body class= "body-style">
    
    <form class="login-box" method="POST" action ="<?php echo $_SERVER['PHP_SELF'] ?>" >
        <h1>Admin Login</h1>
        <div class="textbox">
        <i class="fas fa-user"></i>
        <input type="text" placeholder="Username" name ="username"  >
    </div>

    <div class="textbox" >
    <i class="fas fa-lock"></i>
    <input type="password"  placeholder="Password" name ="password" >
    </div>

    <input type= "submit" class="btn" value="Sign in"  name ="login">

    </form>

<!-- Scripts --> 
<script src= "../js/jquery.min.js"></script>
<script src= "../js/backend.js"></script>
</body>
</html>