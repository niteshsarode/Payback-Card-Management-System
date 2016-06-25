
<?php

session_start();
  

//=========================================================================================

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
 $_SESSION['partner']=$_POST['partner'];
 header("Location: /posthome.php");
}

//=========================================================================================

 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find();
 $total_partner = $cursor_partner->count();
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();
  $coll_redeem = $db->redeem;
 $cursor_redeem = $coll_redeem->find();


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>HOME</title>

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
                        <a class="page-scroll" href="#services"><h2>Partner</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#products"><h2>Products</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#redeem"><h2>Redeem</h2></a>
                    </li> 
                    </ul>
                
            </div>
            <div class="cart"><a href="/buy.php"><input type="image" src="/cart.png" width=60 height=60></a></div>
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
			echo "<h3><a href='myaccount.php'>".$obj['firstname']." ".$obj['lastname']."<br>"."POINTS: " .$obj['points'].
            "</a><br><a href='logout.php'>LOGOUT</a></h3>";
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
                <h1>WE MAKE YOU BUY AT ITS FULLEST !</h1>
                <hr>
                <p>Start purchasing your requirements and services through us. We assure your satisfaction by our GIFTS and OFFERS !</p>
          
            </div>
        </div>
    </header>

    

 <section id="services" name="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
            <?php
            if($total_partner > 0)
 {
    foreach($cursor_partner as $obj){
        if($obj['partnername']){
            ?>
                <div class="col-sm-4 text-center">
                    <div class="service-box">
                         <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <button type="submit" name="partner" value="<?php echo $obj['partnername'];?>">
                <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                <?php echo "<h3>".$obj['partnername']."<h3>";  ?></button>
            </form>

                    </div>
                </div>
                <?php }}} 
		?>
              </div>
        </div>

        <br>
    

    </section>



    <?php
foreach ($cursor_redeem as $obj){
foreach($obj['user'] as $emb_obj) {
if($query==$emb_obj['cardno']) {  
foreach ($emb_obj['shop_history'] as $histo){
    if($histo['id']){?>
    <section class="no-padding" id="products">
        <div class="container-fluid">
            <div class="row no-gutter">
            <center><h2 class="section-heading">Suggestions</h2>
                    <hr class="primary"></center>
 <?php break;}}}}}?>               
<ul>
<?php
$i=0;
$prev=array();
foreach ($cursor_redeem as $obj){
foreach($obj['user'] as $emb_obj) {
if($query==$emb_obj['cardno']) {  
$emb_temp=$emb_obj;
foreach ($emb_obj['shop_history'] as $histo){
foreach($prev as &$pre1){  
if(substr($histo['id'],0,5)!=$pre1){  
foreach($cursor_partner as $obj1){
foreach ($obj1['products'] as $p_prod){   
foreach($p_prod['p_details'] as $suggestion){
if(substr($histo['id'],0,5)==substr($suggestion['id'],0,5) ){    
        foreach($emb_temp['shop_history'] as $histo1){
            if($histo1['id']!=$suggestion['id']){?>
                    
                    <h4><center><li>BUY <u><?php echo $suggestion['name']."</u> just at <u>Rs.".$suggestion['price']." @".$obj1['partnername'];?></u></center></h4></li>
                    
                <?php break;}}}}}}}}
                $prev=array($i=>substr($histo['id'],0,5)); 
                $i=$i+1;
                }}}}?></ul>
            </div>
        </div>
    </section> 

    <section id="redeem">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Surprises For You!</h2>
                    <hr class="primary">
                    <p>Choose one of the deal that suits you best and get ready to use your points !</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <img src="/homestyles/img/gift-2.jpg" height=50 width=50>


<?php
    $coll_redeem = $db->redeem;
    $cursor_redeem = $coll_redeem->find();
    $count=1;
    foreach ($cursor_redeem as $obj)
    {
?>


                    <p>Gifts</p>
               
                    <table class="bordered">
                    <thead>

                    <tr>
                    <th>#</th>        
                    <th>Product Name</th>
                    <th>Points</th>
                    <th>Get It!</th>
                    </tr>
                    </thead>

                    <?php              
                    foreach($obj['offer'] as $emb_obj) { ?>
                    <tr>
                    <?php echo "<td>".$count."</td>"; ?>        
                    <?php echo "<td>".$emb_obj['gift']."</td>"; ?>
                    <?php echo "<td>".$emb_obj['points']."</td>"; ?>
                    <form method="POST" action="redeem.php">
                    <td><button type="submit" name="pointsasid" value="<?php echo $emb_obj['points']; ?>">Redeem</a></td> 
                    </form>
                    </tr>
                    
        
            <?php $count=$count+1;}}?>
		             </table> 
                
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
