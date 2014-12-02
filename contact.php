<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Cornell ACM ICPC</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link rel="stylesheet" type="text/css" href="style/contact.css" />
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Noticia+Text' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
</head>
<body>
	<?php include("header.html"); ?>

	<?php
      //-----------FUNCTIONS--------------
      function get_if_set($fieldname) {
         if ( isset($_POST[$fieldname]) ) {
            return $_POST[$fieldname];
         } 
         return "";
      }
      
      /* Create a div with the requested id and the class error
      that contains the requested message. */
      function make_err($id, $msg) {
         return "<div><span id=\"$id\" class=\"error\">$msg</span></div>";
      }
      
      //-----------VARIABLE DECLARATION/EXTRACTION--------------
      $success = FALSE;
      
      $MAX_TOTAL_NAME_LENGTH = 25;
      $MAX_OTHER_REASON_FOR_CONTACT = 250; 
      $first_name = trim(get_if_set("first_name"));
      $last_name = trim(get_if_set("last_name"));
      $email = trim(get_if_set("email"));
      $email_confirmation = trim(get_if_set("email_confirmation"));
      $reason_for_contact = trim(get_if_set("reason_for_contact")); 
      $other_reason_for_contact = trim(get_if_set("other_reason_for_contact"));

      
      //Set all corresponding possible errors:
      $error = "";
      $first_name_error = "";
      $last_name_error = "";
      $combined_name_error="";
      $email_error = "";
      $other_reason_for_contact_error = "";


      if ( isset($_POST["submit"]) ) {
      $success = TRUE;
        //----------VALIDATION--------------
        //name validation:
        if ( empty($first_name)) {
            $first_name_error = make_err("first_name_error", "Please enter a first name.");
            $success = FALSE;
        }
        
        if ( empty($last_name)) {
            $last_name_error = make_err("last_name_error", "Please enter a last name.");
            $success = FALSE;
        }
        
        if((strlen($first_name) + strlen($last_name)) > $MAX_TOTAL_NAME_LENGTH){
            $combined_name_error = make_err("combined_name_error" ,"Your full name can be at most $MAX_TOTAL_NAME_LENGTH characters.");
            $success = FALSE;
        }
        
        //email validation:
        if(strlen($email) == 0 || strlen($email_confirmation) ==0){
            $email_error = make_err("email_error" , "Please enter an email address in both areas.");
            $success=FALSE;
        } else if( strcasecmp ($email, $email_confirmation) != 0){
            $email_error = make_err("email_error" , "Please make sure your email address is consistent.");
            $success = FALSE;
        } else if( ! filter_var($email, FILTER_VALIDATE_EMAIL)){
            $email_error = make_err("email_error", "This does not look like a valid email address.");
            $success = FALSE;
        }
        
        //other_reason_for_contact_error validation:
         if( strlen($other_new_featured_ingredients) > $MAX_OTHER_REASON_FOR_CONTACT){
            $other_reason_for_contact_error = make_err("other_reason_for_contact_error", "Please only include ingredient (at most $MAX_OTHER_REASON_FOR_CONTACT characters.)");
            $success = FALSE;
         }

         //create generic error message:
         if($success == FALSE){
            $error = "<div class=\"generic_error\"><h1>Oops, there's a problem</h1></div>";
         }
      }
      
      
      //----------FEEDBACK--------------
      if ( $success ) {
          print ("<h1 class='success_message'>Your submission was successful!</h1>");
          print("<p class='success_message'>We'll do our best to get back to you as soon as possible.");
      }

//----------------------------------------------------------------------------------------------------------------------------------
      //----------PRINT BACK THE FORM--------------
      echo <<< END_OF_FORM
      $error
      <p id="required">* indicates required field</p>
      <form action="contact.php" id="contact_form" method="post">
         <fieldset id="personal_info">
            <h1> Personal Information </h1>
            <label for="first_name"> First Name* : </label>
            <input type="text" name="first_name" id="first_name" title="First Name" placeholder="Sam" value = "$first_name" required>
            $first_name_error
            <br>
            <label for="last_name"> Last Name* : </label>
            <input type="text" name="last_name" id="last_name" title="Last Name (Surname)" placeholder="Jones" value = "$last_name" required>
            $last_name_error
            $combined_name_error
            <br>
            <br>
            <label for="email"> Email* : </label>
            <input type="email" name="email" id="email" Title="Email Address" placeholder="goodfood@yahoo.com" value = "$email" required>
            <br>
            <label for="email_confirmation"> Email Confirmation* : </label>
            <input type="email" name="email_confirmation" id="email_confirmation" placeholder="Confirm Email Address" value = "$email_confirmation" required>
            $email_error
         </fieldset>
         
         <fieldset id="questions">
            <h1> Questions </h1>
            <p><label for="reason_for_contact">What is your reason for contact?*</label></p>
            <select id="reason_for_contact" name="reason_for_contact">
               <option value="Interested in joining the team">Interested in joining the team</option>
               <option value="Information about logistics and meeting times">Information about logistics and meeting times</option>
               <option value="You have an opportunity for the team">You have an opportunity for the team</option>
            </select>
            <br>
            <br>
            <label for="other_reason_for_contact">If you would like to elaborate on your reason for contact or have a general inquiry, feel free to do so below: </label>
            <br>
            <textarea id="other_reason_for_contact" name="other_reason_for_contact" rows="10" cols="95" placeholder="Other Reason for Contact">$other_reason_for_contact</textarea>
         </fieldset>
         <input type="submit" id="submit" name="submit" value="Finish">
      </form>
END_OF_FORM;
?>
</body>
</html>