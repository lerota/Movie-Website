<?php
  // include function files for this application
  require_once('book_sc_fns.php');

  // start session which may be needed later
  // start it now because it must go before headers
  session_start();

  try {

  // provide link to members page
  do_html_header('Purchase History');
  check_valid_user();

  $purchase_history_array = get_purchase_history();

  if (!$purchase_history_array||mysqli_num_rows($purchase_history_array)==0) {
    echo "<p>You haven't bought any movie yet.</p>";
  }
  else{
  display_purchase_history($purchase_history_array);
  }

  display_user_menu();
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