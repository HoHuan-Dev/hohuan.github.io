//Contact Form Antinet℠
<?php
  $name = htmlspecialchars($_POST['name']);
  $email = htmlspecialchars($_POST['email']);
  $phone = htmlspecialchars($_POST['number']);
  $email_subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  if(!empty($email) && !empty($message)){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $receiver = "antinet.mac@gmail.com";
      $subject = mb_encode_mimeheader("From: $name <$email>",'UTF-8');
      $body = "Name: $name\nEmail: $email\nPhone: $phone\nSubject: $email_subject\n\nMessage:\n$message\n\nRegards,\n$name";
      $sender = "From: No Reply Antinet.us.kg <noreply@antinet.us.kg>";
      if(mail($receiver, $subject, $body, $sender)){
         echo "Your message has been sent";
      }else{
         echo "Sorry, failed to send your message!";
      }
    }else{
      echo "Enter a valid email address!";
    }
  }else{
    echo "Email and message field is required!";
  }
?>