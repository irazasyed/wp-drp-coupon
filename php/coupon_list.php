<?php 
	global $wpdb;
	$sql="SELECT * FROM $this->coupon_table ORDER BY id DESC";
	$results=$wpdb->get_results($sql);
?>

<div class="wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2>Coupon List <a href="admin.php?page=coupon-new" class="button add-new-h2">Add New</a> </h2>
	<div class="drpcoupon-instructions">
		<div class="drpcoupon-instructions-header">Overview</div>
		<p>
			DRPCoupon will allow you to add coupons in your posts and pages.<br/>
		</p>	
		<div class="drpcoupon-instructions-header">
			How to Use DRPCOUPON
		</div>
		<p>	
			Click on " Add New " on the left and then in the name field type in who the coupon is from i.e Best Buy. Select a start date for future ( leave blank if it starts today), expiry date ( only if it expires, leave blank if no expiry), type in the Coupon Code ( viewer will see it ), give it a description of what the coupon gives the customer. i.e 10% all Electronics. Then add the full website or affiliate URL. Lastly decide if you want to display a custom message to appear when the coupon expires or if you just want the coupon to disappear and then click on Save. ( leave it blank if it never expires )<br/><br/>
			
			If you want to view, edit, or delete a coupon, just click on "Manage Coupons" and then mouse over the coupon name and you will see an edit or delete link.<br/><br/>
			
			Finally to add them to a post or page you can choose between 2 options<br/><br/>
			
			MAIN OPTION RECOMMENDED. Use the button in post or page - Go to your post or page and just above the editor and below the title there is a series of buttons click the one on the far right of the media button, you then see a window with a drop down, select your coupon name, then click ok or check boxes for what your wish to excluded and not viewable. For example if the coupon never expires, check the expiry date as you wont need that. Or if you don't want the coupon to appear in RSS feeds, check RSS feed box then click OK. Now publish your post or page.<br/><br/>
			
			or<br/><br/>
			
			ADVANCED NOT RECOMMENDED. Insert directly into the PHP like your single.php using this line of code &lt;?php get_coupon_content("nameyougaveforcoupongoeshere");?&gt;
		</p>
		<div class="drpcoupon-instructions-header">
			FUTURE START DATE INFO
		</div>
        <p>
            If you want to publish a post with a coupon that will SHOW UP in the future ( i.e 1 day, 5 days, 3 months later ) make sure you select a future date then add it to a post or page and publish. That coupon will only appear to your readers when that start date arrives. By default if you want coupons to appear the same day you publish just leave the start date blank or pick todays date. The Start date by default is based on your LOCAL time that you have selected under wordpress settings>general ( make sure you have your city selected i.e Toronto ).
        </p>
	</div>
	<div class="tablenav">
		<div class="tablenav-pages">
			<?php 
			if($results)
			{
				$count_posts = count($results);
				$pagenum=(isset($_GET["paged"])) ? $_GET["paged"] : 1;
				$per_page=20;
				$allpages=ceil($count_posts / $per_page);
				$base= add_query_arg( 'paged', '%#%' );
				$page_links = paginate_links( array(
					'base' => $base,
					'format' => '',
					'prev_text' => __('&laquo;'),
					'next_text' => __('&raquo;'),
					'total' => $allpages,
					'current' => $pagenum
				));
				$page_links_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %s&#8211;%s of %s' ) . '</span>%s',
						number_format_i18n( ( $pagenum - 1 ) * $per_page + 1 ),
						number_format_i18n( min( $pagenum * $per_page, $count_posts ) ),
						number_format_i18n( $count_posts ),
						$page_links
						);
				echo $page_links_text;
			}	
			?>
		</div>
	</div>
	<table class="wp-list-table widefat fixed posts" cellspacing="0">
		<thead>
			<tr>
				<th><?php _e('Name'); ?></th>
				<th><?php _e('Start date'); ?></th>
				<th><?php _e('Expiry date'); ?></th>
				<th><?php _e('Coupon Code'); ?></th>
				<th><?php _e('Description'); ?></th>
				<th><?php _e('Link'); ?></th>
			</tr>
		</thead>
		
		<tbody id="coupon-list">
			<?php if($results):?>
				<?php 
					//echo $pagenum;
					$count = 0;
					$start = ($pagenum - 1) * $per_page;
					$end = $start + $per_page;
					foreach ($results as $result){	
						if ( $count >= $end )
							break;
						if ( $count >= $start ){	
                            $expires = ($result->edate == '0000-00-00') ? 'Never expires' : $result->edate;				
							echo "<tr id='coupon_$result->id' class='alternate author-self status-publish format-default iedit'>";
							echo "<td>
									<span>".stripslashes($result->name)."</span>
									<div class='row-actions'>
										<span class='inline hide-if-no-js'><a href='admin.php?page=coupon-new&couponid=$result->id' class='editinline'>Edit</a> | </span>
										<span class='trash'><a class='coupondelete' href='#' alt='$result->id'>Delete</a> | </span>
									</div>									
								  </td>";
							echo "<td>$result->sdate</td>";
							echo "<td>$expires</td>";
							echo "<td>".stripslashes($result->codein)."</td>";
							echo "<td>".stripslashes($result->description)."</td>";
							echo "<td>".stripslashes($result->link)."</td>";
							echo "</tr>";							
						}
						$count++;
					}
				?>
			<?php else:?>
				<tr>
					<td align="center" colspan="6" class="empty">No Coupons Added</td>
				</tr>
			<?php endif;?>			
		</tbody>
		<?php if($results):?>
			<tfoot>
				<tr>
					<th><?php _e('Name'); ?></th>
					<th><?php _e('Start date'); ?></th>
					<th><?php _e('Expiry date'); ?></th>
					<th><?php _e('Coupon Code'); ?></th>
					<th><?php _e('Description'); ?></th>
					<th><?php _e('Link'); ?></th>
				</tr>
			</tfoot>
		<?php endif;?>	
	</table>
	<div id="ajax-response"></div>
	<br class="clear">
</div>