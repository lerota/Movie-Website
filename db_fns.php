<?php

function db_connect() {
   $result = new mysqli('cs4111.c5to4aweyhy9.us-west-2.rds.amazonaws.com', 'yd2302', 'database', 'cs4111', '3306');
   if (!$result) {
     throw new Exception('Could not connect to database server');
   }
   $result->autocommit(TRUE);
   return $result;
}

function db_result_to_array($result) {
   $res_array = array();

   for ($count=0; $row = $result->fetch_assoc(); $count++) {
     $res_array[$count] = $row;
   }

   return $res_array;
}

?>
