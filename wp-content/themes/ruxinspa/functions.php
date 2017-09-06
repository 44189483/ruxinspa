<?php
/**
* Ru Xin Spa 
* @package WordPress
* @subpackage Ru_Xin_Spa
* @since Ru Xin Spa 1.0
*/

/**
* 获取所有页面
**/
function get_all_menu(){
	global $wpdb;
	return $wpdb->get_results("SELECT post_title,post_name FROM $wpdb->posts WHERE post_status='publish' AND post_type = 'page' ORDER BY menu_order DESC,ID ASC");
}

//自定义会员后台菜单
add_action('admin_menu', 'register_custom_users_page');

function register_custom_users_page(){

    add_menu_page('Users list', 'Users list', 'administrator', 'customusers', 'custom_users_page', '', 199);
    //plugins_url('myplugin/images/icon.png')

}

//会员统计
function custom_users_page(){

	global $wpdb;

	$where = "WHERE 1=1 ";

	$name = $_GET['name'];
	if(!empty($name)){
		$where .= " AND name LIKE '%{$name}%'";
	}

	$mobile = $_GET['mobile'];
	if(!empty($mobile)){
		$where .= " AND phone='{$mobile}'";
	}

	$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;

	$per_page = 10;

	$cut = ($page - 1) * $per_page;

	$count = $wpdb->get_var("SELECT COUNT(*) AS total FROM (SELECT COUNT(*) FROM rx_appointment {$where} GROUP BY phone) u");

	$sql = "SELECT name,phone FROM rx_appointment {$where} GROUP BY phone ORDER BY id DESC LIMIT $cut,{$per_page}";

	$results = $wpdb->get_results($sql);

    echo '
    	<div class="wrap">
    		<h2 class="screen-reader-text">users list</h2>
	       	<ul class="subsubsub">
				<li class="all">
					<a href="edit.php?post_type=post" class="current">All <span class="count">('.$count.')</span></a>
				</li>
			</ul>
	    	<form method="get" action="">
				<div class="tablenav top">
					<div class="alignleft actions">
						<input type="text" id="name" name="name" value="'.$name.'" placeholder="user name"/>
						<input type="text" id="mobile" name="mobile" value="'.$phone.'" placeholder="user mobile"/>
						<input type="hidden" name="page" value="customusers"/>
						<input type="submit" class="button action" value="seach" />
						<input type="button" class="button action" onclick="javascript:window.location.href=\'../wp-content/themes/ruxinspa/export.php\'" value="Export Excel" />
						<input type="button" class="button action" onclick="javascript:window.location.href=\''.admin_url().'admin.php?page=customusers\'" value="go back" />
					</div>
				</div>
				<h2 class="screen-reader-text">Users list</h2>
				<table class="wp-list-table widefat fixed striped">
					<thead>
						<tr>
							<th class="manage-column">name</th>
							<th class="manage-column">mobile</th>
						</tr>
					</thead>
					<tbody>
	';

	foreach ($results as $key => $val):
		echo '<tr><td><strong>'.$val->name.'</strong></td><td><strong>'.$val->phone.'</strong></td></tr>';
	endforeach;
							
	echo '
					</tbody>
				</table>
			</form>
		</div>

    ';
		 
	echo paginate_links( array(
	    'base' => add_query_arg( 'cpage', '%#%' ),
	    'format' => '',
	    'prev_text' => __('&laquo;'),
	    'next_text' => __('&raquo;'),
	    'total' => ceil($count / $per_page),
	    'current' => $page
	));

}

//自定义短信后台菜单
add_action('admin_menu', 'register_custom_sms_page');

function register_custom_sms_page(){

    add_menu_page('SMS', 'SMS', 'administrator', 'customsms', 'custom_sms_page', '', 200);
    //plugins_url('myplugin/images/icon.png')

}

