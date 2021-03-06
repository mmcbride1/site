<?php

   session_start();

   include('useroption.php');
   
   /**
    * Get the current
    * username
    *
    **/

   function username() {

      return $_SESSION['username'];

   }
   
   /**
    * Display greeting
    * to user
    *
    **/
    
    function usergreeting() {

      $name = (string)username();

      return "Welcome $name!";

   }
   
   /**
    * Create the form
    * that adds site
    * or address
    *
    **/
    
    function addsiteform($obj) {

      include('variables/variables.php');

      echo "<div id='add-container'>";
      echo "<form id='add-site' method='post'>";
      echo "<br>";
      echo "<h3>ADD ADDRESS</h3><br>";
      echo "<input type='text' name='new-site'>";
      echo "<br></br>";
      echo "<input type='submit' value='add'>";
      echo "</form>";

      if(!empty($_POST['new-site'])) {

         if($obj > 0) {

            echo '<h3>';
            echo '<script>';
            echo 'document.write("'.$invalid2.'");';
            echo '</script>';
            echo '</h3>';

         }

         else {

            header("location:userlanding.php");

         }

      }

      echo "</div>";

   }

?>

<html>

   <head>
   
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

      <script src="script/activation.js"></script>

      <link href='http://fonts.googleapis.com/css?family=Play' rel='stylesheet' type='text/css'>

      <link rel="stylesheet" type="text/css" href="style.css" media="screen" />

      <link rel="stylesheet" type="text/css" href="styles/landing.css" media="screen" />

      <title>Landing</title>
      
   </head>
   
   <body>
   
      <div id="landing-outer-wrapper">
      
         <?php

            include('includes/header.php');

            include('includes/nav.php');

            $option = new UserOption(username());

         ?>
         
         <div id="landing-wrapper">
         
            <div id="landing-content">
            
               <!-- user greeting -->

               <div id="greeting">
               
                  <h2><?php echo usergreeting() ?></h2>

                  <h4>Your Account Information</h4>
               
               </div>
               
               <?php

                  $option->displaysite();

                  $cnt = $option->sitecount();

                  if($cnt > 1 && $cnt < 5) {

                     include('includes/checkboxform.php');

                     addsiteform($option->addsite($_POST['new-site']));

                  }

                  else if($cnt > 1 && $cnt >= 5) {

                     include('includes/checkboxform.php');

                  }

                  else {

                     include('includes/checkboxform.php');

                     addsiteform($option->addsite($_POST['new-site']));

                  }

            ?>
            
            <!-- account deactivation/activation -->

               <div id="accountstate">

                  <h3>Account Status</h3>

                  <?php if($option->status() == 0) { ?>

                  <div id="currentstate"><h4><?php echo $inactive ?></h4></div>
                  
                  <br>
                  
                  <input type="button" id="opt" value="activate">

                  <?php } else { ?>

                  <div id="currentstate"><h4><?php echo $active ?></h4></div>
                  
                  <br>
                  
                  <input type="button" id="opt" value="deactivate">

                  <?php } ?>

                  <p>* Deactivation suspends monitroing services.<br>* Reactivate at any time.</p>

               </div>

            <?php include('includes/pingbox.php'); ?>
            
            </div>
         
         </div>
         
         <?php include('includes/footer.php') ?>
      
      </div>
   
   </body>

</html>

<!-- remove user site action -->

<?php

   /* collect sites for deletion */

   $list = $_POST['delete_list'];

   if(!empty($list)) {

      $option->removesite($list);

      header("location:userlanding.php");

   }

?>
