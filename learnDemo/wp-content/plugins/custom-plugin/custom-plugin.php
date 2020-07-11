<?php
   /*
   Plugin Name: CRUD Demo
   Plugin URI: http://my-awesomeness-emporium.com
   description: Custom plugin for CRUD demo
   Version: 1.2
   Author: Hiral Goyani
   Author URI: http://mrtotallyawesome.com
   License: GPL2
   */
  

//  constant define
define('PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ));
define('PLUGIN_URL', plugin_dir_url( __FILE__ ));

// enqueue css and js
function wp_enqueue_fun(){

	// enqueue css
	wp_register_style('custom-css', PLUGIN_URL.'assets/css/custom-style.css');
	wp_enqueue_style('custom-css');

	$current_url =  $_SERVER['QUERY_STRING']; 
	if( $current_url == 'page=custom-plugin'){
		//  font awesome css
		wp_register_style('font-awesome-css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
		wp_enqueue_style('font-awesome-css');

		// bootstreap modal css and js
		wp_register_style('boot-css', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css');
		wp_enqueue_style('boot-css');

		wp_register_script( 'boot-js', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js', array( 'jquery' ), '3.4.1', true );
		wp_enqueue_script( 'boot-js' );
	}
	
	// enqueue js
	wp_register_script( 'custom-js1212', PLUGIN_URL."assets/js/custom-js.js", array( 'jquery' ), '1.0', false );
	wp_enqueue_script( 'custom-js1212' );

	// localize script
	wp_localize_script( 'custom-js1212', 'admin_ajax1', ['ajax_url' => admin_url('admin-ajax.php')] );	
}
add_action( 'wp_enqueue_scripts', 'wp_enqueue_fun' );
add_action( 'admin_enqueue_scripts', 'wp_enqueue_fun' );


//  create custom table
function create_plugin_database_table() {
 global $wpdb;
 $table_name = $wpdb->prefix . 'custom_table';
 if(count($wpdb->get_var('SHOW TABLES LIKE $table_name')) == 0){
 $sql = "CREATE TABLE $table_name (
 id mediumint(9) NOT NULL AUTO_INCREMENT,
 name varchar(150) NOT NULL,
 email varchar(150) NOT NULL,
 password varchar(100) NOT NULL,
 city varchar(100) NOT NULL,
 dob date NOT NULL,
 gender varchar(10) NOT NULL,
 hobbies text NOT NULL,
 profile text NOT NULL,
 create_at timestamp NOT NULL,
 PRIMARY KEY (id)
);";
}

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
}
register_activation_hook( __FILE__, 'create_plugin_database_table' );

// Delete custom table, When plugin will deactive
// function deactive_table(){
// 	// unistall mysql code
// 	global $wpdb;
// 	$wpdb->query('DROP table IF EXISTS `wp_custom_table`');

// 	// get dynamic created page id and remove the page from the post table
// 	$get_the_post_ID = get_option( 'custom_dynamic_page_id' );
// 	if(!empty($get_the_post_ID)){
// 		wp_delete_post($get_the_post_ID, true);
// 	}

// }
// register_deactivation_hook( __FILE__, 'deactive_table' );


// fetch data from employee table
add_action( 'wp_ajax_getEmpdata', 'getEmpdata' );
add_action( 'wp_ajax_nopriv_getEmpdata', 'getEmpdata' );
function getEmpdata() {
  	global $wpdb;
    $tablename = $wpdb->prefix.'custom_table';
    
    $return_json = array();
    $qqq = "SELECT * FROM " . $tablename ;
    $emp_data = $wpdb->get_results($qqq);
    foreach ($emp_data as $empdata) {
   		$return_json[] = $empdata;
  	}
  //return the result to the ajax request and die
  echo json_encode(array('data' => $return_json));
  wp_die();
} 

// fetch employee details by employee ID
add_action( 'wp_ajax_emp_select_by_ID', 'emp_select_by_ID' );
add_action( 'wp_ajax_nopriv_emp_select_by_ID', 'emp_select_by_ID' );
function emp_select_by_ID() {
  	global $wpdb;
  	$tablename = $wpdb->prefix.'custom_table';
    
    $return_json = array();
    $qqq = "SELECT * FROM " . $tablename . " where id = " . $_POST['dataId'];
    $emp_data = $wpdb->get_results($qqq);
    foreach ($emp_data as $empdata) {
   		$return_json[] = $empdata;
  	}
  //return the result to the ajax request and die
  echo json_encode(array('data' => $return_json));
  wp_die();
} 


// delete employee by ID
add_action( 'wp_ajax_emp_del_by_ID', 'emp_del_by_ID' );
add_action( 'wp_ajax_nopriv_emp_del_by_ID', 'emp_del_by_ID' );
function emp_del_by_ID() {
  	global $wpdb;
  	$tablename = $wpdb->prefix.'custom_table';
    
    $return_json = array();
    $qqq = "DELETE FROM " . $tablename . " where id = " . $_POST['dataId'];
    $wpdb->query($qqq);  
  	echo json_encode(1);
  wp_die();
} 


// create admin menu
function add_my_custom_menu(){
	add_menu_page('customplugin', 'Custom Plugin', 'manage_options', 'custom-plugin', 'custom_admin_view', 'dashicons-buddicons-activity', 11 );

	// add_submenu_page( 'custom-plugin', 'Add new', 'Add new', 'manage_options', 'custom-sub-menu1', 'custom_admin_subview1' );	
}
add_action( 'admin_menu', 'add_my_custom_menu' );

function custom_admin_view(){
	?>
		<div class="container cust-wrapper">
		    <div class="row">    
		        <table id="empData" class="display nowrap" width="100%">
		                <thead>
		                    <tr>
		                        <th>Name</th>
		                        <th>Email</th>
		                        <th>City</th>
		                        <th>DOB</th>
		                        <th>Gender</th>
		                        <th>Hobbies</th>
		                        <th>Profile</th>
		                        <th>Created</th>
		                        <th>Delete</th>
		                        <th>Update</th>
		                    </tr>
		                </thead>
		                <tbody></tbody>
		                
		                <tfoot>
		                    <tr>
		                        <th>Name</th>
		                        <th>Email</th>
		                        <th>City</th>
		                        <th>DOB</th>
		                        <th>Gender</th>
		                        <th>Hobbies</th>
		                        <th>Profile</th>
		                        <th>Delete</th>
		                        <th>Update</th>
		                    </tr>
		                </tfoot>
		        </table>
		    </div>
		</div>

  <div class="modal fade custom-modal" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Profile</h4>
        </div>
        <div class="modal-body aut-model-body">
        	<div class="reg-form-container">
			<form method="post" action="#" id="upregEmpForm" enctype="multipart/form-data" >
				<div class="form-control">
					<label>Name</label>
					<input type="hidden" name="uemp_id" id="uemp_id" class="uemp-id input-control" required />
					<input type="text" name="uemp_name" id="uemp_name" class="uemp-name input-control" required />
				</div>

				<div class="form-control">
					<label>Email</label>
					<input type="email" name="uemp_email" id="uemp_email" class="uemp-email input-control" required />
				</div>

				<div class="form-control">
					<label>DOB</label>
					<input type="date" name="uemp_dob" id="uemp_dob" class="uemp-dob input-control" required />
				</div>

				<div class="form-control">
					<label>City</label>
					<select name="uemp_city" id="uemp_city" class="uemp-city input-control" required>
						<option value="">--Choose city--</option>
						<option value="surat">Surat</option>
						<option value="mumbai">Mumbai</option>
						<option value="goa">Goa</option>
					</select>
				</div>

				<div class="form-control">
					<label>Gender</label>
					<input type="radio" name="uemp_gender" value="M" id="uemp_gender1" class="uemp-gender input-control" checked="" /> Male
					<input type="radio" name="uemp_gender" value="F" id="uemp_gender2" class="uemp-gender input-control" /> Female
				</div>

				<div class="form-control">
					<label>Hobbies</label>
					<input type="checkbox" name="uemp_hbs[]" value="cricket" id="uemp_hbs1" class="uemp-hbs input-control"> Cricket
					<input type="checkbox" name="uemp_hbs[]" value="football" id="uemp_hbs2" class="uemp-hbs input-control"> Football
					<input type="checkbox" name="uemp_hbs[]" value="carrom" id="uemp_hbs3" class="uemp-hbs input-control"> carrom
				</div>

				<div class="form-control">
					<label style="float: left;">Profile</label>
					<img src="" id="upImage" width="10%" />
					<input type="file" name="uemp_profile" id="uemp_profile" class="uemp-profile input-control" required />
				</div>

				<div class="form-control sub-btn-div">
					<label></label>
					<button type="button" name="uemp_sub" id="uemp_sub" class="uemp-sub input-control">Update</button>
				</div>
			</form>
		</div>  
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

		<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
		<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css">
		<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>
		<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
		 
		<script type="text/javascript">
		jQuery(document).ready( function () {

		   var jobtable = jQuery('#empData').DataTable({
		    scrollX: true,
		    ajax: {
		      url: admin_ajax1.ajax_url + '?action=getEmpdata'
		    },
		    columns: [
		        { data: 'name' },
		        { data: 'email' },
		        { data: 'city' },
		        { data: 'dob' },
		        { data: 'gender' },
		        { data: 'hobbies' },
		        { data: 'profile' },
		        { data: 'create_at' },
		        { data: 'id' },
		        { data: 'id' },
		    ],
		    columnDefs: [
		        {
		            targets: 2,
		            className: "text-capi",
		        },
		        {
		            targets: 5,
		            className: "hobs-listing text-capi",
		            render: function (data, type, row) {
		                var hbs_array = data.replace(/,/g,"<br/>");
		                return hbs_array;
		            },
		        },
		        {
		            targets: 6,
		            className: "emp-gender",
		            render: function (data, type, row) {
		                return '<img src="http://localhost/learnDemo/wp-content/uploads/employee/'+ data +'" style="width:100px;" />';    
		            },
		        },
		        {
		            targets: 8,
		            render: function (data, type, row) {
		                return '<i class="fa fa-trash font-icon-size empDel" data-delID="'+data+'"></i>';    
		            },
		        },
		        {
		            targets: 9,
		            render: function (data, type, row) {
		                return '<i class="fa fa-pencil font-icon-size empUpdt" data-upID="'+data+'"></i>';    
		            },
		        },
		    ]
		  });

		} );
		</script>
	<?php
}

// get upload path
function get_upload_path2($par){
	$upload_path_ary = wp_upload_dir();
	return $upload_path_ary['basedir'] . "/" . $par . "/";
}

// Insert employee
function emp_update_data_callback(){
	global $wpdb;
	$result = 0;
	$tablename = $wpdb->prefix.'custom_table';

	if($_FILES['emp_profile']['name'] != ""){

		$filename = uniqid().$_FILES['emp_profile']['name'];
	
   		$arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg');
		if (in_array($_FILES['emp_profile']['type'], $arr_img_ext)) {
			  	// file upload
		    	move_uploaded_file($_FILES['emp_profile']['tmp_name'], get_upload_path2('employee').$filename);
				// update with profile inside table			
				$wpdb->update($tablename,array(
					'name' => $_POST['emp_name'],
					'email' => $_POST['emp_email'],
					'city' => $_POST['emp_city'],
					'dob' => $_POST['emp_dob'],
					'gender' => $_POST['emp_gender'],
					'hobbies' => $_POST['ary_hbs'],
					'profile' => $filename,
					), array('id'=>$_POST['uemp_id'])
				);
				$result = 2;
	    }else{
	    	$result = 1;
	    }
	}
	else{
		// update without profile inside table			
		$wpdb->update($tablename,array(
			'name' => $_POST['emp_name'],
			'email' => $_POST['emp_email'],
			'city' => $_POST['emp_city'],
			'dob' => $_POST['emp_dob'],
			'gender' => $_POST['emp_gender'],
			'hobbies' => $_POST['ary_hbs'],
			), array('id'=>$_POST['uemp_id'])
		);
		$result = 2;
	}
    echo json_encode($result);
	die();
}
add_action( 'wp_ajax_emp_update_data', 'emp_update_data_callback' );
add_action( 'wp_ajax_nopriv_emp_update_data', 'emp_update_data_callback' );

