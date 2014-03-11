<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Untitled Document</title>
<style type="text/css">
<!--
body {
	font: 100%/1.4 Verdana, Arial, Helvetica, sans-serif;
	background: #FFF;
	margin: 0;
	padding: 0;
	color: #000;
}

/* ~~ Element/tag selectors ~~ */
ul, ol, dl { /* Due to variations between browsers, it's best practices to zero padding and margin on lists. For consistency, you can either specify the amounts you want here, or on the list items (LI, DT, DD) they contain. Remember that what you do here will cascade to the .nav list unless you write a more specific selector. */
	padding: 0;
	margin: 0;
}
h1, h2, h3, h4, h5, h6, p {
	margin-top: 0;	 /* removing the top margin gets around an issue where margins can escape from their containing div. The remaining bottom margin will hold it away from any elements that follow. */
	padding-right: 15px;
	padding-left: 15px; /* adding the padding to the sides of the elements within the divs, instead of the divs themselves, gets rid of any box model math. A nested div with side padding can also be used as an alternate method. */
}
a img { /* this selector removes the default blue border displayed in some browsers around an image when it is surrounded by a link */
	border: none;
}

/* ~~ Styling for your site's links must remain in this order - including the group of selectors that create the hover effect. ~~ */
a:link {
	color: #42413C;
	text-decoration: underline; /* unless you style your links to look extremely unique, it's best to provide underlines for quick visual identification */
}
a:visited {
	color: #6E6C64;
	text-decoration: underline;
}
a:hover, a:active, a:focus { /* this group of selectors will give a keyboard navigator the same hover experience as the person using a mouse. */
	text-decoration: none;
}

.display { border:2px solid #ccc; width:auto; height:auto; overflow-y: scroll;}

/* ~~this fixed width container surrounds the other divs~~ */
.container {
	width: 960px;
	background: #FFF;
	margin: 0 auto; /* the auto value on the sides, coupled with the width, centers the layout */
}

/* ~~ the header is not given a width. It will extend the full width of your layout. It contains an image placeholder that should be replaced with your own linked logo ~~ */
.header {
	background: #FF0800;
}

/* ~~ These are the columns for the layout. ~~ 

1) Padding is only placed on the top and/or bottom of the divs. The elements within these divs have padding on their sides. This saves you from any "box model math". Keep in mind, if you add any side padding or border to the div itself, it will be added to the width you define to create the *total* width. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design. You may also choose to remove the padding on the element in the div and place a second div within it with no width and the padding necessary for your design.

2) No margin has been given to the columns since they are all floated. If you must add margin, avoid placing it on the side you're floating toward (for example: a right margin on a div set to float right). Many times, padding can be used instead. For divs where this rule must be broken, you should add a "display:inline" declaration to the div's rule to tame a bug where some versions of Internet Explorer double the margin.

3) Since classes can be used multiple times in a document (and an element can also have multiple classes applied), the columns have been assigned class names instead of IDs. For example, two sidebar divs could be stacked if necessary. These can very easily be changed to IDs if that's your preference, as long as you'll only be using them once per document.

4) If you prefer your nav on the right instead of the left, simply float these columns the opposite direction (all right instead of all left) and they'll render in reverse order. There's no need to move the divs around in the HTML source.

*/
.sidebar1 {
	float: left;
	width: 200px;
	background: #FFF;
	padding-bottom: 10px;
}
.content {

	padding: 10px 0;
	width: 580px;
	float: left;
}

/* ~~ This grouped selector gives the lists in the .content area space ~~ */
.content ul, .content ol { 
	padding: 0 15px 15px 40px; /* this padding mirrors the right padding in the headings and paragraph rule above. Padding was placed on the bottom for space between other elements on the lists and on the left to create the indention. These may be adjusted as you wish. */
}

/* ~~ The navigation list styles (can be removed if you choose to use a premade flyout menu like Spry) ~~ */
ul.nav {
	list-style: none; /* this removes the list marker */
	border-top: 1px solid #FFF; /* this creates the top border for the links - all others are placed using a bottom border on the LI */
	margin-bottom: 15px; /* this creates the space between the navigation on the content below */
}
ul.nav li {
	border-bottom: 1px solid #FFF; /* this creates the button separation */
}
ul.nav a, ul.nav a:visited { /* grouping these selectors makes sure that your links retain their button look even after being visited */
	padding: 5px 5px 5px 15px;
	display: block; /* this gives the link block properties causing it to fill the whole LI containing it. This causes the entire area to react to a mouse click. */

	text-decoration: none;
	background: #FFF;
}
ul.nav a:hover, ul.nav a:active, ul.nav a:focus { /* this changes the background and text color for both mouse and keyboard navigators */
	background: #6F7D94;
	color: #FFF;
}

/* ~~ The footer ~~ */
.footer {
	padding: 10px 0;
	background: #FF0800;
	clear: both; /* this clear property forces the .container to understand where the columns end and contain them */
}

/* ~~ miscellaneous float/clear classes ~~ */
.fltrt {  /* this class can be used to float an element right in your page. The floated element must precede the element it should be next to on the page. */
	float: right;
	margin-left: 8px;
}
.fltlft { /* this class can be used to float an element left in your page. The floated element must precede the element it should be next to on the page. */
	float: left;
	margin-right: 8px;
}
.clearfloat { /* this class can be placed on a <br /> or empty div as the final element following the last floated div (within the #container) if the #footer is removed or taken out of the #container */
	clear:both;
	height:0;
	font-size: 1px;
	line-height: 0px;
}
-->
</style></head>

<body>


<div class="container">
  <div class="header"><a href="index.php"><img src="/htdocs/309/candystore/images/pole.jpg" alt="Insert Logo Here" name="Insert_logo" width="200" height="200" id="Insert_logo" style="background: #C6D580; display:block;" /></a> 				<div class="fltrt">
  
  
  <?php
	if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true )    ) {	
	?>
			<p>
			Hi <?= $_SESSION['username']?>.
			</p>     		
	<?php 		
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
	echo "<p>" . anchor('candystore/logout','Clear Cart') . "</p>"; ?></li>
      <li><a href="#">Logout</a></li>
      <li><a href="#">Checkout</a></li>
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
    <h1>Product Table</h1>
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
  <?php
	if ((isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true )    ) {	
	?>
			<p>
			Hi <?= $_SESSION['username']?>.
			</p>     		
	<?php 		
		}
		else {
	 echo "<p>" . anchor('candystore/login','Login') . "</p>";
		}
	?>	

    <!-- end .footer --></div>
  <!-- end .container --></div>
  
</body>
</html>
