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
	else
	{
?>
<p>Le fichier a été transféré avec succès !</p>
<?php
	}
?>
