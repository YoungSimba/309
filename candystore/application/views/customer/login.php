<h2>Login</h2>

<style>
	input { display: block;}
	
</style>

<?php 
	echo "<p>" . anchor('candystore/index','Back') . "</p>";
	
	echo form_open_multipart('candystore/authenticate');
		
	echo form_label('Login'); 
	echo form_error('login');
	echo form_input('login',set_value('login'),"required");

	echo form_label('Password');
	echo form_error('password');
	echo form_input('password',set_value('password'),"required");
	
	echo form_submit('submit', 'Login');
	echo form_close();
?>	