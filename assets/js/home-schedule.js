$(document).ready(function() {
	var slideBlockNumber = 4, slideDone = true, thumbWidth, totalWidth;
	
	$('.calendar_picker').click(function() {
		$('#block_schedule_datepicker').datepicker('show');
	});
	
	$('#block_schedule_datepicker').change(function() {
		var date = new Date($('#block_schedule_datepicker').datepicker('getDate'));
		$('#block_schedule_content .calendar_picker_header').text(block_schedule_datepicker_month_names[date.getMonth()]);
		$('#block_schedule_content .calendar_picker_date').text(date.getDate());
		home_schedule_get();
	});
	
	$('#block_schedule_calendar_left').click(function() {
		$('#block_schedule_datepicker').datepicker('setDate', 'c-1d');
		$('#block_schedule_datepicker').change();
	});

	$('#block_schedule_calendar_right').click(function() {
		$('#block_schedule_datepicker').datepicker('setDate', 'c+1d');
		$('#block_schedule_datepicker').change();
	});
	
	$('#block_schedule_nav_left').click(function() {
		slideSchedule(-1 * slideBlockNumber, 'relative');
	});
	
	$('#block_schedule_nav_right').click(function() {
		slideSchedule(slideBlockNumber, 'relative');
	});

	$('#block_schedule_channel_list a').each( function() {
		$(this).on({
			'click': function() {
				home_schedule_get($(this).prop('id'));
				return false;
			}
			
		})
											 
	});
	
	
	function home_schedule_get(input_channel) {
		var selected_date = new Date($('#block_schedule_datepicker').datepicker('getDate'));
		
		if (typeof input_channel != 'undefined') {
			$('#block_schedule_datepickerchannel').val(input_channel);
			var channel_info = input_channel;
		} else {
			var channel_info = $('#block_schedule_datepickerchannel').val();
		}
		channel_info = channel_info.split('_');
		
		$.ajax({
			url: $('#block_schedule_datepickersubmiturl').val() + "?date=" + selected_date.getFullYear() + "-" + (selected_date.getMonth() + 1) + "-" + selected_date.getDate() + "&channel=" + channel_info[0] + "&feed=" + channel_info[1],
			beforeSend: function() {
				$('#block_schedule_channel_list a').each( function() {
					$(this).removeClass('shows_font cinemax_selected_url');
				});
				$('#block_schedule_channel_list #'+channel_info[0]).addClass('shows_font special_font cinemax_selected_url');
				$('#block_schedule_channel_list_view_full_schedule').click( function() {
					window.location = channels[channel_info[0]];
					return false;
				});
			}
		}).done(function ( data ) {
			var schedule = jQuery.parseJSON(data);
			var source = $("#schedule-block-template").html();
			var template = Handlebars.compile(source);
			var schedule_html = template(schedule);
			$('#block_schedule_list').html(schedule_html);
			
			
			thumbWidth = parseInt($(".show_thumb_block").css("width")) + 9;
			totalWidth = parseInt($(".show_thumb_block").length) * thumbWidth;
			$('#block_schedule_list').css( {width: totalWidth + 'px'} );
			
			if (input_channel == 'demand') {
				slideSchedule(0.0000001, 'absolute', 'load');
				$('#block_schedule_content div.block_schedule_top_nav_item').hide();
			} else {
				var primeTimeSlot = parseInt($('#block_schedule_list').find('.YES').index());
				var nowSlot = parseInt($('#block_schedule_list').find('.NOW').index());
				
				slideSchedule(Math.max(primeTimeSlot, nowSlot), 'relative', 'load');
				$('#block_schedule_content div.block_schedule_top_nav_item').show();
			}
		});
	}
	
	function slideSchedule(slots, moveMode, loadMode) {
		if (slideDone) {
			moveMode = typeof moveMode !== 'undefined' ? moveMode : 'absolute';
			loadMode = typeof loadMode !== 'undefined' ? loadMode : 'slide';
			slideDone = false;
			
			var currentPosition = parseInt($("#block_schedule_list").css("left"));
			var maxRight = (parseInt($("#block_schedule_list div.show_thumb_block").length) - slideBlockNumber) * thumbWidth * -1;
			var maxLeft = 0;
			
			if (moveMode == 'relative') {
				// moveMode=relative: negative slots means move left. Positive slots means move right.
				var futurePosition = Math.min(Math.max(currentPosition + (-1 * slots * thumbWidth), maxRight), maxLeft);
			} else if (moveMode == 'absolute') {
				// moveMode=absolute: slots are number of pixels.
				var futurePosition = slots;
			}
			
			if (loadMode == 'load') {
				$('#block_schedule_list').css({left: futurePosition+'px'});
				slideDone = true;
			} else {
				$('#block_schedule_list').animate({left: futurePosition+'px'}, function(){
					slideDone = true;
				});
			}
			
			if (parseInt($("#block_schedule_list div.show_thumb_block").length) == slideBlockNumber) {
				$('#block_schedule_nav_left').addClass('block_schedule_nav_unavaible');
				$('#block_schedule_nav_right').addClass('block_schedule_nav_unavaible');
			} else {
				if (futurePosition >= maxLeft) {
					$('#block_schedule_nav_left').addClass('block_schedule_nav_unavaible');
					$('#block_schedule_nav_right').removeClass('block_schedule_nav_unavaible');
				} else if (futurePosition<= maxRight) {
					$('#block_schedule_nav_left').removeClass('block_schedule_nav_unavaible');
					$('#block_schedule_nav_right').addClass('block_schedule_nav_unavaible');
				} else {
					$('#block_schedule_nav_left').removeClass('block_schedule_nav_unavaible');
					$('#block_schedule_nav_right').removeClass('block_schedule_nav_unavaible');
				}
			}
		}
	}

	
	home_schedule_get();
	
});