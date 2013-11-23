<ul class="context_menu">
	<li><a href="?module=file&action=displayEditForm&fileId=<?php echo $file->getId(); ?>">Modifier</a></li>
	<li><a href="?module=file">Retour aux fichiers</a></li>
	<li>Chemin vers le fichier : <?php echo $file->getPath(); ?></li>
</ul>

<h2><?php echo stripslashes($file->getTitle()); ?></h2>

<p><?php echo stripslashes($file->getComment()); ?></p>

<div class="main_content">
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
</div>
