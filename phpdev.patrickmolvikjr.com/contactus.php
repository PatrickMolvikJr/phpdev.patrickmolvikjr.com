<?php
  $title = "Contact Us";
  include 'templates/header.php';
  include 'templates/functions.php';
  $name = $_POST['name'];

  $email = $_POST['email'];

  $phone = $_POST['phone'];

  $question = $_POST['question'];

  $newsletter = $_POST['newsletter'];

  $notify = $_POST['notify'];

  $restaurant = $_POST['restaurant'];

  $contact = $_POST['phoneContact'];

  $submit = $_POST['submit'];

  $product = $_POST['product'];
  //$_server


  $errorEmail = "";
  $errorName = "";

  if (!empty($submit) && empty($email)) {
    $errorEmail = "<h3 style='color:red'>Please enter your email address!</h3>";
  }
  if (!empty($submit) && empty($name)) {
    $errorName = "<h3 style='color:red'>Please enter your name!</h3>";
  }

  $subscribed = '';
  if ($newsletter == "subscribed") {

    $subscribed = "checked='checked'";

  }
  $notifySubscribe = '';
  if ($notify == "subscribed") {

    $notifySubscribe = "checked='checked'";

  }

  $contactPhone = "";
  $contactEmail = "";
  if ($contact == 'phone') {
    $contactPhone = "checked='checked'";
  } else if ($contact == 'email') {
    $contactEmail = "checked='checked'";

  }

  $products = array("Stapler", "Tape", "Pen", "Pencil", "Water Bottle", "The Cure for Cancer");

?>

  <h1>Contact Us</h1>

  <form action="contactus.php" method="post">

    <?php echo $errorName ?>
    <label for="name">Name:</label> <input type="text" id="name" name="name" value="<?php echo $name ?>"></label><br/>

    <?php echo $errorEmail ?>
    <label for="email">Email:<input type="email" id="email" name="email" value="<?php echo $email ?>"></label><br/>

    <label for="phone">Phone:</label> <input type="text" id="phone" name="phone" value="<?php echo $phone ?>"></label>
    <br/>

    <label for="question">Question:<br/><textarea id="question" name="question"><?php echo $question ?></textarea></label><br/>


    <label>Preferred Contact Type: </label>

    <label for="contact phone">Contact me by Phone:<input type="radio" id="contactPhone" name="phoneContact" value="phone" <?php echo $contactPhone ?> ></label>


    <label for="contact name">Contact me by Email: <input type="radio" id="contactEmail" name="phoneContact" value="email" <?php echo $contactEmail ?> ></label><br/>


    <?php
      CreateSelectBox($products, $product, "product");
    ?>

    <label for="newsletter">Subscribe to Newsletter:<input type="checkbox" id="newsletter" name="newsletter" value="subscribed" <?php echo $subscribed ?> ></label>


    <label for="notify">Notify me when new products are added:<input type="checkbox" id="notify" name="notify" value="subscribed" <?php echo $notifySubscribe ?> ></label>



    <input type="submit" name="submit" value="Ask a Question"><br/>

  </form>

<?php
  include 'templates/footer.php';
?>