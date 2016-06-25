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
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $_SESSION['buytype']=$_POST['buybtn'];
}
 
 $check_array=$_SESSION['id'];

 settype($query,"integer");
 	
 	


    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {


    	$action = isset($_POST['buybtn'])?$_POST['buybtn'] : null;

    	switch($action)
    	{
    		case 'Redeem':
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
                    else
                    {
                     header("Location: /confirmbuy.php");    
                    }
                    break;
            case 'Buy':
            		?>
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
    				<?php 
    					break;

    		default: 

    				$del_val=$_POST['buybtn'];
					if(($key = array_search($del_val,$check_array)) !== false) {
					unset($check_array[$key]);
					//echo "removed";
					$_SESSION['id']=array();
					$_SESSION['id']=$check_array;
					}
					/*else
					{
						echo "not removed";
					}*/

					break;
			}
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
                        <a class="page-scroll" href="/home.php#products"><h2>Products</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/home.php#redeem"><h2>Redeem</h2></a>
                    </li>
                </ul>
                
            </div>
            <div class="cart"><a href="/buy.php"><input type="image" src="/cart.png" width=60 height=60></a></div>

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
            echo "<h3><a href='myaccount.php'>".$obj['firstname']." ".$obj['lastname']."<br>"."POINTS: " .$obj['points']."</a><br><a href='logout.php'>LOGOUT</a></h3>";
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
    	
        <div class="header-content-left">
        <?php

            foreach($cursor_user as $obj)
            {
            if($query==$obj['cardno'])
            {
            	echo "<h2>"."NAME: "."</h2><h3>".$obj['firstname']." ".$obj['lastname']."</h3>";
            	echo "<h2>ADDRESS: "."</h2><h3>".$obj['address']['houseno'].", ".$obj['address']['street'].", ".$obj['address']['city']."</h3>";
            	echo "<h2>"."CONTACT NO: "."</h2><h3>".$obj['phoneno']."</h3>";

            }
        }?>
        </div>
        <div class="header-content-right">
            <!div class="header-content-inner">
              <?php if(!empty($check_array)) 
              {
              	
              	?> 
            	<center><h2>YOUR CART</h2></center>
                <table>
         	<?php	
         	foreach ($cursor_partner as $obj_partner) 
			{
				# code...

			foreach($obj_partner['products'] as $obj_pro)
			{

	 			foreach($obj_pro['p_details'] as $obj_details)
    		{
    			foreach($_SESSION['id'] as $key=>$valueid)
    			{
					   if($obj_details['id'] == $valueid )
					   {
					?>
					<tr>
					<?php

					echo "<td><h2>".$obj_details['name'].str_repeat("&nbsp;",14)."</h2></td>";
					
					echo "<td><h2>Rs.".$obj_details['price'].str_repeat("&nbsp;",6)."</h2></td>";

					$sum+=$obj_details['price'];
					$_SESSION['sum']=$sum;
					?>
					<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
					<td><input type="image" src="/cross.png" width=50 height=50 ></td>
					<input type="hidden" name="buybtn" value="<?php echo $obj_details['id']; ?>">
					</form>
					</tr><?php
					}
				}
			}
			
	}

}?></table>

		<?php 
			}
		else {
			echo "<h2>"."Your Cart is Empty!"."</h2>";
		}
		?>


            </div>
        </div>

    </header>

	<?php
		if(!empty($check_array)) 
              {?>
    <div class="buycss" >
       <center> <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		
		<div style="border: 3px solid orange">

		<?php foreach($cursor_user as $obj)
				{
					if($query==$obj['cardno'])
					{
	   		 		$pts=$obj['points'];
					}
				}
				if ($pts < $_SESSION['sum'])
				{
					$total_sum=$_SESSION['sum'];
					$bal= $total_sum-$pts;

					echo "<h3>"."Total sum for your purchase:  Rs.".$total_sum."</h3>";
					echo "<h3>"."Your current points: ".$pts."<h3>";
					echo "<h3>"."Amount to be paid: ".$bal."<h3><br>";
				}
				else
				{
					$total_sum=$_SESSION['sum'];
					$bal= $pts-$total_sum;

					echo "<h3>"."Total sum for your purchase:  Rs.".$total_sum."</h3>";
					echo "<h3>"."Your current points: ".$pts."<h3>";
					echo "<h3>"."Points after redeem: ".$bal."<h3><br>";
				}

		?>

		<input type="submit" name="buybtn" value="Redeem" class="btn">
		</div>
		<div style="border: 3px solid orange; margin-top: 40px;">
		<?php	

			foreach ($cursor_partner as $obj_partner) 
			{
			# code...
			
			foreach($obj_partner['products'] as $obj_pro)
			{

			 	foreach($obj_pro['p_details'] as $obj_details)
		    	{
		    		
		    		foreach($_SESSION['id'] as $key => $valid)
		    		{
						if($obj_details['id'] == $valid )
						{
							$calc_points += $obj_details['price']*$obj_partner['redeem_value']/100;
					   }
                    }	

				}
			}

		}



			foreach($cursor_user as $obj)
    		{
        	if($query==$obj['cardno'])
	        	{
	        		$prev_points = $obj['points'];
	        	}
    		}

    	$total_sum=$_SESSION['sum'];
    	$updating_ponts=$prev_points+$calc_points;
    	echo "<h3>"."Total sum for your purchase:  Rs.".$total_sum."</h3>";
    	echo "<h3>"."Your points after purchase:  Rs.".$updating_ponts."</h3><br>";

		?>
		<input type="submit" name="buybtn" value="Buy" class="btn" style="margin-bottom: 15px;">
		</div>
		</form></center>
	</div>
   <?php } ?>

    
   
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