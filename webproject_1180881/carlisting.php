<?php
$pageName = 'Home';
session_start();
include('includes/config.php');
include('functions.php');
error_reporting(0);

// $sql = "SELECT vehicles.VehiclesTitle,brands.BrandName,vehicles.PricePerDay,vehicles.ModelYear,
// vehicles.CarReference,vehicles.SeatingCapacity,vehicles.VehiclesOverview,vehicles.Vimage1 
// from vehicles join brands on tblbrands.ID=vehicles.VehiclesBrand";
// $query = $dbh->prepare($sql);
// $query->execute();
// $results = $query->fetchAll(PDO::FETCH_OBJ); // rows
// $cnt = 1;
$stmt = $dbh->prepare("SELECT vehicles.* ,brands.BrandName from vehicles join brands on brands.ID=vehicles.VehiclesBrand  ");
$stmt->execute();
$rows = $stmt->fetchAll();



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="images/logo.png">
  <!-- Render All Elements Normally -->
  <link rel="stylesheet" href="css/normalize.css" />
  <!-- Font Awesome Library -->
  <link rel="stylesheet" href="css/all.min.css" />
  <!-- Main Template CSS File -->
  <link rel="stylesheet" href="css/style.css" />
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com" />
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />

  <title>Car Rental | CarListing Page</title>
</head>

<body>

  <!--Header-->
  <?php
  $pageName = 'carlisting';
  include('includes/header.php'); ?>
  <!-- /Header -->
  <div style="min-height:20vh ;"></div>
  <div class="container">
    <div class="num-carlist"> We Have <span><?php echo countItems('CarReference', 'vehicles'); ?></span> Cars ! Find The Best Car For You </div>
  </div>


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
                <li>ID: <?php echo $row['CarReference']; ?> </li>
                <li>Model: <?php echo $row['BrandName'] . ' ' . $row['ModelYear']; ?> </li>
                <li>Overview: <?php echo substr($row['VehiclesOverview'], 0, 70); ?> </li>
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