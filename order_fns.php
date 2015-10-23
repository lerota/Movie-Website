<?php
require_once('db_fns.php');
if( ! ini_get('date.timezone') )
{
    date_default_timezone_set('GMT');
}

function process_card($card_details) {
  // connect to payment gateway or
  // use gpg to encrypt and mail or
  // store in DB if you really want to

  return true;
}

function insert_order($order_details) {
  // extract order_details out as variables
  $valid_user = $_SESSION['valid_user'];
  extract($order_details);

  // set shipping address same as address
  if((!$ship_name) && (!$ship_address) && (!$ship_address_2) && (!$ship_city) && (!$ship_state) && (!$ship_zip)) {
    $ship_name = $name;
    $ship_address = $address;
    $ship_address_2 = $address_2;
    $ship_city = $city;
    $ship_state = $state;
    $ship_zip = $zip;
  }

  $conn = db_connect();

  // we want to insert the order as a transaction
  // start one by turning off autocommit
  $conn->autocommit(FALSE);

  // insert customer address
//  $query = "select user_id from customer where email = '".$valid_user."'";
//  $query = "select customerid from customers where
//            name = '".$name."' and address = '".$address."'
//            and city = '".$city."' and state = '".$state."'
//            and zip = '".$zip."' and country = '".$country."'";

//  $result = $conn->query($query);

  $query = "insert into has_address values
        (DEFAULT, '".$address."','".$address_2."','".$city."','".$state."','".$zip."',(select c.user_id from customer c
                                 where c.email='".$valid_user."'))";
  $result = $conn->query($query);

//  if($result->num_rows>0) {
//    $customer = $result->fetch_object();
//    $customerid = $customer->user_id;
//  } else {
//    $query = "insert into has_address values
//            (DEFAULT, '".$address."','".$address_2."','".$city."','".$state."','".$zip."',(select c.user_id from customer c
//                                     where c.email='".$valid_user."'))";
//    $result = $conn->query($query);

  if (!$result) {
      return false;
  }
//  }

//  $customerid = $conn->insert_id;

  $date = date("Y-m-d");

//  $query = "insert into purchase values
//            ('".$customerid."', '".$_SESSION['cart'][0]."', '".$_SESSION['total_price']."', '".$date."')";

//  $result = $conn->query($query);
//  if (!$result) {
//    return false;
//  }

//  $query = "select orderid from orders where
//               customerid = '".$customerid."' and
//               amount > (".$_SESSION['total_price']."-.001) and
//               amount < (".$_SESSION['total_price']."+.001) and
//               date = '".$date."' and
//               order_status = 'PARTIAL' and
//               ship_name = '".$ship_name."' and
//               ship_address = '".$ship_address."' and
//               ship_city = '".$ship_city."' and
//               ship_state = '".$ship_state."' and
//               ship_zip = '".$ship_zip."' and
//               ship_country = '".$ship_country."'";

//  $result = $conn->query($query);

//  if($result->num_rows>0) {
//    $order = $result->fetch_object();
//    $orderid = $order->orderid;
//  } else {
//    return false;
//  }
  $query_VIP = "select VIP from customer where email = '".$valid_user."'";

  // insert each book
  foreach($_SESSION['cart'] as $isbn => $quantity) {
    $detail = get_book_details($isbn);
//    $query = "delete from order_items where
//              orderid = '".$orderid."' and isbn = '".$isbn."'";
//    $result = $conn->query($query);
    
    $result = $conn->query($query_VIP);
    $row = $result->fetch_assoc();
    $entity_value = $row["VIP"];
    if ($entity_value==1) {
      $discounted_value = 0.75*$detail[0]['price'];
      $query = "insert into purchase values
              (DEFAULT, (select c.user_id from customer c
                                       where c.email='".$valid_user."'), '".$isbn."','".$discounted_value."', '".$date."')";
    }
    else{
      $query = "insert into purchase values
              (DEFAULT, (select c.user_id from customer c
                                       where c.email='".$valid_user."'), '".$isbn."','".$detail[0]['price']."', '".$date."')";
    } 
    $result = $conn->query($query);
    if(!$result) {
      return false;
    }
  }

  // end transaction
  $conn->commit();
  $conn->autocommit(TRUE);

  return TRUE;
}

?>
