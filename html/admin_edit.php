<?php
session_start();


 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find(); 
$coll_user = $db->user;
$coll_redeem = $db->redeem;
 $cursor_redeem = $coll_redeem->find(); 

//**********************************************************ADD OFFER
 if($_POST['tisra'] == "add_offer")
 {
 	$ofr=array("points"=>$_POST['points'],"gift"=>$_POST['gift']);
	$x=$coll_redeem->update(array(),array('$push'=>array('offer'=>$ofr)),array('upsert'=>true));
	var_dump($x);
    	header("Location: /admin.php");
 }
//********************************************************************

//**********************************************************ADD PARTNER
 else if($_POST['tisra']=="add")
{
	$qu=array("partnername"=> $_POST['partnername'],"redeem_value"=>$_POST['redeem_value'],"products"=>array());
	$x=$coll_partner->insert($qu);
	$u=array("cardno"=> $_POST['partnername'],"password"=>"admin","admin"=>"true","partner"=>$_POST['partnername']);
	$y=$coll_user->insert($u);	
	//var_dump($y);
  ?>
  <script type='text/javascript'>
   var bal= "<?php echo $_POST['partnername'];?>";
     alert("USERNAME : " + bal + "\r\nPASSWORD : admin" );
     window.location="/admin.php";
</script>
<?php
        //header("Location: /admin.php");
}
//**********************************************************

//************************************************************REMOVE OFFER
else if($_POST['tisra'] == "remove")
 {
   $query=$_POST['gift'];
   $coll_redeem->update(array(),array('$pull' => array("offer" =>array("gift" => $query))));
   header("Location: /admin.php");
  }
//************************************************************************

//*************************************************************DELETE PARTNER
 else if($_POST['tisra'] == "delete")
 {
    $x=$coll_partner->remove(array('partnername'=>$_POST['partnername']));
    $y=$coll_user->remove(array('partner'=>$_POST['partnername']));
    //var_dump($x);
    header("Location: /admin.php");
  }
//*******************************************************************************

//***********************************************UPDATE REDEEM VALUE
else if($_POST['tisra'] == "update")
 {
    $c_partner=$_POST['partnername'];
    $qu=array("partnername"=> $c_partner);
    $nw=$_POST['redeem_value'];
    $x=$coll_partner->findAndModify($qu,array('$set'=>array("redeem_value" => $nw)));  
    header("Location: /admin.php");
}
//************************************************************

?>