//短信统计
function custom_sms_page(){

	global $wpdb;

	$table = 'rx_options';

	$sql = "SELECT option_value FROM {$table} WHERE option_name='used-message'";

	$row = $wpdb->get_row($sql);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$sql = "UPDATE {$table} SET option_value=0 WHERE option_name='used-message'";
    	$wpdb->query($sql);
    	echo '<script>window.location.href="'.admin_url().'admin.php?page=customsms"</script>';
	}

    echo '
    	<div class="wrap">
    		<h2 class="screen-reader-text">Message</h2>
    		<form method="POST" action="">
	       	<ul class="subsubsub">
				<li class="all">
					USED <span class="count">('.$row->option_value.')</span>
				</li>
				<li class="publish">
					<input type="submit" name="submit" onclick="return confirm(\'Do you want to reset the SMS value?\');" class="button action" value="clear" />
				</li>
			</ul>
			</form>
		</div>

    ';
		 

}

//自定义预约时间后台菜单
add_action('admin_menu', 'register_custom_appointment_page');

function register_custom_appointment_page(){

    add_menu_page('Appointment Time', 'Appointment Time', 'administrator', 'customtime', 'custom_appointment_page', '', 201);
    //plugins_url('myplugin/images/icon.png')

}

//预约时间统计
function custom_appointment_page(){

	global $wpdb;

	$sql = "SELECT REPLACE(SUBSTRING(appointmentTime, -19),'t ','') AS time,COUNT(appointmentTime) AS count FROM rx_appointment GROUP BY REPLACE(SUBSTRING(appointmentTime, -19),'t ','') ORDER BY COUNT(appointmentTime) DESC";

	$results = $wpdb->get_results($sql);

    echo '
    	<div class="wrap">
			<h2 class="screen-reader-text">Time list</h2>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th class="manage-column">time</th>
						<th class="manage-column">count</th>
					</tr>
				</thead>
				<tbody>
	';

	foreach ($results as $key => $val):
		echo '<tr><td><strong>'.$val->time.'</strong></td><td><strong>'.$val->count.'</strong></td></tr>';
	endforeach;
							
	echo '
				</tbody>
			</table>
		</div>

    ';

}

add_action('admin_menu', 'register_services_page');

function register_services_page(){   
    add_menu_page('Our Services', 'Our Services', 'administrator', 'customservices','services_display_page', '', 201); 
}   
 
