<?php 
if($_GET["page"]=="coupon-new"){
	$pageurl=site_url("wp-admin/admin.php?page=coupon");
}

if(isset($_GET["couponid"])){
	$couponid=$_GET["couponid"];
	$row=$wpdb->get_row($wpdb->prepare("SELECT * FROM $this->coupon_table WHERE id = %d", $couponid));
}
?>
<div class="wrap">
	<h2><?php _e( 'Add New Coupon' ); ?></h2>
	<form method="post" action="<?php echo $pageurl;?>" id="coupon_edit_form">
		<div class="media-single">
			<div class='media-item'>
				<table class="slidetoggle describe form-table" style="border: 0;">
					<thead class="media-item-info" id="media-head-">
						<tr valign="top">
							<td class="A1B1" id="thumbnail-head-">								
								
							</td>
						</tr>			
					</thead>
					<tbody>						
						<tr class="post_title">
							<th valign="top" scope="row" class="label">
								<label for="attachments[0][post_title]">
									<span class="alignleft">Name</span><br class="clear">
								</label>
							</th>
							<td class="field">
								<input type="text" class="text" id="coupon_name" name="coupon_name" value="<?php echo (isset($row))?stripslashes($row->name):"";?>">
							</td>
						</tr>
						<tr >
							<th valign="top" scope="row" class="label">
								<label for="attachments[0][post_excerpt]">
									<span class="alignleft">Start Date</span><br class="clear">
								</label>
							</th>
							<td >
								<input type="hidden" id="hi_coupon_start" name="hi_coupon_start" value="<?php echo (isset($row))?$row->sdate:"";?>">
								<input name="c_start" id="f_couponStart" style="width:150px;" value="<?php echo (isset($row))?$row->sdate:"";?>" />
								<button id="f_couponStart_trigger" style="height:25px;">...</button>
						        <button id="f_clearcouponStart" onclick="clearCouponStart()" style="height:25px;">clear</button>
						        <script type="text/javascript">
				                	new Calendar({
				                          inputField: "f_couponStart",
				                          dateFormat: "%B %d, %Y",
				                          trigger: "f_couponStart_trigger",
				                          bottomBar: false,
				                          onSelect: function() {//				                                  
				                		  	 document.getElementById("hi_coupon_start").value =this.selection.print("%Y/%m/%d").join("\n");
						                     this.hide();
				                          }
				                  	});
				                  	function clearCouponStart() {
				                          document.getElementById("f_couponStart").value = "";
				                          document.getElementById("hi_coupon_start").value="";
				                          LEFT_CAL.args.min = null;
				                          LEFT_CAL.redraw();
				                  	};
				                  					                   
						        </script>
                                <span style="padding: 0 0 0 20px;">Leave blank if coupon will start today</span>
							</td>
						</tr>
						<tr class="post_excerpt">
							<th valign="top" scope="row" class="label">
								<label for="attachments[0][post_excerpt]">
									<span class="alignleft">Expiry date</span><br class="clear">
								</label>
							</th>
							<td class="field">
								<input type="hidden" id="hi_coupon_end" name="hi_coupon_end" value="<?php echo (isset($row))?$row->edate:"";?>" />
								<input name="c_end" id="f_couponEnd" style="width:150px;" value="<?php echo (isset($row) && $row->edate != '0000-00-00')?$row->edate:"";?>" />
								<button id="f_couponEnd_trigger" style="height:25px;">...</button>
						        <button id="f_clearcouponEnd" onclick="clearCouponEnd()" style="height:25px;">clear</button>
						        <script type="text/javascript">
				                	new Calendar({
				                          inputField: "f_couponEnd",
				                          dateFormat: "%B %d, %Y",
				                          trigger: "f_couponEnd_trigger",
				                          bottomBar: false,
				                          onSelect: function() {
						                	 document.getElementById("hi_coupon_end").value =this.selection.print("%Y/%m/%d").join("\n");
							                 this.hide();
				                          }
				                  	});
				                  	function clearCouponEnd() {
				                          document.getElementById("f_couponEnd").value = "";
				                          document.getElementById("hi_coupon_end").value = "";
				                          LEFT_CAL.args.min = null;
				                          LEFT_CAL.redraw();
				                  	};
						        </script>
                                <span style="padding: 0 0 0 20px;">Leave blank if coupon will never expire</span>
							</td>
						</tr>
						<tr class="post_title">
							<th valign="top" scope="row" class="label">
								<label for="attachments[0][post_title]">
									<span class="alignleft">Coupon Code</span><br class="clear">
								</label>
							</th>
							<td class="field">
								<input type="text" class="text" id="coupon_code_in" name="coupon_code_in" value="<?php echo (isset($row))?stripslashes($row->codein):"";?>">
							</td>
						</tr>
						<tr class="post_content">
							<th valign="top" scope="row" class="label">
								<label for="attachments[0][post_content]">
									<span class="alignleft">Description</span><br class="clear">
								</label>
							</th>
							<td class="field">
								<?php 
									if(isset($row)){
										$description=$row->description;
										$description=str_replace("<br/>","\n",$description);
									}else{
										$description="";
									}
								?>
								<textarea type="text" id="coupon_description" name="coupon_description" style="height:150px;"><?php echo stripslashes($description);?></textarea>
								<input type="hidden" id="hi_coupon_description" name="hi_coupon_description" />
							</td>
						</tr>
						<tr class="url">
							<th valign="top" scope="row" class="label">
								<label for="attachments[0][url]"><span class="alignleft">Link URL</span><br class="clear"></label>
							</th>
							<td class="field">
								<input type="text" class="text urlfield" name="coupon_url" id="coupon_url" value="<?php echo (isset($row))?stripslashes($row->link):"";?>"><br>							
							</td>
						</tr>	
						<tr>
							<th valign="top" scope="row" class="label">
								<label>
									<span class="alignleft">Expiration Message</span><br class="clear">
								</label>
							</th>
							<td class="field">
								<input type="text" class="text" name="coupon_message" value="<?php echo (isset($row))?stripslashes($row->message):"";?>">
								<div style="padding:5px 0 0; line-height:16px; color:#666;">
									Enter a custom message to be shown when a coupon expires. Leave blank if you want the coupon to not be shown to the user upon expiration.
								</div>
							</td>
						</tr>					
					</tbody>
				</table>
			</div>
		</div>			
		<p class="submit">
			<input type="button" class="button-primary coupon_save" value="<?php esc_attr_e('Coupon Save'); ?>" />
		</p>
		<input type="hidden" name="couponid" value="<?php echo (isset($couponid))?$couponid:"";?>" />
	</form>	
</div>
