<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/FileContainer.php');

class Action_file_download implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->fileId;

		$fileContainer = FileContainer::getInstance();
		$file = $fileContainer->getById($id);
		
		$filePath = 'upload/'.$file->getFileName();
		
		if(!empty($file))
		{
			if(is_file($filePath))
			{
				header('Location: '.$file->getPath());
			}
			else
			{
				throw new Exception('File does not exist : '.$file->getFileName());
			}
		}

		$actionResponse = new ActionResponse_Default();
		$actionResponse->setTemplateId('file/index');

		return $actionResponse;
	}
}

?>
