<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" href="<?php echo base_url();?>css/style.css" type="text/css">
<title>Candystore</title>
</head>

<body>

<div class="container">
  <div class="header"><a href="index.php"><img src="/htdocs/309/candystore/images/pole.jpg" alt="Insert Logo Here" name="Insert_logo" width="200" height="200" id="Insert_logo" style="background: #C6D580; display:block;" /></a> 				<div class="fltrt">
  
  
  <?php
	if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true )    ) {	
	
	?><p>
			Hi <?= $_SESSION['username']?>.
			</p><div class='fltrt'><?php
	
		}
		else {
	 echo "<p>" . anchor('candystore/newCustomer','New Customer') . "</p>";
		}
	?>				<form action="index.php">
		<input type="text" name="search" />
		<input type="submit" value="Search" />
			</form>	</div>
    <!-- end .header --></div>
  <div class="sidebar1">
    <ul class="nav">
      <li><?php 
	echo "<p>" . anchor('candystore/listCustomer','List Customers') . "</p>"; ?></li>
      <li><?php 
	echo "<p>" . anchor('candystore/clearCart','Clear Cart') . "</p>"; ?></li>
      <li><?php if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true )    ) {
	echo "<p>" . anchor('candystore/logout','Logout') . "</p>";}else{ echo "<p>" . anchor('candystore/login','Login') . "</p>";  }?></li>
      <li><?php 
	echo "<p>" . anchor('candystore/logout','Checkout') . "</p>"; ?></li>
    </ul>
<h3>Cart</h3>
<?php
if(isset($_COOKIE["candystore"]))
{
    $total = 0;
    echo '<ol>';
    foreach (unserialize($_COOKIE["candystore"]) as $cart_itm)
    {
        echo '<li class="cart-itm">';
        echo '<span class="remove-itm"><a href="cart_update.php?removep='.$cart_itm["code"].'">&times;</a></span>';
        echo '<h3>'.$cart_itm["name"].'</h3>';
        echo '<div class="p-code">P code : '.$cart_itm["code"].'</div>';
        echo '<div class="p-qty">Qty : '.$cart_itm["qty"].'</div>';
        echo '<div class="p-price">Price :'.$cart_itm["price"].'</div>';
        echo '</li>';
    }
    echo '</ol>';

}else{
    echo 'Your Cart is empty';
}
?>
    <!-- end .sidebar1 --></div>
  <div class="container">
  <?php $qty = 3;
echo "<p>" . anchor('candystore/newForm','Add New') . "</p>";
 
echo "<table>";
echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";

foreach ($products as $product) {
echo "<tr>";
echo "<td>" . $product->name . "</td>";
echo "<td>" . $product->description . "</td>";
echo "<td>" . $product->price . "</td>";
echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";

echo "<td>" . anchor("candystore/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
echo "<td>" . anchor("candystore/editForm/$product->id",'Edit') . "</td>";
echo "<td>" . anchor("candystore/read/$product->id",'View') . "</td>";
echo "<td>" . anchor("candystore/buy?var1=$product->id&var2=$qty",'Buy',"onClick='return confirm(\"Do you really want to purchase this item?\");'") . "</td>";

echo "</tr>";
}
echo "<table>";
?>	


    <!-- end .content --></div>
  <div class="footer">


  <!-- end .footer --></div>
  <!-- end .container --></div>
  
</body>
</html>
