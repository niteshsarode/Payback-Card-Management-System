<?php
session_start();
try{
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
$cursor = $collection->find();
$num_docs = $cursor->count();
$max=0;
if($num_docs > 0)
  {
	foreach($cursor as $obj)
	{
		if($obj['cardno']>$max )
		{
			$max=$obj['cardno'];	
		}				
	}
}
$max+=1;
$_SESSION['uname']=$max;
$addr=array('houseno'=>$_POST['houseno'],'street'=>$_POST['street'],
	'city'=>$_POST['city'],'state'=>$_POST['state'],'country'=>$_POST['country']);
$a=array('cardno'=>$max,'firstname'=>$_POST['firstname'],'lastname'=>$_POST['lastname'],'email'=>$_POST['email'],
	'phoneno'=>$_POST['phoneno'],'password'=>$_POST['password'],'dob'=>$_POST['dob'],'address'=>$addr,'points'=>100);
$collection->insert($a);
var_dump($a);
header("Location: /home.php");
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