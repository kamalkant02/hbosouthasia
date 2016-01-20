$(document).ready(function() {
	$('.thumb_video_player').click(function() {
		var video_link = $(this).children('.thumb_video_link').html();
		var video_type = video_link.substr(video_link.length - 3);
				
		// Set the background mask to the screen height and width.
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		
		$("#video_player_background_mask").css({'width': maskWidth, 'height': maskHeight});
		$("#video_player_background_mask").show();
		$("#video_player_background_mask").fadeTo("fast", 0.7);  
		
		// Set the player to the window height and width.
		var winHeight = $(window).height();
		var winWidth = $(window).width();
		
		$("#video_player_modal_container").css("width", Math.floor(winHeight * 0.8 * (4/3)));
		$("#video_player_modal_container").css("height", Math.floor(winHeight * 0.8));
		$("#video_player_modal_container").css("margin-top", (winHeight / 2) - ($("#video_player_modal_container").height() / 2));
		$("#video_player_modal_container").css("left", (winWidth / 2) - ($("#video_player_modal_container").width() / 2));
		$("#video_player_playlist").css("width", "100%");
		$("#video_player_playlist").css("height", "100%");
		//console.log(winHeight + ',' + winWidth + ',' + $("#video_player_modal_container").height() + ',' + ((winHeight / 2) - ($("#video_player_modal_container").height() / 2)));
		
		if (video_type == 'flv') {
			$("#video_player_playlist").flowplayer({
				playlist: [
					[
						{ flv:  video_link },
					]
				],
				engine: "flash",
				//key: "$325822610779515",	// LICENSE FOR HBOASIA.COM
				key: '$130388743137804',	// LICENSE FOR 127.0.0.1
				logo: 'http://127.0.0.1/assets/img/core/logo-hbo-flowplayer.png',
				//width: 661,
				//height: 350
				//ratio: 3/4 // video with 4:3 aspect ratio
			});
		} else {
			$("#video_player_playlist").flowplayer({
				playlist: [
					[
						{ mp4:  video_link },
					]
				],
				engine: "html5",
				//key: "$325822610779515",	// LICENSE FOR HBOASIA.COM
				key: '$130388743137804',	// LICENSE FOR 127.0.0.1
				logo: 'http://127.0.0.1/assets/img/core/logo-hbo-flowplayer.png',
				//width: 400,
				//height: 380
				//ratio: 1080/1920 // video with 4:3 aspect ratio
			});
		}
		flowplayer($("#video_player_playlist")).play(0);
				
		// Display the player.
		$("#video_player_modal_container").show();
		
	});
	
	$("#video_player_background_mask").click(function(){
		closeVideoPlayerModal();
	});
	
	$("#video_player_modal_container div.close_popup_video").click(function(){
		closeVideoPlayerModal();
	});
	
	
	function closeVideoPlayerModal() {
		$("#video_player_modal_container").fadeOut("slow", function() {
			flowplayer($("#video_player_playlist")).stop(0);
			flowplayer($("#video_player_playlist")).unload();
		});
		$("#video_player_background_mask").fadeOut("slow");
	}

});