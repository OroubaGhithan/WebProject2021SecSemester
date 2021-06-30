<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../images/logo.png">
    <link rel="stylesheet" href="../css/adminstyle.css">
     <!-- Render All Elements Normally -->
     <link rel="stylesheet" href="../css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="../css/all.min.css" />
    <title>Admin</title>
</head>
<body>
        <!-- Side navigation -->
        <nav class="sidenav"  class = "col-1">
            <a> Main Page </a>
            <a class="tab active"  href="dashboard.php?do=Dashboard">  <i class="fas fa-chalkboard"></i>  Dashboard </a>
            <a class="tab" href="dashboard.php?do=post_brand"> <i class="fas fa-gem"></i> Post a new Brand</a>
            <a class="tab" href="dashboard.php?do=manage_brand"><i class="fas fa-edit"></i> Manage Brands</a>
            <a class="tab" href="dashboard.php?do=post_vehicle"><i class="fas fa-car-side"></i> Post a new Vehicle</a>
            <a class="tab" href="dashboard.php?do=manage_vehicle"><i class="fas fa-sitemap"></i> Manage Vehicles</a>
            <a class="tab" href="dashboard.php?do=booking_info"><i class="fas fa-question-circle"></i> Booking Info</a>
            <a class="tab" href="dashboard.php?do=reg_users"><i class="fas fa-users"></i> Registered User </a>
            <a class="tab" href="logout.php">  <i class="fas fa-sign-out-alt"></i>  Logout</a>
        </nav> 

        <script src="../js/jquery.min.js"></script>
        <script src="../js/backend.js"></script>

</body>
</html>