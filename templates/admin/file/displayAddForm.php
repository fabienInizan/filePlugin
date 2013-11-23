<ul class="context_menu">
	<li><a href="index.php?module=file">Retour aux fichiers</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="index.php?module=file&action=add" method="post" enctype="multipart/form-data">
	<label class="mandatory">Titre du fichier</label>
	<input type="text" name="title" value="<?php echo stripslashes($file->getTitle()); ?>" />
	
	<label class="mandatory">Fichier à transférer</label>
	<input type="hidden" name="MAX_FILE_SIZE" value="67108864" /> 
	<input type="file" id="fileUpload" name="fileUpload" value="<?php echo $fileUpload; ?>" />

	<div class="main_content">
		<label>Commentaire</label>
		<textarea name="comment"><?php echo stripslashes($file->getComment()); ?></textarea>
	</div>

	<button type="submit">Transférer le fichier</button>
</form>
