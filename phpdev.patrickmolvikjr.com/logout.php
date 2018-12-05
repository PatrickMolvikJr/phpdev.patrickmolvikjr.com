<?php
  /**
   * Created by PhpStorm.
   * User: pmolv
   * Date: 11/15/2017
   * Time: 2:50 PM
   */

  session_start();
  session_destroy();
  header("Location: /login.php");