<?php
class ThreadController extends Controller{
	public function actionAdd(){
		$ret = $errors = '';
		$post_content = getRequest()->getParam('ThreadContent');
		$content_model = new ThreadContent();
		$content_model->attributes = $post_content;
		
		$thread = new Thread();
		$thread->attributes = getRequest()->getParam('Thread');
		if ($ret = ($content_model->validate() && $thread->validate())){
			$thread = new Thread();
			$thread->attributes = getRequest()->getParam('Thread');
			$thread->save();
			$content_model->thread_id = $thread->id;
			$content_model->save(false);
		}else{
			$errors = array(
				get_class($thread)=>$thread->errors,
				get_class($content_model)=>$content_model->errors
			);
		}
		
		$this->_returnAjax(array(
				'result'=>$ret,
				'errors'=>$errors
		));
	}
}