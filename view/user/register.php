<? include '../header.php'; ?>
<? include '../navigation.php'; ?>
<? include '../errors.php'; ?>

<form method="POST" id="registration_form" class="central">

	<input type="email" placeholder="Email" name="email" /><br />
	<input type="password" placeholder="Password" name="password" /><br />
	<input type="text" placeholder="First name" name="first_name" /><br />
	<input type="text" placeholder="Last name" name="last_name" /><br />
	<input type="submit" value="Register" />
</form>

<? include '../footer.php'; ?>