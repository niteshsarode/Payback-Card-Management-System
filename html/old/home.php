
<?php

session_start();



 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();

 if($num_docs > 0)
 {
	foreach($docfind as $obj)
	{
		if($query==$obj['cardno'])
		{
			echo "WELCOME ";
			echo "<a href='myaccount.php'>".$obj['firstname']."</a>";
			?>
			<br/>
			<?php
			echo "POINTS: " .$obj['points'];
		}
	}
 }
 
?>
