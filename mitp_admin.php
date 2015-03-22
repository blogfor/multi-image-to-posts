<?php
/*
  Plugin Name: Muli Image To Posts
  Plugin URI: http://www.blogfordeveloper.com/
  Description: 
  Version: 1.0
  Author: 
  Author URI: http://www.blogfordeveloper.com/about-us/
*/


global $wpdb;


define('MITP_BG_VERSION',22);

/* Handlers for Detect and save search keywords */
add_action( 'wp_loaded', 'mitp_keyword_trace' );

function mitp_keyword_trace( ) {
    
   
	
	
}

/* Admin menu */
add_action( 'admin_menu', 'mitp_menu' );

add_action( 'plugins_loaded', 'mitp_plugins_update' );

function mitp_plugins_update()
{
 include plugin_dir_path( __FILE__ ).'update.php';
}


function mitp_admin_dashboard() {
	require 'mitp-admin-dashboard.php';
}

function mitp_menu() {
	add_menu_page( 'Keyword Statistics', 'Keyword Statistics', 'administrator', 'mitp-menu', 'mitp_admin_dashboard' );
	
	//add_submenu_page( 'ss-menu', 'Active Post Type', 'Active Post Type', 'administrator','active-post-type', 'active_post_type_func' );
}

function mitp_active_post_type_func()
{
	$args = array(
	   'public'   => true,
	   '_builtin' => true
	);

	$output = 'names'; // names or objects, note names is the default
	//$operator = 'and'; // 'and' or 'or'
	
	if(isset($_POST['mitp_post']))
	{
		$arr=serialize($_POST['mitp_post']);
		update_option('mitp_post_types',$arr);
	}
	
	$post_types = get_post_types( $args, $output ); 
	echo '<form method="post">';
	echo '<div><div style="float:left; width:200px;">Operation</div><div style="float:left; width:200px;"> Post Type</div></div>';
	//var_dump($post_types);
	
	foreach ( $post_types  as $post_type ) {
	if($post_type!='attachment')
	   echo '<div style="clear:both;"><div style="float:left; width:200px;"><input type="checkbox" name="mitp_post[]" value="'.$post_type.'" checked="checked"></div><div style="float:left; width:200px;"> ' . $post_type . '</div></div>';
	}
	echo '<input type="submit" name="submit" value="submit">';
	echo '</form>';
}



