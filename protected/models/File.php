<?php
class File extends CFormModel{
	public $file;

	public function rules()
	{
		return array(
			array('file', 'file', 'maxSize'=>2*1024*1024),
		);
	}
}