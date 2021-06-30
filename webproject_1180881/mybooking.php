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

  <title>Car Rental | My Booking </title>
</head>

<body>

  <!--Header-->
  <?php
  $pageName = 'mybooking';
  include('includes/header.php'); ?>
  <!-- /Header -->
<div style="min-height: 25vh;"></div>
    <div class="container">
    <table class="reg-table">
                        <caption>My Booking Info</caption>
                        <thead>
                            <th>Vehicle Image</th>
                            <th>Vehicle Name</th>
                            <th>CarID</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>TotalPrice/Car</th>

                        </thead>

                        <tbody>
                            <?php

                                $stmt = $dbh->prepare("SELECT *   
                                FROM booking , users, vehicles
                                WHERE booking.VehicleId = vehicles.CarReference  AND
                                    booking.UserID  = users.ID ;");
                                $stmt->execute();
                                $rows = $stmt->fetchAll();
                                if ($stmt->rowCount() > 0 )
                                {
                                    foreach($rows as $row) {
                                        echo "<tr>";
                                        echo "<td><img class ='test-img' src='images/vehicleimages/" . $row['Vimage1'] . "' alt=''</td>";
                                        echo "<td>" . $row['VehiclesTitle'] . "</td>";
                                        echo "<td>" . $row['CarReference'] . "</td>";
                                        echo "<td>" . $row['FromDate'] . "</td>";
                                        echo "<td>" . $row['ToDate'] . "</td>";
                                        echo "<td>" . $row['TotalPrice'] . "</td>";
                                        echo "<tr>";
                                    }
                                }

                            ?>
                        </tbody>
        </table>

        
    </div>
    </div>

  <!-- Scripts -->
  <script src="js/jquery.min.js"></script>
  <script src="js/backend.js"></script>
  <!-- footer -->
  <?php include 'includes/footer.php'; ?>
</body>

</html>