<?php
  // include function files for this application
  require_once('book_sc_fns.php');

  // start session which may be needed later
  // start it now because it must go before headers
  session_start();

  //create short variable names
  $movie_title=$_POST['movie_title'];
  try   {
    // check forms filled in
    if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }

  // provide link to members page
  movie_html_header('Movie Information:');

  $movie_title_array = get_movie_movie_title($movie_title);
  if (!$movie_title_array) {
    echo "<p>No movie currently available with this title.</p>";
  }
  display_movie_movie_title($movie_title_array);

  display_button("index.php", "continue-shopping", "Continue Shopping");
   // end page
   do_html_footer();
  }
  catch (Exception $e) {
     movie_html_header('Problem:');
     echo $e->getMessage();
       echo "<hr />";
    display_button("index.php", "continue-shopping", "Continue Shopping");
     do_html_footer();
     exit;
  }
?>
