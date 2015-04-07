<?
if(isset($errors)){
	foreach($errors as $error){
		?>
		<div class="error"><?=$error?></div>
		<?
	}
}
?>