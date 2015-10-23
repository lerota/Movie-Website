<?php
  require_once('book_sc_fns.php');
  include ('book_sc_fns.php');
  // The shopping cart needs sessions, so start one
  session_start();
  movie_html_header("Welcome to Lion Movie");
  
  display_site_info(); 

  display_most_popular_movies();

  echo "<p>Search movie by movie ID:</p>";
  display_search_form();

  echo "<p>Search movie by title:</p>";
  display_search_form_title();

  echo "<p>Search movie by actor name:</p>";
  display_search_form_actor();

  echo "<p>Search movie by release year:</p>";
  display_search_form_release_time();

  echo "<p>Search movie by release area:</p>";
  display_search_form_release_area();

  echo "<p>Search movie by rating:</p>";
  display_search_form_rating();

  echo "<p>Please choose a category:</p>";

  // get categories out of database
  $cat_array = get_categories();

  // display as links to cat pages
  display_categories($cat_array);

// give menu of options
display_member_menu();

  do_html_footer();
?>
