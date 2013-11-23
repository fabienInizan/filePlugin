<?php

require_once('model/containers/Container_Pdo.php');
require_once('model/entities/ActionRestriction.php');
require_once('model/containers/ActionRestrictionContainer.php');
require_once('model/entities/File.php');
require_once('model/containers/FileContainer.php');
require_once('core/utils/filesystem/FileSystem.php');

class __fileDbHelper extends Container_Pdo
{
	private static $_instance;
	
	private $_actionRestrictionDescriptors = array(
		array(
			'action'=>'add',
			'description'=>'Upload a file to the server',
			'accessLevel'=>255
		),
		array(
			'action'=>'delete',
			'description'=>'Delete a file from the server',
			'accessLevel'=>255
		),
		array(
			'action'=>'display',
			'description'=>'Display details about a file',
			'accessLevel'=>0
		),
		array(
			'action'=>'displayAddForm',
			'description'=>'Display the file upload form',
			'accessLevel'=>255
		),
		array(
			'action'=>'displayDeleteForm',
			'description'=>'Display the file delete form',
			'accessLevel'=>255
		),
		array(
			'action'=>'displayEditForm',
			'description'=>'Display the file information edition form',
			'accessLevel'=>255
		),
		array(
			'action'=>'download',
			'description'=>'Download a file',
			'accessLevel'=>255
		),
		array(
			'action'=>'edit',
			'description'=>'Apply modifications to a page',
			'accessLevel'=>255
		),
		array(
			'action'=>'index',
			'description'=>'Display a list of the files on the server',
			'accessLevel'=>255
		)
	);

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}
	
	public function dbInstall()
	{
		$query = 'CREATE TABLE IF NOT EXISTS `file` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`title` varchar(255) NOT NULL,
			`fileName` varchar(255) NOT NULL,
			`mimeType` varchar(127) NOT NULL,
			`size` int(11) NOT NULL,
			`path` varchar(255) NOT NULL,
			`comment` text DEFAULT NULL,
			PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=latin1';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		
		$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
		$actionRestriction = new ActionRestriction();
		$actionRestriction->setModule('file');
		
		foreach($this->_actionRestrictionDescriptors as $actionRestrictionDescriptor)
		{
			$actionRestriction->setAction($actionRestrictionDescriptor['action']);
			$actionRestriction->setDescription($actionRestrictionDescriptor['description']);
			$actionRestriction->setAccessLevel($actionRestrictionDescriptor['accessLevel']);
			$actionRestrictionContainer->save($actionRestriction);
		}
		
		/* If the directory exists, it may return an error */
		if(!is_dir('upload'))
		{
			mkdir('upload');
		}
	}
	
	public function dbPurge()
	{
		$query = 'DELETE FROM file';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		
		/* Remove the whole directory then recreate it */
		FileSystem::remove('upload', true);
		mkdir('upload');
	}
	
	public function dbUninstall()
	{		
		$query = 'DROP TABLE IF EXISTS file';
		
		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();	
		
		$actionRestrictionContainer = ActionRestrictionContainer::getInstance();
		$actionRestrictionContainer->deleteByModule('file');
		
		FileSystem::remove('upload', true);	
	}
}

?>
