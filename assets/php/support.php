<?php
 
if(isset($_POST['email'])) {
 
 if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
        //your site secret key
        $secret = '6LewOCITAAAAAHBW79L-X636khL7pBBqpWoZsWJ7';
        //get verify response data
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
        $responseData = json_decode($verifyResponse);
        if($responseData->success) {
 
          // EDIT THE 2 LINES BELOW AS REQUIRED
       
          $email_to = "support@purebredgaming.com";
       
          $email_subject = "New entry in Support form";
       
           
       
           
       
          function died($error) {
       
              header("Location: https://www.purebredgaming.com/form/form-error.html");
       
              die();
       
          }
       
           
       
          // validation expected data exists
       
          if(!isset($_POST['name']) ||
       
              !isset($_POST['email']) ||
       
              !isset($_POST['message'])) {
       
              header("Location: https://www.purebredgaming.com/form/form-error.html");

              die();       
       
          }
       
           
       
          $name = $_POST['name']; // required
       
          $email_from = $_POST['email']; // required
       
          $message = $_POST['message']; // required
       
           
       
          $error_message = "";
       
          $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
       
        if(!preg_match($email_exp,$email_from)) {
       
          $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
       
        }
       
          $string_exp = "/^[A-Za-z .'-]+$/";
       
        if(!preg_match($string_exp,$name)) {
       
          $error_message .= 'The name you entered does not appear to be valid.<br />';
       
        }
       
        if(strlen($message) < 2) {
       
          $error_message .= 'The message you entered do not appear to be valid.<br />';
       
        }
       
        if(strlen($error_message) > 0) {
       
          died($error_message);
       
        }
       
          $email_message = "Form details below.\n\n";
       
           
       
          function clean_string($string) {
       
            $bad = array("content-type","bcc:","to:","cc:","href");
       
            return str_replace($bad,"",$string);
       
          }
       
           
       
          $email_message .= "Name: ".clean_string($name)."\n";
       
          $email_message .= "Email: ".clean_string($email_from)."\n";
       
          $email_message .= "Message: ".clean_string($message)."\n";
       
           
       
           
       
      // create email headers
       
      $headers = 'From: '.$email_from."\r\n".
       
      'Reply-To: '.$email_from."\r\n" .
       
      'X-Mailer: PHP/' . phpversion();
       
      @mail($email_to, $email_subject, $email_message, $headers);  
       

      header("Location: https://www.purebredgaming.com/form/form-success.html");
      die();

    }

  } else {
      header("Location: https://www.purebredgaming.com/form/form-error.html");
    }
}
 
?>