<?php
class AjaxController extends Controller{
	public function actionSaveimage(){
		$file = new File();
		$file->file = CUploadedFile::getInstance($file, 'file');
		$ret = $message = '';
		if ($ret = $file->validate()) {
			$new_name = $this->randomString().'.'.$file->file->extensionName;
			$new_file = getApp()->basePath.'/../uploads/'.$new_name;
			$file->file->saveAs($new_file);
			$message = getBaseUrl().'/uploads/'.$new_name;
		}else{
			$message = $file->getError('file');
		}
		$this->_returnAjax(array(
			'result'=>$ret,
			'message'=>$message	
		));
	}

	function randomString() {
		return md5(rand(100, 200));
	}
}