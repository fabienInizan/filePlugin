<?php

require_once('model/containers/Container_Pdo.php');

class FileContainer extends Container_Pdo
{
	private static $_instance;

	public function getAll()
	{
		$query = 'SELECT * FROM file';

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$files = array();
		
		foreach($rows as $row)
		{
			$files[] = $this->createEntity('File', $row);
		}
		
		return $files;
	}

	public function getById($id)
	{
		$query = 'SELECT * FROM file WHERE file.id = :id';

		$params = array('id'=>$id);

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		if (empty($row))
		{
			throw new Exception('Cannot find required file');
		}

		return $this->createEntity('File', $row);
	}

	public static function getInstance()
	{
		if(empty(self::$_instance))
		{
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function save(File $file)
	{
		$id = $file->getId();
		$double = null;
		
		try
		{
			$double = $this->getById($id);
		}
		catch(Exception $e)
		{
		}

		if(!empty($double))
		{
			$query = 'UPDATE file SET 
				file.title = :title,
				file.fileName = :fileName,
				file.mimeType = :mimeType,
				file.size = :size,
				file.path = :path,
				file.comment = :comment
				WHERE file.id = :id';

			$params = array('id'=>$file->getId(),
							'title'=>$file->getTitle(),
							'fileName'=>$file->getFileName(),
							'mimeType'=>$file->getMimeType(),
							'size'=>$file->getSize(),
							'path'=>$file->getPath(),
							'comment'=>$file->getComment());
		}
		else
		{
			$query = 'INSERT INTO file(id, title, fileName, mimeType, size, path, comment)
				VALUES(:id, :title, :fileName, :mimeType, :size, :path, :comment)';

			$params = array('id'=>$file->getId(),
							'title'=>$file->getTitle(),
							'fileName'=>$file->getFileName(),
							'mimeType'=>$file->getMimeType(),
							'size'=>$file->getSize(),
							'path'=>$file->getPath(),
							'comment'=>$file->getComment());
		}

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}

	public function delete(File $file)
	{
		$query = 'DELETE FROM file WHERE file.id = :id';

		$params = array('id'=>$file->getId());

		$stmt = $this->getPdo()->prepare($query);
		$stmt->execute($params);
	}
}

?>
