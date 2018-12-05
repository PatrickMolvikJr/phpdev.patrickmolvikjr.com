<?php
  /**
   * Created by PhpStorm.
   * User: pmolv
   * Date: 11/15/2017
   * Time: 3:02 PM
   */

  $to = "pmolvik15@gmail.com";
  $subject = "Test Email";
  $message = "Hello PJ";
  $headers = "From: info@phpdev.patrickmolvikjr.com\r\n";
  $headers .= "BBC: pmm@wwdb.com\r\n";

  $sent = mail($to, $subject, $message, $headers);

  echo "Mail was sent: $sent";

  //mail("pmolvik15@gmail.com", "Test Mail", "Hello Pat", "From: info@phpdev.patrickmolvikjr.com\r\n");