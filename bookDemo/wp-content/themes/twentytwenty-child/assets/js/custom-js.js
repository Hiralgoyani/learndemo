var page = 2;
jQuery(function($) {
	// load more for podcast
    var smpl_cnt = 1;
    var post_cnt = jQuery('#post_cnt').val();
   
    // load more books ajax calling
    $('body').on('click', '.pcloadmore', function() {
        var data = {
            'action': 'load_pcposts_by_ajax',
            'page': page,
            'security': books.security
        };
 
        $.post(books.ajaxurl, data, function(response) {
           if(response.match(/[a-z]/i)){
                $('.pcblog-postss').append(response);
                page++;   
                if(post_cnt <= smpl_cnt){
                    $('.pcloadmore').hide();    
                }else{
                    smpl_cnt = smpl_cnt + 1;            
                }
            }else{                 
                $('.pcloadmore').hide();    
            }            
        });
    });

    // ajax call for retrive books based on tag
    jQuery(document).on('click','#custTagID', function(){
    	var dataTagID =  jQuery(this).attr('datatagid');
    	
    	var data = {
            'action': 'book_get_by_tag',
            'dataId': dataTagID,
            'security': books.security
        };
 
        $.post(books.ajaxurl, data, function(response) {
        	$('.pc-books').empty();
            $('.pcblog-postss').append(response); 
            $('.pcloadmore').hide();                       
        });
    });
});