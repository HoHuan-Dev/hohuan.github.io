<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
				$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $number = filter_var(trim($_POST["number"]), FILTER_SANITIZE_EMAIL);
        $subject = filter_var(trim($_POST["subject"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR empty($subject) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Please complete the form and try again.";
            exit;
        }

        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "antinet.mac@gmail.com";

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email headers.
        $email_headers = "From: noreply <noreply@antinet.us.kg>";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n";
        $email_content .= "Number: $number\n";
        $email_content .= "Subject: $subject\n\n";
        $email_content .= "Message:\n\n$message\n";

        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo '<html lang="en">
                    <head>
                        <meta charset="utf-8" />
                        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
                        <meta name="viewport" content="width=device-width, initial-scale=1">
                        <title>Thank you</title>
                        <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Montserrat:700" rel="stylesheet" type="text/css">
                        <style>
                            @import url(//cdnjs.cloudflare.com/ajax/libs/normalize/3.0.1/normalize.min.css);
                            @import url(//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css);
                        </style>
                        <link rel="stylesheet" href="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/default_thank_you.css">
                        <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/jquery-1.9.1.min.js"></script>
                        <script src="https://2-22-4-dot-lead-pages.appspot.com/static/lp918/min/html5shiv.js"></script>
                    </head>
                    <body>
                        <header class="site-header" id="header">
                            <h1 class="site-header__title" data-lead-id="site-header-title">THANK YOU!</h1>
                        </header>

                        <div class="main-content">
                            <i class="fa fa-check main-content__checkmark" id="checkmark"></i>
                            <p class="main-content__body" data-lead-id="main-content-body">Thanks a bunch for filling that out. It means a lot to us, just like you do! We really appreciate you giving us a moment of your time today. Thanks for being you.</p></br>
                            <p>Come back to <a href="https://antinet.us.kg">Home Page</a></p>
                        </div>

                        <footer class="site-footer" id="footer">
                            <p class="site-footer__fineprint" id="fineprint">Copyright ©2024 | All Rights Reserved</p>
                        </footer>
                    </body>
                    </html>';
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
?>
