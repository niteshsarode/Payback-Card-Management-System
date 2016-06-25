
<?php

session_start();



 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
$coll_partner = $db->partner;
$quer='e-store';
 $cursor_partner = $coll_partner->findOne(array('partnername'=>$quer)); 
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();
 //$x="mobile and accessories";
  //$fin=array('products.product_group'=>$x);
 foreach($cursor_partner as $obj)
{
echo "hello";	
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
                        <a class="page-scroll" href="#about">Home</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Partner</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#portfolio">Redeem</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contact Us</a>
                    </li>
                </ul>
                
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <a class="navbar-brand page-scroll" href="#page-top" style="text-align: right"><?php
 if($num_docs > 0)
 {
	foreach($docfind as $obj)
	{
		if($query==$obj['cardno'])
		{
			echo "WELCOME <a href='myaccount.php'>".$obj['firstname']."</a><br>"."POINTS: " .$obj['points'];
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

    

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Mobiles</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>A</h3>
                        <p class="text-muted">Buy all electronic devices at our store!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>B</h3>
                        <p class="text-muted">Here you can speed up for booking tickets online!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>C</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
		<div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>D</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Laptops</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>A</h3>
                        <p class="text-muted">Buy all electronic devices at our store!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>B</h3>
                        <p class="text-muted">Here you can speed up for booking tickets online!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>C</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
		<div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>D</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

   <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">TV</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>A</h3>
                        <p class="text-muted">Buy all electronic devices at our store!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>B</h3>
                        <p class="text-muted">Here you can speed up for booking tickets online!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>C</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
		<div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>D</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

   <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Cameras</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-diamond wow bounceIn text-primary"></i>
                        <h3>A</h3>
                        <p class="text-muted">Buy all electronic devices at our store!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-paper-plane wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>B</h3>
                        <p class="text-muted">Here you can speed up for booking tickets online!</p>
                    </div>
                </div>
                <div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>C</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
		<div class="col-lg-3 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-newspaper-o wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>D</h3>
                        <p class="text-muted">Order any daily requirement product from our store!</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Surprises For You!</h2>
                    <hr class="primary">
                    <p>Choose one of the deal that suits you best and get ready to use your points !</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>Gifts</p>
		    
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p>Offers</p>
                </div>
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
