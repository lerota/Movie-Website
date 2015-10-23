<?php
  // include function files for this application
  require_once('book_sc_fns.php');

// start session which may be needed later
  // start it now because it must go before headers
  session_start();
  //create short variable names
  $movie_rating=$_POST['movie_rating'];
  
  try   {
    // check forms filled in
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }

    movie_html_header('Movie Information:');
    $movie_rating_array = get_movie_movie_rating($movie_rating);
  
    if (!$movie_rating_array) {
      echo "<p>No movie currently available with this rating.</p>";
    }

     display_movie_movie_rating($movie_rating_array);

    display_button("index.php", "continue-shopping", "Continue Shopping");
   // end page
   do_html_footer();
  }
  catch (Exception $e) {
     do_html_header('Problem:');
     echo $e->getMessage();
     do_html_footer();
     exit;
  }
?>
