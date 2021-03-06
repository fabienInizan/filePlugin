<ul class="context_menu">
	<li><a href="index.php?module=file">Retour aux fichiers</a></li>
</ul>

<form action="index.php?module=file&action=edit" method="post">
	<input type="hidden" name="fileId" value="<?php echo $file->getId(); ?>" />

	<label class="mandatory">Titre du fichier</label>
	<input type="text" name="title" value="<?php echo stripslashes($file->getTitle()); ?>" />

	<div class="main_content">
		<label>Commentaire</label>
		<textarea name="comment"><?php echo stripslashes($file->getComment()); ?></textarea>
	</div>

	<button type="submit">Modifier</button>
</form>
