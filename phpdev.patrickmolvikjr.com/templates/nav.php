<!-- Nav -->
<nav id="nav">
  <ul>
    <li><a class="icon fa-home" href="index.php"><span>Home</span></a></li>

    <li><a class="icon fa-retweet" href="restaurants.php"><span>restaurant</span></a></li>
    <li><a class="icon fa-sitemap" href="blog_top.php"><span>Blog</span></a></li>
    <li><a class="icon fa-sitemap" href="article_top.php"><span>Articles</span></a></li>
    <li><a class="icon fa-sitemap" href="calendar.php"><span>Calendar</span></a></li>
    <li><a class="icon fa-sitemap" href="maps.php"><span>Maps</span></a></li><li>
      <a href="contactus.php" class="icon fa-bar-chart-o"><span>Contact Us</span></a>
      <ul>
        <li><a href="preferences.php">Preferences</a></li>
        <?php
          if( isset($_SESSION['email']) ){
            echo '<li><a href="logout.php">Logout</a></li>';

          }else{

            echo '<li><a href="login.php">Login</a></li>';
          }

        ?>
      </ul>
    </li>
  </ul>
</nav>
