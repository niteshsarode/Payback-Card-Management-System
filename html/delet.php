<?php
session_start();
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $coll_redeem = $db->redeem;
 $cursor_redeem = $coll_redeem->find();
$query=$_SESSION['uname'];
settype($query,"integer");
$collection->remove(array('cardno'=>$query), array("justOne" => true));
$coll_redeem->update(array(),array('$pull' => array("user" =>array("cardno" => $query))));
header("Location: /login.php");
?>