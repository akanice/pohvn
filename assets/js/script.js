$(document).ready(function() {

	$('#share_link_input').val(share_link);
	url = share_link;
	$('.sharethis-inline-share-buttons').attr('data-url', share_link);
	
	$('#search_button').click(function() {
		$('#search_mobile').toggle({ effect: "scale", direction: "horizontal" });
	})
	
	// new_url = $('.article-content a').attr("href").replace(/\/$/, "");
	// $('.article-content a').attr("href", new_url);
	$('.article-content a').each(function(){
		$(this).attr("href").replace(/\/$/, "");
	});

	$("a[href^='http']:not([href*='poh.vn'])").attr("rel", "nofollow");
	
	$('#btn_expand.expand').click(function() {
		$('.short_info').toggleClass('active',1000, "easeOutSine");
		var text = $(this).text();console.log(text);
		$(this).text(text == "Thu gọn -" ? "Xem thêm +" : "Thu gọn -");
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

function killCopy(e){
	return false;
}
function reEnable(){
	return true;
}
document.onselectstart = new Function ("return false")
if (window.sidebar){
	document.onmousedown=killCopy
	document.onclick=reEnable
}