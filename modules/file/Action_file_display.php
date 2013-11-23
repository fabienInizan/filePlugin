<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/FileContainer.php');

class Action_file_display implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$id = $httpRequest->fileId;

		$fileContainer = FileContainer::getInstance();
		$file = $fileContainer->getById($id);

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('file', $file);

		return $actionResponse;
	}
}

?>
