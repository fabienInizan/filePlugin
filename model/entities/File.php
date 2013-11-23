<?php

class File
{
	private $_id;
	private $_title;
	private $_fileName;
	private $_mimeType;
	private $_size;
	private $_path;
	private $_comment;

	public function getId()
	{
		return $this->_id;
	}

	public function getTitle()
	{
		return $this->_title;
	}
	
	public function getFileName()
	{
		return $this->_fileName;
	}
	
	public function getMimeType()
	{
		return $this->_mimeType;
	}
	
	public function getSize()
	{
		return $this->_size;
	}
	
	public function getPath()
	{
		return $this->_path;
	}

	public function getComment()
	{
		return $this->_comment;
	}

	public function setId($id)
	{
		$this->_id = $id;
	}

	public function setTitle($title)
	{
		$this->_title = $title;
	}
	
	public function setFileName($fileName)
	{
		$this->_fileName = $fileName;
	}
	
	public function setMimeType($mimeType)
	{
		$this->_mimeType = $mimeType;
	}
	
	public function setSize($size)
	{
		$this->_size = $size;
	}
	
	public function setPath($path)
	{
		$this->_path = $path;
	}

	public function setComment($comment)
	{
		$this->_comment = $comment;
	}
}

?>
