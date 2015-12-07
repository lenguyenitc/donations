(function($){
    "use strict";
    var zoDummyData = function(current_data,p,theme){
    	$.ajax({
            type: 'POST',
            url: ajaxurl,
            data: {
                'action': 'zodummy',
                'current_data':  current_data,
                'theme' : theme
            },
            success: function(data, textStatus, XMLHttpRequest){
                $('.zo-dummy-process-bar').css({
                    'width':p+'%',
                    '-webkit-transition':'width 1s',
                    'transition':'width 1s'
                });
                $('#zo-msg .zo-status').text(' Loading '+p+'%');
                if(isNaN(current_data)){
                    $('#zo-msg').parent().css('width','100%');
                    $('#zo-msg').append(data);
                }
                if(current_data=='grid'){
                    p+=5;
                    zoDummyData(15,p,theme);
                }
                if(current_data>1 && current_data<16){
                    zoDummyData(current_data-1,p+5,theme);
                }
                if(current_data==1){
                    zoDummyData(16,100,theme);
                }
                if(current_data==16){
                    $('#zo-msg').parent().css('width','100%');
                    $('#zo-msg .zo-status').text(' Loading 100%');
                    $('#zo-msg').append(data);
                }
            }
        });
    }
    $(document).ready(function(){
    	$("#dummy-data").on("click",function(){
    		var r = confirm("Are you want import the demo data?");
        	if(r == true){
        		$('.zo-dummy-process').show();
	            var theme = $('#smof_data-theme .redux-image-select-selected').find('input').val();
	            $(this).attr('disabled','true');
	            $('#zo-msg .zo-status').text(' Loading ');
	            var p = 0;
	            var arr = ["options","widget","slider","grid"];
	            arr.forEach(function(entry){
	                p+=5;
	                zoDummyData(entry,p,theme);
	            });
        	}
    	});
    });
})(jQuery)