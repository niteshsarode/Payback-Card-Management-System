<?php

 session_start();

 $conn = new Mongo('localhost');
 $db = $conn->payback;
 $collection = $db->user;
 $coll_partner = $db->partner;
 $cursor_partner = $coll_partner->find();
 $total_partner = $cursor_partner->count();
 $query=$_SESSION['uname'];
 $docfind = $collection->find();
 $num_docs = $docfind->count();

?>