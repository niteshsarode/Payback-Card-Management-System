<?php

 session_start();
 
 $value= $_SESSION['id'];
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
 print_r($_SESSION['id']);
 

 settype($query,"integer");
 
foreach ($cursor_partner as $obj_partner) 
{
	# code...
	

	foreach($obj_partner['products'] as $obj_pro)
	{

	 	foreach($obj_pro['p_details'] as $obj_details)
    	{
			if($obj_details['id'] == $value )
			{

				echo $obj_details['price'];
				$calc_points = $obj_details['price']*$obj_partner['redeem_value']/100;
				$val= array( "id" => $obj_details['id'], "product_group" => $obj_pro['product_group'], 
					"product_name" => $obj_details['name'], "product_price" => $obj_details['price']);
				//$coll_redeem->update(array('user.cardno'=>$query),array('$addToSet' => array("user.$.shop_history" => $val)));
			}

		}
	}

}


foreach ($cursor_user as $obj_user) {
	# code...
	if($obj_user['cardno']==$query)
	{
		$prev_points=$obj_user['points'];
	}
}

$updated_points = $prev_points + $calc_points;
echo $updated_points;



//$coll_user->update(array("cardno" => $query),array('$set' => array("points" => $updated_points)));
//$coll_redeem->update(array('user.cardno'=>$query),array('$set' => array('user.$.points' => $updated_points)));


foreach ($cursor_user as $obj_user) {
	# code...
	if($obj_user['cardno']==$query)
	{
		echo $obj_user['points'];
	}
}


foreach ($cursor_redeem as $obj_redeem) {
	# code...
	foreach ($obj_redeem['user'] as $obj_user) {
		# code...
		if($obj_user['cardno'] == $query)
		{
			echo $obj_user['points'];
		}
	}

}

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
    		if($_POST['submit']== "Redeem")
    		{
    			 foreach($cursor_user as $obj)
    				{
        				if($query==$obj['cardno'])
        				{
           		 		$pts=$obj['points'];
        				}
    				}
    				if ($pts < $_SESSION['sum'])
    				{
    					$total_sum=$_SESSION['sum'];?>
    					<script>
    					var	bal= '<?php echo ($total_sum-$pts);?>';
    					var result=confirm("Not enough points!Pay " + bal +" using cash");
    					if(result == true)
    					{
    						window.location="/confirmbuy.php";
    					}
    					else if(result == false)
    					{
    						window.location="/buy.php";
    					}
    					</script>
    				<?php
    				}
    		}
    	
    		else if ($_POST['submit'] == "Buy")
    		{?>
    					<script>
    					
    					var result=confirm("Are you sure for purchasing this item?");
    					if(result == true)
    					{
    						window.location="/confirmbuy.php";
    					}
    					else if(result == false)
    					{
    						window.location="/buy.php"
    					}
    					</script>
    		<?php }
    	}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>E-STORE</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="homestyles/css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="homestyles/font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="homestyles/css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="homestyles/css/creative.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="homestyles/css/tables.css" type="text/css">
    <link rel="stylesheet" href="buttons.css" type="text/css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                    <ul class="nav navbar-nav ">
                    <li>
                        <a class="page-scroll" href="/home.php"><h2>Home</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/home.php#services"><h2>Partner</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#products"><h2>Products</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#redeem"><h2>Redeem</h2></a>
                    </li>
                </ul>
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <a class="page-scroll" href="#page-top">
<?php
 if($total_user > 0)
 {
    foreach($cursor_user as $obj)
    {
        if($query==$obj['cardno'])
        {
            echo "<h3><a href='myaccount.php'>".$obj['firstname']." ".$obj['lastname']."</a><br>"."POINTS: " .$obj['points']."</h3>";
        }
    }
 }
 
?></a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                
            	<h1>YOUR CART</h1>

         	<?php	
         	foreach ($cursor_partner as $obj_partner) 
			{	
			foreach($obj_partner['products'] as $obj_pro)
			{

	 			foreach($obj_pro['p_details'] as $obj_details)
    		{
    			foreach($_SESSION['id'] as $key=>$valueid)
    			{
					if($obj_details['id'] == $valueid )
					{
					
					echo "<h2>".($key+1);
					echo str_repeat("&nbsp;",10);
					echo $obj_details['name'];
					echo str_repeat("&nbsp;",10);
					echo $obj_details['price']."<br></h2>";
					$sum+=$obj_details['price'];
					}

				}
			}
			
	}

}
				$_SESSION['sum']=$sum;
				echo "<h2>TOTAL AMOUNT: ".$sum."</h2>";
				?>
		<br>
		<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="submit" name="submit" value="Redeem" class="btn">
		<input type="submit" name="submit" value="Buy" class="btn">
		</form>
            </div>
        </div>
    </header>

   

    
   
    <!-- jQuery -->
    <script src="homestyles/js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="homestyles/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="homestyles/js/jquery.easing.min.js"></script>
    <script src="homestyles/js/jquery.fittext.js"></script>
    <script src="homestyles/js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="homestyles/js/creative.js"></script>

</body>

</html>
