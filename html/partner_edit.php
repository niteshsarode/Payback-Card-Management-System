<?php
session_start();

$current_partner=$_SESSION['partner'];

 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find();
 $new_p=$coll_partner->findOne(array("counter"=>"true")); 
 //var_dump($new_p);
 print_r($_POST);


//**********************************************************ADD PRODUCT GROUP
 if($_POST['dusra']=="addgroup")
{
	$qu=array("partnername"=> $current_partner);
	$nw=array("product_group"=>$_POST['product_group'],"p_details"=>array());
	$x=$coll_partner->update($qu,array('$addToSet'=>array("products" => $nw)));
	var_dump($x);
        header("Location: /postadmin.php");
}
//**********************************************************


 else if($_POST['dusra'] == "add")
 {
    $xc=$new_p['count'];
    $new_id=strtolower(substr($_POST['product_group'],0,3).substr($_POST['name'],0,2));
    if($_POST['acc']){
    $new_id=$new_id."acc";
    }
    if($xc<10){
        $new_id=$new_id."0".$xc;
    }
    else{
        $new_id=$new_id.$xc;
    }
    $qu=array("partnername" => $current_partner,"products.product_group" => $_POST['product_group']);
    $nw=array("name" => $_POST['name'],"id" => $new_id, "price" => intval($_POST['price']));
    $x=$coll_partner->update($qu,array('$addToSet' => array("products.$.p_details"=>$nw)));
    $qu=array("counter"=> "true");
    $nw=$xc+1;
    $x=$coll_partner->findAndModify($qu,array('$set'=>array("count" => $nw)));  
    header("Location: /postadmin.php");
 }
else if($_POST['dusra'] == "delete")
 {
    $qu=array("partnername" => $current_partner,"products.product_group" => $_POST['product_group']);
    $nw=array("id" => $_POST['id']);
    $x=$coll_partner->update($qu,array('$pull' => array("products.$.p_details"=>$nw)));
    header("Location: /postadmin.php");
  }

//************************************************REMOVE PRODUCT GROUP
 else if($_POST['dusra'] == "remove")
 {

    $x=$coll_partner->update(array("partnername"=>$current_partner),array('$pull' => array("products" =>array("product_group" =>$_POST['product_group']))));
    header("Location: /postadmin.php");
    print_r($x);
  }
//****************************************************************

 else  if($_POST['dusra'] == "update")
 {
 	foreach($cursor_partner as $obj)
    {

    if($obj['partnername']==$current_partner)
    {
        foreach($obj['products'] as $obj_pro)
        {
            
            if($obj_pro['product_group']==$_POST['product_group'])
            {
            $count=0;
        	foreach($obj_pro[p_details] as $obj_details)           
            {
                    
                    
                    if($obj_details['id'] ==$_POST['id'])
                    {

                        $flag=1;
                    	break;
                    }
                    $count+=1;	

            }
             if($flag=1)
                    {
                        break;
                    }
            }
        }
    }
}
$qu=array("partnername" => $current_partner,"products.p_details.id" => $_POST['id']);
$nw=array("products.$.p_details.{$count}.name" => $_POST['name'],
 "products.$.p_details.{$count}.id" => $_POST['id'], "products.$.p_details.{$count}.price" => intval($_POST['price']));
$coll_partner->update($qu,array('$set'=>$nw));
header("Location: /postadmin.php");
 }
	

?>
