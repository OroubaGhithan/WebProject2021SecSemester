<?php
// session_start();
function getTitle()
{
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    } else echo 'Car Rental';
}

function redirectHome1($errorMsg, $sec  = 3)
{
    echo $errorMsg;
    header("refresh:$sec;url=1180881.php");
    exit();
}
function redirectHome($url = null)
{
    if ($url === null) $url = '1180881.php';
    else {
        $url = isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] != '' ? $_SERVER['HTTP_REFERER'] : '1180881.php';
    }
    header("refresh:1 : url=$url");
    exit();
}

// Chek item function 
// if item is in database or not 

function checkItem($select, $from, $value)
{
    global $dbh;
    $statement = $dbh->prepare("SELECT $select FROM $from WHERE $select = ? ");

    $statement->execute(array($value));

    $count = $statement->rowCount();

    "<script>alert('Danret count in 1')</script>";
    echo $count;
    return $count;
}

//***************/
// count number of items 
function countItems($item, $tableName)
{
    global $dbh;
    $stmt2 = $dbh->prepare("SELECT COUNT($item) FROM $tableName");
    $stmt2->execute();
    return $stmt2->fetchColumn();
}

// function to fetch or Get latest records from DB

function getLatest($select, $table, $order, $limit = 5)
{
    global $dbh;
    $getstmt = $dbh->prepare("SELECT $select FROM $table ORDER BY $order LIMIT $limit ");
    $getstmt->execute();
    $rows = $getstmt->fetchAll();
    return $rows;
}
// ////////////////////////////////////////////////////////////////////////

function getFilter($year = null , $model=  ''  )
{
    global $dbh;

    $getstmt = $dbh->prepare("SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
    join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID
    where vehicles.ModelYear= $year and vehicles.ModelYear = $model ");
    $getstmt->execute();
    $rows = $getstmt->fetchAll();
    return $rows;
}


//////////////////////////////
function filterupdate()
{
    $querytest = "SELECT * from booking join vehicles on vehicles.CarReference = booking.VehicleId 
    join users on users.ID=booking.UserID join brands on vehicles.VehiclesBrand=brands.ID";

    $filtered_get = array_filter($_POST); // removes empty values from $_GET

    if (count($filtered_get)) { //not empty
        $querytest .= " WHERE";

        $keynames = array_keys($filtered_get); // make array of key names from $filtered_get

        foreach($filtered_get as $key => $value)
        {
        $querytest .= " $keynames[$key] = '$value'";  // $filtered_get keyname = $filtered_get['keyname'] value
        if (count($filtered_get) > 1 && (count($filtered_get) > $key)) { // more than one search filter, and not the last
            $querytest .= " AND";
        }
        }
    }
    $querytest .= ";" ;
echo $querytest ; 
}


// SET ACTIVE PAGE
function setActive($name)
{
    global $pageName;
    if (isset($pageName) && $pageName == $name) {
        echo "class = 'active' ";
    }
}

// get today date 

function getTodayDate()
{
    $arrDate = getdate();

    $intMonthDay = $arrDate['mday'];
    $intMonth = $arrDate['mon'];
    $intYear = $arrDate['year'];

    $date = $intYear . "-" . $intMonth . "-" . $intMonthDay;

    return $date;
}


// get today time 
function getTodayDatetime(){
    $arrDate = getdate();

    $intMinutes = $arrDate['minutes'];
    $intHours = $arrDate['hours'];
    
    $intMonthDay = $arrDate['mday'];
    $intMonth = $arrDate['mon'];
    $intYear = $arrDate['year'];
    
    $datetime = $intYear . "-" . $intMonth . "-" . $intMonthDay . " " . $intHours . ":" . $intMinutes . ":00";
    
    return $datetime;
}
