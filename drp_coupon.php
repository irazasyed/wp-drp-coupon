<?php
/*
  Plugin Name: DRP Coupon
  Plugin URI: http://www.directresponsepublishing.com
  Description: DRP Coupon is a Wordpress Coupon Plugin which Allows You To Add Coupons that Expire To Your Posts and Pages.
  Version: 2.1
  Author: Direct Response Publishing
  Author URI: http://www.directresponsepublishing.com

Copyright 2011 Direct Response Publishing  (email : contact@directresponsepublishing.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */


if (!class_exists('drpCoupon'))
{

    class drpCoupon {

        var $coupon_table;
		var $db_version = '2.1';
		
        function drpCoupon()
        {
            $this->contactDefine();
            register_activation_hook(__FILE__, array($this, 'create_coupon_table'), 21);
            add_action('init', array($this, 'include_coupon_css_js'));
            add_action('admin_menu', array($this, 'create_coupon_option_menu'), 12);
            add_action('admin_init', array($this, 'create_coupon_table'));
            add_shortcode('drpcoupon', array($this, 'get_coupon_display'));
			add_filter('media_buttons_context', array($this, 'add_media_button'));
			add_filter('media_upload_drp_coupon', array($this, 'show_custom_coupon_page'));
        }

		function add_media_button($context)
		{
			$button = "<a href='" . esc_url( get_upload_iframe_src('drp_coupon') ) . "' id='add_drp_coupon' class='thickbox' title='Add A Coupon'><img src='" . esc_url( plugins_url('images/coupon_icon.jpg', __FILE__) ) . "' alt='Add A Coupon' onclick='return false;' /></a>";
			
			return $context.$button;
		}

		function show_custom_coupon_page()
		{
			global $wpdb;
			
   			$sql = "SELECT 
						* 
					FROM 
						".$wpdb->prefix."drp_coupon 
					WHERE 
						edate = '0000-00-00' OR edate >= '".date('Y-m-d', current_time('timestamp', 0))."'";
    		
			$rows = $wpdb->get_results($sql);
			
 			wp_admin_css( 'global', TRUE);
 			wp_admin_css( 'wp-admin', TRUE);
 			wp_admin_css( 'media', TRUE);
  			wp_admin_css( 'colors' , TRUE);
?>
		<script type="text/javascript">
			var addDRPCoupon = {
				insert : function() {
					f = document.forms[0];
					
					if(f.coupon_name.value == '' || f.coupon_name == 'undefined')
						return;
					
					html = '[drpcoupon name="'+ f.coupon_name.value +'"';
					
					var exclude = '';
					
					if(f.name.checked)
						exclude += "name,";
						
					if(f.expiration.checked)
						exclude += "expiration,";
						
					if(f.description.checked)
						exclude += "description,";
                    
					if(f.rss.checked)
						exclude += "rss,";
					
					if(exclude != '')
					{	
						if(exclude.charAt(exclude.length - 1, 1) == ",")
							exclude = exclude.substring(0, exclude.length - 1);	
							
						html += ' exclude="' + exclude + '"';	
					}
							
					html += '] ';
					
					var win = window.dialogArguments || opener || parent || top;
					
					win.send_to_editor(html);
				}
			}
		</script>
		<style>
			label {
				color:#777;
			}
			
			form {
				padding:0 15px;
			}
			
			form div {
				margin:0 0 15px;
			}
			
			form div div {
				margin:7px 0 0;
			}
			
			body, html {
				overflow:hidden;
			}
			
			.button {
				margin-top:15px;
			}
		</style>
		<form>
			<h3 class="media-title">Add A Coupon</h3>
			<div>
				<label>Select Coupon To Add</label>
				<div>
					<select class="input" name="coupon_name">
						<?php foreach($rows as $r):?>
							<option value="<?php echo stripslashes($r->name);?>"><?php echo stripslashes($r->name);?></option>
						<?php endforeach;?>
					</select>
				</div>
			</div>	
			<div>
				<label>Which Coupon Sections Would You Like To Exclude:</label>
				<div>
					<input type="checkbox" value="1" name="name" /> Coupon Name <br/>
					<input type="checkbox" value="1" name="description"  /> Coupon Description <br/>
					<input type="checkbox" value="1" name="expiration" /> Coupon Expiration Date<br/>
					<input type="checkbox" value="1" name="rss" /> Entire Coupon For RSS Feeds
				</div>
			</div>	
			<div>
				<input type="button" class="button" id="go_button" onclick="addDRPCoupon.insert()" value="Insert Into Post" />
			</div>
		</form>			
<?php
		}

        function contactDefine()
        {
            define ('COUPON_PLUGIN_URL', plugins_url() . '/drp-coupon');
            define ('COUPON_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins/drp-coupon');
        }

        function create_coupon_table()
        {
            global $wpdb;
            $COUPON_TABLE = $wpdb->prefix . 'drp_coupon';
            if ($this->db_version != get_option('drp_coupon_db_version'))
            {
				require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
				
                $query = "CREATE TABLE {$COUPON_TABLE} (
                             id bigint(20) unsigned NOT NULL auto_increment,
                             name varchar(50) NOT NULL default '',
                             sdate date NOT NULL default '0000-00-00',
                             edate date NOT NULL default '0000-00-00',
                             codein varchar(50) NOT NULL default '',
                             description longtext NOT NULL ,
                             link varchar(200) NOT NULL default '',
                             message varchar(255) NOT NULL default '',
                             PRIMARY KEY  (id),
                             KEY name (name)
                         );";
				
				dbDelta($query);
				
				update_option('drp_coupon_db_version', $this->db_version);
            }
        }

        function include_coupon_css_js()
        {							   
			wp_register_style('plugin', plugins_url('css/plugin.css', __FILE__));
			wp_register_style('calendar', plugins_url('css/jscal2.css', __FILE__));
            wp_register_script('plugin', plugins_url('sc/plugin.js', __FILE__), array('jquery'));
            wp_register_script('calendar', plugins_url('sc/jscal2.js', __FILE__));
            wp_register_script('calendar_en', plugins_url('sc/en.js', __FILE__));
			
			wp_register_style('shortcode', plugins_url('css/shortcode.css', __FILE__));
            wp_register_script('zeroclipboard', plugins_url('sc/zeroclipboard/ZeroClipboard.js', __FILE__), array('jquery'));
            wp_register_script('zeroclipboard_ready', plugins_url('sc/zeroclipboard_ready.js', __FILE__));
			
			if(is_admin())
			{
				wp_enqueue_style('plugin');
				wp_enqueue_style('calendar');
				wp_enqueue_script('calendar');
				wp_enqueue_script('calendar_en');
			}
			else
			{
				wp_enqueue_style('shortcode');
				wp_enqueue_script('zeroclipboard');
			
				$data = array(
					'swfPath' => plugins_url('sc/zeroclipboard/ZeroClipboard.swf', __FILE__)
				);
			
				wp_localize_script('zeroclipboard_ready', 'ZCData', $data);
				wp_enqueue_script('zeroclipboard_ready');
			}
			
			wp_enqueue_script('plugin');
        }

        function create_coupon_option_menu()
        {
            global $wpdb;
            $this->coupon_table = $wpdb->prefix . 'drp_coupon';
            add_menu_page(__('DRP Coupon', 'coupon'), __('DRP Coupon', 'myplugin'), 'administrator', 'coupon', array($this, 'able_coupon_setting'));
            add_submenu_page('coupon', __('DRP Coupon','myplugin'), __('Manage Coupons','myplugin'), 'administrator', 'coupon', Array($this,'able_coupon_setting'));
            add_submenu_page('coupon', __('DRP Coupon', 'myplugin'), __('Add New', 'myplugin'), 'administrator', 'coupon-new', array($this, 'add_new_coupon'));

        }

        function save_coupon_data()
        {
            if ($_GET["page"] <> "coupon") return;
            if (isset($_POST["coupon_name"]))
            {
				$_POST = stripslashes_deep($_POST);
				
                global $wpdb;
                $couponName = trim($_POST["coupon_name"]);
                $startDate = (!empty($_POST["c_start"])) ? trim($_POST["hi_coupon_start"]) : date('Y-m-d', current_time('timestamp', 0));
                $endDate = (!empty($_POST["c_end"])) ? trim($_POST["hi_coupon_end"]) : '0000-00-00';
                $coupon_code_in = trim($_POST["coupon_code_in"]);
                $coupon_description = trim($_POST["hi_coupon_description"]);
                $coupon_url = trim($_POST["coupon_url"]);
                $coupon_message = trim($_POST["coupon_message"]);
                $datas = array("name" => $couponName,
                               "sdate" => $startDate,
                               "edate" => $endDate,
                               "codein" => $coupon_code_in,
                               "description" => $coupon_description,
                               "message" => $coupon_message,
                               "link" => $coupon_url);
							
                if ($_POST["couponid"] == "")
                {
                    $wpdb->insert($this->coupon_table, $datas);
                } else
                {
                    $wpdb->update($this->coupon_table, $datas, array("id" => (int)$_POST["couponid"]));
                }

            }
        }

        function able_coupon_setting()
        {
            $this->save_coupon_data();
            include(COUPON_PLUGIN_DIR . "/php/coupon_list.php");
        }

        function add_new_coupon()
        {
            global $wpdb;
            include(COUPON_PLUGIN_DIR . "/php/add_new_coupon.php");
        }

        function get_coupon_display($atts)
        {
            return drpcoupon_get_coupon_content($atts, "shortcode");
        }
    }

    new drpCoupon ();
}

