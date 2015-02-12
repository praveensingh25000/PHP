<?php

define('INCLUDE_CHECK',1);
require "../connect.php";

if(!$_POST['img']) die("There is no such product!");

$img=mysql_real_escape_string(end(explode('/',$_POST['img'])));

$row=mysql_fetch_assoc(mysql_query("SELECT * FROM internet_shop WHERE img='".$img."'"));

if(!$row) die("There is no such product!");

echo '<strong>'.$row['name'].'</strong>

<p class="descr">'.$row['description'].'</p>

<strong>price: $'.$row['price'].'</strong>
<small>Drag it to your shopping cart to purchase it</small>';
?>
