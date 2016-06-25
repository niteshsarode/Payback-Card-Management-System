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

<html >
  <head>
    <meta charset="UTF-8">
	<style>
	 .error {color: white;}
	</style>
    <title>LOGIN</title>
        <link rel="stylesheet" href="loginstyles/css/style.css">    
  </head>

  <body>
    
    <div class="wrapper">
	<div class="container">
		<center><h1>PAYBACK CARD MANAGEMENT SYSTEM</h1></center>
		<h7>Welcome</h7>
		
		<form class="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    			<input type="text" name="username" placeholder="USERNAME" value="<?php echo $username;?>">
   			<span class="error">*<br><?php echo $usernameErr;?></span>
   			<input type="password" name="password" placeholder="PASSWORD" value="<?php echo $password;?>">
   			<span class="error">* <?php echo $passwordErr;?></span>
   			<input type="submit" name="submit" value="Submit">
			<a href="form1.html">NEW USER?</a>
		</form> 	
	</div>
	
	<ul class="bg-bubbles">
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
		<li></li>
	</ul>
</div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="loginstyles/js/index.js"></script>

    
    

  </body>
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
			if($obj['admin']==true)
			{
				$flag=2;
				break;
			}
      $flag=1;
      break;  
    }
  }
  if($flag==1)
  {
    
    header("Location: /home.php");
    exit();
  }
	else if($flag==2)
	{
	
	header("Location: /admin.php");
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
