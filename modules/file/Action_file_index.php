<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/FileContainer.php');

class Action_file_index implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$fileContainer = FileContainer::getInstance();
		$files = $fileContainer->getAll();

		$actionResponse = new ActionResponse_Default();

		$actionResponse->setElement('files', $files);

		return $actionResponse;
	}
}

?>
