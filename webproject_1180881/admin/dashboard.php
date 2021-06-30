<?php
session_start();
include('../includes/config.php');
include('../functions.php');

if (isset($_SESSION['Username'])) {
    include 'sidenav.php';

    $do = isset($_GET['do']) ? $_GET['do'] : 'Dashboard';
    $del = isset($_GET['del']) ? $_GET['del'] : 'manage_brand';
    if ($do == 'Dashboard') {
?>
        <div class="col-2">
            <header>
                <div>Car Rental | Dashboard Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article class="dashboard-style">
                    <div class="dashInfo-style">
                        <div>
                            <a href="dashboard.php?do=reg_users">
                                Total Members <br> <span><?php echo countItems('ID', 'users'); ?></span>
                            </a>
                        </div>
                        <div>
                            <a href="dashboard.php?do=booking_info">
                                
                                TOTAL BOOKINGS <br> <span><?php echo countItems('ID', 'booking'); ?></span>
                            </a>
                     </div>
                        <div> <a href="dashboard.php?do=manage_vehicle">
                                LISTED VEHICLES <br> <span><?php echo countItems('CarReference', 'vehicles'); ?></span></div>
                        </a>
                        <div>
                            <a href="dashboard.php?do=manage_brand">
                                LISTED BRANDS<br> <span><?php echo countItems('ID', 'brands'); ?></span>
                        </div>
                        </a>
                    </div>
                    <div class="last-reg-user">

                        <table class="last-reg">
                            <thead>
                                <th> <i class="fas fa-user-tag"></i> Latest 5 Registered Users</th>
                            </thead>
                            <tbody>
                                <?php
                                $theLatest = getLatest("FullName", "users", "ID", 5);
                                foreach ($theLatest as $last) {
                                    echo "<tr>";
                                    echo "<td>" . $last['FullName'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <table class="last-reg">
                            <thead>
                                <th> <i class="fas fa-tag"></i> Latest 5 Brands</th>
                            </thead>
                            <tbody>
                                <?php
                                $theLatest = getLatest("BrandName", "brands", "ID", 5);
                                foreach ($theLatest as $last) {
                                    echo "<tr>";
                                    echo "<td>" . $last['BrandName'] . "</td>";
                                    echo "</tr>";
                                }
                                ?>

                            </tbody>
                        </table>

                    </div>

                </article>
            </main>
        </div>
    <?php
    }

    elseif ($do == 'post_brand') {

        if (isset($_POST['submit'])) {
            $brand = $_POST['brand'];

            $isExistInDB = array();
            if (!ctype_alpha($brand)) {
                $isExistInDB[] = 'Brand Name must containt just characters !';
            }

            $ch1 = checkItem("BrandName", "brands", $brand);
            if ($ch1 == 1) {
                $isExistInDB[] = 'Brand is already EXISTS !';
            }
            if (empty($isExistInDB)) {
                $stmt = "INSERT INTO brands (BrandName) VALUES (:brand)";
                $query = $dbh->prepare($stmt);
                $query->bindParam(':brand', $brand, PDO::PARAM_STR);
                $query->execute();
            }
        }

    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Post Brand Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>

                    <form class="new-brand-form" name="new-brand-form" method="POST">
                        <div class="label">
                            <label>Post New Brand</label>
                        </div>
                        <div class="post-style">
                            <input type="text" class="post-input" placeholder="Enter Brand Name to Post" name="brand" required>
                        </div>
                        <div><button type="submit" class="submit-btn" name="submit">Submit</button> </div>
                        <div>
                            <label class="isposted">
                                <?php
                                if (empty($isExistInDB) && isset($_POST['submit'])) {
                                    echo "brand inserted successfully!";
                                } else if (!empty($isExistInDB) && isset($_POST['submit'])) {

                                    echo $isExistInDB[0];
                                }
                                ?>
                            </label>
                        </div>
                    </form>

                </article>
            </main>
        </div>

    <?php   } elseif ($do == 'edit_brand') {
        if (isset($_POST['submit'])) {
            $brand = $_POST['brand'];
            $id = $_GET['ID'];

            $isExistInDB = array();
            if (!ctype_alpha($brand)) {
                $isExistInDB[] = 'Brand Name must containt just characters !';
            }

            $ch1 = checkItem("BrandName", "brands", $brand);
            if ($ch1 == 1) {
                $isExistInDB[] = 'Brand is already EXISTS!';
            }
            if (empty($isExistInDB)) {
                $sql = "UPDATE  brands set BrandName=:brand where ID=:id";
                $query = $dbh->prepare($sql);
                $query->bindParam(':brand', $brand, PDO::PARAM_STR);
                $query->bindParam(':id', $id, PDO::PARAM_STR);
                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
            }

            // must be not empty !! 
            //echo "Brand updted successfully";

        }
        // $brand_id = isset($_GET['ID'] && is_numeric ($_GET['ID'])) ? intval($_GET['ID']) : 0 ;
        $brand_id = $_GET['ID'];
        $stmt = $dbh->prepare("SELECT * FROM brands WHERE ID = ?");
        $stmt->execute(array($brand_id));
        $row  = $stmt->fetch();

    ?>

        <div class="col-2">
            <header>
                <div>Car Rental | Edit Brand Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <form class="new-brand-form" name="new-brand-form" method="POST">
                        <div class="label"><label>Post New Brand</label></div>
                        <div class="post-style">
                            <input type="text" class="post-input" placeholder="Enter Brand Name to Post" name="brand" required value="<?php echo  $row['BrandName']; ?>">
                        </div>
                        <div><button type="submit" class="submit-btn" name="submit">Submit</button> </div>
                        <div>
                            <label class="isposted">
                                <?php
                                if (empty($isExistInDB) && isset($_POST['submit'])) {
                                    echo "brand updated successfully!";
                                } else if (!empty($isExistInDB) && isset($_POST['submit'])) {

                                    echo $isExistInDB[0];
                                }
                                ?>
                            </label>
                        </div>
                    </form>


                </article>
            </main>
        </div>



    <?php } elseif ($do == 'manage_brand') {
        $msg = '';
        if (isset($_GET['del'])) {
            $id = $_GET['del'];
            $sql = "DELETE FROM brands  WHERE ID=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $msg = "Page data updated successfully";
        }

        $stmt = $dbh->prepare("SELECT * FROM brands ");
        $stmt->execute();
        $rows = $stmt->fetchAll();
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Manage Brand Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <h3 class="delete-brand"> <?php if ($msg != '') echo $msg; ?> </h3>
                    <table class="reg-table">
                        <thead>
                            <th>Number</th>
                            <th>Brand Name</th>
                            <th>Creation Date</th>
                            <th>Updation date</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php
                            $cnt = 1;
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $cnt++ . "</td>";
                                echo "<td>" . $row['BrandName'] . "</td>";
                                echo "<td>" . $row['CreateDate'] . "</td>";
                                echo "<td>";
                                if ($row['updationDate'] == '') echo '-';
                                else echo $row['updationDate'];
                                echo "</td>";
                                //     echo "<td>" ;
                                //    echo  "<a href = 'dashboard.php?do=manage-brands.php&del= " .$row['ID'] . "'  onclick='return confirm('Do you want to delete');> > <i class='fas fa-trash-alt'></i> Delete </a>" ;
                                //     echo "</td>" ;

                            ?>

                                <td class="action-manage-brand">
                                    <a href="dashboard.php?do=edit_brand&ID=<?php echo $row['ID']; ?>"><i class="fa fa-edit"></i>Edit</a>&nbsp;&nbsp;
                                    <a href="dashboard.php?do=manage_brand&del=<?php echo $row['ID']; ?>" onclick="return confirm('Be Carfull delete this brand causes to delete all cars belonging to it\\n Do you want to delete, ');"><i class="fas fa-trash-alt"></i> Delete </a>
                                    <!-- <a href="dashboard.php?do=manage-brands&del=5" onclick="return confirm('Do you want to delete');"><i class="fas fa-trash-alt"></i> Delete </a> -->
                                </td>

                            <?php echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>



                </article>
            </main>
        </div>


    <?php   } elseif ($do == 'manage_vehicle') {

        $msg = '';
        if (isset($_GET['del'])) {
            $id = $_GET['del'];
            $sql = "DELETE FROM vehicles  WHERE CarReference=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $msg = "Vehicle record deleted successfully";
        }

        $stmt = $dbh->prepare("SELECT vehicles.* ,brands.BrandName from vehicles join brands on brands.ID=vehicles.VehiclesBrand");
        $stmt->execute();
        $rows = $stmt->fetchAll();
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Manage Vehcile Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <h3 class="delete-brand"> <?php if ($msg != '') echo $msg; ?> </h3>
                    <table class="reg-table">
                        <thead>
                            <th>Number</th>
                            <th>Vehcile Title</th>
                            <th>Brand</th>
                            <th>Price / Day</th>
                            <th>Year Model</th>
                            <th>Image </th>
                            <th>Creation Date</th>
                            <th>Updation date</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                            <?php
                            $cnt = 1;
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $cnt++ . "</td>";
                                echo "<td>" . $row['VehiclesTitle'] . "</td>";
                                echo "<td>" . $row['BrandName'] . "</td>";
                                echo "<td>" . $row['PricePerDay'] . "</td>";
                                echo "<td>" . $row['ModelYear'] . "</td>";
                                echo "<td><img class ='test-img' src='../images/vehicleimages/" . $row['Vimage1'] . "' alt=''</td>";
                                echo "<td>" . $row['RegDate'] . "</td>";
                                echo "<td>";
                                if ($row['UpdationDate'] == '') echo '-';
                                else echo $row['UpdationDate'];
                                echo "</td>";

                            ?>

                                <td class="action-manage-brand">
                                    <a href="dashboard.php?do=edit_vehicle&CarReference=<?php echo $row['CarReference']; ?>"><i class="fa fa-edit"></i>Edit</a>&nbsp;&nbsp;
                                    <a href="dashboard.php?do=manage_vehicle&del=<?php echo $row['CarReference']; ?>" onclick="return confirm('Do you want to delete !');"><i class="fas fa-trash-alt"></i> Delete </a>
                                    <!-- <a href="dashboard.php?do=manage-brands&del=5" onclick="return confirm('Do you want to delete');"><i class="fas fa-trash-alt"></i> Delete </a> -->
                                </td>

                            <?php echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>



                </article>
            </main>
        </div>




    <?php
    } elseif ($do == 'post_vehicle') {
        if (isset($_POST['submit'])) {
            $vehicletitle   = $_POST['vehicletitle'];
            $brand          = $_POST['brandname'];
            $vehicleoverview = $_POST['vehicalorcview'];
            $priceperday    = $_POST['priceperday'];
            $modelyear      = $_POST['modelyear'];
            $CarReference    = $_POST['carid'];
            $ManufacturingCountry = $_POST['country'];
            $colors         = $_POST['colors'];
            $horsepower     = $_POST['horsepower'];
            $length         = $_POST['length'];
            $width          = $_POST['width'];
            $avgkm          = $_POST['l_km'];
            $seatingcapacity = $_POST['seatingcapacity'];


            $vimage1 = $_FILES["img1"]["name"];
            $vimage2 = $_FILES["img2"]["name"];
            $vimage3 = $_FILES["img3"]["name"];
            $vimage4 = $_FILES["img4"]["name"];

            $vimage1size = $_FILES["img1"]["size"];
            $vimage2size = $_FILES["img2"]["size"];
            $vimage3size = $_FILES["img3"]["size"];
            $vimage4size = $_FILES["img4"]["size"];


            $formErrors = array();
            $isExistInDB = array();

            // list of allowed file typed to upload 
            $avatarAllowedExt = array("jpeg", "jpg", "png", "gif");
            //Get avatar extension or img of car 
            // $avatarExt1 = strtolower(end(explode('.' , $vimage1) )) ;
            // $avatarExt2 = strtolower(end(explode('.' , $vimage2) )) ;
            // $avatarExt3 = strtolower(end(explode('.' , $vimage3) )) ;
            // $avatarExt4 = strtolower(end(explode('.' , $vimage4) )) ;

            $avatarExt1 = strtolower(substr(strrchr($vimage1, '.'), 1));
            $avatarExt2 = strtolower(substr(strrchr($vimage2, '.'), 1));
            $avatarExt3 = strtolower(substr(strrchr($vimage3, '.'), 1));
            $avatarExt4 = strtolower(substr(strrchr($vimage4, '.'), 1));

            if (!empty($vimage1) && !in_array($avatarExt1, $avatarAllowedExt)) {
                $formErrors[] = 'image 1 Extension Is Not Allowed !';
            }
            if (!empty($vimage2) && !in_array($avatarExt2, $avatarAllowedExt)) {
                $formErrors[] = 'image 2 Extension Is Not Allowed !';
            }
            if (!empty($vimage3) && !in_array($avatarExt3, $avatarAllowedExt)) {
                $formErrors[] = 'image 3 Extension Is Not Allowed !';
            }
            if (!empty($vimage4) && !in_array($avatarExt4, $avatarAllowedExt)) {
                $formErrors[] = 'image 4 Extension Is Not Allowed !';
            }

            if (!empty($vimage1) && $vimage1size > 4194304) {
                $formErrors[] = 'Image 1 Can\'t Be Large than 4MB !';
            }
            if (!empty($vimage2) && $vimage2size > 4194304) {
                $formErrors[] = 'Image 2 Can\'t Be Large than 4MB !';
            }
            if (!empty($vimage3) && $vimage3size > 4194304) {
                $formErrors[] = 'Image 3 Can\'t Be Large than 4MB !';
            }
            if (!empty($vimage4) &&  $vimage4size > 4194304) {
                $formErrors[] = 'Image 4 Can\'t Be Large than 4MB !';
            }




            if (!is_numeric($priceperday)) {
                $formErrors[] = 'Price per day Must be  numeric value ! ';
            }
            if (strlen($modelyear) != 4) {
                $formErrors[] = 'Vehcile Model year Must be  4 Digit , For example 2010 , 1999  ! ';
            }
            if (!is_numeric($modelyear)) {
                $formErrors[] = 'Vehcile Model year Must be numeric value ! ';
            }
            if (!is_numeric($horsepower)) {
                $formErrors[] = 'Vehcile horse power Must be numeric value ! ';
            }
            if (!is_numeric($width)) {
                $formErrors[] = 'Vehcile Width Must be numeric value ! ';
            }
            if (!is_numeric($length)) {
                $formErrors[] = 'Vehcile Length Must be numeric value ! ';
            }
            if (!is_numeric($seatingcapacity)) {
                $formErrors[] = 'Vehcile seating capacity Must be numeric value ! ';
            }




            $ch1 = checkItem("CarReference", "vehicles", $CarReference);
            if ($ch1 == 1) {
                $isExistInDB[] = 'Vehcile is already EXISTS !';
            }

            if (empty($formErrors) && empty($isExistInDB)) {
                move_uploaded_file($_FILES["img1"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img1"]["name"]);
                move_uploaded_file($_FILES["img2"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img2"]["name"]);
                move_uploaded_file($_FILES["img3"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img3"]["name"]);
                move_uploaded_file($_FILES["img4"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img4"]["name"]);

                //!-------------------------------------------------------------------------------------------------------------------------                    //
                $sql = "INSERT INTO vehicles
                                    (VehiclesTitle,VehiclesBrand,VehiclesOverview,PricePerDay,CarReference,
                                    ModelYear,SeatingCapacity,Vimage1,Vimage2,Vimage3,Vimage4 , ManCountry  , AvailableColors, 
                                    HorsePower ,  	Width  ,  	Length_ , AvgConPerKM  ) 
                                    VALUES(:vehicletitle,:brand,:vehicleoverview,:priceperday,:CarReference,:modelyear,
                                    :seatingcapacity,:vimage1,:vimage2,:vimage3,:vimage4,
                                    :ManufacturingCountry ,:colors, :horsepower , :width , :length , :avgkm )";

                $query = $dbh->prepare($sql);
                $query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
                $query->bindParam(':brand', $brand, PDO::PARAM_STR);
                $query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
                $query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
                $query->bindParam(':CarReference', $CarReference, PDO::PARAM_STR);
                $query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
                $query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);

                $query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
                $query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
                $query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
                $query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);

                $query->bindParam(':ManufacturingCountry', $ManufacturingCountry, PDO::PARAM_STR);
                $query->bindParam(':colors', $colors, PDO::PARAM_STR);
                $query->bindParam(':horsepower', $horsepower, PDO::PARAM_STR);
                $query->bindParam(':width', $width, PDO::PARAM_STR);  // PARAM_STR
                $query->bindParam(':length', $length, PDO::PARAM_STR);
                $query->bindParam(':avgkm', $avgkm, PDO::PARAM_STR);


                $query->execute();
                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    //echo "<h3>Vehicle posted successfully</h3>";
                }

                //!-------------------------------------------------------------------------------------------------------------------------                    // 

            }
        }
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Post Vehicle Admin Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <!-- begin code html for post  -->
                    <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->
                    <div class="is-updated">
                        <label for="">

                            <?php

                            if (empty($isExistInDB)) {
                                if (!empty($formErrors)) {
                                    echo '______________________________________________________' . '<br> <br>';
                                    echo 'Error Messeges: ' . '<br><br>';
                                    foreach ($formErrors as $error) echo  '- ' . $error . '<br>';
                                    echo '______________________________________________________' . '<br> <br>';
                                } else if (empty($formErrors) && isset($_POST['submit'])) {
                                    echo "<span style ='color:green'>Vehicle posted successfully</span>";
                                }
                            } elseif (!empty($isExistInDB)) {
                                echo '______________________________________________________' . '<br> <br>';
                                echo 'Error Messeges: ' . '<br><br>';
                                foreach ($isExistInDB as $error) echo  '- ' . $error . '<br>';
                                echo '______________________________________________________' . '<br> <br>';
                            }




                            ?>

                        </label>
                    </div>

                    <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->
                    <div class="container">
                        <div class="title">POST NEW VEHICLE</div>
                        <div class="content">
                            <!--------------------------------------------------------------- BEGIN FORM TO POST NEW CAR ------------------------------------------------------------------->

                            <form method="POST" enctype="multipart/form-data">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">Vehicle Title </span>
                                        <input type="text" name="vehicletitle" placeholder="Enter Vehicle name" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">select Brand </span>
                                        <select name="brandname" class="brand-select">

                                            <?php
                                            $ret = "SELECT ID , BrandName from brands";
                                            $query = $dbh->prepare($ret);
                                            $query->execute();
                                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($results as $result) { // echo $result -> id . '   ' ;
                                            ?>
                                                    <option value="<?php echo htmlentities($result->ID); ?>"><?php echo htmlentities($result->BrandName); ?></option>
                                            <?php }
                                            } ?>

                                        </select>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Car Refrence ID </span>
                                        <input type="text" name="carid" placeholder="Enter Car Refrence ID" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Price Per Day(in USD) </span>
                                        <input type="text" name="priceperday" placeholder="Enter Price Per Day" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Model Year</span>
                                        <input type="text" name="modelyear" placeholder="Enter Model Year" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Seating Capacity</span>
                                        <input type="text" name="seatingcapacity" placeholder="Confirm your password" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Manufacturing Country</span>
                                        <input type="text" name="country" placeholder="Enter Seating Capacity" required>
                                    </div>

                                    <div class="input-box">
                                        <span class="details">Available Colors</span>
                                        <input type="text" name="colors" placeholder="Enter Available Colors" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Horse Power</span>
                                        <input type="text" name="horsepower" placeholder="Enter Horse Power" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Width</span>
                                        <input type="text" name="width" placeholder="Enter Vehicle Width" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Length</span>
                                        <input type="text" name="length" placeholder="Enter Vehicle Length" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Avg consumption Litter/km</span>
                                        <input type="text" name="l_km" placeholder="Enter avg consumption  L/KM" required>
                                    </div>


                                </div>
                                <!-- end user details  -->

                                <hr><br>
                                <div class="input-box">
                                    <span class="details">Vehical Overview</span>
                                    <textarea type="text" name="vehicalorcview" placeholder="Enter Vehicle details" cols="95" rows="10"></textarea>
                                </div>

                                <br>
                                <hr>
                                <br>
                                <br>
                                <div class="img-box">
                                    <span class="details">Upload Images</span>
                                    <div class="one">
                                        <div>Image 1<span>* </span><input type="file" name="img1" required>
                                        </div>
                                        <div>
                                            Image 2<span>* </span><input type="file" name="img2" required>
                                        </div>
                                    </div>

                                    <div class="two">
                                        <div>
                                            Image 3<span>* </span><input type="file" name="img3" required>
                                        </div>
                                        <div>
                                            Image 4 <input type="file" name="img4">
                                        </div>
                                    </div>

                                </div>


                                <div class="button">
                                    <input type="submit" value="SUBMIT" name="submit">
                                </div>

                            </form>
                            <!--------------------------------------------------------------- END FORM TO POST NEW CAR ------------------------------------------------------------------->
                        </div>
                    </div>
                    <!-- end code html for post  -->





                </article>
            </main>
        </div>

    <?php
    } elseif ($do == 'change_image1') {
        if (isset($_POST['update']) ) {
            $vimage1 = $_FILES["img1"]["name"];
            $id = $_GET['imgid'];
            move_uploaded_file($_FILES["img1"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img1"]["name"]);
            $sql = "UPDATE vehicles set Vimage1=:vimage1 where CarReference=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':vimage1', $vimage1, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $sec = 3;
        }
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Change Image 1 Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>


                    <form class="new-brand-form" method="POST" enctype="multipart/form-data">
                        <div class="label">
                            <label> Change Image </label>

                        </div>

                        <!-- ------------------------------------------------------------------ -->
                        <?php
                        $id = $_GET['imgid'];
                        $sql = "SELECT Vimage1 from vehicles where vehicles.CarReference=:id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {    ?>

                                <div class="img-change">
                                    <div>
                                        Current Image 1
                                    </div>
                                    <img src="../images/vehicleimages/<?php echo htmlentities($result->Vimage1); ?>" width="500" height="300" style="padding-block:20px;">
                                    <input type="file" name="img1" value="img1">
                                </div>


                                <!-- <div><button type="submit" class="submit-btn" name="update">Update</button> </div>
                                <div><a class="submit-btn" type="submit" href='dashboard.php?do=edit_vehicle&CarReference=<?php echo $id ?>'>Back</a></div> -->
                                <div class="submit-back-btn">
                                    <button type="submit" name="update">Update</button>
                                    <a type="submit" href='dashboard.php?do=edit_vehicle&CarReference=<?php echo $id ?>'>Back</a>
                                </div>


                        <?php
                            }
                        } ?>
        </div>
        <!-- ------------------------------------------------------------------ -->

        </form>


        </article>
        </main>
        <?php
        // if (isset($_POST['update'])) {       
        //         echo "<span> Image updated successfully ! , you will be redirect Edit  vechile page after $sec second </span>"  ;
        //         header ("refresh:$sec;url=dashboard.php?do=edit_vehicle&CarReference=$id") ;
        //         exit() ;}
        ?>
        </div>



    <?php } else if ($do == 'change_image2' ) {
        if (isset($_POST['update'])) {
            $vimage2 = $_FILES["img2"]["name"];
            $id = $_GET['imgid'];
            move_uploaded_file($_FILES["img2"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img2"]["name"]);
            $sql = "UPDATE vehicles set Vimage2=:vimage2 where CarReference=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':vimage2', $vimage2, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        }

    ?>

        <div class="col-2">
            <header>
                <div>Car Rental | Change Image 2 Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <form class="new-brand-form" method="POST" enctype="multipart/form-data">
                        <div class="label">
                            <label> Change Image </label>

                        </div>
                        <!-- ------------------------------------------------------------------ -->
                        <?php
                        $id = $_GET['imgid'];
                        $sql = "SELECT Vimage2 from vehicles where vehicles.CarReference=:id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {    ?>

                                <div class="img-change">
                                    <div>
                                        Current Image 2
                                    </div>
                                    <img src="../images/vehicleimages/<?php echo htmlentities($result->Vimage2); ?>" width="500" height="300" style="padding-block:20px;">
                                    <input type="file" name="img2">
                                </div>


                                <!-- <div><button type="submit" class="submit-btn" name="update">Update</button> </div> -->
                                <div class="submit-back-btn">
                                    <button type="submit" name="update">Update</button>
                                    <a type="submit" href='dashboard.php?do=edit_vehicle&CarReference=<?php echo $id ?>'>Back</a>
                                </div>

                        <?php
                            }
                        } ?>
        </div>
        <!-- ------------------------------------------------------------------ -->

        </form>



        </article>
        </main>
        </div>

    <?php  }
    /////////////////////////

    /////////////////////////
    elseif ($do == 'change_image3') {
        if (isset($_POST['update']) ) {
            $vimage3 = $_FILES["img3"]["name"];
            $id = $_GET['imgid'];
            move_uploaded_file($_FILES["img3"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img3"]["name"]);
            $sql = "UPDATE vehicles set Vimage3=:vimage3 where CarReference=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':vimage3', $vimage3, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        }
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Change Image 3 Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <form class="new-brand-form" method="POST" enctype="multipart/form-data">
                        <div class="label">
                            <label> Change Image </label>

                        </div>
                        <!-- ------------------------------------------------------------------ -->
                        <?php
                        $id = $_GET['imgid'];
                        $sql = "SELECT Vimage3 from vehicles where vehicles.CarReference=:id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {    ?>

                                <div class="img-change">
                                    <div>
                                        Current Image 1
                                    </div>
                                    <img src="../images/vehicleimages/<?php echo htmlentities($result->Vimage3); ?>" width="500" height="300" style="padding-block:20px;">
                                    <input type="file" name="img3">
                                </div>


                                <div class="submit-back-btn">
                                    <button type="submit" name="update">Update</button>
                                    <a type="submit" href='dashboard.php?do=edit_vehicle&CarReference=<?php echo $id ?>'>Back</a>
                                </div>

                        <?php
                            }
                        } ?>
        </div>
        <!-- ------------------------------------------------------------------ -->

        </form>



        </article>
        </main>
        </div>



    <?php }
    /////////////////////////
    elseif ($do == 'change_image4') {
        if (isset($_POST['update']) ) {
            $vimage4 = $_FILES["img4"]["name"];
            $id = $_GET['imgid'];
            move_uploaded_file($_FILES["img4"]["tmp_name"], "../images/vehicleimages/" . $_FILES["img4"]["name"]);
            $sql = "UPDATE vehicles set Vimage4=:vimage4 where CarReference=:id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':vimage4', $vimage4, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_STR);
            $query->execute();
        }
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Change Image 4 Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <form class="new-brand-form" method="POST" enctype="multipart/form-data">
                        <div class="label">
                            <label> Change Image </label>

                        </div>
                        <!-- ------------------------------------------------------------------ -->
                        <?php
                        $id = $_GET['imgid'];
                        $sql = "SELECT Vimage4 from vehicles where vehicles.CarReference=:id";
                        $query = $dbh->prepare($sql);
                        $query->bindParam(':id', $id, PDO::PARAM_STR);
                        $query->execute();
                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                        $cnt = 1;
                        if ($query->rowCount() > 0) {
                            foreach ($results as $result) {    ?>

                                <div class="img-change">
                                    <div>
                                        Current Image 4
                                    </div>
                                    <img src="../images/vehicleimages/<?php echo htmlentities($result->Vimage4); ?>" width="500" height="300" style="padding-block:20px;">
                                    <input type="file" name="img4" value="img1">
                                </div>


                                <div class="submit-back-btn">
                                    <button type="submit" name="update">Update</button>
                                    <a type="submit" href='dashboard.php?do=edit_vehicle&CarReference=<?php echo $id ?>'>Back</a>
                                </div>

                        <?php
                            }
                        } ?>
        </div>
        <!-- ------------------------------------------------------------------ -->

        </form>



        </article>
        </main>
        </div>



    <?php }
    /////////////////////////

    elseif ($do == 'edit_vehicle') {
        if (isset($_POST['submit'])) {
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`

            //$CarReference    =$_GET['CarReference'] ;
            $vehicletitle   = $_POST['vehicletitle'];
            $brand          = $_POST['brandname'];
            $vehicleoverview = $_POST['vehicalorcview'];
            $priceperday    = $_POST['priceperday'];
            $modelyear      = $_POST['modelyear'];
            $ManufacturingCountry = $_POST['country'];
            $colors         = $_POST['colors'];
            $horsepower     = $_POST['horsepower'];
            $length         = $_POST['length'];
            $width          = $_POST['width'];
            $avgkm          = $_POST['l_km'];
            $seatingcapacity = $_POST['seatingcapacity'];
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`


            $formErrors = array();




            if (!is_numeric($priceperday)) {
                $formErrors[] = 'Price per day Must be  numeric value ! ';
            }
            if (strlen($modelyear) != 4) {
                $formErrors[] = 'Vehcile Model year Must be  4 Digit , For example 2010 , 1999  ! ';
            }
            if (!is_numeric($modelyear)) {
                $formErrors[] = 'Vehcile Model year Must be numeric value ! ';
            }
            if (!is_numeric($horsepower)) {
                $formErrors[] = 'Vehcile horse power Must be numeric value ! ';
            }
            if (!is_numeric($width)) {
                $formErrors[] = 'Vehcile Width Must be numeric value ! ';
            }
            if (!is_numeric($length)) {
                $formErrors[] = 'Vehcile Length Must be numeric value ! ';
            }
            if (!is_numeric($seatingcapacity)) {
                $formErrors[] = 'Vehcile seating capacity Must be numeric value ! ';
            }


            if (empty($formErrors) ) {
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`
                // $sql="UPDATE vehicles set VehiclesTitle=:vehicletitle,VehiclesBrand=:brand,VehiclesOverview=:vehicleoverview,
                // PricePerDay=:priceperday,ModelYear=:modelyear,SeatingCapacity=:seatingcapacity
                // where CarReference=:CarReference";
                // $query = $dbh->prepare($sql);
                // $query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
                // $query->bindParam(':brand',$brand,PDO::PARAM_STR);
                // $query->bindParam(':vehicleoverview',$vehicleoverview,PDO::PARAM_STR);
                // $query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
                // $query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
                // $query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
                // $query->bindParam(':CarReference',$CarReference,PDO::PARAM_STR);
                // $query->execute();
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~`

                //!-------------------------------------------------------------------------------------------------------------------------                    //
                //$sql="UPDATE  vehicles set VehiclesTitle=:vehicletitle where ID=:id";



                $sql = "UPDATE vehicles set VehiclesTitle=:vehicletitle,VehiclesBrand=:brand,
                    VehiclesOverview=:vehicleoverview,PricePerDay=:priceperday,
                    ModelYear=:modelyear,SeatingCapacity=:seatingcapacity,ManCountry=:ManufacturingCountry,AvailableColors=:colors, 
                    HorsePower=:horsepower ,Width=:width,Length_=:length,AvgConPerKM =:avgkm
                    
                    where CarReference=:CarReference";


                $query = $dbh->prepare($sql);
                $query->bindParam(':vehicletitle', $vehicletitle, PDO::PARAM_STR);
                $query->bindParam(':brand', $brand, PDO::PARAM_STR);
                $query->bindParam(':vehicleoverview', $vehicleoverview, PDO::PARAM_STR);
                $query->bindParam(':priceperday', $priceperday, PDO::PARAM_STR);
                $query->bindParam(':modelyear', $modelyear, PDO::PARAM_STR);
                $query->bindParam(':seatingcapacity', $seatingcapacity, PDO::PARAM_STR);
                
                $query->bindParam(':ManufacturingCountry', $ManufacturingCountry, PDO::PARAM_STR);
                $query->bindParam(':colors', $colors, PDO::PARAM_STR);
                $query->bindParam(':horsepower', $horsepower, PDO::PARAM_STR);
                $query->bindParam(':width', $width, PDO::PARAM_STR);  // PARAM_STR
                $query->bindParam(':length', $length, PDO::PARAM_STR);
                $query->bindParam(':avgkm', $avgkm, PDO::PARAM_STR);
                $query->bindParam(':CarReference',$CarReference,PDO::PARAM_STR);


                $query->execute();

                $lastInsertId = $dbh->lastInsertId();
                if ($lastInsertId) {
                    //echo "<h3>Vehicle posted successfully</h3>";
                }

                //!-------------------------------------------------------------------------------------------------------------------------                    // 

            }
        }

        $id = ($_GET['CarReference']);
        $sql = "SELECT vehicles.* , brands.BrandName,brands.ID as bid from vehicles join brands on brands.ID=vehicles.VehiclesBrand where vehicles.CarReference=:id";
        $query = $dbh->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        $query->execute();
        $row = $query->fetch();
        $cnt = 1;


    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Edit Vehicle Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>
                    <!-- begin code html for post  -->
                    <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->
                    <div class="is-updated">
                        <label for="">

                            <?php


                                if (!empty($formErrors)) {
                                    echo '______________________________________________________' . '<br> <br>';
                                    echo 'Error Messeges: ' . '<br><br>';
                                    foreach ($formErrors as $error) echo  '- ' . $error . '<br>';
                                    echo '______________________________________________________' . '<br> <br>';
                                } else if (empty($formErrors) && isset($_POST['submit'])) {
                                    echo "<span style ='color:green'>Vehicle Updated successfully</span>";
                                }
                         




                            ?>

                        </label>
                    </div>

                    <!-- ----------------------------------------------------------------------------------------------------------------------------------- -->
                    <div class="container">
                        <div class="title">EDIT VEHICLE INFO</div>
                        <div class="content">
                            <!--------------------------------------------------------------- BEGIN FORM TO POST NEW CAR ------------------------------------------------------------------->

                            <form method="POST" enctype="multipart/form-data">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">Vehicle Title </span>
                                        <input type="text" name="vehicletitle" placeholder="Enter Vehicle name" value="<?php echo  $row['VehiclesTitle']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">select Brand </span>
                                        <select name="brandname" class="brand-select">
                                            <option value="<?php echo htmlentities($row['bid']); ?>"><?php echo htmlentities($bdname = $row['BrandName']); ?> </option>

                                            <?php

                                            $ret = "SELECT ID , BrandName from brands";
                                            $query = $dbh->prepare($ret);
                                            $query->execute();
                                            $resultss = $query->fetchAll(PDO::FETCH_OBJ);
                                            if ($query->rowCount() > 0) {
                                                foreach ($resultss as $results) {
                                                    if ($results->BrandName == $row['BrandName']) {
                                                        continue;
                                                    } else {
                                            ?>
                                                        <option value="<?php echo htmlentities($results->id); ?>"><?php echo htmlentities($results->BrandName); ?></option>
                                            <?php }
                                                }
                                            } ?>

                                        </select>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Car Refrence ID </span>
                                        <input type="text" name="carid" placeholder="Enter Car Refrence ID" value="<?php echo  $row['CarReference']; ?>" disabled required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Price Per Day(in USD) </span>
                                        <input type="text" name="priceperday" placeholder="Enter Price Per Day" value="<?php echo  $row['PricePerDay']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Model Year</span>
                                        <input type="text" name="modelyear" placeholder="Enter Model Year" value="<?php echo  $row['ModelYear']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Seating Capacity</span>
                                        <input type="text" name="seatingcapacity" placeholder="Confirm your password" value="<?php echo  $row['SeatingCapacity']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Manufacturing Country</span>
                                        <input type="text" name="country" placeholder="Enter Seating Capacity" value="<?php echo  $row['ManCountry']; ?>" required>
                                    </div>

                                    <div class="input-box">
                                        <span class="details">Available Colors</span>
                                        <input type="text" name="colors" placeholder="Enter Available Colors" value="<?php echo  $row['AvailableColors']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Horse Power</span>
                                        <input type="text" name="horsepower" placeholder="Enter Horse Power" value="<?php echo  $row['HorsePower']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Width</span>
                                        <input type="text" name="width" placeholder="Enter Vehicle Width" value="<?php echo  $row['Width']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Length</span>
                                        <input type="text" name="length" placeholder="Enter Vehicle Length" value="<?php echo  $row['Length_']; ?>" required>
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Avg consumption Litter/km</span>
                                        <input type="text" name="l_km" placeholder="Enter avg consumption  L/KM" value="<?php echo  $row['AvgConPerKM']; ?>" required>
                                    </div>


                                </div>
                                <!-- end user details  -->

                                <hr><br>
                                <div class="input-box">
                                    <span class="details">Vehical Overview</span>
                                    <textarea type="text" name="vehicalorcview" placeholder="Enter Vehicle details" cols="95" rows="10"><?php echo  $row['VehiclesOverview']; ?></textarea>
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
                                            Image 1 <img src="../images/vehicleimages/<?php echo htmlentities($row['Vimage1']); ?>">
                                            <a href="dashboard.php?do=change_image1&imgid=<?php echo htmlentities($row['CarReference']) ?>">Change Image 1</a>
                                        </div>

                                        <div>
                                            Image 2<img src="../images/vehicleimages/<?php echo htmlentities($row['Vimage2']); ?>">
                                            <a href="dashboard.php?do=change_image2&imgid=<?php echo htmlentities($row['CarReference']) ?>">Change Image 2</a>
                                        </div>

                                        <!-- ----------------------------------------------------------------------------------------------- -->





                                        <div class="two">
                                            <div>
                                                Image 3 <img src="../images/vehicleimages/<?php echo htmlentities($row['Vimage3']); ?>">

                                                <a href="dashboard.php?do=change_image3&imgid=<?php echo htmlentities($row['CarReference']) ?>">Change Image 3</a>
                                            </div>

                                            <div>
                                                <?php if ($row['Vimage4'] == "") {
                                                    echo "Image 4";
                                                    echo htmlentities("File not available");
                                                ?>
                                                <?php
                                                } else { ?>
                                                    Image 4<img src="../images/vehicleimages/<?php echo htmlentities($row['Vimage4']); ?>">
                                                    <a href="dashboard.php?do=change_image4&imgid=<?php echo htmlentities($row['CarReference']) ?>">Change Image 4</a>
                                                <?php } ?>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="button">
                                        <input type="submit" value="SUBMIT" name="submit">
                                    </div>

                            </form>
                            <!--------------------------------------------------------------- END FORM TO POST NEW CAR ------------------------------------------------------------------->
                        </div>
                    </div>
                    <!-- end code html for post  -->





                </article>
            </main>
        </div>

    <?php } elseif ($do == 'booking_info') {
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Booking Info Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page'; ?>

                    <table class="reg-table">
                        <caption>Booking Info</caption>
                        <thead>
                            <th>Image</th>
                            <th>Vehicle</th>
                            <th>UserName</th>
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
                                        echo "<td><img class ='test-img' src='../images/vehicleimages/" . $row['Vimage1'] . "' alt=''</td>";
                                        echo "<td>" . $row['VehiclesTitle'] . "</td>";
                                        echo "<td>" . $row['FullName'] . "</td>";
                                            echo "<td>" . $row['FromDate'] . "</td>";
                                            echo "<td>" . $row['ToDate'] . "</td>";
                                            echo "<td>" . $row['TotalPrice'] . "</td>";
                                            
                                        echo "<tr>";
                                    }
                                }

                            ?>
                        </tbody>
                    </table>


                </article>
            </main>
        </div>

    <?php } elseif ($do == 'reg_users') {
        $stmt = $dbh->prepare("SELECT * FROM users ");
        $stmt->execute();
        $rows = $stmt->fetchAll();
    ?>
        <div class="col-2">
            <header>
                <div>Car Rental | Admin Panel</div>
                <div> Welcome ADMIN </div>
            </header>
            <main class="content">
                <article><?php echo $do . ' page '; ?>

                    <table class="reg-table">
                        <caption>Registered users</caption>
                        <thead>
                            <th>ID Number</th>
                            <th>UserName</th>
                            <th>Email</th>
                            <th>Date Of Birth</th>
                            <th>Registered Date</th>
                            <th>Updated Date</th>
                            <th>Address </th>
                            <th>Moblie </th>
                            <th>Telephone </th>
                        </thead>

                        <tbody>
                            <?php
                            foreach ($rows as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['ID'] . "</td>";
                                echo "<td>" . $row['FullName'] . "</td>";
                                echo "<td>" . $row['Email'] . "</td>";
                                echo "<td>" . $row['DateOfBirth'] . "</td>";
                                echo "<td>" . $row['RegDate'] . "</td>";
                                // echo "<td>" . $row['UpdationDate'] . "</td>" ;

                                echo "<td>";
                                if ($row['UpdationDate'] == '') echo '-';
                                else echo $row['UpdationDate'];
                                echo "</td>";
                                echo "<td>" . $row['Address'] . "</td>";
                                echo "<td>" . $row['Mobile'] . "</td>";
                                echo "<td>" . $row['Telephone'] . "</td>";

                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>

                </article>
            </main>
        </div>



<?php }
} else {
    header('Location: index.php');
    exit();
}

?>