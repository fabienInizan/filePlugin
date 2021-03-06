<?php

require_once('core/action/Action.php');
require_once('core/action/ActionResponse_Default.php');
require_once('model/containers/FileContainer.php');
require_once('model/entities/File.php');

class Action_file_add implements Action
{
	public function run(HttpRequest $httpRequest)
	{
		$title = $httpRequest->title;
		$fileUpload = $httpRequest->fileUpload;
		$actionResponse = new ActionResponse_Default();
		
		$uploadErrors = array(
			UPLOAD_ERR_OK		=> "Aucune erreur.",
			UPLOAD_ERR_INI_SIZE	=> "La taille du fichier dépasse la taille maximum supportée par le serveur.",
			UPLOAD_ERR_FORM_SIZE	=> "La taille du fichier dépasse la taille maximum autorisée par l'application.",
			UPLOAD_ERR_PARTIAL	=> "Le transfert est incomplet.",
			UPLOAD_ERR_NO_FILE	=> "Aucun fichier.",
			UPLOAD_ERR_NO_TMP_DIR	=> "Le répertoire de stockage temporaire n'est pas défini.",
			UPLOAD_ERR_CANT_WRITE	=> "L'écriture sur le disque a échoué (problème de permission ou d'espace insuffisant).",
			UPLOAD_ERR_EXTENSION	=> "L'envoi du fichier a été stoppé par une extension PHP.",
			UPLOAD_ERR_EMPTY	=> "Le fichier est vide."
		); 

		if(!empty($title) && !empty($fileUpload))
		{
			$fileContainer = FileContainer::getInstance();
			try
			{
				$double = $fileContainer->getById($id);
			}
			catch(Exception $e)
			{
				$double = null;
			}
			
			if(!empty($double))
			{
				$actionResponse->setElement('warning', 
					'Un fichier utilisant le même identifiant existe déjà. Modifiez le fichier existant ou modifiez le champ d\'identifiant pour créer un nouveau fichier');
				$actionResponse->setTemplateId('file/displayAddForm');
			}
			else
			{
				if(!empty($fileUpload['name']) && ($fileUpload['error'] == UPLOAD_ERR_OK))
				{
					$fileName = basename($fileUpload['name']);
					$filePath = 'upload/'.$fileName;
					if(!move_uploaded_file($fileUpload['tmp_name'], $filePath))
					{
						throw new Exception('Impossible to upload '.$fileName);
					}
				
					$mimeType = $fileUpload['type'];
					if(empty($mimeType))
					{
						$mimeType = "Inconnu";
					}
					$size = $fileUpload['size'];
					$path = 'http://'.$_SERVER['SERVER_NAME'].str_replace($_SERVER['DOCUMENT_ROOT'], '', getcwd()).'/'.$filePath;
			
					$file = new File();
					$file->setTitle($title);
					$file->setFileName($fileName);
					$file->setMimeType($mimeType);
					$file->setSize($size);
					$file->setPath($path);
					$file->setComment($httpRequest->comment);
				
					$fileContainer->save($file);
				}
				else
				{
					throw new Exception('Impossible d\'envoyer le fichier. Erreur : '.$uploadErrors[$fileUpload['error']]);
				}
			}			
		}
		else
		{
			$actionResponse->setElement('warning', 
					'Le champ de titre est obligatoire.');
			$actionResponse->setTemplateId('file/displayAddForm');
		}

		return $actionResponse;
	}
}

?>
