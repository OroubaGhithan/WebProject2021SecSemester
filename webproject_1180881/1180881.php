<?php
$pageName = 'Home';
session_start();
include('includes/config.php');
include('functions.php');
error_reporting(0);

$stmt = $dbh->prepare("SELECT vehicles.* ,brands.BrandName from vehicles join brands on brands.ID=vehicles.VehiclesBrand LIMIT  6 ");
$stmt->execute();
$rows = $stmt->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Render All Elements Normally -->
  <link rel="stylesheet" href="css/normalize.css" />
  <link rel="icon" href="images/logo.png">
  <!-- Font Awesome Library -->
  <link rel="stylesheet" href="css/all.min.css" />
  <!-- Main Template CSS File -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />

  <title>Car Rental | Home Page</title>
</head>

<body>

  <!--Header-->
  <?php
  $pageName = 'Home';
  include('includes/header.php'); 
  ?>
  <!-- /Header -->

  <!-- start landing -->
  <section class="landing">
    <div class="overlay"></div>
    <div class="text">
      <h2>Find the Best Car For You</h2>

      <p>We have a lot of cars for you to choose.</p>
    </div>
  </section>
  <!-- end landing -->

  <!-- start main -->

  <!-- Start Pricing -->
  <div class="pricing">
    <div class="container">
      <div class="plans">
        <?php
        if ($rows > 0) {
          foreach ($rows as $row) { ?>

            <div class="plan">
              <div class="head">

                <h3><?php echo htmlentities($row['VehiclesTitle']); ?></h3>
                <span><?php echo $row['PricePerDay'] ?></span>
              </div>
              <ul>
                <li>ModelYear: <?php echo $row['ModelYear']; ?> </li>
                <li>BrandName: <?php echo $row['BrandName']; ?> </li>
                <li> <a href="#"><img src="images/vehicleimages/<?php echo htmlentities($row['Vimage1']); ?>"></a>
                </li>
              </ul>
              <div class="foot">
                <!--  -->
                <?php if ($_SESSION['login']) { ?>

                  <a href="vehical-details.php?do=rent&vhid=<?php echo $row['CarReference']; ?>"><i class="fas fa-bookmark"></i> Rent Now </a>&nbsp;&nbsp;

                <?php } else { ?>


                  <a href="login.php">Login For Rent</a>
                  <!-- save the page here !! -->


                <?php } ?>
                <!--  -->
                <a target="_blank" href="vehical-details.php?do=fullview&vhid=<?php echo $row['CarReference']; ?>"><i class="far fa-eye"></i> Full View</a>
              </div>
            </div>

        <?php  }
        } ?>

      </div>





    </div>

  </div>
  </div>
  <!-- End Pricing -->
  <?php // print_r($_SESSION['ID']) ;  
  ?>
  </div>
  <!-- end main -->
  <!-- Script  -->
  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/backend.js"></script>
  <!-- footer -->
  <?php include 'includes/footer.php'; ?>
</body>

</html>