<?php
require_once('db_fns.php');

function get_movie_movie_id($movie_id) {
  //extract from the database the movie with movie_id
  if ((!$movie_id) || ($movie_id == '')) {
     return false;
   }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title, p.description, p.duration, p.rating, p.price, D.director_name, d.format, a.actor_name from played_in_movie p, director D, directed d, actor a where p.movie_id = d.movie_id and D.director_id = d.director_id and a.actor_id = p.actor_id and p.movie_id='".$movie_id."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  //create an array of the movies
  return db_result_to_array($result);
}

function get_movie_movie_title($movie_title) {
  //extract from the database the movie with movie_id
  if ((!$movie_title) || ($movie_title == '')) {
     return false;
   }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title from played_in_movie p where p.title like '%".$movie_title."%'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  //create an array of the movies
  return db_result_to_array($result);
}

function get_movie_movie_actor($movie_actor) {
  //extract from the database the movie with movie_id
  if ((!$movie_actor) || ($movie_actor == '')) {
     return false;
   }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title from played_in_movie p, actor a where p.actor_id = a.actor_id and a.actor_name = '".$movie_actor."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  //create an array of the movies
  return db_result_to_array($result);
}

function get_movie_movie_release_time($movie_release_time) {
  //extract from the database the movie with movie_id
  if ((!$movie_release_time) || ($movie_release_time == '')) {
     return false;
   }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title from played_in_movie p, release_info r, include i where p.movie_id = i.movie_id and i.release_id = r.release_id and r.release_date = '".$movie_release_time."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  //create an array of the movies
  return db_result_to_array($result);
}

function get_movie_movie_release_area($movie_release_area) {
  //extract from the database the movie with movie_id
  if ((!$movie_release_area) || ($movie_release_area == '')) {
     return false;
   }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title from played_in_movie p, release_info r, include i where p.movie_id = i.movie_id and i.release_id = r.release_id and r.release_area = '".$movie_release_area."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  //create an array of the movies
  return db_result_to_array($result);
}

function get_movie_movie_rating($movie_rating) {
  //extract from the database the movie with movie_id
  if ((!$movie_rating) || ($movie_rating == '')) {
     return false;
   }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title from played_in_movie p where p.rating = '".$movie_rating."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  //create an array of the movies
  return db_result_to_array($result);
}

function get_purchase_history() {
  //extract from the database the movie with movie_id
  //if ((!$_SESSION['valid_user']) || ($_SESSION['valid_user'] == '')) {
  //   return false;
  // }
  $conn = db_connect();
  $query = "select p.movie_id, p.cost, p.date from purchase p, customer c where p.user_id = c.user_id and c.email = '".$_SESSION['valid_user']."'";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  return $result;
}

function get_all_ratings($movie_id) {
  //extract from the database the ratings with movie_id
  //if ((!$_SESSION['valid_user']) || ($_SESSION['valid_user'] == '')) {
  //   return false;
  // }
  $conn = db_connect();
  $query = "select distinct c.email, r.rating from rated r, customer c where r.movie_id = '".$movie_id."'and r.user_id = c.user_id";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  return $result;
}

function get_most_popular_movies() {
  //extract from the database the ratings with movie_id
  //if ((!$_SESSION['valid_user']) || ($_SESSION['valid_user'] == '')) {
  //   return false;
  // }
  $conn = db_connect();
  $query = "select M.movie_id, M.title, avg(r.rating) as avg_rating
from played_in_movie M, rated r
where M.movie_id = r.movie_id 
group by M.title 
order by avg_rating desc limit 10";
  $result = @$conn->query($query);
  if (!$result) {
    return false;
  }

  return $result;
}

?>
