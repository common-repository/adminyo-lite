/*Display Action button on scroll*/
jQuery('.menuhold').hide();
/* FAB actions  */
jQuery(document).ready(function($){
/*Normal FAB*/
//scroll back to top
$('#backtotop').click(function(){
		$('html, body').animate({ scrollTop : 0 }, 800);
		return false;
	});
//Scroll to bottom	
	$('#backtobottom').click(function(){
	//console.log("meree")
		$('html, body').animate({ scrollTop: $(document).height() }, 1000);
		return false;
	});
//scroll back to bottom
$('.dash_icon_bottom').click(function(){
		$('html, body').animate({ scrollTop : $(document).height() }, 1500);
		return false;
	});		
});
//publish button simulate
function updatepost() {
    jQuery('#publish').click();
};
//save to draft
function savetodraft() {
    jQuery('#save-post').click();
};
//END of file