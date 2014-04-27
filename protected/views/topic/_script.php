<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/plugins/summernote/summernote.js')?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/plugins/summernote/summernote-zh-CN.js')?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/plugins/summernote/summernote.css')?>
<?php Yii::app()->clientScript->registerScript('editor', "
		$('.editor').summernote({
		  onImageUpload: function(files, editor, welEditable) {
		      sendFile(files[0],editor,welEditable);
		  },
		  //lang: 'zh-cn',
		  height: 150,   //set editable area's height
		  codemirror: { // codemirror options
		    theme: 'monokai'
		  }
		});
		
		$('#df{$form}').submit(function(){
			var form = $(this);
			 
			if($('.editor').val() == '<p><br></p>'){
			    console.log('zzz');
                return false;
            }
			$.post($(this).attr('action'), $(this).serialize(), function(ret){
				ret = $.parseJSON(ret);
				if(ret.result){
					$.fn.yiiListView.update('{$list}');
				}else{
					form.showFormError(ret);
				}
			});
			return false;
		});

		function sendFile(file,editor,welEditable) {
		    data = new FormData();
		    data.append('File[file]', file);
		    $.ajax({
		        data: data,
		        type: 'POST',
				dataType: 'json',
		        url: '".url('/ajax/saveimage')."',
		        cache: false,
		        contentType: false,
		        processData: false,
		        success: function(ret) {
					if(ret.result){
						editor.insertImage(welEditable, ret.message);
					}else{
						alert(ret.message);
					}
		        }
		    });
		}
")?>