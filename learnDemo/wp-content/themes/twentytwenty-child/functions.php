<?php
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

 	wp_register_style('custom-theme-css', get_stylesheet_directory_uri() .'/assets/css/custom-theme-css.css');
	wp_enqueue_style('custom-theme-css');

	// enqueue js
	wp_register_script( 'custom-theme-js', get_stylesheet_directory_uri()  . '/assets/js/custom-theme-js.js', array( 'jquery' ) );
	wp_enqueue_script( 'custom-theme-js' );

	// localize script
	wp_localize_script( 'custom-theme-js', 'admin_ajax_theme', ['ajax_url_theme' => admin_url('admin-ajax.php')] );	
}

// get upload path
function get_upload_path($par){
	$upload_path_ary = wp_upload_dir();
	return $upload_path_ary['basedir'] . "/" . $par . "/";
}

// Insert employee
function emp_insert_data_callback(){
	global $wpdb;
	$result = 0;
	$tablename = $wpdb->prefix.'custom_table';
	$filename = uniqid().$_FILES['emp_profile']['name'];
	
   	$arr_img_ext = array('image/png', 'image/jpeg', 'image/jpg');
	if (in_array($_FILES['emp_profile']['type'], $arr_img_ext)) {
		  	// file upload
	    	move_uploaded_file($_FILES['emp_profile']['tmp_name'], get_upload_path('employee').$filename);
			// insert inside table
			$wpdb->insert($tablename,array(
				'name' => $_POST['emp_name'],
				'email' => $_POST['emp_email'],
				'password' => wp_hash_password($_POST['emp_password']),
				'city' => $_POST['emp_city'],
				'dob' => $_POST['emp_dob'],
				'gender' => $_POST['emp_gender'],
				'hobbies' => $_POST['ary_hbs'],
				'profile' => $filename,
				'create_at' => date("Y-m-d H:i:s"),
				),
			);
			$result = 2;
    }else{
    	$result = 1;
    }
    echo json_encode($result);
	die();
}
add_action( 'wp_ajax_emp_insert_data', 'emp_insert_data_callback' );
add_action( 'wp_ajax_nopriv_emp_insert_data', 'emp_insert_data_callback' );

