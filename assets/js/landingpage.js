//Custom Javascript for POH Theme - CRTeam

//vietth - Ajax calculate date 
jQuery( document ).ready(function($) {
	
	// Smooth scroll
	$(".scroll").click(function(event){
		event.preventDefault();
		//calculate destination place
		var dest=0;
		if($(this.hash).offset().top > $(document).height()-$(window).height()){
			dest=$(document).height()-$(window).height()-100;
		}else{
			dest=$(this.hash).offset().top-100;
		}
	//go to destination
	$('html,body').animate({scrollTop:dest}, 1000,'swing');
	});
	
	$('#share_link_input').val(share_link) ;
	// Set and Get Cookies
	if (typeof poh_affiliate_slug === 'undefined' || poh_affiliate_slug === null) {
		poh_affiliate_cookie = $.cookie('poh_affiliate');
		// console.log(poh_affiliate_cookie);
		if (typeof poh_affiliate_cookie === 'undefined' || poh_affiliate_cookie === null) {			
			$.cookie("poh_affiliate", null, { expires: cookies_expires });
			$("input[name=poh_affiliate_id]").val(0);
			$("input[name=poh_affiliate]").val(0);
		} else {
			$("input[name=poh_affiliate_id]").val(poh_affiliate_cookie);
			$("input[name=poh_affiliate]").val(poh_affiliate_cookie);
		}
	} else {
		$.cookie("poh_affiliate", poh_affiliate_slug, { expires: cookies_expires });
		// var poh_affiliate_id = $.cookie("poh_affiliate_id");	
		$("input[name=poh_affiliate_id]").val(poh_affiliate_slug);
		$("input[name=poh_affiliate]").val(poh_affiliate_slug);
	}

	
	$(function(){
		// Calculate Date
		$('#calculate_date').on('submit', function(e) {
			e.preventDefault();
			$('.spinner').show();
			var first_date = $('#first_date_1').val();
			var id = post_id;
			// alert(id);
			
			$.ajax({
				type: "POST",
				url: site_url + "ajax/calculate_date",
				data: { first_date : first_date, id:id},
				dataType: 'JSON',
				cache: false,
				success: function(response){
					$('.spinner').hide();
					$('.result_text').show();
					$('#remain_days').html(response.print_text);
					$('#duration_days').html(response.duration_days);
					if (response.package_1) {
						$('#package1_price').html(response.package_1);
						$('#total_price').html(response.package_1);
						$('#package_price_value').val(response.package_1);
					}
					$('#customer_pre_birth').val(response.first_date);
					console.log(response);
				}
			});
		});
		
		// Process after submit form at LandingPage
		$('#register_course').on('submit', function(e) {
			e.preventDefault();
			$('.spinner_loading').show();
			var name = $("input[name=your-name]").val();
			var email = $("input[name=your-email]").val();
			var phone = $("input[name=your-phone]").val();
			var pre_birth = $("input[name=your-pre-birth]").val();
			var address = $("input[name=your-address]").val();
			var message = $("textarea[name=your-message]").val();
			var poh_affiliate = $("input[name=poh_affiliate]").val();
			var package_price_value = $("input[name=package_price_value]").val();
			var id = post_id;
			
			$.ajax({
				type: "POST",
				url: site_url + "ajax/register_course",
				data: { name : name, id:id, email:email, pre_birth:pre_birth, address:address, message:message, poh_affiliate:poh_affiliate, package_price_value:package_price_value, phone:phone},
				dataType: 'JSON',
				cache: false,
				success: function(result){
					$('.spinner_loading').hide();
					$('#register_course').html('Đăng ký thành công');
					console.log(result);
				}
			});		
		});
		
		// Submit form - New LandingPage
		$("#form_course").submit(function(e) {
			$('.spinner_loading').show();
			if(document.getElementById('form_checkbox').checked  == true){
				//$(this).submit();
				e.preventDefault();
				var form = $(this);
				
				$.ajax({
					url : site_url + "ajax/reg_course",
					type: "POST",
					data : form.serialize(),
					success: function(data){
						console.log(data);
						$('.spinner_loading').hide();
						location.href = site_url + '/poh-cam-on';
						//$('#register_course').html('Đăng ký thành công');
					}
				});
			}else{
				alert('Xin hãy đồng ý điều khoản dịch vụ trước khi tiếp tục');
				return false;
			}
		});
		
	});
	
	// add dot/(.) to numbers every three digits
	$.fn.digits = function(){ 
		return this.each(function(){ 
			$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.") ); 
		})
	}
	
	// Calculate total price
	$('#total_price').html($('#package_price_value').val());
	$('.extra-package').change(function() {
		if(this.checked) {
			var total_price = parseInt($('#package_price_value').val()*1000) + parseInt($(this).val()*1000);
			$('.extra-package').prop('checked', true);
			$('#total_price').html(parseInt(total_price));
			$("#total_price").digits();
			//$('#total_price').html(data.package_1);
		} else {
			$('.extra-package').prop('checked', false);
			$('#total_price').html($('#package_price_value').val());
		}
	});
	
	//vietth - Countdown Clock
	var target_date = new Date().getTime() + (4000*3600); // set the countdown date
	var days, hours, minutes, seconds; // variables for time units
	var countdown = document.getElementById("clock_countdown_title"); // get tag element

	getCountdown();
	setInterval(function () { getCountdown(); }, 1000);

	function getCountdown(){
		// find the amount of "seconds" between now and target
		var current_date = new Date().getTime();
		var seconds_left = (target_date - current_date) / 1000;

		days = pad( parseInt(seconds_left / 86400) );
		seconds_left = seconds_left % 86400;
			 
		hours = pad( parseInt(seconds_left / 3600) );
		seconds_left = seconds_left % 3600;
			  
		minutes = pad( parseInt(seconds_left / 60) );
		seconds = pad( parseInt( seconds_left % 60 ) );

		// format countdown string + set tag value
		if (countdown) {countdown.innerHTML = "<span>" + hours + "</span><span>" + minutes + "</span><span>" + seconds + "</span>";}
	}

	function pad(n) {
		return (n < 10 ? '0' : '') + n;
	}
	
	// Load more course
	$('#seemore').click(function() {
		$('.btn-tab').show();
		$(this).hide();
	});
});

// function copyClipboard(e) {
	// var $temp = $("<input>");
	// $("body").append($temp);
	// $temp.val($(e).html()).select();
	// document.execCommand("copy");
	// $temp.remove();
// }

function copyClipboard() {
	// var copyText = $('#bank_number').text();
	var copyText = document.getElementById("bank_number");
	copyText.select();
	document.execCommand("copy");

	var tooltip = document.getElementById("myTooltip");
	tooltip.innerHTML = "Đã copy: " + copyText.value;
}

function outFunc() {
	var tooltip = document.getElementById("myTooltip");
	tooltip.innerHTML = "Sao chép vào clipboard";
}
