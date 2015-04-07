<? include '../header.php'; ?>
<? include '../navigation.php'; ?>
<? include '../errors.php'; ?>

<form method="POST" id="login_form" class="central" action="?c=user&m=login">
	<input type="email" placeholder="Email" name="email" /><br />
	<input type="password" placeholder="Password" name="password" /><br />
	<input type="submit" value="Login" />
</form>

<? include '../footer.php'; ?>