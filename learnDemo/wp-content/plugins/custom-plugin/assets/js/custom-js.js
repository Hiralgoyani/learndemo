jQuery(document).on('click','.empDel', function(){
    var dataId =  jQuery(this).attr('data-delID');
    // console.log('Up ID : '+dataId);

    jQuery.ajax({
        url: admin_ajax1.ajax_url,
        type: 'POST',
        data : {
            action:'emp_del_by_ID',
            dataId: dataId,
        },
        async : false,
        success: function (response) {
           alert('Delete Sucessfully!...');
           location.reload();
        }
    });     

});

jQuery(document).on('click','.empUpdt', function(){
// jQuery(':input','#upregEmpForm')
//   .not(':button, :submit, :reset, :hidden')
//   .val('')
//   .removeAttr('checked')
//   .removeAttr('selected');
  
  jQuery('#uemp_hbs1').prop('checked', false);
  jQuery('#uemp_hbs2').prop('checked', false);
  jQuery('#uemp_hbs3').prop('checked', false);

	var dataId =  jQuery(this).attr('data-upID');
	
	jQuery.ajax({
        url: admin_ajax1.ajax_url,
        type: 'POST',
        data : {
        	action:'emp_select_by_ID',
        	dataId: dataId,
        },
        async : false,
        success: function (response) {
            jQuery('#myModal').modal('show');
            var emp_obj = JSON.parse(response);
            var emp_data = emp_obj['data'][0];
            jQuery('#uemp_id').val(dataId);
            jQuery('#uemp_name').val(emp_data['name']);
            jQuery('#uemp_email').val(emp_data['email']);
            jQuery('#uemp_dob').val(emp_data['dob']);
            if(emp_data['city'] == 'surat'){
                jQuery("select option[value='surat']").attr("selected","selected");
            }else if(emp_data['city'] == 'mumbai'){
                jQuery("select option[value='mumbai']").attr("selected","selected");                
            }else{
                jQuery("select option[value='goa']").attr("selected","selected");                
            }

            if(emp_data['gender'] == "F"){
                jQuery("#uemp_gender2").prop("checked", true);
            }else{
                jQuery("#uemp_gender1").prop("checked", true);
            }

            var hbs_arr = emp_data['hobbies'].split(',');
            if(hbs_arr[0] == "cricket" || hbs_arr[1] == "cricket" || hbs_arr[2] == "cricket" ){
                jQuery("#uemp_hbs1").prop("checked", true);
            }
            if(hbs_arr[0] == "football" || hbs_arr[1] == "football" || hbs_arr[2] == "football" ){
                jQuery("#uemp_hbs2").prop("checked", true);
            }
            if(hbs_arr[0] == "cricket" || hbs_arr[1] == "football" || hbs_arr[2] == "carrom" ){
                jQuery("#uemp_hbs3").prop("checked", true);
            }

            var pro_path = 'http://localhost/learnDemo/wp-content/uploads/employee/'+emp_data['profile'];
            jQuery("#upImage").attr("src", pro_path);
            // jQuery('#').val();
            // jQuery('#').val();
            // jQuery(".aut-model-body").append(response);
        }
    });	
});

jQuery(document).on('click','#uemp_sub', function(){
        var uemp_id = jQuery('#uemp_id').val();
        var emp_name = jQuery('#uemp_name').val();
        var emp_email = jQuery('#uemp_email').val();
        var emp_dob = jQuery('#uemp_dob').val();
        var emp_city = jQuery('#uemp_city option:selected').val();
        var emp_gender = jQuery('input[name="uemp_gender"]:checked').val();
        
        var ary_hbs = [];
        jQuery("input[name='uemp_hbs[]']:checked").each(function() {
            ary_hbs.push(jQuery(this).val());
        });

        console.log('id : '+uemp_id);
        console.log('name : '+emp_name);
        console.log('email : '+emp_email);
        console.log('dob : '+emp_dob);
        console.log('city : '+emp_city);
        console.log('gender : '+emp_gender);
        console.log('hbs : '+ary_hbs);

        jQuery('span.uemp-name').remove();
        if (emp_name.length == 0) {
            jQuery('.uemp-name').after('<span class="red uemp-name">Required</span>');
            emp_name_err = 1;
        }else{  
            var regName = /^[a-zA-Z ]+$/;
            if(!regName.test(emp_name)){
                jQuery('.uemp-name').after('<span class="red uemp-name">Name must have alphabets and space</span>');
                emp_name_err = 1;
            }else{
                emp_name_err = 0;
            }   
        }

        jQuery('span.uemp-email').remove();
        if (emp_email.length == 0) {
            jQuery('.uemp-email').after('<span class="red uemp-email">Required</span>');
            emp_email_err = 1;
        }else{  
            var regEmail = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,7}|[0-9]{1,3})(\]?)$/;
            if(!regEmail.test(emp_email)){
                jQuery('.uemp-email').after('<span class="red uemp-name">Enter valid email format</span>');
                emp_email_err = 1;
            }else{
                emp_email_err = 0;
            }   
        }

        jQuery('span.uemp-dob').remove();
        if (emp_dob.length == 0) {
            jQuery('.uemp-dob').after('<span class="red uemp-dob">Required</span>');
            emp_dob_err = 1;
        }else{  
            emp_dob_err = 0;            
        }

        jQuery('span.uemp-city').remove();
        if (emp_city.length == 0) {
            jQuery('.uemp-city').after('<span class="red uemp-city">Required</span>');
            emp_city_err = 1;
        }else{  
            emp_city_err = 0;           
        }
        
        // // ajax calling for insertion
        if (emp_name_err == 0 && emp_email_err == 0 && emp_dob_err == 0
            && emp_city_err == 0 ) {
            
            var form_data = new FormData();
            form_data.append('action', 'emp_update_data');
            form_data.append('uemp_id', uemp_id);
            form_data.append('emp_name', emp_name);
            form_data.append('emp_email', emp_email);
            form_data.append('emp_dob', emp_dob);
            form_data.append('emp_city', emp_city);
            form_data.append('emp_gender', emp_gender);
            form_data.append('ary_hbs', ary_hbs);
            if (document.getElementById("uemp_profile").files.length != "") {
                var emp_profile = jQuery('#uemp_profile').prop('files')[0];
                form_data.append('emp_profile', emp_profile);
            }
            // console.log('form data : '+form_data);

            jQuery.ajax({
                url: admin_ajax1.ajax_url,
                type: 'POST',
                contentType: false,
                processData: false,
                data: form_data,
                success: function (response) {
                    if(response == 1){
                        alert('File Upload error');
                    }else{
                        alert('Update successfully!!!');
                        jQuery('#myModal').modal('hide');
                        location.reload();
                    }
                }
            }); 
        }

    });