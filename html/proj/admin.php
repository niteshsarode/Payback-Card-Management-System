 <?php
 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find();
 print_r($_POST);
 ?>

 <h2> SELECT PARTNER TO EDIT<h2>
 	<?php
 	 foreach($cursor_partner as $obj)
    {
            ?>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<button type="submit" name="partner" value="<?php echo $obj['partnername'];?>">
				<?php echo "<h3>".$obj['partnername']."<h3>"; </button> ?>
			</form>
                <?php }?> 
	