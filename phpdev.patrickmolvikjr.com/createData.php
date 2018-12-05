<?php

  require_once 'autoload.php';
  include 'templates/functions.php';

  //New items are not created yet, have to use POST

  $db = db_connect();
  $faker = Faker\Factory::create();


    for( $i=0;$i < 20; $i++ ) {
      $blog_title = $faker->sentence($nbWords = 4, $variableNbWords = true) ;
      $blog_author = $faker->name;
      $blog_text = $faker->paragraph($nbSentences = 5, $variableNbSentences = true);
      $date_posted = $faker->date($format = 'Y-m-d', $max = 'now');

      $sql = "INSERT INTO `blogs` (`id`, `blog_title`, `blog_author`, `blog_text`, `date_posted`) VALUES (NULL, $blog_title, $blog_author, $blog_text, $date_posted)";
      echo "SQL: $sql <br />";
      $result = $db->query($sql);

    }
  /*
      for( $i;$i < 20; $i++ ) {
        $title = $faker->sentence($nbWords = 4, $variableNbWords = true) ;
        $author = $faker->name;
        $article_text = $faker->paragraph($nbSentences = 5, $variableNbSentences = true);
        $published_date = $faker->date($format = 'Y-m-d', $max = 'now');

        $sql = "INSERT INTO `articles` (`article_id`, `title`, `author`, `article_text`, `published_date`, `modified_at`, `created_at`) VALUES (NULL,'$title', '$author', '$article_text', '$published_date', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        echo "SQL: $sql <br />";
        $result = $db->query($sql);

      }


       for( $i;$i < 80; $i++ ) {
         $name = $faker->name;
         $location = $faker->address;
         $priceRangeLow = rand(1, 10);
         $priceRangeHigh = rand(11, 100);
         $tags = $faker->bs;

         $sql = "INSERT INTO `restaurants` (`id`, `name`, `location`, `priceRangeLow`, `priceRangeHigh`, `tags`, `modifiedAt`, `createdAt`) VALUES (NULL,'$name', '$location', '$priceRangeLow', '$priceRangeHigh', '$tags', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
         echo "SQL: $sql <br />";
         $result = $db->query($sql);
         $number_reviews =  rand(0,10);
         for( $j; $j < $number_reviews; $j++){
           $restaurantIDFK = $db->insert_id;
           $author = $faker->name;
           $reviewText = $faker->bs;
           $rating = rand(1,5);
           $sql = "INSERT INTO reviews (id, author, review, rating, created_at, restaurantIDFK)
                          VALUES (null, '$author', '$reviewText', '$rating', NOW(), $restaurantIDFK)";
         }
       }
       /*
       for( $i;$i < 20; $i++ ) {
         $title = $faker->company;
         $author = $faker->name;
         $article_text = $faker->text(1000);

         $published_date = $faker->dateTime;
         $pubDateStr = $published_date->format("Y-m-d H:i:s");

         echo $title . "<br />";
         echo $author . "<br />";
         echo $article_text . "<br />";
         echo $pubDateStr . "<br />";
       }
  */