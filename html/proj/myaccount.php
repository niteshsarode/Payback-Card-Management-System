
<?php

session_start();



 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $coll_redeem=$db->redeem;
 $cur_redeem=$coll_redeem->find();
 $count_redeem=$cur_redeem->count();
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
    input{
	background-color: transparent;
	}
table{
margin-left:50px;
font-size:20px;
}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

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
                        <a class="page-scroll" href="#products"><h2>History</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="/home.php#redeem"><h2>Redeem</h2></a>
                    </li>
                </ul>
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <a class="page-scroll" href="#page-top">
<?php
 if($num_docs > 0)
 {
    foreach($docfind as $obj)
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
        <!div class="header-content">
            <!div class="header-content-inner">

	<br><br><br><br><br>
                <h2>ACCOUNT DETAILS</h2>
                <hr>
<?php
foreach($docfind as $obj)
	{
		if($query==$obj['cardno'])
		{
			?>
 <center><form action="accountedit.php" method="POST">
      <table style="font-size: 25px" >
	  <th>Card number:<td>
          <?php echo $obj['cardno'];?><tr>
	
          <th>Firstname:<td>
          <?php echo $obj['firstname'];?><tr>
	
	  <th>Lastname:<td>
          <?php echo $obj['lastname'];?><tr>
          
          <th>Email:<td>
          <?php echo $obj['email'];?><tr>
          
	  <th>Phone number:<td>
          <?php echo $obj['phoneno'];?><tr>
           
          <th>Date of birth:<td>
          <?php echo $obj['dob'];?><tr><br>

          <th>Address:<tr>

          <th>&nbsp;House No:<td>
          <?php echo $obj['address']['houseno'];?><tr>

          <th>&nbsp;Street:<td>
          <?php echo $obj['address']['street'];?><tr>


          <th>&nbsp;City:<td>
          <?php echo $obj['address']['city'];?><tr>

          <th>&nbsp;State:<td>
          <?php echo $obj['address']['state'];?><tr>


          <th>&nbsp;Country:<td>
          <?php echo $obj['address']['country'];?><tr>
             
      <td><td><br><input type="submit" value="EDIT">
	</table>
	<br>
<?php }} ?>
      </form></center>
	
</div>
        </div>
    </header>

    

    <section id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">ACCOUNT HISTORY</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

<?php           


 foreach($cur_redeem as $obj)
                {
                    foreach($obj['user'] as $obj_user)
                        { 
                            if($obj_user['cardno']==$query)
                            {
                                foreach($obj_user['shop_history'] as $obj_shop)
                                {
                                    if($obj_shop != null)
                                    {       
                            ?>

                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <?php echo "<h3>".$obj_shop['product_name']."</h3>";?>
                        <?php echo "<h3>Rs. ".$obj_shop['product_price']."</h3>";?>
                        
                    </div>
                </div>
          <?php 
            }

          else {
               # code...
                echo "<h3><center>"."You have not purchased any products yet!"."</center></h3>";
           }

          }}}} ?>
                
            </div>
        </div>
    </section> 

    

    

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
