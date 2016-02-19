//* activation.js *//

$(document).ready(function() {

   $("#opt").click(function() {

      var bool = ($(this).val() == "deactivate");

      var out = (bool) ? "deactivate account?" : "activate account?";

      if(confirm(out) == true) {

         $.ajax({

            url: "includes/activation.php"

         });

      }

      else {return false;}

      if (bool) {

         $('#currentstate').html("<h4>Your account is currently INACTIVE</h4>");

         $(this).val("activate");

      }

      else if ($(this).val() == "activate") {

         $('#currentstate').html("<h4>Your account is currently ACTIVE</h4>");

         $(this).val("deactivate");

      }

   });

});
