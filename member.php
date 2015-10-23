<?php

// include function files for this application
require_once('book_sc_fns.php');
session_start();

//create short variable names
$email = $_POST['email'];
$passwd = $_POST['passwd'];
try   {
  if (!filled_out($_POST)) {
      throw new Exception('You have not filled the form out correctly - please go back and try again.');
    }

  if ($email && $passwd) {
// they have just tried logging in
  try  {
    login($email, $passwd);
    // if they are in the database register the user id
    $_SESSION['valid_user'] = $email;
  }
  catch(Exception $e)  {
    // unsuccessful login
    do_html_header('Problem:');
    echo 'Wrong email or password.
          Please try again.';
    echo"<hr/>";
    do_html_url('login.php', 'Login');
    do_html_footer();
    exit;
  }
}
do_html_header('');

check_valid_user();

// get the bookmarks this user has saved
if ($url_array = get_user_urls($_SESSION['valid_user'])) {
  display_user_urls($url_array);
}

// give menu of options
display_user_menu();

do_html_footer();

}
catch(Exception $e){
  do_html_header('Problem:');
  echo $e->getMessage();
  echo"<hr/>";
      do_html_url('login.php', 'Login');
     do_html_footer();
     exit;
}

?>
