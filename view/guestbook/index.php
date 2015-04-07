<? include '../header.php'; ?>
<? include '../navigation.php'; ?>

<? if(isset($_SESSION['user'])) { ?>
	<form method="POST" id="comment_form" class="central" action="?c=guestbook&m=add_post">
		<textarea name="text" placeholder="Comment"></textarea>
		<input type="submit" value="Add comment"/>
	</form>
<?
}
else {
	?>
	<div class="info">Please login or register to add a message</div>
<? } ?>

	<div class="central">
		<?
		if($message_list) {
			foreach($message_list as $item) {

				?>
				<div class="message">
					<img class="message_avatar" src="http://www.gravatar.com/avatar/<?=md5( strtolower( trim(($item['email']))))?>?s=50" />

					<strong><?= htmlspecialchars($item['first_name'].' '.$item['last_name'], ENT_QUOTES, 'UTF-8', false)?></strong><br />
					<?= nl2br(htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8', false)) ?>
				</div>
			<?
			}
		}
		?>
	</div>

<? include '../footer.php'; ?>