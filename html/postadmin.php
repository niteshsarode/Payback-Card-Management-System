<?php
session_start();
$current_partner=$_SESSION['partner'];

 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find(); 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>POSTADMIN</title>

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

    <link rel="stylesheet" href="homestyles/css/tables.css" type="text/css">
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
                        <a class="page-scroll" href="#page-top"><h2>Home</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services"><h2>Update</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#redeem"><h2>Add</h2></a>
                    </li>
                    </ul>
                
            </div>
            <div style="float:right;"><a href="logout.php"> <h3 style="text-align:right">LOGOUT</h3></a>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
                <a class="page-scroll" href="#page-top"></a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1> <center> <?php echo $current_partner;?></center></h1>
		<hr>
                <p><u>REDEEM VALUE: <?php foreach($cursor_partner as $temp){
					if($temp['partnername']==$current_partner){
						echo $temp['redeem_value'];}}?></u></p>
		
            </div>
        </div>
    </header>

    

 <section id="services" name="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Update or remove product</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <?php
foreach($cursor_partner as $obj)
	{
		if($obj['partnername']==$current_partner)
		{
			?>

        <?php 
	  foreach($obj['products'] as $prod){?><form method="post" action="partner_edit.php">
		<input type="text" name="product_group" value="<?php echo $prod['product_group'];?>" hidden></input>
	  <br><br><center><table style="font-size: 20px; table-layout:fixed; width:700px;" border="0">
	  <th style="text-transform:uppercase;" colspan="4"><ul><u><center><li><?php echo $prod['product_group'];?></u>&nbsp;
	  <button type="submit" name="dusra" value="remove" style="color:red;">REMOVE</button></center></form></li>
	<?php  foreach($prod['p_details'] as $pro_det){?><tr>
	       <form action="partner_edit.php" method="POST">
	       	<input type="text" name="product_group" value="<?php echo $prod['product_group'];?>" hidden></input>
	  <tr><td>Product Name:<td colspan="2">
          <input type="text"  name="name" value="<?php echo $pro_det['name'];?>" ><td rowspan="3">
		<button type="submit" name="dusra" value="update"><u>UPDATE</u></button><br>
		<button type="submit" name="dusra" value="delete"><u>DELETE</u></button><tr>
          <td>Product Id:<td colspan="2">
          <input type="text"  name="id" value="<?php echo $pro_det['id'];?>" readonly><tr>
	
	  <td>Price:<td colspan="2">
          <input type="number"  name="price" value="<?php echo $pro_det['price'];?>">
		</form><tr><th colspan="4"><hr style="color:purple;">
          <?php }?>
        </table></center><?php }?>
        
                    </div>
                </div>
                <?php }} 
		?>
              </div>
        </div>

    

    </section>



        



    <section id="redeem">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-lg-offset-2 text-center">
<h2>ADD NEW PRODUCT GROUP</h2><hr>
		<form action="partner_edit.php" method="post"><h4><b>Enter group name:</b><input style="background-color: Transparent;"type="text" name="product_group"></input>
		<button type="submit" name="dusra" value="addgroup"><u>ADD</u></button></h4></form><br><br>

                    <h2 class="section-heading">Add new product</h2>
                    <hr class="primary">
                 </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">


<?php foreach($cursor_partner as $obj)
    {
         
        if($obj['partnername'] == $current_partner)
        {?>
 <form action="partner_edit.php" method="POST"><center>         
<table style="font-size: 20px; width:500px;" border="0"><th>Product Group:<td>
<select name="product_group" value="PRODUCT GROUP">
<?php foreach($obj['products'] as $p_grp){?>
<option value="<?php echo $p_grp['product_group'];?>"><?php echo $p_grp['product_group'];?></option>
<?php }?></select><tr><th>Product Name:<td>
<input type="text" name="name"></input><tr><th>Price:<td>
<input type="text" name="price" ></input><tr><th colspan="2"><center>
<button type="submit" name="dusra" value="add"><u>ADD</u></button></center></table></center><?php }}?>
</form> 
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
