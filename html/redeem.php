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

 $pointss = $_POST[pointsasid];
 $_SESSION['pt']=$pointss;
 
 
 settype($query,"integer");

	 foreach($cursor_user as $obj)
		{
			if($query==$obj['cardno'])
			{
		 		$pts=$obj['points'];
			}
		}
		if ($pts > $pointss)
		{?>
			<script>
	        var pts= '<?php echo ($pointss);?>';
	        var result=confirm("For accepting this gift your points will be deducted by" + pts + 
	            ". Do you want this gift to be delivered?");
	        if(result == true)
	        {
	            alert("Confirmed");
	            window.location="/confirmredeem.php";

	        }
	        else if(result == false)
	        {
	            window.location="/home.php";
	        }
	        </script>
		<?php
		}
		else
		{?>
			<script>
			var pts= '<?php echo ($pointss);?>';
			alert("You do not have sufficient points!" + pts);
			window.location="/home.php";
			</script>
		<?php }
		?>