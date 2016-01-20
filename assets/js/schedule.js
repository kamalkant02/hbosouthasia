var fixedTime = Array('now', 'morning', 'afternoon', 'primetime');
var choosen = 0;
var checker = true;


$(document).ready(function(){
	timelineGenerate();
	jumpSchedule(schedule_choosen_slot);
	
	if ($('#schedule_datenow').val() == $('#schedule_datepicker').val()) {
		$('#timeline_time_now_quote').css({display:'block'});
	}

	$('#timeline_left_arrow').click(
		function(){
			moveSchedule(-2, 'relative');
			return false;
		}
	);
	
	$('#timeline_right_arrow').click(
		function(){
			moveSchedule(2, 'relative');
			return false;
		}
	);
	
	$('#timeline_time_now').click(
		function(){
			jumpSchedule('now');
		}
	);
	
	$('#timeline_time_morning').click(
		function(){
			jumpSchedule('morning');
		}
	);
	
	$('#timeline_time_afternoon').click(
		function(){
			jumpSchedule('afternoon');
		}
	);
	
	$('#timeline_time_primetime').click(
		function(){
			jumpSchedule('primetime');
		}
	);
	
	function timelineGenerate(){
		htmltxt = '';
		for(var i=0; i<schedule_pagetimeline.length; i++){
			htmltxt += '<li class="shows_font special_font" id="oclock_'+i+'"><a>'+schedule_pagetimeline[i]+'</a></li>';
		}
		$('.schedule_timer_list').html(htmltxt);
	}
	
	function jumpSchedule(slot_name) {
		if (slot_name == 'now') {
			var time_to_jump = processMinute($('#schedule_timenow').val());
		} else if (slot_name == 'primetime_now') {
			var primetime_slot = schedule_pagetimeline.indexOf(processMinute($('#schedule_primetime').val()));
			var now_slot = schedule_pagetimeline.indexOf(processMinute($('#schedule_timenow').val()));
			
			var time_to_jump = processMinute($('#schedule_primetime').val());
			slot_name = 'primetime';
			if (primetime_slot < now_slot) {
				var time_to_jump = processMinute($('#schedule_timenow').val());
				slot_name = 'now';
			}
			
		} else {
			for (i = 0; i < schedule_slot_names.length; i++) {
				if (slot_name == schedule_slot_names[i]) {
					var time_to_jump = $('#schedule_' + slot_name).val();
					break;
				}
			}
		}
		
		$('#timeline_time_' + schedule_choosen_slot).removeClass('selected');
		schedule_choosen_slot = slot_name;
		$('#timeline_time_' + schedule_choosen_slot).addClass('selected');
		moveSchedule(time_to_jump, 'jump');
	}
	
	function moveSchedule(slots, moveMode) {
		moveMode = typeof moveMode !== 'undefined' ? moveMode : 'absolute';
		scheduleRightMost = -7920;
		scheduleLeftMost = 0;
		schedulePerSlot = 180;
		
		if (moveMode == 'relative') {
			// moveMode=relative: negative slots means move left. Positive slots means move right.
			var current = parseInt($('.schedule_timer_list').css("left"));
			var moveLeft = Math.min(scheduleLeftMost, Math.max(scheduleRightMost, current + (-1 * schedulePerSlot * slots)));
			
		} else if (moveMode == 'jump') {
			// moveMode=jump: slots are in time format.
			slotIndex = schedule_pagetimeline.indexOf(slots);
			var moveLeft = -1 * schedulePerSlot * slotIndex;
			
			for(var i = 0; i < schedule_pagetimeline.length; i++) {
				$('#oclock_' + i + ' a').removeClass('selected');
			}
			$('#oclock_' + slotIndex + ' a').addClass('selected');
		
		} else {
			// moveMode=absolute: slots are index of the time.
			var moveLeft = Math.min(scheduleLeftMost, Math.max(scheduleRightMost, -1 * schedulePerSlot * slots));
			
		}
		
		$('.schedule_timer_list').css({left:moveLeft+'px'});
		$('.timeline_full_width').css({left:moveLeft+'px'});
		
		$('#timeline_left_arrow').removeClass('block_schedule_nav_unavaible');
		$('#timeline_right_arrow').removeClass('block_schedule_nav_unavaible');
		
		if (moveLeft <= scheduleRightMost) {
			$('#timeline_left_arrow').removeClass('block_schedule_nav_unavaible');
			$('#timeline_right_arrow').addClass('block_schedule_nav_unavaible');
		} else if (moveLeft >= scheduleLeftMost) {
			$('#timeline_left_arrow').addClass('block_schedule_nav_unavaible');
			$('#timeline_right_arrow').removeClass('block_schedule_nav_unavaible');
		}
	}
	
	function processMinute(fullTime){
		var splitTime = fullTime.split(":");
		var minutes = splitTime[1].split(" ");
		
		if(minutes[0] > 0 && minutes[0] < 30){
			minutes[0] = '00';
		}
		else if(minutes[0] > 30 && minutes[0] < 60){
			minutes[0] = 30;
		}
		return splitTime[0]+':'+minutes[0]+' '+minutes[1];
	}

	
	$('.calendar_picker').click(function() {
		$('#schedule_datepicker').datepicker('show');
	});
	
	$('#schedule_datepicker').change(function(){
		var date = new Date($('#schedule_datepicker').datepicker('getDate'));
		$('#schedule_date_nav .calendar_picker_header').text(schedule_page_datepicker_month_names[date.getMonth()]);
		$('#schedule_date_nav .calendar_picker_date').text(date.getDate());
		schedule_get();
	});
	
	$('#calendar_left').click(function(){
		$('#schedule_datepicker').datepicker('getDate');
		$('#schedule_datepicker').datepicker('setDate', 'c-1d');
		$('#schedule_datepicker').change();
		return false;
	});
	$('#calendar_right').click(function(){
		$('#schedule_datepicker').datepicker('getDate');
		$('#schedule_datepicker').datepicker('setDate', 'c+1d');
		$('#schedule_datepicker').change();
		return false;
	});
	
	function schedule_get() {
		var selected_date = new Date($('#schedule_datepicker').datepicker('getDate'));
		window.location = $('#schedule_datepickersubmiturl').val() + '/' + selected_date.getFullYear() + "/" + (selected_date.getMonth() + 1) + "/" + selected_date.getDate();
	}
	
});