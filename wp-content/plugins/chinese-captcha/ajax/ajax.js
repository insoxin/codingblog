   var $commentlist=jQuery('.commentlist');
   var $respond=jQuery('#respond');
   var $message=jQuery('<span class="chicha-ajax"></span>').appendTo("#commentform");
   var $textarea=$respond.find('#comment').attr('rows','4');
 jQuery('#commentform').submit(function(){
       jQuery.ajax({
         beforeSend:function(xhr){
            xhr.setRequestHeader("If-Modified-Since","0");
           $message.empty().append('<img src="'+chichaSettings.gifUrl+'">正在提交，请稍等');
         },
         type:'post',
         url:jQuery(this).attr('action'),
         data:jQuery(this).serialize(),
         dataType:'html',	 
         error:function(xhr){
             if(xhr.status==500){
               $message.empty().append(xhr.responseText.split('<p>')[1].split('</p>')[0]);
			   if((xhr.responseText.split('<p>')[1].split('</p>')[0])=='<strong>错误</strong>：验证码错误或超时，请重新输入。')
			   {jQuery('img#chinesecaptcha').attr('src',chichaSettings.chichaUrl+Math.random());
            jQuery('input#chicha').val(''); }
             }
             else if(xhr.status=='timeout'){
               $message.empty().append('服务器超时，请重试!');
             }
             else{
               $message.empty().append('您的发布频率太快了!');
             }
         },
         success:function(data){
            $message.empty().append('提交成功，非常感谢您的评论!');
            $newComList=jQuery(data).find('.commentlist');
		    $commentlist.replaceWith($newComList);
			if($commentlist.length<1){
			$newComList.prev().andSelf().insertBefore($respond);}
			$commentlist=$newComList;
			jQuery('img#chinesecaptcha').attr('src',chichaSettings.chichaUrl+Math.random());
            jQuery('input#chicha').val('');
            $textarea.val('');
         }
       });//end of ajax
      return false;
   });//end of submit function