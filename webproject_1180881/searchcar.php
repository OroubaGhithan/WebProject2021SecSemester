<?php
$pageName = 'Home';
session_start();
include('includes/config.php');
include('functions.php');
error_reporting(0);


$stmt = $dbh->prepare("SELECT vehicles.* ,brands.BrandName from vehicles join brands on brands.ID=vehicles.VehiclesBrand");
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

    <title>Car Rental | Search Page</title>
</head>

<body>

    <!--Header-->
    <?php
    $pageName = 'searchcar';
    include('includes/header.php'); ?>
    <!-- /Header -->

    <div style="min-height:1400px ; padding-top:120px">
        <div class="container">

            <form method="POST">

                <div id="searchBox">

                    <input type="text" placeholder="ManYear" value="" name="v1">
                    <input type="text" placeholder="Brand or model" name="v2">
                    <input type="text" placeholder="ManCountry" value="" name="v3">
                    <input placeholder="Price form 0 to entered value" type="text" value="" name="v4">
                    <input type="submit" value="search" name="search">



                </div>
                <div id="settingsBox">


                </div>
                <div id="paintingBox">

                    <table class="reg-table">
                        <thead>
                            <th>Image </th>
                            <th>Vehcile Title</th>
                            <th>Brand</th>
                            <th>Price / Day</th>
                            <th>CarReference</th>
                            <th>VehiclesOverview</th>
                            <th>Action</th>
                        </thead>

                        <tbody>

                            <?php

                            // $stmt = $dbh->prepare("SELECT * FROM booking , users, vehicles WHERE 
                            // booking.VehicleId = vehicles.CarReference AND booking.UserID = users.ID  ;"); // 
                            // $stmt->execute();
                            // $rows = $stmt->fetchAll();


                            if (isset($_POST['search'])) {
                                $year = $_POST['v1'];
                                $model = $_POST['v2'];
                                $country = $_POST['v3'];
                                $price = $_POST['v4'];


                                // !one variables is selected just 
                                //  if (1) $results = getFilter($year);

                                if ($year != '' && $model == '' && $country == '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.ModelYear=:year";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.ModelYear=:year";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model != '' && $country == '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID  
                      where brands.BrandName =:model ";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID where brands.BrandName =:model ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model == '' && $country != '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.ManCountry=:country";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID where vehicles.ManCountry=:country";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model == '' && $country == '' && $price != '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.PricePerDay<=:price";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.PricePerDay<=:price";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                }
                                //!end one variables is selected just 
                                //!-----------------------------------------------------------------------------------------------------------------
                                elseif ($year != '' && $model != '' && $country == '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID  
                      where vehicles.ModelYear=:year and brands.BrandName =:model  ";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.ModelYear=:year and brands.BrandName =:model  ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year != '' && $model == '' && $country != '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.ModelYear=:year and vehicles.ManCountry=:country ";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.ModelYear=:year and vehicles.ManCountry=:country ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year != '' && $model == '' && $country == '' && $price != '') {

                                    echo 'hhhYP';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.ModelYear=:year  and vehicles.PricePerDay<=:price";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.ModelYear=:year  and vehicles.PricePerDay<=:price";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model != '' && $country != '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.ManCountry=:country and brands.BrandName =:model";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.ManCountry=:country and brands.BrandName =:model ";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model != '' && $country == '' && $price != '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where  
                      brands.BrandName =:model and vehicles.PricePerDay<=:price";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where  
                                    //                   brands.BrandName =:model and vehicles.PricePerDay<=:price";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model == '' && $country != '' && $price != '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where vehicles.PricePerDay<=:price  and vehicles.ManCountry=:country";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where vehicles.PricePerDay<=:price  and vehicles.ManCountry=:country";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                }
                                // //! two different hereee end-----------------------------------------------------------------------------------------------------------------

                                // ! three different vars 
                                elseif ($year != '' && $model != '' && $country != '' && $price == '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where 
                      vehicles.ModelYear=:year and vehicles.ManCountry=:country and brands.BrandName =:model";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where 
                                    //                   vehicles.ModelYear=:year and vehicles.ManCountry=:country and brands.BrandName =:model";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year != '' && $model == '' && $country != '' && $price != '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where   
                      vehicles.ModelYear=:year   and vehicles.PricePerDay<=:price and vehicles.ManCountry=:country";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where   
                                    //                   vehicles.ModelYear=:year   and vehicles.PricePerDay<=:price and vehicles.ManCountry=:country";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year != '' && $model != '' && $country == '' && $price != '') {

                                    echo 'hhh';
                                    $sql = "SELECT * SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where 
                      vehicles.ModelYear=:year and brands.BrandName =:model and vehicles.PricePerDay<=:price";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where 
                                    //                   vehicles.ModelYear=:year and brands.BrandName =:model and vehicles.PricePerDay<=:price";
                                    $query = $dbh->prepare($sql);

                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                } elseif ($year == '' && $model != '' && $country != '' && $price != '') {

                                    echo 'hhh';
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                      where 
                      vehicles.PricePerDay<=:price and vehicles.ManCountry=:country and brands.BrandName =:model";
                                    // $sql = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where 
                                    //                   vehicles.PricePerDay<=:price and vehicles.ManCountry=:country and brands.BrandName =:model";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                }
                                // //! three upove , here is four variables 
                                elseif ($year != '' && $model != '' && $country != '' && $price != '') {

                                    echo 'hhh';
                                    // $sql = "SELECT  * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
                                    //                   join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID 
                                    //                   where 
                                    //                   vehicles.ModelYear=:year and
                                    //                   vehicles.PricePerDay=:price and vehicles.ManCountry=:country and brands.BrandName =:model";
                                    $sql = "SELECT  * from vehicles  join brands on vehicles.VehiclesBrand=brands.ID 
                                    where 
                                    vehicles.ModelYear=:year and
                                    vehicles.PricePerDay<=:price and vehicles.ManCountry=:country and brands.BrandName =:model";
                                    $query = $dbh->prepare($sql);
                                    $query->bindParam(':year', $year, PDO::PARAM_STR);
                                    $query->bindParam(':country', $country, PDO::PARAM_STR);
                                    $query->bindParam(':price', $price, PDO::PARAM_STR);
                                    $query->bindParam(':model', $model, PDO::PARAM_STR);
                                    $query->execute();
                                    $results = $query->fetchAll();
                                }
                            }


                            foreach ($results as $row) {
                                echo "<tr>";
                                echo "<td><img class ='test-img' src='images/vehicleimages/" . $row['Vimage1'] . "' alt=''</td>";
                                echo "<td>" . $row['VehiclesTitle'] . "</td>";
                                echo "<td>" . $row['BrandName'] . "</td>";
                                echo "<td>" . $row['PricePerDay'] . "</td>";
                                echo "<td>" . $row['CarReference'] . "</td>";
                                echo "<td>" . substr($row['VehiclesOverview'], 0, 20). "</td>";

                            ?>

                                <td class="action-manage-brand">

                                    <?php if ($_SESSION['login']) { ?>

                                        <a href="vehical-details.php?do=rent&vhid=<?php echo $row['CarReference']; ?>"><i class="fas fa-bookmark"></i> Rent Now </a>&nbsp;&nbsp;

                                    <?php } else { ?>


                                        <a href="login.php">Login For Rent</a>
                                        <!-- save the page here !! -->


                                    <?php } ?>
                                    <!--  -->
                                    <a target="_blank" href="vehical-details.php?do=fullview&vhid=<?php echo $row['CarReference']; ?>"><i class="far fa-eye"></i> Full View</a>
                                    <!-- <a  target="_blank" href="vehical-details.php?do=fullview&vhid=<?php echo $row['CarReference']; ?>"><i class="far fa-eye"></i> View</a>&nbsp;&nbsp; -->
                                    <!-- <a href="vehical-details.php?do=rent&vhid=<?php echo $row['CarReference']; ?>" ><i class="fas fa-bookmark"></i> Rent </a> -->
                                </td>

                            <?php echo "</tr>";
                            }

                            ?>


                        </tbody>




                        </tbody>
                    </table>

                </div>

            </form>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/backend.js"></script>

    <?php include 'includes/footer.php'; ?>
</body>

</html>