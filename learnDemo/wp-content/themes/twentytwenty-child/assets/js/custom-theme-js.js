jQuery(document).ready(function() {
	
	jQuery(document).on('click','#emp_sub', function(){
		var emp_name = jQuery('#emp_name').val();
		var emp_email = jQuery('#emp_email').val();
		var emp_password = jQuery('#emp_password').val();
		var emp_dob = jQuery('#emp_dob').val();
		var emp_city = jQuery('#emp_city option:selected').val();
		var emp_gender = jQuery('input[name="emp_gender"]:checked').val();
		
		var ary_hbs = [];
		jQuery("input[name='emp_hbs[]']:checked").each(function() {
            ary_hbs.push(jQuery(this).val());
        });

		var emp_profile = jQuery('#emp_profile').prop('files')[0];

		jQuery('span.emp-name').remove();
		if (emp_name.length == 0) {
			jQuery('.emp-name').after('<span class="red emp-name">Required</span>');
			emp_name_err = 1;
		}else{	
			var regName = /^[a-zA-Z ]+$/;
			if(!regName.test(emp_name)){
				jQuery('.emp-name').after('<span class="red emp-name">Name must have alphabets and space</span>');
				emp_name_err = 1;
			}else{
			    emp_name_err = 0;
			}	
		}

		jQuery('span.emp-email').remove();
		if (emp_email.length == 0) {
			jQuery('.emp-email').after('<span class="red emp-email">Required</span>');
			emp_email_err = 1;
		}else{	
			var regEmail = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,7}|[0-9]{1,3})(\]?)$/;
			if(!regEmail.test(emp_email)){
				jQuery('.emp-email').after('<span class="red emp-name">Enter valid email format</span>');
				emp_email_err = 1;
			}else{
			    emp_email_err = 0;
			}	
		}

		jQuery('span.emp-password').remove();
		if (emp_password.length == 0) {
			jQuery('.emp-password').after('<span class="red emp-name">Required</span>');
			emp_password_err = 1;
		}else{	
			var password = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
			if(!password.test(emp_password)){
				jQuery('.emp-password').after('<span class="red emp-password">Minimum eight characters, at least one uppercase letter, one lowercase letter, one number and one special character</span>');
				emp_password_err = 1;
			}else{
			    emp_password_err = 0;
			}	
		}

		jQuery('span.emp-dob').remove();
		if (emp_dob.length == 0) {
			jQuery('.emp-dob').after('<span class="red emp-dob">Required</span>');
			emp_dob_err = 1;
		}else{	
			emp_dob_err = 0;			
		}

		jQuery('span.emp-city').remove();
		if (emp_city.length == 0) {
			jQuery('.emp-city').after('<span class="red emp-city">Required</span>');
			emp_city_err = 1;
		}else{	
			emp_city_err = 0;			
		}

		jQuery('span.emp-profile').remove();
		if (document.getElementById("emp_profile").files.length == 0) {
			jQuery('.emp-profile').after('<span class="red emp-profile">Required</span>');
			emp_profile_err = 1;
		}else{	
			emp_profile_err = 0;			
		}
		
		// ajax calling for insertion
		if (emp_name_err == 0 && emp_email_err == 0 && emp_password_err == 0 && emp_dob_err == 0
			&& emp_city_err == 0 && emp_profile_err == 0) {
			
			var form_data = new FormData();
	        form_data.append('action', 'emp_insert_data');
	        form_data.append('emp_name', emp_name);
	        form_data.append('emp_email', emp_email);
	        form_data.append('emp_password', emp_password);
	        form_data.append('emp_dob', emp_dob);
	        form_data.append('emp_city', emp_city);
	        form_data.append('emp_gender', emp_gender);
	        form_data.append('ary_hbs', ary_hbs);
	        form_data.append('emp_profile', emp_profile);
	        console.log('form data : '+form_data);

        	jQuery.ajax({
	            url: admin_ajax_theme.ajax_url_theme,
	            type: 'POST',
	            contentType: false,
	            processData: false,
	            data: form_data,
	            success: function (response) {
	                jQuery(':input','#regEmpForm') .not(':button, :submit, :reset, :hidden') .val('') .prop('checked', false) .prop('selected', false);
  					jQuery('#emp_gender1').prop('checked', true);
	                if(response == 1){
	                	alert('File Upload error');
	                }else{
	                	alert('Insert successfully!!!');
	                }
	            }
	        });	
        }

	});

});