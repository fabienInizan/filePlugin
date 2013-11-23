<h2>Liste des fichiers</h2>

<ul class="context_menu">	
	<li><a href="index.php?module=file&amp;action=displayAddForm">Transférer un nouveau fichier</a></li>
</ul>

<?php
	if(sizeof($files) > 0)
	{
?>

<table cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Titre</th>
			<th colspan="4">Actions</th>
		</tr>
	</thead>
	<tbody>
	<?php 
		foreach($files as $file)
		{
	?>
		<tr>
			<td><?php echo stripslashes($file->getTitle()); ?></td>
			<td><a href="?module=file&action=display&fileId=<?php echo $file->getId(); ?>">Voir</a></td>
			<td><a href="?module=file&action=displayEditForm&fileId=<?php echo $file->getId(); ?>">Editer</a></td>
			<td><a href="?module=file&action=download&fileId=<?php echo $file->getId(); ?>">Télécharger</a></td>
			<td><a href="?module=file&action=displayDeleteForm&fileId=<?php echo $file->getId(); ?>">Supprimer</a></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>

<?php
	}
	else
	{
?>

<p>Aucun fichier.</p>

<?php
	}
?>
