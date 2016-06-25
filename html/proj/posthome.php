
<?php

session_start();

$current_partner=$_SESSION['partner'];

 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find(); 
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
 array_push($_SESSION['id'],$_POST['buybtn'] );
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

    <title><?php echo $current_partner ?></title>

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
        <a href="/buy.php"><input type="image" src="/homestyles/img/shopping-cart.jpg" width=100 height=75></a>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1><?php echo $current_partner ?></h1>
            </div>
        </div>
    </header>

   <?php   

    foreach($cursor_partner as $obj)
    {

    if($obj['partnername']==$current_partner)
    {
        foreach($obj['products'] as $obj_pro)
        {

    ?>
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <?php echo "<h2>".$obj_pro['product_group']."</h2>"; ?>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

             <?php 
                    foreach($obj_pro[p_details] as $obj_details)
                    {
                        ?>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>


                        <?php echo "<h3>".$obj_details['name']."</h3>"; ?>
                        <?php echo "<p>Code: ".$obj_details['id']."</p>"; ?>
                        <?php echo "<p>Rs.".$obj_details['price']."</p>"; ?>

                    </div>
                    <br><br>
                    <form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
			<h4>Add to cart</h4><br>
                       <input type="image" src="/homestyles/img/shopping-cart.jpg" width=50 height=50>
                       <input type="hidden" name="buybtn" value="<?php echo $obj_details['id'] ?>">
                    </form>
                </div>
                 <?php } ?>
             
                
            </div>
        </div>
     </section> 
     <?php }}} ?> 

    

    

   
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
