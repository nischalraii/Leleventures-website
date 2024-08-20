<?php
  $receiving_email_address = 'info@leleventures.com';

  $to = $receiving_email_address;
  $from_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
  $from_email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
  $subject = filter_input(INPUT_POST, 'subject', FILTER_SANITIZE_SPECIAL_CHARS);
  $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_SPECIAL_CHARS);

  if (filter_var($from_email, FILTER_VALIDATE_EMAIL)) {
      $headers = [
        'From' => $from_name . "<$from_email>",
        'X-Mailer' => 'PHP/' . phpversion()
      ];

      mail($to, $subject, $message, $headers);

      die('OK');
  } else {
      die('Invalid address');
  }
?>