function drpcoupon_dynamic_coupon_delete_fun()
{
    global $wpdb;
    $COUPON_TABLE = $wpdb->prefix . 'drp_coupon';
    $couponid = (int)$_POST["couponid"];
    $wpdb->query($wpdb->prepare("DELETE FROM $COUPON_TABLE WHERE id =$couponid"));
    echo "ok";
    exit();
}

add_action('wp_ajax_dynamic_coupon_delete', 'drpcoupon_dynamic_coupon_delete_fun');

function get_coupon_content($name, $exclude = '')
{
	$array = array();
	$array['name'] = $name;
	$array['exclude'] = $exclude;
	
	drpcoupon_get_coupon_content($array);
}

function drpcoupon_get_coupon_content($atts, $action = "code")
{
    $coupon = drpcoupon_get_coupon($atts['name']);
	$exclude = (!empty($atts['exclude'])) ? array_map('trim', explode(',', $atts['exclude'])) : array();
	
    if(!empty($exclude) && in_array('rss', $exclude) && is_feed())
    {
        return;
    }
    
    if ($coupon)
    {
        if ($action == "shortcode")
        {
            ob_start();
        }
        ?>
    	<?php
			$random = rand();
        	$cdate = ($coupon->edate != '0000-00-00') ? new DateTime($coupon->edate) : '';
        ?>
    <div class="coupon_box">
	
		<?php if(!in_array('name', $exclude)):?>
			<span class="coupon_name"><?php echo stripslashes($coupon->name);?></span>
		<?php endif;?>
		<?php if(!in_array('description', $exclude)):?>
			<div class="coupon_description"><?php echo stripslashes($coupon->description);?></div>
		<?php endif;?>
		<?php if(!in_array('expiration', $exclude)):?>
			<div class="coupon_date"><span>Expires: </span><span><?php echo ($cdate instanceof DateTime) ?  $cdate->format("m/d/Y") : 'Never Expires';?></span></div>
		<?php endif;?>
			
        <div id="coupon-container-<?php echo $coupon->id;?>-<?php echo $random;?>" class="coupon_container">
            <div unselectable="on" onselectstart="return false;" ondragstart="return false;"  id="coupon-<?php echo $coupon->id;?>-<?php echo $random;?>"  class="coupon" href="http://<?php echo str_replace('http://', '', $coupon->link);?>">
				<span><?php echo stripslashes($coupon->codein);?></span>
				<div class="hover-message">
					Click To Open/Copy
				</div>
			</div>
        </div>
		
		<?php if(date('Y-m-d', current_time('timestamp', 0)) > $coupon->edate AND !empty($coupon->message)):?>
			<div class="coupon_message">
				<?php echo stripslashes($coupon->message);?>
			</div>
		<?php endif;?>
    </div>
    <?php

        if ($action == "shortcode")
        {
            $result = ob_get_contents();
            ob_end_clean();
            return $result;
        }
    }
}

function drpcoupon_get_coupon($name)
{
    global $wpdb;
    $coupon_table = $wpdb->prefix . 'drp_coupon';
    $sql = "SELECT * FROM $coupon_table WHERE name='%s'";
    $row = $wpdb->get_row($wpdb->prepare($sql, trim($name)));
	
    if ($row AND $row->sdate <= date('Y-m-d', current_time('timestamp', 0)) AND (!empty($row->message) OR ($row->edate == '0000-00-00' OR date('Y-m-d', current_time('timestamp', 0)) <= $row->edate ) ))
    {
        return $row;
    } else
    {
        return "";
    }
}


?>