$(document).ready(function() {

	$('#share_link_input').val(share_link);
	url = share_link;
	$('.sharethis-inline-share-buttons').attr('data-url', share_link);
	
	$('#search_button').click(function() {
		$('#search_mobile').toggle({ effect: "scale", direction: "horizontal" });
	})
		
}); 

function copyClipboard() {
	var copyText = document.getElementById("share_link_input");
	copyText.select();
	document.execCommand("copy");

	var tooltip = document.getElementById("myTooltip");
	tooltip.innerHTML = "Copied: " + copyText.value;
}

function outFunc() {
	var tooltip = document.getElementById("myTooltip");
	tooltip.innerHTML = "Copy to clipboard";
}