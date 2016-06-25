 <?php

session_start();
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find();
 $coll_redeem = $db->redeem;
 $cursor_redeem = $coll_redeem->find();

 $map=new MongoCode("function(){for(var idx=0;idx<this.user.length;idx++){
    for(var id=0;id<this.user[idx].shop_history.length;id++){
    var value=1;
    var key=this.user[idx].shop_history[id].id;emit(key,value);}}}");
 $reduce=new MongoCode("function(keys,values){var sum=0;
    for(var id=0;id<values.length;id++){sum+=values[id];}return sum;}");
 $total=$db->command(array("mapreduce"=>"redeem","map"=>$map,"reduce"=>$reduce,"out"=>"an"));
$z=$db->an->find();
$values=array();


foreach($z as $obj)
{
  $id=$obj['_id'];
    $values[$id]=$obj['value'];
    
}
$_SESSION['dta']=$values;
 $img_width=900;
    $img_height=500; 
    $margins=50;

 
    # ---- Find the size of graph by substracting the size of borders
    $graph_width=$img_width - $margins * 2;
    $graph_height=$img_height - $margins * 2; 
    $img=imagecreate($img_width,$img_height);

 
  $bar_width=25;
    $total_bars=count($values);
    $gap= ($graph_width- $total_bars * $bar_width ) / ($total_bars +1);

 
    # -------  Define Colors ----------------
    $bar_color=imagecolorallocate($img,0,64,128);
    $background_color=imagecolorallocate($img,240,240,255);
    $border_color=imagecolorallocate($img,200,200,200);
    $line_color=imagecolorallocate($img,220,220,220);
 
    # ------ Create the border around the graph ------

    imagefilledrectangle($img,1,1,$img_width-2,$img_height-2,$border_color);
    imagefilledrectangle($img,$margins,$margins,$img_width-1-$margins,$img_height-1-$margins,$background_color);

 
    # ------- Max value is required to adjust the scale -------
    $max_value=max($values);
    $ratio= $graph_height/$max_value;

 
    # -------- Create scale and draw horizontal lines  --------
   $horizontal_lines=30;
    $horizontal_gap=$graph_height/$horizontal_lines;

   for($i=1;$i<=$horizontal_lines;$i++){
        $y=$img_height - $margins - $horizontal_gap * $i ;
       // imageline($img,$margins,$y,$img_width-$margins,$y,$line_color);
        $v=intval($horizontal_gap * $i /$ratio);
        //imagestring($img,1,5,$y-5,$v,$bar_color);

    }
 
 
    # ----------- Draw the bars here ------
    for($i=0;$i< $total_bars; $i++){ 
        # ------ Extract key and value pair from the current pointer position
        list($key,$value)=each($values); 
        $x1= $margins + $gap + $i * ($gap+$bar_width) ;
        $x2= $x1 + $bar_width; 
        $y1=$margins +$graph_height- intval($value * $ratio) ;
        $y2=$img_height-$margins;
        imagestring($img,1,$x1+10,$y1-10,$value,$bar_color);
        imagestring($img,0,$x1-5,$img_height-35,$key,$bar_color);       
        imagefilledrectangle($img,$x1,$y1,$x2,$y2,$bar_color);
    }
   // header("Content-type:image/png");
    imagepng($img,"Test.png",0);

 ?>	
	

<!DOCTYPE html>
<html lang="en">

