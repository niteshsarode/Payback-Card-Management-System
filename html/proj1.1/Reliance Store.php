
<?php

session_start();



 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find(); 
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();
 //$x="mobile and accessories";
  //$fin=array('products.product_group'=>$x);


 
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
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1>OUR ELECTRONICS, YOUR NEW BEGINNINGS !</h1>
                <hr>
                <p><b><h2>MOBILES, LAPTOPS, TVS AND CAMERAS!</h2></b></p>
            </div>
        </div>
    </header>

   <?php   

    foreach($cursor_partner as $obj)
    {

    if($obj['partnername']=="Reliance Store")
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
                </div>
                 <?php } ?>
             
                
            </div>
        </div>
     </section> 
     <?php }}} ?> 

    

    

   <section id="redeem">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Surprises For You!</h2>
                    <hr class="primary">
                    <p>Choose one of the deal that suits you best and get ready to use your points !</p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <img src="/homestyles/img/greengift.jpeg">



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
                    <td><a href="#">Redeem</a></td> 
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
