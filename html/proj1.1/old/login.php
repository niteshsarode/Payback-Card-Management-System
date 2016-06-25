<?php

session_start();

// define variables and set to empty values
$usernameErr = $passwordErr = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$_SESSION['uname']=$_POST['username'];
$_SESSION['pwd']=$_POST['password'];
   if (empty($_POST["username"])) {
     $usernameErr = "Username is required";
   } else {
     $username = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[0-9]*$/",$username)) {
       $usernameErr = "Only valid cards are allowed";
     }
   }
  
   if (empty($_POST["password"])) {
     $passwordErr = "Password is required";
   } else {
     $password = test_input($_POST["password"]);
   }


   }

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>


<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Creative - Start Bootstrap Theme</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<center>

<style>
.error {color: #FF0000;}
</style>
<h2>PAYBACK CARD MANAGEMENT SYSTEM</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   Userame: <input type="text" name="username" value="<?php echo $username;?>">
   <span class="error">* <br><?php echo $usernameErr;?></span>
   <br><br>
   Password: <input type="password" name="password" value="<?php echo $password;?>">
   <span class="error">* <br><?php echo $passwordErr;?></span>
   <br><br>
   <input type="submit" name="submit" value="Submit">
</form>
<br><br>
<a href="form1.htm">New User?</a>
</center>
</html>


<?php

try{
  
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $cursor = $collection->find();
 $num_docs = $cursor->count();



 $flag=0;
if ($_SERVER["REQUEST_METHOD"] == "POST"){

 if($num_docs > 0)
  {
  foreach($cursor as $obj)
  {
  
    if($username==$obj['cardno'] && $password==$obj['password'])
    {
      $flag=1;
      break;  
    }
  }

  if($flag==1)
  {
    echo "<script type='text/javascript'>alert('Login Successful!')</script>";
    header("Location: /home.php");
    exit();
  }
  else
  {
    echo "<script type='text/javascript'>alert('Invlaid Username or Password!')</script>";
    
  }
  }

}
}
catch ( MongoConnectionException $e )
{
    // if there was an error, we catch and display the problem here
    echo $e->getMessage();
}
catch ( MongoException $e )
{
    echo $e->getMessage();
}

    

?>
