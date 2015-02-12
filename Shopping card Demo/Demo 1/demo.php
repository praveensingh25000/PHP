<?php

define('INCLUDE_CHECK',1);
require "connect.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Tutorialzine's shopping cart | Tutorialzine demo</title>

<link rel="stylesheet" type="text/css" href="demo.css" />

<!--[if lt IE 7]>
<style type="text/css">
	.pngfix { behavior: url(pngfix/iepngfix.htc);}
    .tooltip{width:200px;};
</style>
<![endif]-->


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>

<script type="text/javascript" src="simpletip/jquery.simpletip-1.3.1.pack.js"></script>


<script type="text/javascript" src="script.js"></script>

</head>

<body>

<div id="main-container">

	<div class="tutorialzine">
    <h1>Shopping cart</h1>
    <h3>The best products at the best prices</h3>
    </div>


    <div class="container">
    
    	<span class="top-label">
            <span class="label-txt">Products</span>
        </span>
        
        <div class="content-area">
    
    		<div class="content drag-desired">
            	
                <?php

				$result = mysql_query("SELECT * FROM internet_shop");
				while($row=mysql_fetch_assoc($result))
				{
					echo '<div class="product"><img src="img/products/'.$row['img'].'" alt="'.htmlspecialchars($row['name']).'" width="128" height="128" class="pngfix" /></div>';
				}

				?>
                
                
       	        <div class="clear"></div>
            </div>

        </div>
        
        <div class="bottom-container-border">
        </div>

    </div>



    <div class="container">
    
    	<span class="top-label">
            <span class="label-txt">Shopping Cart</span>
        </span>
        
        <div class="content-area">
    
    		<div class="content drop-here">
            	<div id="cart-icon">
	            	<img src="img/Shoppingcart_128x128.png" alt="shopping cart" class="pngfix" width="128" height="128" />
					<img src="img/ajax_load_2.gif" alt="loading.." id="ajax-loader" width="16" height="16" />
                </div>

				<form name="checkoutForm" method="post" action="order.php">
                
                <div id="item-list">
                </div>
                
				</form>                
                <div class="clear"></div>

				<div id="total"></div>

       	        <div class="clear"></div>
                
                <a href="" onclick="document.forms.checkoutForm.submit(); return false;" class="button">Checkout</a>
                
          </div>

        </div>
        
        <div class="bottom-container-border">
        </div>

    </div>

	<div class="tutorial-info">	
    This is a Tutorialzine demo. View the <a href="http://tutorialzine.com/2009/09/shopping-cart-php-jquery/">original tutorial</a>, or download the <a href="demo.zip">demo files</a>.</div>

</div>

</body>
</html>
