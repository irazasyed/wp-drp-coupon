jQuery(document).ready(function(){
	jQuery(".coupon").each(function (i) {
		var $this = jQuery(this);							 
		var clip = new ZeroClipboard.Client();
		clip.setText( $this.find('span').text() );
		clip.setHandCursor( true );
		clip.setCSSEffects( true );
		
		var href = $this.attr('href');
		
		clip.addEventListener('complete', function (client, text) {
			window.open(href);
			$this.removeClass('hover');
		});
		
		clip.glue( $this.attr("id") , $this.parent().attr("id"));
		
	});
	
	var submit_action=0;
	jQuery(".coupon_save").click(function(){
		chkobjs=new Array("coupon_name","coupon_code_in","coupon_url");
		for(i=0;i<chkobjs.length;i++)
		{
			if(!jQuery("#"+chkobjs[i]).val())
			{
				jQuery("#"+chkobjs[i]).focus();
				return;
			}
		}
		submit_action=1;
		content=jQuery("#coupon_description").val();
		jQuery("#hi_coupon_description").val(content.replace(/\n/g, "<br/>"));
		jQuery("#coupon_edit_form").submit();
	});
	jQuery("#coupon_edit_form").submit(function(){
		if(!submit_action)
			return false;
	});
	jQuery(".coupondelete").click(function(){
		id=jQuery(this).attr('alt');		
		var data = {
				action: 'dynamic_coupon_delete',
				'couponid':id
			};
				
		jQuery.post(ajaxurl, data, function(response) {			
			if(response=="ok"){
				jQuery("#coupon_"+id).remove();
			}
		});
	});
	
});
