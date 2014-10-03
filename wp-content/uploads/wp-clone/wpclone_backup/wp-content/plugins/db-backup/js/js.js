var jq = jQuery.noConflict();
jq(document).ready(function() {
	jq('#am_csv').submit(function(){
		if( null == jq('#am_csv_tbl').val() ) {
			show_alert( 'Please select atleast one table.' );
			return false;
		}else if( !jq('#am_option_csv').is(":checked") && !jq('#am_option_ex').is(":checked") ) {
			show_alert( 'Please select on of the options ( "Make CSV" or "Export" )' );
			return false;
		}else if( jq('#am_option_ex').is(":checked") ) {
			if( !jq('#ex_struct').is(':checked') && !jq('#ex_data').is(':checked') ) {
				show_alert( 'Please select Export option ( "Structure" or "Data" )' );
				return false;
			}else{
				passToAjax();
			}
		}else{
			passToAjax();
		}
	});
	
	jq('#am_csv_tbl').click(function(){
		jq('#csv_comp_bkp').removeAttr("checked");
	});
	
	jq('#csv_comp_bkp').click(function(){
		if( jq('#csv_comp_bkp').is(":checked") ){
			jq("#am_csv_tbl").children().each(function () { jq(this).attr("selected", "selected"); });
		}
	});

	jq('#am_saveAs_option').click(function(){
		jq('#am_saveAs_fileName').prop("disabled", !jq(this).is(":checked"));
		jq('#am_saveAs_zip').prop("disabled", !jq(this).is(":checked"));
	});
	
	jq('#am_option_csv').click(function(){
		jq('#ex_struct').removeAttr("checked");
		jq('#ex_data').removeAttr("checked");
	});
	jq('#csv_inc_col').click(function(){
		jq('#am_option_csv').trigger('click');
	});
	jq('#am_option_ex').click(function(){
		jq('#csv_inc_col').prop("checked", false);
	});
	jq('#ex_struct').click(function(){
		jq('#am_option_ex').trigger('click');
	});
	jq('#ex_data').click(function(){
		jq('#am_option_ex').trigger('click');
	});
	
});

var show_alert = function( msg ) {
	jq('.am_csv_alerts').show();
	jq('.am_csv_alerts').html( msg );
	setTimeout(function(){ jq('.am_csv_alerts').fadeOut(); },5000);
}
var passToAjax = function(){
	var values = jq('#am_csv').serialize();
	var ajaxobject = {
		action: 'myAjax',
		data: values					      // We pass php values differently!
	};
	jq.post(ajaxurl, ajaxobject, function(response) {
		jq('.am_csv_output').html( response );
		jq('.am_csv_output').show();
	});
    return false; 
}