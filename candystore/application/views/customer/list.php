    <h1>Customer Table</h1>
  <?php
echo "<p>" . anchor('candystore/index','Back') . "</p>";
 
echo "<table>";
echo "<tr><th>First</th><th>Last</th><th>Login</th><th>Email</th></tr>";

foreach ($customers as $customer) {
echo "<tr>";
echo "<td>" . $customer->first . "</td>";
echo "<td>" . $customer->last . "</td>";
echo "<td>" . $customer->login . "</td>";
echo "<td>" . $customer->email . "</td>";

echo "<td>" . anchor("candystore/delete/$customer->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
echo "<td>" . anchor("candystore/editForm/$customer->id",'Edit') . "</td>";
echo "<td>" . anchor("candystore/read/$customer->id",'View') . "</td>";

echo "</tr>";
}
echo "<table>";
?>	
