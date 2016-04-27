<script>

   function checkList(limit) {

      var form = document.forms[0];
      
      var checked = form.querySelectorAll(':checked').length;
      
      checks = form['delete_list[]'].length;
      
      if(checked == 0) {
      
         alert("no selection registered!");
         
         return false;
      
      }
      
      else if(checked == checks) {
      
         alert("must maintain at least one monitored address!");
         
         return false;
      
      }

      else {

         if(confirm("are you sure?")) {

            return true;

         }

         else {

            return false;

         }

      }
      
   }

</script>

<div id="checkbox">

   <h3>My Monitored Addresses</h3>
   
   <form name="remove" method="post" onsubmit="return checkList()">
   
   <?php $v = $option->checkbox(); ?>
   
   <br></br>

   <?php

   if ($v == 0) {

      echo "<input type='submit' value='remove address'>";

   }

   ?>

   </form>
   
</div>
