//Custom Javascript for POH Theme - CRTeam

//vietth - Ajax calculate date 
jQuery( document ).ready(function($) {
	
	$(function(){
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
					$('#remain_days').html(data.print_text);
					$('#duration_days').html(data.duration_days);
					if (data.package_1) {
						$('#package1_price').html(data.package_1);
						$('#total_price').html(data.package_1);
						$('#package_price_value').val(data.package_1);
					}
					$('#customer_pre_birth').val(data.first_date);
					console.log(data);
				}
			})	
			
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