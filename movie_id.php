<?php
  // include function files for this application
  require_once('book_sc_fns.php');

  // start session which may be needed later
  // start it now because it must go before headers
  session_start();

  //create short variable names
  $movie_id=$_POST['movie_id'];
  try   {
    // check forms filled in
    if (!filled_out($_POST)) {

      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }
    else{
// provide link to members page
  movie_html_header('Movie Information:');

  $movie_id_array = get_movie_movie_id($movie_id);
  if (!$movie_id_array) {
    echo "<p>No movie currently available with this ID.</p>";
    echo "<hr />";
  }
  else{
  display_movie_movie_id($movie_id_array);
  check_valid_user();
  $result = add_rating($movie_id);
  if($result->num_rows>0){
    echo "<p>You already rated this movie.</p>";
  }
  else{
    display_user_rating_form($movie_id);
  }
  $rating_array = get_all_ratings($movie_id);
  if (!$rating_array||mysqli_num_rows($rating_array)==0) {
    echo "<p>This movie has not been rated yet. Be the first rater?</p>";
  }
  else{
  display_all_ratings($rating_array);
  }
  echo "<hr />";
  display_button("show_cart.php?new=".$movie_id, "add-to-cart",
                   "Add".$movie_id_array[0]['title']." To My Shopping Cart");
  }

  display_button("index.php", "continue-shopping", "Continue Shopping");


   // end page
   do_html_footer();
    }
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