<head>
	<style>
    input{
	background-color: transparent;
	}
	</style>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>ADMIN</title>

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
                        <a class="page-scroll" href="#page-top"><h2>PARTNERS</h2></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services"><h2>OFFERS</h2></a>
                    </li>
                     <li>
                        <a class="page-scroll" href="#redeem"><h2>ANALYSIS</h2></a>
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
		<h2 style="font-size: 40px;">PARTNERS</h2><hr>
            <div class="header-content-inner" style="float:left;">
	    
	    <?php
 	    foreach($cursor_partner as $obj){
                if($obj['partnername']){?>
            <form method="post" action="admin_edit.php">
		<input type="text" name="partnername" value="<?php echo $obj['partnername'];?>" hidden></input>
		<table border="0" style="table-layout:fixed; width:500px;">
		<tr><th><center>
			<h3 style="text-transform:uppercase;"><?php echo $obj['partnername'];?></center><td>REDEEM VALUE:<input type="number" name="redeem_value" value="<?php echo $obj['redeem_value'];?>"></input></h3></table> 
			<button type="submit" value="update" name="tisra"><b><u>UPDATE</u></b></button> 
			<button type="submit" value="delete" name="tisra"><b><u>REMOVE PARTNER</u></b></button>
			</form><?php }}?></div>
	  <div class="header-content-inner" style="float:right;">
		<form method="post" action="admin_edit.php"><h2>ADD NEW PARTNER</h2>
		<table border="0" style="font-size: 20px; table-layout:fixed; width:500px;"><tr><th>PARTNER NAME<td>
		<input type="text" name="partnername" value=""></input><tr>
<th>REDEEM VALUE<td><input type="number" name="redeem_value" value=""></input><tr><th colspan="2" rowspan="2"><center>			<button type="submit" value="add" name="tisra"><b><u>ADD</u></b></button></center>
		</table></form>
             </div>
        </div>
    </header>

    

 <section id="services" name="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">EDIT OFFERS</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row" style="float:left;">
	    
            <?php
	foreach($cursor_redeem as $obj_r){?><center><table style="font-size: 20px; table-layout:fixed; width:600px;" border="1"><tr><th colspan="2">PRODUCT NAME<th>POINTS<?php
		foreach($obj_r['offer'] as $obj_off){?>
<tr><form method="post" action="admin_edit.php"><input type="text" name="gift" value="<?php echo $obj_off['gift'];?>" hidden></input>
						<th colspan="2"><?php echo $obj_off['gift'];?>
						<td><?php echo $obj_off['points'];?>
<button type="submit" value="remove" name="tisra" style="color:red; float:right;"><u>REMOVE</u></button></form>
        <?php }?></table></center><?php }?>
                    </div>
<div class="row" style="float:right;">
		<form method="post" action="admin_edit.php"><h2>ADD NEW OFFER</h2>
		<table border="0" style="font-size: 15px; table-layout:fixed; width:400px;"><tr><th>PRODUCT NAME<td>
		<input type="text" name="gift" value=""></input><tr>
		<th>POINTS<td><input type="number" name="points" value=""></input><tr><th colspan="2" rowspan="2"><center>
		<button type="submit" value="add_offer" name="tisra"><b><u>ADD</u></b></button>		
		</center>
		</table></form>
             </div>
                </div>
                </div>
        </div>

    

    </section>

    <section id="redeem">
    <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">STATISTICAL ANALYSIS</h2>
		    <hr class="primary"><u>
                    <h3 class="section-heading">USERS</h2></u>
                    <h4>For the customers !</h4>
		    <table border="1" style="font-size:18px;"><tr>
		    <th><center>CARD NO.<th><center>RECENT PURCHASE<th><center>TOTAL PURCHASE COUNT<th><center>CURRENT POINTS</center><?php
		    foreach($cursor_redeem as $obj_a){
			foreach($obj_a['user'] as $obj_b){ $response[retval]=0;?>
	            <tr><td><?php echo $obj_b['cardno'];?><td>
		    <?php foreach($obj_b['shop_history'] as $obj_i){
				$toexec='function(x) { return recent(x) }';
				$args=array($response[retval]);
				$response=$db->execute ($toexec, $args);  
			}
			$k=$response[retval];
		    foreach($obj_b['shop_history'] as $obj_i){
			while($k>0){
				$k=$k-1; 
			}}
			if($response[retval]==0){
			echo "No purchase yet";
			}
			else{
			echo $obj_i['product_name'];
			}
		    ?>
		    <td><?php echo $response[retval];?>
		    <td><?php echo $obj_b['points']; }}?>
		    </table>
                </div>
	    </div>
        </div>
   <br><br><br>
   <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center"><u>
                    <h3 class="section-heading">PRODUCTS</h3></u>
                    <p>For most bought products !</p>
                </div>
                <!div class="col-lg-8 col-lg-offset-2 text-center">
                    <center>
                   <img src="Test.png" alt="dd"></center>
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
