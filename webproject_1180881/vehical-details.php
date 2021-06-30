<?php
$pageName = 'Home';
session_start();
include('includes/config.php');
include('functions.php');
error_reporting(0);


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

    <title>Car Rental | Vehical Details Page</title>
</head>

<body>

    <!--Header-->
    <?php
    $pageName = 'Vehical Details';
    include('includes/header.php');
    $do = isset($_GET['do']) ? $_GET['do'] : 'searchcar.php';
    if ($do == 'fullview') {
        echo $do . ' page ';


        $id = ($_GET['vhid']);
        //echo $id ;
        $sql = "SELECT vehicles.* , brands.BrandName,brands.ID as bid from vehicles join brands on brands.ID=vehicles.VehiclesBrand where vehicles.CarReference=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();
        $cnt = 1;

    ?>
        <div style="min-height:18vh;"></div>
        <main class="container">
            <article class="content">



                <div class="container1">

                    <div class="title">FULLVIEW VEHICLE INFO</div>
                    <div class="content">
                        <!--------------------------------------------------------------- BEGIN FORM TO POST NEW CAR ------------------------------------------------------------------->

                        <form method="POST" enctype="multipart/form-data">
                            <div class="user-details">
                                <div class="input-box">
                                    <span class="details">Vehicle Title </span>
                                    <input type="text" name="vehicletitle" placeholder="Enter Vehicle name" value="<?php echo  $row['VehiclesTitle']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">select Brand </span>
                                    <input type="text" name="brandname" placeholder="Enter Car Refrence ID" value="<?php echo htmlentities($row['BrandName']); ?>" readonly>


                                </div>
                                <div class="input-box">
                                    <span class="details">Car Refrence ID </span>
                                    <input type="text" name="carid" placeholder="Enter Car Refrence ID" value="<?php echo  $row['CarReference']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Price Per Day(in USD) </span>
                                    <input type="text" name="priceperday" placeholder="Enter Price Per Day" value="<?php echo  $row['PricePerDay']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Model Year</span>
                                    <input type="text" name="modelyear" placeholder="Enter Model Year" value="<?php echo  $row['ModelYear']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Seating Capacity</span>
                                    <input type="text" name="seatingcapacity" placeholder="Confirm your password" value="<?php echo  $row['SeatingCapacity']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Manufacturing Country</span>
                                    <input type="text" name="country" placeholder="Enter Seating Capacity" value="<?php echo  $row['ManCountry']; ?>" readonly>
                                </div>

                                <div class="input-box">
                                    <span class="details">Available Colors</span>
                                    <input type="text" name="colors" placeholder="Enter Available Colors" value="<?php echo  $row['AvailableColors']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Horse Power</span>
                                    <input type="text" name="horsepower" placeholder="Enter Horse Power" value="<?php echo  $row['HorsePower']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Width</span>
                                    <input type="text" name="width" placeholder="Enter Vehicle Width" value="<?php echo  $row['Width']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Length</span>
                                    <input type="text" name="length" placeholder="Enter Vehicle Length" value="<?php echo  $row['Length_']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Avg consumption Litter/km</span>
                                    <input type="text" name="l_km" placeholder="Enter avg consumption  L/KM" value="<?php echo  $row['AvgConPerKM']; ?>" readonly>
                                </div>


                            </div>
                            <!-- end user details  -->

                            <hr><br>
                            <div class="input-box">
                                <span class="details">Vehical Overview</span>
                                <textarea type="text" readonly name="vehicalorcview" placeholder="Enter Vehicle details" cols="95" rows="10"><?php echo  $row['VehiclesOverview']; ?></textarea>
                            </div>

                            <br>
                            <hr>
                            <br>
                            <br>
                            <div class="img-box">
                                <span class="details">Vehicle Images</span>
                                <div class="one">

                                    <!-- ----------------------------------------------------------------------------------------------- -->

                                    <div>
                                        Image 1 <img src="images/vehicleimages/<?php echo htmlentities($row['Vimage1']); ?>">
                                    </div>

                                    <div>
                                        Image 2<img src="images/vehicleimages/<?php echo htmlentities($row['Vimage2']); ?>">
                                    </div>

                                    <!-- ----------------------------------------------------------------------------------------------- -->





                                    <div class="two">
                                        <div>
                                            Image 3 <img src="images/vehicleimages/<?php echo htmlentities($row['Vimage3']); ?>">
                                        </div>

                                        <div>
                                            <?php if ($row['Vimage4'] == "") {
                                                echo "Image 4";
                                                echo htmlentities("\nFile not available");
                                            ?>
                                            <?php
                                            } else { ?>
                                                Image 4<img src="images/vehicleimages/<?php echo htmlentities($row['Vimage4']); ?>">
                                            <?php } ?>
                                        </div>
                                    </div>

                                </div>
                                <!--  -->
                                <?php if ($_SESSION['login']) { ?>
                                    <div class="button">
                                        <button>

                                            <a href="vehical-details.php?do=rent&vhid=<?php echo $row['CarReference']; ?>"> RENT NOW </a>&nbsp;&nbsp;
                                        </button>

                                    </div>
                                <?php } else { ?>
                                    <div class="button">
                                        <button>

                                            <a href="login.php">Login For RENT</a>
                                        </button>
                                    </div>

                                <?php } ?>
                                <!--  -->



                        </form>
                        <!--------------------------------------------------------------- END FORM TO POST NEW CAR ------------------------------------------------------------------->
                    </div>
                </div>
                <!-- end code html for post  -->


            </article>


        </main>

        </div>
    <?php } elseif ($do == 'rent') {
        echo $do . ' page ';
        $msg = '';
        // !---------------------------------------------------------------------------------------------
        if (isset($_POST['submit'])) {

            $id = ($_GET['vhid']);
            $sql = "SELECT vehicles.* , brands.BrandName,brands.ID as bid from vehicles join brands on brands.ID=vehicles.VehiclesBrand where vehicles.CarReference=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $row = $query->fetch();
            $pr = $row['PricePerDay'];


            $fromdate = $_POST['fromdate'];
            $todate = $_POST['todate'];
            $useremail =  $_SESSION['ID'];
            $vhid = $_GET['vhid'];

            ///
            $sql1 = "SELECT FromDate , ToDate FROM booking WHERE VehicleId=:id";
            $query1 = $dbh->prepare($sql1);
            $query1->bindParam(':id', $id, PDO::PARAM_STR);
            $query1->execute();
            $rows = $query1->fetchAll();
            $count = $query1->rowCount();
            $pairDates = array();

            // check if its valued form date to date function     
            $isrentedCar = 0; // is it rented by another user ? 
            if ($query1->rowCount()) {
                foreach ($rows as $row) {
                    //echo $row['FromDate'] .  ' ' . $row['ToDate'] . "<br>";
                    $pairDates[$row['FromDate']] = $row['ToDate'];
                }
            }

            foreach ($pairDates as $firstDate => $secDates) {
                if ($fromdate >  $secDates or $todate < $firstDate) {
                    continue;
                } else {

                    $isrentedCar = 1;
                    break;
                }
            }
            if ($isrentedCar) {
                $msg = 'Unfortunately, This Car can\'t be available in this date ! ';
                echo 'can\'t rent';
            } else {
                $pairDates = array();
                echo 'ok then insert to db ';
                // !---------------- Start calculate totalPrice -----------------------------

                $date1 = strtotime($fromdate);
                $date2 = strtotime($todate);

                $diff = abs($date2 - $date1);

                $years = floor($diff / (365 * 60 * 60 * 24));


                $months = floor(($diff - $years * 365 * 60 * 60 * 24)
                    / (30 * 60 * 60 * 24));

                $days = floor(($diff - $years * 365 * 60 * 60 * 24 -
                    $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                $days += $years * 365 + $months * 30 + 1;
                $totalPrice = $pr * $days;
                $tot_pr = $totalPrice;
                //echo $tot_pr . ' ' . $totalPrice . ' ' . $days ; 
                // !---------------- End calculate totalPrice -----------------------------

                $sql = "INSERT INTO booking(UserID,VehicleId,FromDate,ToDate,TotalPrice) VALUES(:useremail,:vhid,:fromdate,:todate,:tot_pr)";
                $query = $dbh->prepare($sql);
                $query->bindParam(':useremail', $useremail, PDO::PARAM_STR);
                $query->bindParam(':vhid', $vhid, PDO::PARAM_STR);
                $query->bindParam(':fromdate', $fromdate, PDO::PARAM_STR);
                $query->bindParam(':todate', $todate, PDO::PARAM_STR);
                $query->bindParam(':tot_pr', $tot_pr, PDO::PARAM_STR);
                $query->execute();

                $msg = 'Booking successfull ! And totalPrice Is = ' . $tot_pr;
            }
        }

    ?>
        <div style="min-height:18vh;"></div>
        <main class="container">
            <article class="content">
                <?php //!------------------------------------------------------------------------------------- 
                ?>
                <div class="container1">

                    <div class="title">VEHICLE INFO</div>
                    <div class="content">
                        <!--------------------------------------------------------------- BEGIN FORM TO POST NEW CAR ------------------------------------------------------------------->
                        <?php
                        $id = ($_GET['vhid']);
                        //echo $id ;
                        $sql = "SELECT vehicles.* , brands.BrandName,brands.ID as bid from vehicles join brands on brands.ID=vehicles.VehiclesBrand where vehicles.CarReference=:id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                        $query->execute();
                        $row = $query->fetch();

                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="user-details">

                                <div class="input-box">
                                    <span class="details">Car Refrence ID </span>
                                    <input type="text" name="carid" placeholder="Enter Car Refrence ID" value="<?php echo  $row['CarReference']; ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Brand / Model </span>
                                    <input type="text" name="brandname" placeholder="Enter Car Refrence ID" value="<?php echo htmlentities($row['BrandName']); ?>" readonly>
                                </div>
                                <div class="input-box">
                                    <span class="details">Price Per Day(in USD) </span>
                                    <input type="text" name="priceperday" placeholder="Enter Price Per Day" value="<?php echo  $row['PricePerDay']; ?>" readonly>
                                </div>

                                <div class="input-box">
                                    <span class="details">Manufacturing Country</span>
                                    <input type="text" name="country" placeholder="Enter Seating Capacity" value="<?php echo  $row['ManCountry']; ?>" readonly>
                                </div>



                            </div>
                            <!-- end user details  -->

                            <hr><br>
                            <div class="input-box">
                                <span class="details">Vehical Overview</span>
                                <textarea type="text" readonly name="vehicalorcview" placeholder="Enter Vehicle details" cols="95" rows="10"><?php echo  $row['VehiclesOverview']; ?></textarea>
                            </div>

                            <?php //!------------------------------------------------------------------------------------- 
                            ?>

                            <br><br>
                            <table class="reg-table">
                                <caption>This Vehicle Is Already Rented By another User in THese Days <br><br></caption>
                                <thead>
                                    <th>Renting Date</th>
                                    <th>Return Date</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $id = ($_GET['vhid']);
                                    $sql1 = "SELECT FromDate , ToDate FROM booking WHERE VehicleId=:id";
                                    $query1 = $dbh->prepare($sql1);
                                    $query1->bindParam(':id', $id, PDO::PARAM_STR);
                                    $query1->execute();
                                    $rows = $query1->fetchAll();
                                    $count = $query1->rowCount();
                                    $pairDates = array();

                                    // check if its valued form date to date function     
                                    $isrentedCar = 0; // is it rented by another user ? 
                                    if ($query1->rowCount()) {
                                        foreach ($rows as $row) {
                                            //echo $row['FromDate'] .  ' ' . $row['ToDate'] . "<br>";
                                            $pairDates[$row['FromDate']] = $row['ToDate'];
                                        }
                                    }

                                    foreach ($pairDates as $firstDate => $secDates) {
                                        // print in table data 
                                        echo "<tr>";
                                        echo "<td>" . $firstDate . "</td>";
                                        echo "<td>" . $secDates . "</td>";
                                        echo "<tr>";
                                    }

                                    ?>
                                </tbody>
                            </table>



                            <div class="rent">
                                <h1 class="h1">RENT PAGE</h1>
                                <form method="POST" action="">


                                    <div>
                                        <label>From Date</label>
                                        <input type="date" name="fromdate" required />
                                        <label>To Date</label>
                                        <input type="date" name="todate" required />
                                    </div>

                                    <div class="btn-rent">
                                        <label>
                                            <?php
                                            if ($msg != '') echo $msg;
                                            echo "<br>"
                                            ?>
                                        </label>
                                        <input type="submit" name="submit" value="RENT NOW" />
                                    </div>
                                </form>
                            </div>
            </article>
        </main>


    <?php } elseif ($do == 'confirm_renting') {

        echo 'heeee' ;

    ?>


    <?php } ?>


    <!-- Scripts -->
    <script src="js/jquery.min.js"></script>
    <script src="js/backend.js"></script>
    <!-- footer -->
    <?php include 'includes/footer.php'; ?>
</body>

</html>