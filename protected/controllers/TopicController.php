<?php
class TopicController extends Controller{
	public function actionAdd(){	
		$ret = $errors = '';
		$post_topic = getRequest()->getParam('Topic');
		$topic_model = new Topic();
		$topic_model->attributes = $post_topic;

		$post_content = getRequest()->getParam('ThreadContent');
		$content_model = new ThreadContent();
		$content_model->attributes = $post_content;
		if ($ret = ($topic_model->validate() && $content_model->validate())){
			$topic_model->save(false);
			$thread = new Thread();
			$thread->topic_id = $topic_model->id;
			$thread->save();
			$content_model->thread_id = $thread->id;
			$content_model->save(false);
		}else {
			$errors = array(
				get_class($topic_model)=>$topic_model->errors,
				get_class($content_model)=>$content_model->errors
			);
		}
		$this->_returnAjax(array(
				'result'=>$ret,
				'errors'=>$errors
		));
	}
	
	public function actionView($id){
		$topic = $this->loadModel('Topic', $id, array('threads', 'threads.content'));
		$topic->visits++;
		$topic->save(false);
		$this->render('view', array(
			'topic'=>$topic
		));
	}
}