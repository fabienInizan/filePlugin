<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/FileContainer.php');

class Action_file_delete implements Action
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
				if(!unlink($filePath))
				{
					throw new Exception('Unable to remove file '.$file->getFileName());
				}
				$fileContainer->delete($file);
			}
			else
			{
				throw new Exception('File does not exist : '.$filePath);
			}
		}

		$actionResponse = new ActionResponse_Default();
		$actionResponse->setTemplateId('file/index');

		return $actionResponse;
	}
}

?>