// Function that outputs the contents of the dashboard widget
function mitp_dashboard_widget_function($post, $callback_args ) {
	
	  global $wpdb;
        $rows=$wpdb->get_results( "SELECT * FROM " . MITP_TABLE . " ORDER BY repeat_count DESC LIMIT 0,10" );
        
?>
<div>
	<h3> Search Keyword Statistics <span style="color: gray;">2.2</span> - Most repeated result</h3>

        <div>
            <?php 
            
            if(isset($error) && $error!='')
            {
                echo '<span style="color:red;font-size:12px;font-weight:bold;">'.$error.'</span>';
            }
            
           
            ?>
            
            
          
        </div>


<style type="text/css">
.mitp_dasboard_table {
	margin:0px;padding:0px;
	width:100%;
	box-shadow: 10px 10px 5px #888888;
	border:1px solid #000000;
	
	-moz-border-radius-bottomleft:4px;
	-webkit-border-bottom-left-radius:4px;
	border-bottom-left-radius:4px;
	
	-moz-border-radius-bottomright:4px;
	-webkit-border-bottom-right-radius:4px;
	border-bottom-right-radius:4px;
	
	-moz-border-radius-topright:4px;
	-webkit-border-top-right-radius:4px;
	border-top-right-radius:4px;
	
	-moz-border-radius-topleft:4px;
	-webkit-border-top-left-radius:4px;
	border-top-left-radius:4px;
}.mitp_dasboard_table table{
    border-collapse: collapse;
        border-spacing: 0;
	width:100%;
	height:100%;
	margin:0px;padding:0px;
}.mitp_dasboard_table tr:last-child td:last-child {
	-moz-border-radius-bottomright:4px;
	-webkit-border-bottom-right-radius:4px;
	border-bottom-right-radius:4px;
}
.mitp_dasboard_table table tr:first-child td:first-child {
	-moz-border-radius-topleft:4px;
	-webkit-border-top-left-radius:4px;
	border-top-left-radius:4px;
}
.mitp_dasboard_table table tr:first-child td:last-child {
	-moz-border-radius-topright:4px;
	-webkit-border-top-right-radius:4px;
	border-top-right-radius:4px;
}.mitp_dasboard_table tr:last-child td:first-child{
	-moz-border-radius-bottomleft:4px;
	-webkit-border-bottom-left-radius:4px;
	border-bottom-left-radius:4px;
}.mitp_dasboard_table tr:hover td{
	
}
.mitp_dasboard_table tr:nth-child(odd){ background-color:#b2b2b2; }
.mitp_dasboard_table tr:nth-child(even)    { background-color:#ffffff; }.mitp_dasboard_table td{
	vertical-align:middle;
	
	
	border:1px solid #000000;
	border-width:0px 1px 1px 0px;
	text-align:left;
	padding:7px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}.mitp_dasboard_table tr:last-child td{
	border-width:0px 1px 0px 0px;
}.mitp_dasboard_table tr td:last-child{
	border-width:0px 0px 1px 0px;
}.mitp_dasboard_table tr:last-child td:last-child{
	border-width:0px 0px 0px 0px;
}
.mitp_dasboard_table tr:first-child td{
		background:-o-linear-gradient(bottom, #7f7f7f 5%, #191919 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7f7f7f), color-stop(1, #191919) );
	background:-moz-linear-gradient( center top, #7f7f7f 5%, #191919 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#7f7f7f", endColorstr="#191919");	background: -o-linear-gradient(top,#7f7f7f,191919);

	background-color:#7f7f7f;
	border:0px solid #000000;
	text-align:center;
	border-width:0px 0px 1px 1px;
	font-size:14px;
	font-family:Arial;
	font-weight:bold;
	color:#ffffff;
}
.mitp_dasboard_table tr:first-child:hover td{
	background:-o-linear-gradient(bottom, #7f7f7f 5%, #191919 100%);	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #7f7f7f), color-stop(1, #191919) );
	background:-moz-linear-gradient( center top, #7f7f7f 5%, #191919 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr="#7f7f7f", endColorstr="#191919");	background: -o-linear-gradient(top,#7f7f7f,191919);

	background-color:#7f7f7f;
}
.mitp_dasboard_table tr:first-child td:first-child{
	border-width:0px 0px 1px 0px;
}
.mitp_dasboard_table tr:first-child td:last-child{
	border-width:0px 0px 1px 1px;
}
</style>
<div class="mitp_dasboard_table">
    <form action="" method="post" name="frmKeyword" >
<table cellpadding="1" cellspacing="1" border="1" class="display" id="example" width="100%">
		<tr>
						<td>Sl No</td>
                        <td>keywords</td>
                       	<td>Repeat</td>
                        <td>No. of Result</td>
       </tr>
            <?php
            
            for($i=0;$i<count($rows);$i++)
	   {
                if(is_numeric($rows[$i]->user))
                {
                    $user_info =get_userdata($rows[$i]->user);
                    $user=$user_info->user_login;
                }
                else
                    $user='Non-Registered';
                
           ?>
		<tr class="odd gradeX">
                	<td><?php echo $i+1; ?></td>
			<td><?php echo $rows[$i]->keywords; ?></td>
			
			<td class="center"><?php echo $rows[$i]->repeat_count; ?></td>
                        <td class="center"><?php echo $rows[$i]->search_count; ?></td>
                        
		</tr>
                <?php
                }
            ?>
		
	
</table>
        
    </form>
</div>

</div>

<?php
}

// Function used in the action hook
function mitp_add_dashboard_widgets() {
	wp_add_dashboard_widget('dashboard_widget', 'Keyword Statistics', 'mitp_dashboard_widget_function');
}

// Register the new dashboard widget with the 'wp_dashboard_setup' action
add_action('wp_dashboard_setup', 'mitp_add_dashboard_widgets' );



/* Uninstall and Activation handlers */
register_activation_hook( __FILE__, 'mitp_activate' );
register_deactivation_hook( __FILE__, 'mitp_deactivate' );

register_uninstall_hook( __FILE__, 'mitp_deactivate_uninstall' );

function mitp_activate( ) {
	
}

function mitp_deactivate_uninstall( ) {
	
}

function mitp_deactivate( ) {
	delete_option( 'MITP_BG_VERSION' );
}




?>