function services_display_page(){  

	global $wpdb;

	$id = $_GET['id'];

	$table = 'rx_services';

	$sql = "SELECT * FROM {$table} WHERE type=0";

	$url = admin_url().'admin.php?page=customservices';

	$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;

	$per_page = 4;

	$cut = ($page - 1) * $per_page;

	$count = $wpdb->get_var("SELECT COUNT(*) AS total FROM {$table} WHERE type=0");

	$results = $wpdb->get_results($sql." ORDER BY id DESC LIMIT $cut,{$per_page}");

	if(!empty($id)){
		$sql = $sql." AND id={$id}";
		$row = $wpdb->get_row($sql);
	}

    /****处理数据********/  
    if ( isset( $_POST['save_wp_options'] ) ) { //save_wp_options是先前输出的隐藏域   
        $new_option = $old_option = get_option('_upload'); //获取老数据,新数据的值暂时和老数据一样   
        $new_option = $_POST['_upload']; //获取提交的数据，新数据重新赋值 

        $act = $_GET['act'];
        $id =  $_GET['id'];

        $title = trim($_POST["title"]);
        $times = trim($_POST["times"]);
        $price = trim($_POST["price"]);

        if($act == 'edit'){
        	$sql = "UPDATE rx_services SET title='{$title}',img='{$new_option}',times='{$times}',price='{$price}' WHERE id={$id}";
        }else{
        	$sql = "INSERT INTO rx_services (title,img,times,price,type)VALUES('{$title}','{$new_option}','{$times}','{$price}','0')";
        }
      
    	$wpdb->query($sql); 

    	echo "<script>window.location.href=\"{$url}&act={$act}&id={$id}\"</script>"; 
           
        // if ( $old_option != $new_option ) { //如果新老数据不一样，就说明更改了   
        //     update_option( '_upload', $new_option ); //更新上数据   
        // }   
    } 

    if($_GET['act'] == 'del'){

    	if(!empty($id)){//单删
    		$wpdb->query("DELETE FROM {$table} WHERE id={$id}");
    	}else if($_POST['ids']){//多删
    		$wpdb->query("DELETE FROM {$table} WHERE id IN(".implode(',', $_POST['ids']).")");
    	}
    	
    	echo "<script>window.location.href=\"{$url}\"</script>";

    }

    /******处理数据*****/  
    echo '
    	<style>
    	.wp-list-table img,#_upload_img{
    		max-width:100px;
    		max-height:100px;
    		margin:5px;
    	}
    	#_upload_img{
    		display:none;
    	}
    	</style>
    	<div class="wrap nosubsub">
    		<h1 class="wp-heading-inline">Our Services</h1>
    		<div id="col-container" class="wp-clearfix">
		    	<div id="col-left">
			    	<div class="col-wrap">
						<div class="form-wrap">
							<form method="post" action="">
								<table class="form-table">
									<tbody>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="title">Title</label>
											</td>
											<td>
												<input name="title" type="text" id="title" value="'.$row->title.'" required="true" />
											</td>
										</tr>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="img">Img</label>
											</td>
											<td>
												<img alt="" id="_upload_img"/>		
												<input type="text" value="'.$row->img.'" name="_upload" id="_upload_input" required="true"/>
												<a id="_upload" class="_upload_button button" href="#">upload</a>
											</td>
										</tr>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="times">Times<span class="description">(mins)</span></label>
											</td>
											<td>											
												<input name="times" id="times" type="text" value="'.$row->times.'" size="40" required="true" onKeyUp="value=value.replace(/\D/g,\'\')" onafterpaste="value=value.replace(/\D/g,\'\')"/>
											</td>
										</tr>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="price">price<span class="description">(S$)</span></label>
											</td>
											<td>											
												<input name="price" id="price" type="text" value="'.$row->price.'" size="40" required="true" onkeyup="value=value.replace(/[^\d\.]/g,\'\')" />
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<input type="hidden" value="1" name="save_wp_options"/>
								    			<input type="submit" name="Submit" class="button-primary autowidth" value="Save" />
								    			<input type="button" class="button action" onclick="javascript:window.location.href=\''.admin_url().'admin.php?page=customservices\'" value="go back" />
											</td>
										</tr>
									</tbody>
								</table>								
					    	</form>
				    	</div>
					</div>
				</div>
				<div id="col-right">
					<div class="col-wrap">
						<form method="POST" action="'.$url.'&act=del">
							<table class="wp-list-table widefat fixed striped">
								<thead>
									<tr>
										<td class="manage-column column-cb check-column">
											<input type="checkbox"/>
										</td>
										<th class="manage-column column-primary">
											<span>pic</span>
										</th>
										<th class="manage-column">
											<span>title</span>
										</th>
										<th class="manage-column">
											<span>times</span>
										</th>
										<th class="manage-column">
											<span>price</span>
										</th>	
									</tr>
								</thead>
								<tbody>
								';
								foreach ($results as $key => $val):
									echo '<tr>
												<th class="check-column">
													<input type="checkbox" name="ids[]" value="'.$val->id.'"/>
												</th>
												<td class="column-primary">
													<img src="'.$val->img.'" alt=""/>
													<div class="row-actions">
														<span class="edit">
															<a href="/wp-admin/admin.php?page=customservices&act=edit&id='.$val->id.'">Edit</a> | 
														</span>
														<span class="delete">
															<a href="/wp-admin/admin.php?page=customservices&act=del&id='.$val->id.'" onClick="return confirm(\'确认要删除吗？\');">Delete</a>
														</span>
													</div>
												</td>
												<td>'.$val->title.'</td>
												<td>'.$val->times.'</td>
												<td>'.$val->price.'</td>
											</tr>
										';
								endforeach;	
							echo '</tbody>
							</table>
							<br/>
							<input type="submit" class="button action" value="Clear Choice" onClick="return confirm(\'确认要删除吗？\');"/>
							'.paginate_links( array(
							    'base' => add_query_arg( 'cpage', '%#%' ),
							    'format' => '',
							    'prev_text' => __('&laquo;'),
							    'next_text' => __('&raquo;'),
							    'total' => ceil($count / $per_page),
							    'current' => $page
							)).'
						</form>
					</div>
				</div>
			</div>
		</div>
    ';  
       
    /******以下是添加的js****/  
    wp_enqueue_media(); //在设置页面需要加载媒体中心   
    ?>   
    <script>   
    jQuery(document).ready(function(){   
    var _upload_frame;   
    var value_id;   
    jQuery('._upload_button').live('click',function(event){   
        value_id =jQuery( this ).attr('id');       
        event.preventDefault();   
        if( _upload_frame ){   
            _upload_frame.open();   
            return;   
        }   
        _upload_frame = wp.media({   
            title: 'Insert image',   
            button: {   
                text: 'Insert',   
            },   
            multiple: false   
        });   
        _upload_frame.on('select',function(){   
            attachment = _upload_frame.state().get('selection').first().toJSON(); 
            jQuery('#_upload_img').show();  
            jQuery('#_upload_img').attr('src',attachment.url).trigger('change');   
            jQuery('input[name='+value_id+']').val(attachment.url).trigger('change');   
        });   
           
        _upload_frame.open();   
    });   
    });   
    </script>   
    <?php   
    /*****js******/  
}  

