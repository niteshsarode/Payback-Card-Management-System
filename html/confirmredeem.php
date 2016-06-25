<?php	
session_start();
 

 $query = $_SESSION['uname'];

 $conn = new Mongo('localhost');
 $db = $conn->payback;

 $coll_user = $db->user;
 $coll_partner = $db->partner;
 $coll_redeem = $db->redeem;

 $cursor_partner = $coll_partner->find();
 $total_partner = $cursor_partner->count();
 
 $cursor_user = $coll_user->find();
 $total_user = $cursor_user->count();

 $cursor_redeem = $coll_redeem->find();
 $total_redeem = $cursor_redeem->count();

 $pointss = $_SESSION['pt'];

  foreach($cursor_user as $obj)
		{
			if($query==$obj['cardno'])
			{
		 		$pts=$obj['points'];
			}
		}
	
 $updated_points=$pts-$pointss;

 settype($query,"integer");
	        	
$coll_user->update(array("cardno" => $query),array('$set' => array("points" => $updated_points)));
$coll_redeem->update(array('user.cardno'=>$query),array('$set' => array('user.$.points' => $updated_points)));
//echo $updated_points;
header("Location: /home.php");

	            ?>