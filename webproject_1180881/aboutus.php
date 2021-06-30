<?php
session_start();
include('includes/config.php');
include('functions.php');
error_reporting(0);
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
  <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet" />
  <title>Car Rental | About Us</title>
</head>

<body>
  <!-- Header -->
  <?php
  $pageName = 'about';
  include 'includes/header.php' ?>
  <!-- Header -->
  <!-- Start Features -->
  <main class="features">
   

      <div id="agency" class="feat">
        <i class="fas fa-magic fa-3x"></i>
        <h3>The Agency</h3>
        <p>Since the beginning of its activities, the company for the trade of cars, "Jamal Al-Masry Company previously", has witnessed remarkable successes, which enabled it to occupy a prominent position in the field of car trade and maintenance in the Palestinian territories. The company, which has proven its establishment in a subsidiary of Volkswagen,
          has its own construction,
          in addition to the agencies of Volkswagen International and (Liebherr Heavy Equipments), heavy heavy. The company was founded in 1960s. </p>
      </div>


      <section class="container2">
        <div class="feat">
          <i class="fas fa-city fa-3x"></i>
          <h3>The City Of Company</h3>
          <p>Position: Ramallah & Al Bireh Address : Al Quds Street, Near New Red Crescent Hospital, Al Bireh, Ramallah,
            population: 38,998 people , weather is around 29c in summer and it reach under zero in winter, famous product :nutella coffe shop,
            famous people: Yasser Arafat, <a href="https://en.wikipedia.org/wiki/Ramallah">Ramallah</a> webpage may have more info about Ramallah city. </p>
        </div>
        <div class="feat">
          <i class="far fa-gem fa-3x"></i>
          <h3>Main Business Activities</h3>
          <p> <span>60+</span> years in Business <br> <span>1200+ </span>
            New Cars For Sale <br> <span>1000+</span>
            Used Cars For Sale <br> <span>600+</span>
            Satisfied Customers <br>
            <span>16+</span> Available hours in company <br>
            <span>24</span> Available online website <br>
          </p>
        </div>
      </section>


  </main>
  <!-- End Features -->
  <!-- footer -->
  <?php include 'includes/footer.php' ?>
  <!-- footer -->

</body>

</html>