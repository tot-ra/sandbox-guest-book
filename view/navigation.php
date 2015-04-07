
<nav class="central">
	<?if (isset($_SESSION['user'])){ ?>
		<img id="avatar" src="http://www.gravatar.com/avatar/<?=md5( strtolower( trim(($_SESSION['user']['email']))))?>?s=30" />
	<?}
	?>

	<a href="?c=guestbook&m=index">Guestbook</a>



	<?if (isset($_SESSION['user'])){ ?>
		<a href="?c=user&m=logout">Logout</a>
	<?}else{ ?>
		<a href="?c=user&m=register">Register</a>
		<a href="?c=user&m=login">Login</a>
	<?}?>
</nav>