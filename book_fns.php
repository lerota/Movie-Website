<?php
function calculate_shipping_cost() {
  // as we are shipping products all over the world
  // via teleportation, shipping is fixed
  return 10.00;
}

function get_categories() {
   // query database for a list of categories
   $conn = db_connect();
   $query = "select category_id, category_name from category";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_category_name($catid) {
   // query database for the name for a category id
   $conn = db_connect();
   $query = "select category_name from category
             where category_id = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_cats = @$result->num_rows;
   if ($num_cats == 0) {
      return false;
   }
   $row = $result->fetch_object();
   return $row->category_name;
}


function get_books($catid) {
   // query database for the books in a category
   if ((!$catid) || ($catid == '')) {
     return false;
   }

   $conn = db_connect();
   $query = "select distinct p.movie_id, p.title from played_in_movie p, categoried_as c where p.movie_id = c.movie_id and c.category_id = '".$catid."'";
   $result = @$conn->query($query);
   if (!$result) {
     return false;
   }
   $num_books = @$result->num_rows;
   if ($num_books == 0) {
      return false;
   }
   $result = db_result_to_array($result);
   return $result;
}

function get_book_details($isbn) {
  // query database for all details for a particular book
  if ((!$isbn) || ($isbn=='')) {
     return false;
  }
  $conn = db_connect();
  $query = "select distinct p.movie_id, p.title, p.description, p.duration, p.rating, p.price, D.director_name, d.format, a.actor_name from played_in_movie p, director D, directed d, actor a where p.movie_id = d.movie_id and D.director_id = d.director_id and a.actor_id = p.actor_id and p.movie_id='".$isbn."'";
  $result = @$conn->query($query);
  if (!$result) {
     return false;
  }
  $result = db_result_to_array($result);
  return $result;
}

function calculate_price($valid_user,$cart) {
  // sum total price for all items in shopping cart
  $valid_user = $_SESSION['valid_user'];
  $price = 0.0;
  if(is_array($cart)) {
    $conn = db_connect();
    foreach($cart as $isbn => $qty) {
      $query = "select price from played_in_movie where movie_id='".$isbn."'";
      $query2 = "select VIP from customer where email='".$valid_user."'";
      $result = $conn->query($query);
      $result2 = $conn->query($query2);
      $entity = $result2->fetch_object();
      $entity_value = $entity->VIP;
      if ($result) {
        $item = $result->fetch_object();
        $item_price = $item->price;
        $price +=$item_price*$qty;
      }
//      if ($entity_value == 1) {
//        $price = 0.75 * $price;
//      }
    }
    if ($entity_value == 1) {
      $price = 0.75 * $price;
    }
  }
  return $price;
}

function calculate_items($cart) {
  // sum total items in shopping cart
  $items = 0;
  if(is_array($cart))   {
    foreach($cart as $isbn => $qty) {
      $items += $qty;
    }
  }
  return $items;
}
?>
