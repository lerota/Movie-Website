<?php
  include ('book_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();

  $isbn = $_GET['isbn'];

  // get this book out of database
  $book = get_book_details($isbn);
  movie_html_header($book[0]['title']);
  display_movie_movie_id($book);

  // set url for "continue button"
  $target = "index.php";
  //if($book[0]['movie_id']) {
  //  $target = "show_cat.php?isbn=".$book[0]['movie_id'];
  //}
  check_valid_user();
  $result = add_rating($isbn);

  if($result->num_rows>0){
    echo "<p>You already rated this movie.</p>";
  }
  else{
    display_user_rating_form($isbn);
  }

  $rating_array = get_all_ratings($isbn);
  if (!$rating_array||mysqli_num_rows($rating_array)==0) {
    echo "<p>This movie has not been rated yet. Be the first rater?</p>";
  }
  else{
  display_all_ratings($rating_array);
  }

  echo "<hr />";
  display_button("show_cart.php?new=".$isbn, "add-to-cart",
                   "Add".$book[0]['title']." To My Shopping Cart");
  display_button($target, "continue-shopping", "Continue Shopping");

  do_html_footer();
?>
