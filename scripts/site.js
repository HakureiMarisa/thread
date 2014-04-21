
$(function(){
    $("#gotop").click(function(e) {
    	$('html').animate({scrollTop:0},1000);
    });
    
    $(window).scroll(function(e) {
        //若滚动条离顶部大于100元素
        if($(window).scrollTop()>100)
            $("#gotop").fadeIn(1000);//以1秒的间隔渐显id=gotop的元素
        else
            $("#gotop").fadeOut(1000);//以1秒的间隔渐隐id=gotop的元素
    });
	
	$.fn.extend({       
		showFormError: function(ret){  
			var form = $(this);
			$.each(ret.errors, function(model, modelErrors){
				$.each(modelErrors, function(attribute, error){		
					if('create_by' == attribute){
						alert(error);
						return;
					}
					var element = form.find("[name^='"+model+"["+attribute+"]']");
					element.parents(".control-group").addClass('error').find('.help-block').html(error).show();
				});
			});			
	    }              
	}); 
});