<?php
require_once('db_fns.php');

function get_user_urls($email) {
  //extract from the database all the URLs this user has stored

  $conn = db_connect();
  $result = $conn->query("select movie_id
                          from watched w, customer c
                          where c.email = '".$email."' and w.user_id = c.user_id");
  if (!$result) {
    return false;
  }

  //create an array of the URLs
  $movie_id_array = array();
  for ($count = 1; $row = $result->fetch_row(); ++$count) {
    $movie_id_array[$count] = $row[0];
  }
  return $movie_id_array;
}

function add_bm($new_movie_id) {
  // Add new bookmark to the database

  echo "Attempting to add ".htmlspecialchars($new_movie_id).".<br />";
  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat bookmark
  $result = $conn->query("select * from watched w, customer c
                         where w.user_id = c.user_id and c.email='".$valid_user."'
                         and w.movie_id='".$new_movie_id."'");
  if ($result && ($result->num_rows>0)) {
    throw new Exception('Movie already exists.');
  }

  // insert the new bookmark
  if (!$conn->query("insert into watched values ((select c.user_id from customer c
                           where c.email='".$valid_user."'), '".$new_movie_id."')")) {
    throw new Exception('There is no such movie with this ID.');
  }

  return true;
}

function delete_bm($valid_user,$movie) {
  // delete one URL from the database
  $conn = db_connect();
  $valid_user = $_SESSION['valid_user'];

  // delete the bookmark
  if (!$conn->query("delete from watched where
     user_id=(select c.user_id from customer c where c.email='".$valid_user."') and movie_id='".$movie."'")) {
     throw new Exception('Movie could not be deleted');
  }
  return true;
}

function add_rating($new_movie_id) {
  // Add new rating to the database

  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat rating
  $result = $conn->query("select * from customer c, rated r
                         where c.user_id = r.user_id and c.email='".$valid_user."'
                         and r.movie_id='".$new_movie_id."'");
  if (!$result) {
    throw new Exception('Can not extract rating information.');
  }

  return $result;
}

function add_rating_to_db($new_movie_id,$new_rating) {
  // Add new rating to the database

  $valid_user = $_SESSION['valid_user'];

  $conn = db_connect();

  // check not a repeat rating
  $result = $conn->query("select * from customer c, rated r
                         where c.user_id = r.user_id and c.email='".$valid_user."'
                         and r.movie_id='".$new_movie_id."'");
  if (!$result) {
    throw new Exception('Can not extract rating information.');
  }

  // insert the new rating
  if (!$conn->query("insert into rated values ((select c.user_id from customer c
                           where c.email='".$valid_user."'), '".$new_movie_id."','".$new_rating."')")) {
    throw new Exception('Movie could not be inserted.');
  }

  return true;
}

?>
