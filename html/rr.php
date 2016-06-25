<?php
session_start();
try{
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
$cursor = $collection->find();
$num_docs = $cursor->count();
$coll_redeem = $db->redeem;
$cursor_redeem = $coll_redeem->find();
$max=51265200;
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
$usr=array('cardno'=>$max,'points'=>100,'shop_history'=>array());
$x=$coll_redeem->update(array(),array('$push'=>array('user'=>$usr)),array('upsert'=>true));
var_dump($x);?>
<script type='text/javascript'>
    var	bal= '<?php echo $max;?>';
     alert('USERNAME : ' + bal);
     window.location="/login.php";
</script>
    <?php
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