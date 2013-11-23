<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/entities/File.php');

class Action_file_displayAddForm implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$actionResponse = new ActionResponse_Default();
		
		$id = $httpRequest->fileId or "";
		$title = $httpRequest->title or "";
		$comment = $httpRequest->comment or "";
		$fileUpload = $httpRequest->fileUpload or "";
		
		$file = new File();
		$file->setId($id);
		$file->setTitle($title);
		$file->setComment($comment);
		
		$actionResponse->setElement('file', $file);
		$actionResponse->setElement('fileUpload', $fileUpload);
		
		return $actionResponse;
	}
}
?>
