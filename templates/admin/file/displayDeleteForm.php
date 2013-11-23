<ul class="context_menu">
	<li><a href="?module=file&action=displayEditForm&fileId=<?php echo $file->getId(); ?>">Modifier ce fichier</a></li>
	<li><a href="?module=file">Retour aux fichiers</a></li>
</ul>

<?php
	if(!empty($warning))
	{
?>
<p class="warning"><?php echo $warning; ?></p>
<?php
	}
?>

<form action="index.php?module=file&action=delete" method="post">
	<input type="hidden" name="fileId" value="<?php echo $file->getId(); ?>" />

	<h2><?php echo stripslashes($file->getTitle()); ?></h2>
	<p>
		<?php echo stripslashes($file->getComment()); ?>
	</p>
	
	<table cellpadding="0" cellspacing="0">
		<thead>
			<tr>
				<th>Titre</th>
				<th>Nom du fichier</th>
				<th>Type du fichier</th>
				<th>Taille du fichier</th>
				<th>Chemin vers le fichier</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo stripslashes($file->getTitle()); ?></td>
				<td><?php echo stripslashes($file->getFileName()); ?></td>
				<td><?php echo stripslashes($file->getMimeType()); ?></td>
				<td><?php echo stripslashes($file->getSize()); ?></td>
				<td><?php echo stripslashes($file->getPath()); ?></td>
			</tr>
		</tbody>
	</table>
	
	<p><strong>Etes-vous certain de vouloir supprimer ce fichier ?</strong></p>

	<button type="submit">Supprimer le fichier</button>
</form>
