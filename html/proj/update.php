<?php
session_start();
try{
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
$query=$_SESSION['uname'];
settype($query,"integer");
$addr=array('houseno'=>$_POST['houseno'],'street'=>$_POST['street'],
	'city'=>$_POST['city'],'state'=>$_POST['state'],'country'=>$_POST['country']);
$a=array('firstname'=>$_POST['firstname'],'lastname'=>$_POST['lastname'],'email'=>$_POST['email'],
	'phoneno'=>$_POST['phoneno'],'dob'=>$_POST['dob'],'address'=>$addr);
$collection->update(array('cardno'=>$query),array('$set'=>$a));
var_dump($a);
header("Location: /myaccount.php");
exit();
}

catch ( MongoConnectionException $e )
{
    // if there was an error, we catch and display the problem here
    echo $e->getMessage();
}
catch ( MongoException $e )
{
    echo $e->getMessage();
}

?>
