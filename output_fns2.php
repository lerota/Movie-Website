<?php

function do_html_header($title) {
  // print an HTML header
?>
  <html>
  <head>
    <title><?php echo $title;?></title>
    <style>
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #3333cc; width=300; text-align=left}
      a { color: #000000 }
    </style>
  </head>
  <body>
  <img src="bookmark.gif" alt="PHPbookmark logo" border="0"
       align="left" valign="bottom" height="55" width="57" />
  <h1>Lion Movie</h1>
  <hr />
<?php
  if($title) {
    do_html_heading($title);
  }
}

function movie_html_header($title = '') {
  // print an HTML header

  // declare the session variables we want access to inside the function
  if (!$_SESSION['items']) {
    $_SESSION['items'] = '0';
  }
  if (!$_SESSION['total_price']) {
    $_SESSION['total_price'] = '0.00';
  }
?>
  <html>
  <head>
    <title><?php echo $title; ?></title>
    <style>
      h2 { font-family: Arial, Helvetica, sans-serif; font-size: 22px; color: red; margin: 6px }
      body { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      li, td { font-family: Arial, Helvetica, sans-serif; font-size: 13px }
      hr { color: #FF0000; width=70%; text-align=center}
      a { color: #000000 }
    </style>
  </head>
  <body>
  <table width="100%" border="0" cellspacing="0" bgcolor="#cccccc">
  <tr>
  <td rowspan="2">
  <a href="index.php"><img src="images/Book-O-Rama.gif" alt="Lion Movie" border="0"
       align="left" valign="bottom" height="55" width="325"/></a>
  </td>
  <td align="right" valign="bottom">
  <?php
       echo "Total Items = ".$_SESSION['items'];
  ?>
  </td>
  <td align="right" rowspan="2" width="135">
  <?php
       display_button('show_cart.php', 'view-cart', 'View Your Shopping Cart');
  ?>
  </tr>
  <tr>
  <td align="right" valign="top">
  <?php
       echo "Total Price = $".number_format($_SESSION['total_price'],2);
  ?>
  </td>
  </tr>
  </table>
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  // print an HTML footer
?>
  </body>
  </html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h2><?php echo $heading; ?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <a href="<?php echo $url; ?>"><?php echo $name; ?></a><br />
<?php
}

function display_site_info() {
  // display some marketing info
?>
  <ul>
  <li>Find your favorite movies!</li>
  <li>See what your friends like!</li>
  <li>Deliver your favorite movies right to you!</li>
  </ul>
<?php
}

function display_most_popular_movies() {

    //echo "<br>";
    echo "<div style='text-align:right'><h2>---Most popular movies----</h2></div>";
    //create table
    $popular_array = get_most_popular_movies();
    if ($popular_array->num_rows > 0) {
     echo "<table align = right><tr><td><strong>Title</strong></td><td><strong>Rating</strong></td></tr>";
     // output data of each row
     while($row = $popular_array->fetch_assoc()) {
         echo "<tr><td>" . $row["title"]. "</td><td>" . $row["avg_rating"]. "</td></tr>";
     }
    echo "</table>";
  }
  //echo "<hr />";
}

function display_search_form() {
?>
 <form method="post" action="movie_id.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Movie ID:</td>
     <td><input type="text" name="movie_id" size="16" maxlength="10"/></td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Search"></td></tr>
 </table></form>
<?php

}

function display_search_form_title() {
?>
 <form method="post" action="movie_title.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Movie Title:</td>
     <td><input type="text" name="movie_title" size="16" maxlength="50"/></td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Search"></td></tr>
 </table></form>
<?php

}

function display_search_form_actor() {
?>
 <form method="post" action="movie_actor.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Actor Name:</td>
     <td><input type="text" name="movie_actor" size="16" maxlength="30"/></td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Search"></td></tr>
 </table></form>
<?php

}

function display_search_form_release_time() {
?>
 <form method="post" action="movie_release_time.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Release Year(yyyy):</td>
     <td><input type="text" name="movie_release_time" size="16" maxlength="11"/></td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Search"></td></tr>
 </table></form>
<?php

}

function display_search_form_release_area() {
?>
 <form method="post" action="movie_release_area.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Release Area(e.g. USA):</td>
     <td><input type="text" name="movie_release_area" size="16" maxlength="20"/></td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Search"></td></tr>
 </table></form>
<?php

}

function display_search_form_rating() {
?>
 <form method="post" action="movie_rating.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Rating:</td>
     <td><input type="radio" name="movie_rating" value=1/>1<input type="radio" name="movie_rating" value=2/>2<input type="radio" name="movie_rating" value=3/>3<input type="radio" name="movie_rating" value=4/>4<input type="radio" name="movie_rating" value=5/>5</td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Search"></td></tr>
 </table></form>
<?php
}

function display_login_form() {
?>
  <p><a href="register_form.php">Not a member?</a></p>
  <form method="post" action="member.php">
  <table bgcolor="#cccccc">
   <tr>
     <td colspan="2">Members log in here:</td>
   <tr>
     <td>Email:</td>
     <td><input type="text" name="email"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="passwd"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
 </table></form>
<?php
}

function display_registration_form() {
?>
 <form method="post" action="register_new.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Email address:</td>
     <td><input type="text" name="email" size="30" maxlength="25"/></td></tr>
   <tr>
     <td>Preferred username <br />(max 11 chars):</td>
     <td valign="top"><input type="text" name="username"
         size="16" maxlength="11"/></td></tr>
   <tr>
     <td>Password <br />(max 6 chars):</td>
     <td valign="top"><input type="password" name="passwd"
         size="16" maxlength="6"/></td></tr>
   <tr>
     <td>Confirm password:</td>
     <td><input type="password" name="passwd2" size="16" maxlength="6"/></td></tr>
   <tr>
     <td>Membership:</td>
     <td><input type="radio" name="vip" value="Y"/>VIP<input type="radio" name="vip" value="N"/>Non-VIP</td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Register"></td></tr>
 </table></form>
<?php
}

function display_user_urls($movie_id_array) {
  // display the table of URLs

  // set global variable, so we can test later if this is on the page
  global $bm_table;
  $bm_table = true;
?>
  <br />
  <form name="bm_table" action="delete_bms.php" method="post">
  <table width="300" cellpadding="2" cellspacing="0">
  <?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\"><td><strong>Watched movies</strong></td>";
  echo "<td><strong>Delete?</strong></td></tr>";
  if ((is_array($movie_id_array)) && (count($movie_id_array) > 0)) {
    foreach ($movie_id_array as $movie)  {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      echo "<tr bgcolor=\"".$color."\"><td><a href=\"show_book.php?isbn=".$movie."\">".htmlspecialchars($movie)."</a></td>
            <td><input type=\"checkbox\" name=\"del_me[]\"
                value=\"".$movie."\"/></td>
            </tr>";
    }
  } else {
    echo "<tr><td>No bookmarks on record</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

function display_user_menu() {
  // display the menu options on this page
?>
<hr />
<a href="member.php">Home</a> &nbsp;|&nbsp;
<a href="index.php">Movie Home</a> &nbsp;|&nbsp;
<a href="add_bm_form.php">Add Watched Movie</a> &nbsp;|&nbsp;
<?php
  // only offer the delete option if bookmark table is on this page
  global $bm_table;
  if ($bm_table == true) {
    echo "<a href=\"#\" onClick=\"bm_table.submit();\">Delete Watched Movie</a> ";
  } else {
    echo "<span style=\"color: #cccccc\">Delete Watched Movie</span> ";
  }
?>&nbsp;|&nbsp;
<a href="show_purchase.php">Purchase History</a> &nbsp;|&nbsp;
<br />
<a href="logout.php">Logout</a>
<hr />

<?php
}

function display_add_bm_form(){
  // display the form for people to ener a new bookmark in
?>
<form name="bm_table" action="add_bms.php" method="post">
<table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
<tr><td>New movie:</td>
<td><input type="text" name="new_movie_id" value=""
     size="30" maxlength="255"/></td></tr>
<tr><td colspan="2" align="center">
    <input type="submit" value="Add watched movie"/></td></tr>
</table>
</form>
<?php
}

function display_categories($cat_array) {
  if (!is_array($cat_array)) {
     echo "<p>No categories currently available</p>";
     return;
  }
  echo "<ul>";
  foreach ($cat_array as $row)  {
    $url = "show_cat.php?catid=".$row['category_id'];
    $title = $row['category_name'];
    echo "<li>";
    do_html_url($url, $title);
    echo "</li>";
  }
  echo "</ul>";
 // echo "<hr />";
}

function display_movie_movie_id($movie_id_array) {

 if (!is_array($movie_id_array)) {
    echo "<hr />";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";
    echo "<tr><td><ul>";
    echo "<li><strong>MovieID:</strong> ";
    echo $movie_id_array[0]['movie_id'];
    echo "</li><li><strong>Title:</strong> ";
    echo $movie_id_array[0]['title'];
    echo "</li><li><strong>Our Price:</strong> ";
    echo number_format($movie_id_array[0]['price'], 2);
    echo "</li><li><strong>Description:</strong> ";
    echo $movie_id_array[0]['description'];
    echo "</li><li><strong>Duration:</strong> ";
    echo number_format($movie_id_array[0]['duration'], 1);
    echo "</li><li><strong>Original Rating:</strong> ";
    echo number_format($movie_id_array[0]['rating'], 1);
    echo "</li><li><strong>Director:</strong> ";

    $movie_id_array_director = array();
    foreach ($movie_id_array as $item) {
      $movie_id_array_director[] = $item['director_name'];
    }
    $movie_id_array_director = array_unique($movie_id_array_director);
    foreach ($movie_id_array_director as $row) {
      echo $row.';';
    }
    echo "</li><li><strong>Actor:</strong> ";
    $movie_id_array_actor = array();
    foreach ($movie_id_array as $item) {
      $movie_id_array_actor[] = $item['actor_name'];
    }
    $movie_id_array_actor = array_unique($movie_id_array_actor);
    foreach ($movie_id_array_actor as $row) {
      echo $row.';';
    }
    echo "</li><li><strong>Format:</strong> ";
    $movie_id_array_format = array();
    foreach ($movie_id_array as $item) {
      $movie_id_array_format[] = $item['format'];
    }
    $movie_id_array_format = array_unique($movie_id_array_format);
    foreach ($movie_id_array_format as $row) {
      echo $row.';';
    }
    echo "</li></ul></td></tr></table>";
  }
  //echo "<hr />";
}

function display_movie_movie_title($movie_title_array) {
  //display all books in the array passed in
  if (!is_array($movie_title_array)) {
    echo "<p>No movie currently available with this title.</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($movie_title_array as $row) {
      $url = "show_book.php?isbn=".$row['movie_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['isbn'].".jpg")) {
        $title = "<img src=\"images/".$row['isbn'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_movie_movie_actor($movie_actor_array) {
  //display all books in the array passed in
  if (!is_array($movie_actor_array)) {
    echo "<p>No movie currently available played by this actor.</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($movie_actor_array as $row) {
      $url = "show_book.php?isbn=".$row['movie_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['isbn'].".jpg")) {
        $title = "<img src=\"images/".$row['isbn'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_movie_movie_release_time($movie_release_time_array) {
  //display all books in the array passed in
  if (!is_array($movie_release_time_array)) {
    echo "<p>No movie currently available released this year.</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($movie_release_time_array as $row) {
      $url = "show_book.php?isbn=".$row['movie_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['isbn'].".jpg")) {
        $title = "<img src=\"images/".$row['isbn'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_movie_movie_release_area($movie_release_area_array) {
  //display all books in the array passed in
  if (!is_array($movie_release_area_array)) {
    echo "<p>No movie currently available released in this area.</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($movie_release_area_array as $row) {
      $url = "show_book.php?isbn=".$row['movie_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['isbn'].".jpg")) {
        $title = "<img src=\"images/".$row['isbn'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_movie_movie_rating($movie_rating_array) {
  //display all books in the array passed in
  if (!is_array($movie_rating_array)) {
    echo "<p>No movie currently available with this rating.</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($movie_rating_array as $row) {
      $url = "show_book.php?isbn=".$row['movie_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['isbn'].".jpg")) {
        $title = "<img src=\"images/".$row['isbn'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_purchase_history($purchase_history_array) {

 if (!$purchase_history_array) {
  } else {
    echo "<br>";

    //create table
    if ($purchase_history_array->num_rows > 0) {
     echo "<table><tr><th>MovieID</th><th>Cost</th><th>Date</th></tr>";
     // output data of each row
     while($row = $purchase_history_array->fetch_assoc()) {
         echo "<tr><td><a href=\"show_book.php?isbn=" . $row["movie_id"]. "\">".htmlspecialchars($row["movie_id"])."</a></td><td>" . $row["cost"]. "</td><td>" . $row["date"]. "</td></tr>";
     }
    echo "</table>";
  }
  //echo "<hr />";
}
}

function display_books($book_array) {
  //display all books in the array passed in
  if (!is_array($book_array)) {
    echo "<p>No movie currently available in this category.</p>";
  } else {
    //create table
    echo "<table width=\"100%\" border=\"0\">";

    //create a table row for each book
    foreach ($book_array as $row) {
      $url = "show_book.php?isbn=".$row['movie_id'];
      echo "<tr><td>";
      if (@file_exists("images/".$row['isbn'].".jpg")) {
        $title = "<img src=\"images/".$row['isbn'].".jpg\"
                  style=\"border: 1px solid black\"/>";
        do_html_url($url, $title);
      } else {
        echo "&nbsp;";
      }
      echo "</td><td>";
      $title = $row['title'];
      do_html_url($url, $title);
      echo "</td></tr>";
    }

    echo "</table>";
  }

  echo "<hr />";
}

function display_book_details($book) {
  // display all details about this book
  if (is_array($book)) {
    echo "<table><tr>";
    //display the picture if there is one
    if (@file_exists("images/".$book['isbn'].".jpg"))  {
      $size = GetImageSize("images/".$book['isbn'].".jpg");
      if(($size[0] > 0) && ($size[1] > 0)) {
        echo "<td><img src=\"images/".$book['isbn'].".jpg\"
              style=\"border: 1px solid black\"/></td>";
      }
    }
    echo "<td><ul>";
    echo "<li><strong>MovieID:</strong> ";
    echo $book[0]['movie_id'];
    echo "</li><li><strong>Title:</strong> ";
    echo $book[0]['title'];
    echo "</li><li><strong>Our Price:</strong> ";
    echo number_format($book[0]['price'], 2);
    echo "</li><li><strong>Description:</strong> ";
    echo $book[0]['description'];
    echo "</li><li><strong>Duration:</strong> ";
    echo number_format($book[0]['duration'], 1);
    echo "</li><li><strong>Original Rating:</strong> ";
    echo number_format($book[0]['rating'], 1);
    echo "</li><li><strong>Director:</strong> ";
    foreach ($book as $row) {
      echo $row['director_name'].';';
    }
    echo "</li><li><strong>Actor:</strong> ";
    foreach ($book as $row) {
      echo $row['actor_name'].';';
    }
    echo "</li><li><strong>Format:</strong> ";
    if ($book[0]['format'] != $book[1]['format']) {
      echo $book[0]['format'].';'.$book[1]['format'].';';
    } else {
      echo $book[0]['format'];
    }
    echo "</li></ul></td></tr></table>";
  } else {
    echo "<p>The details of this book cannot be displayed at this time.</p>";
  }

  echo "<hr />";

}

function display_checkout_form() {
  //display the form that asks for name and address
?>
  <br />
  <table border="0" width="100%" cellspacing="0">
  <form action="purchase.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Your Details</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address_2</td>
    <td><input type="text" name="address_2" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr><th colspan="2" bgcolor="#cccccc">Shipping Address (leave blank if as above)</th></tr>
  <tr>
    <td>Name</td>
    <td><input type="text" name="ship_name" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address</td>
    <td><input type="text" name="ship_address" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>Address_2</td>
    <td><input type="text" name="ship_address_2" value="" maxlength="40" size="40"/></td>
  </tr>
  <tr>
    <td>City/Suburb</td>
    <td><input type="text" name="ship_city" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>State/Province</td>
    <td><input type="text" name="ship_state" value="" maxlength="20" size="40"/></td>
  </tr>
  <tr>
    <td>Postal Code or Zip Code</td>
    <td><input type="text" name="ship_zip" value="" maxlength="10" size="40"/></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><p><strong>Please press Purchase to confirm
         your purchase, or Continue Shopping to add or remove items.</strong></p>
     <?php display_form_button("purchase", "Purchase These Items"); ?>
    </td>
  </tr>
  </form>
  </table><hr />
<?php
}

function display_shipping($shipping) {
  // display table row with shipping cost and total price including shipping
?>
  <table border="0" width="100%" cellspacing="0">
  <tr><td align="left">Shipping</td>
      <td align="right"> <?php echo number_format($shipping, 2); ?></td></tr>
  <tr><th bgcolor="#cccccc" align="left">TOTAL INCLUDING SHIPPING</th>
      <th bgcolor="#cccccc" align="right">$ <?php echo number_format($shipping+$_SESSION['total_price'], 2); ?></th>
  </tr>
  </table><br />
<?php
}

function display_card_form($name) {
  //display form asking for credit card details
?>
  <table border="0" width="100%" cellspacing="0">
  <form action="process.php" method="post">
  <tr><th colspan="2" bgcolor="#cccccc">Credit Card Details</th></tr>
  <tr>
    <td>Type</td>
    <td><select name="card_type">
        <option value="VISA">VISA</option>
        <option value="MasterCard">MasterCard</option>
        <option value="American Express">American Express</option>
        </select>
    </td>
  </tr>
  <tr>
    <td>Number</td>
    <td><input type="text" name="card_number" value="" maxlength="16" size="40"></td>
  </tr>
  <tr>
    <td>AMEX code (if required)</td>
    <td><input type="text" name="amex_code" value="" maxlength="4" size="4"></td>
  </tr>
  <tr>
    <td>Expiry Date</td>
    <td>Month
       <select name="card_month">
       <option value="01">01</option>
       <option value="02">02</option>
       <option value="03">03</option>
       <option value="04">04</option>
       <option value="05">05</option>
       <option value="06">06</option>
       <option value="07">07</option>
       <option value="08">08</option>
       <option value="09">09</option>
       <option value="10">10</option>
       <option value="11">11</option>
       <option value="12">12</option>
       </select>
       Year
       <select name="card_year">
       <?
       for ($y = date("Y"); $y < date("Y") + 10; $y++) {
         echo "<option value=\"".$y."\">".$y."</option>";
       }
       ?>
       </select>
  </tr>
  <tr>
    <td>Name on Card</td>
    <td><input type="text" name="card_name" value = "<?php echo $name; ?>" maxlength="40" size="40"></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <p><strong>Please press Purchase to confirm your purchase, or Continue Shopping to
      add or remove items</strong></p>
     <?php display_form_button('purchase', 'Purchase These Items'); ?>
    </td>
  </tr>
  </table>
<?php
}

function display_cart($cart, $change = true, $images = 1) {
  // display items in shopping cart
  // optionally allow changes (true or false)
  // optionally include images (1 - yes, 0 - no)

   echo "<table border=\"0\" width=\"100%\" cellspacing=\"0\">
         <form action=\"show_cart.php\" method=\"post\">
         <tr><th colspan=\"".(1 + $images)."\" bgcolor=\"#cccccc\">Item</th>
         <th bgcolor=\"#cccccc\">Price</th>
         <th bgcolor=\"#cccccc\">Quantity</th>
         <th bgcolor=\"#cccccc\">Total</th>
         </tr>";

  //display each item as a table row
  foreach ($cart as $isbn => $qty)  {
    $book = get_book_details($isbn);
    echo "<tr>";
    if($images == true) {
      echo "<td align=\"left\">";
      if (file_exists("images/".$isbn.".jpg")) {
         $size = GetImageSize("images/".$isbn.".jpg");
         if(($size[0] > 0) && ($size[1] > 0)) {
           echo "<img src=\"images/".$isbn.".jpg\"
                  style=\"border: 1px solid black\"
                  width=\"".($size[0]/3)."\"
                  height=\"".($size[1]/3)."\"/>";
         }
      } else {
         echo "&nbsp;";
      }
      echo "</td>";
    }
    echo "<td align=\"left\">
          <a href=\"show_book.php?isbn=".$isbn."\">".$book[0]['title']."</a>
          </td>
          <td align=\"center\">\$".number_format($book[0]['price'], 2)."</td>
          <td align=\"center\">";

    // if we allow changes, quantities are in text boxes
    if ($change == true) {
      echo "<input type=\"text\" name=\"".$isbn."\" value=\"".$qty."\" size=\"3\">";
    } else {
      echo $qty;
    }
    echo "</td><td align=\"center\">\$".number_format($book[0]['price']*$qty,2)."</td></tr>\n";
  }
  // display total row
  echo "<tr>
        <th colspan=\"".(2+$images)."\" bgcolor=\"#cccccc\">&nbsp;</td>
        <th align=\"center\" bgcolor=\"#cccccc\">".$_SESSION['items']."</th>
        <th align=\"center\" bgcolor=\"#cccccc\">
            \$".number_format($_SESSION['total_price'], 2)."
        </th>
        </tr>";

  // display save change button
  if($change == true) {
    echo "<tr>
          <td colspan=\"".(2+$images)."\">&nbsp;</td>
          <td align=\"center\">
             <input type=\"hidden\" name=\"save\" value=\"true\"/>
             <input type=\"image\" src=\"images/save-changes.gif\"
                    border=\"0\" alt=\"Save Changes\"/>
          </td>
          <td>&nbsp;</td>
          </tr>";
  }
  echo "</form></table>";
}

function display_member_menu() {
  // display the menu options on this page
  if ($_SESSION['valid_user']) {
    ?>
<hr />
<a href="member.php">Member Home</a> &nbsp;|&nbsp;
<br />
<a href="logout.php">Logout</a>
<hr />

<?php
  }
  else{?>
<hr />
<a href="member.php">Member Home</a> &nbsp;|&nbsp;
<br />
<a href="login.php">Login</a>
<hr />

<?php

  }

}

function display_button($target, $image, $alt) {
  echo "<div align=\"center\"><a href=\"".$target."\">
          <img src=\"images/".$image.".gif\"
           alt=\"".$alt."\" border=\"0\" height=\"50\"
           width=\"135\"/></a></div>";
}

function display_form_button($image, $alt) {
  echo "<div align=\"center\"><input type=\"image\"
           src=\"images/".$image.".gif\"
           alt=\"".$alt."\" border=\"0\" height=\"50\"
           width=\"135\"/></div>";
}

function display_user_rating_form($isbn){
?>
 <form method="post" action="user_rating.php">
 <table align = "center">
   <tr>
     <td>Rate it:</td>
     <td><input type="radio" name="movie_rating" value=1/>1<input type="radio" name="movie_rating" value=2/>2<input type="radio" name="movie_rating" value=3/>3<input type="radio" name="movie_rating" value=4/>4<input type="radio" name="movie_rating" value=5/>5</td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Submit"><input type="hidden" name="movie_id" value="<?php echo $isbn; ?>">
</td></tr>
 </table></form>
<?php
}

function display_all_ratings($rating_array) {

 if (!$rating_array) {
  } else {
    //echo "<br>";
    echo "Ratings from all users:";
    //create table
    if ($rating_array->num_rows > 0) {
     echo "<table align = center><tr><td><strong>Username</strong></td><td><strong>Rating</strong></td></tr>";
     // output data of each row
     while($row = $rating_array->fetch_assoc()) {
         echo "<tr><td>" . $row["email"]. "</td><td>" . $row["rating"]. "</td></tr>";
     }
    echo "</table></br>";
  }
  //echo "<hr />";
}
}

?>
