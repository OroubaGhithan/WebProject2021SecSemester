
<?php 
// session_start();
//include('config.php');
error_reporting(0);

  $protocol=$_SERVER['SERVER_PROTOCOL'];

  if(strpos($protocol, "HTTPS"))
  {
      $protocol="HTTPS://";
  }
  else
  {
      $protocol="HTTP://";   
  }
  $redirect_link_var=$protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
?>
<!-- Start Header -->
<header>
      <div class="container">
        <a href="1180881.php" class="logo">
          <i class="fas fa-car fa-3x"></i>
        </a>
        <nav>
         
          <ul>
            <li>
              <a  <?php setActive('Home') ; ?>  href="1180881.php"><i class="fas fa-home"></i> Home</a>
            </li>
            <li>
              <a <?php setActive('about') ; ?>  href="aboutus.php"><i class="far fa-address-card"></i> About us</a>
            </li>
            <li>
              <a   <?php setActive('carlisting') ; ?> href="carlisting.php"><i class="fas fa-car-side"></i> Cars listing</a>
            </li>
            <li>
              <a  <?php setActive('searchcar') ; ?> href="searchcar.php"><i class="fas fa-search"></i> Search</a>
            </li>
            <li>
              <a  href="#contact"><i class="fas fa-people-arrows"></i> Contact us</a>
            </li>
            <li>
            <!-- <a href="login.php"> <i class="fas fa-sign-in-alt"></i> Login/Register</a> -->
            <?php if (strlen ($_SESSION['login']) == 0 )
            { ?>
             <a <?php setActive('login') ; setActive('reg') ;  ?>   href="login.php"> <i class="fas fa-sign-in-alt"></i> Login/Register</a>
             <!-- ?page_url=<?php //echo $redirect_link_var;?> -->

         <?php } else 
         {
           ?> 
           <a id = "show-profile"  onclick="myFunction()"   <?php setActive('login') ; ?>     > <i class="fas fa-user-circle"></i> Welcome  <?php echo $_SESSION['fullname'] ?>    </a>   
       <?php  } ?> 
           
            </li>
          </ul>
        </nav>
        <?php if (strlen($_SESSION['login']) != 0)
        { ?> 
         <div id = "content" class="links" id="myDIV" > 
           <!-- begin profile info -->
           <ul>
           
            <li> <a  <?php setActive('editprofile') ; ?>  href="editprofile.php">Edit Profile</a> </li>
            <li><a  <?php setActive('mybooking') ; ?> href="mybooking.php">My Booking</a></li>
            <li><a href="logout.php">Logout</a></li>
           
           </ul>
           <!-- end profile info -->
        </div>

     <?php   } ?> 
       

      </div>
    </header>
<!-- End Header -->





<script src="js/jquery.min.js"></script>

<script>
  $(document).ready(function(){
  $("#show-profile").click(function(){
    $("#content").toggle();
  });
});

</script>

<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>