add_action('admin_menu', 'register_promo_page');

function register_promo_page(){   
    add_menu_page('Special Promo', 'Special Promo', 'administrator', 'custompromo','promo_display_page', '', 201); 
}   
  
function promo_display_page(){  

	global $wpdb;

	$id = $_GET['id'];

	$table = 'rx_services';

	$sql = "SELECT * FROM {$table} WHERE type=1";

	$url = admin_url().'admin.php?page=custompromo';

	$page = isset( $_GET['cpage'] ) ? abs( (int) $_GET['cpage'] ) : 1;

	$per_page = 4;

	$cut = ($page - 1) * $per_page;

	$count = $wpdb->get_var("SELECT COUNT(*) AS total FROM {$table} WHERE type=1");

	$results = $wpdb->get_results($sql." ORDER BY id DESC LIMIT $cut,{$per_page}");

	if(!empty($id)){
		$sql = $sql." AND id={$id}";
		$row = $wpdb->get_row($sql);
	}

    /****处理数据********/  
    if ( isset( $_POST['save_wp_options'] ) ) { //save_wp_options是先前输出的隐藏域   
        $new_option = $old_option = get_option('_upload'); //获取老数据,新数据的值暂时和老数据一样   
        $new_option = $_POST['_upload']; //获取提交的数据，新数据重新赋值 

        $act = $_GET['act'];
        $id =  $_GET['id'];

        $title = trim($_POST["title"]);
        $times = trim($_POST["times"]);
        $price = trim($_POST["price"]);

        if($act == 'edit'){
        	$sql = "UPDATE rx_services SET title='{$title}',img='{$new_option}',times='{$times}',price='{$price}' WHERE id={$id}";
        }else{
        	$sql = "INSERT INTO rx_services (title,img,times,price,type)VALUES('{$title}','{$new_option}','{$times}','{$price}','1')";
        }
      
    	$wpdb->query($sql); 

    	echo "<script>window.location.href=\"{$url}&act={$act}&id={$id}\"</script>"; 
           
        // if ( $old_option != $new_option ) { //如果新老数据不一样，就说明更改了   
        //     update_option( '_upload', $new_option ); //更新上数据   
        // }   
    } 

    if($_GET['act'] == 'del'){

    	if(!empty($id)){//单删
    		$wpdb->query("DELETE FROM {$table} WHERE id={$id}");
    	}else if($_POST['ids']){//多删
    		$wpdb->query("DELETE FROM {$table} WHERE id IN(".implode(',', $_POST['ids']).")");
    	}
    	
    	echo "<script>window.location.href=\"{$url}\"</script>";

    }

    /******处理数据*****/  
    echo '
    	<style>
    	.wp-list-table img,#_upload_img{
    		max-width:100px;
    		max-height:100px;
    		margin:5px;
    	}
    	#_upload_img{
    		display:none;
    	}
    	</style>
    	<div class="wrap nosubsub">
    		<h1 class="wp-heading-inline">Special Promo</h1>
    		<div id="col-container" class="wp-clearfix">
		    	<div id="col-left">
			    	<div class="col-wrap">
						<div class="form-wrap">
							<form method="post" action="">
								<table class="form-table">
									<tbody>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="title">Title</label>
											</td>
											<td>
												<input name="title" type="text" id="title" value="'.$row->title.'" required="true" />
											</td>
										</tr>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="img">Img</label>
											</td>
											<td>
												<img alt="" id="_upload_img"/>		
												<input type="text" value="'.$row->img.'" name="_upload" id="_upload_input" required="true"/>
												<a id="_upload" class="_upload_button button" href="#">upload</a>
											</td>
										</tr>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="times">Times<span class="description">(mins)</span></label>
											</td>
											<td>											
												<input name="times" id="times" type="text" value="'.$row->times.'" size="40" required="true" onKeyUp="value=value.replace(/\D/g,\'\')" onafterpaste="value=value.replace(/\D/g,\'\')"/>
											</td>
										</tr>
										<tr class="form-field form-required">
											<td scope="row">
												<label for="price">price<span class="description">(S$)</span></label>
											</td>
											<td>											
												<input name="price" id="price" type="text" value="'.$row->price.'" size="40" required="true" onkeyup="value=value.replace(/[^\d\.]/g,\'\')" />
											</td>
										</tr>
										<tr>
											<td colspan="2">
												<input type="hidden" value="1" name="save_wp_options"/>
								    			<input type="submit" name="Submit" class="button-primary autowidth" value="Save" />
								    			<input type="button" class="button action" onclick="javascript:window.location.href=\''.admin_url().'admin.php?page=custompromo\'" value="go back" />
											</td>
										</tr>
									</tbody>
								</table>								
					    	</form>
				    	</div>
					</div>
				</div>
				<div id="col-right">
					<div class="col-wrap">
						<form method="POST" action="'.$url.'&act=del">
							<table class="wp-list-table widefat fixed striped">
								<thead>
									<tr>
										<td class="manage-column column-cb check-column">
											<input type="checkbox"/>
										</td>
										<th class="manage-column column-primary">
											<span>pic</span>
										</th>
										<th class="manage-column">
											<span>title</span>
										</th>
										<th class="manage-column">
											<span>price</span>
										</th>	
									</tr>
								</thead>
								<tbody>
								';
								foreach ($results as $key => $val):
									echo '<tr>
												<th class="check-column">
													<input type="checkbox" name="ids[]" value="'.$val->id.'"/>
												</th>
												<td class="column-primary">
													<img src="'.$val->img.'" alt=""/>
													<div class="row-actions">
														<span class="edit">
															<a href="/wp-admin/admin.php?page=custompromo&act=edit&id='.$val->id.'">Edit</a> | 
														</span>
														<span class="delete">
															<a href="/wp-admin/admin.php?page=custompromo&act=del&id='.$val->id.'" onClick="return confirm(\'确认要删除吗？\');">Delete</a>
														</span>
													</div>
												</td>
												<td>'.$val->title.'</td>
												<td>'.$val->price.'</td>
											</tr>
										';
								endforeach;	
							echo '</tbody>
							</table>
							<br/>
							<input type="submit" class="button action" value="Clear Choice" onClick="return confirm(\'确认要删除吗？\');"/>
							'.paginate_links( array(
							    'base' => add_query_arg( 'cpage', '%#%' ),
							    'format' => '',
							    'prev_text' => __('&laquo;'),
							    'next_text' => __('&raquo;'),
							    'total' => ceil($count / $per_page),
							    'current' => $page
							)).'
						</form>
					</div>
				</div>
			</div>
		</div>
    ';  
       
    /******以下是添加的js****/  
    wp_enqueue_media(); //在设置页面需要加载媒体中心   
    ?>   
    <script>   
    jQuery(document).ready(function(){   
    var _upload_frame;   
    var value_id;   
    jQuery('._upload_button').live('click',function(event){   
        value_id =jQuery( this ).attr('id');       
        event.preventDefault();   
        if( _upload_frame ){   
            _upload_frame.open();   
            return;   
        }   
        _upload_frame = wp.media({   
            title: 'Insert image',   
            button: {   
                text: 'Insert',   
            },   
            multiple: false   
        });   
        _upload_frame.on('select',function(){   
            attachment = _upload_frame.state().get('selection').first().toJSON(); 
            jQuery('#_upload_img').show();  
            jQuery('#_upload_img').attr('src',attachment.url).trigger('change');   
            jQuery('input[name='+value_id+']').val(attachment.url).trigger('change');   
        });   
           
        _upload_frame.open();   
    });   
    });   
    </script>   
    <?php   
    /*****js******/  
}  