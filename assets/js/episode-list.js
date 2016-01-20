var slideBlockNumber = 4, slideDone = true, thumbWidth, totalWidth;

$(document).ready(function(){
	thumbWidth = parseInt($(".show_thumb_block").css("width"))+9;
	totalWidth = parseInt($(".show_thumb_block").length) * thumbWidth;
	$('#block_schedule_list').css({width:totalWidth+'px'});
	slideSchedule($("#block_schedule_list div.current_episode").index(), 'index');
	$('#block_cast_nav_left').click(function() { slideSchedule(-1 * slideBlockNumber, 'relative'); });
	$('#block_cast_nav_right').click(function() { slideSchedule(slideBlockNumber, 'relative'); });
});

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
		} else if (moveMode == 'index') {
			// moveMode=index: slots is the index to go to.
			var futurePosition = Math.min(Math.max(-1 * slots * thumbWidth, maxRight), maxLeft);
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
			$('#block_cast_nav_left').addClass('block_schedule_nav_unavaible');
			$('#block_cast_nav_right').addClass('block_schedule_nav_unavaible');
		} else {
			if (futurePosition >= maxLeft) {
				$('#block_cast_nav_left').addClass('block_schedule_nav_unavaible');
				$('#block_cast_nav_right').removeClass('block_schedule_nav_unavaible');
			} else if (futurePosition<= maxRight) {
				$('#block_cast_nav_left').removeClass('block_schedule_nav_unavaible');
				$('#block_cast_nav_right').addClass('block_schedule_nav_unavaible');
			} else {
				$('#block_cast_nav_left').removeClass('block_schedule_nav_unavaible');
				$('#block_cast_nav_right').removeClass('block_schedule_nav_unavaible');
			}
		}
	}
}