<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/FileContainer.php');

class Action_file_edit implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->fileId;

		$actionResponse = new ActionResponse_Default();
		
		if(!empty($id))
		{
			$fileContainer = FileContainer::getInstance();
			$file = $fileContainer->getById($id);
			
			if(!empty($file))
			{
				$file->setTitle($httpRequest->title);
				$file->setComment($httpRequest->comment);
				
				$fileContainer->save($file);				
			}
			else
			{		
				throw new Exception('Le fichier demandé n\'existe pas');
			}
		}
		else
		{
			throw new Exception('Le fichier demandé n\'existe pas');
		}

		return $actionResponse;
	}
}

?>
