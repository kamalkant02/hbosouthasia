$(document).ready(function(){
	// Country selector.
	$("#country_selector").click(
		function() {
			$("#country_popup").fadeToggle(200);
		}
	);
	
	// Menu.
	$("#channel_nav .menu_channel").hover(
		function() {
			$(this).addClass("hover");
		},
		function() {
			$(this).removeClass("hover");
		}
	);
	
	// Search.
	$("#qs,#qs2").focus(
		function() {
			if ($(this).val() == search_text) {
				$(this).val('');
				$(this).addClass('nav_search_box_string_entry');
			}
		}
	);
	$("#qs,#qs2").blur(
		function() {
			if ($(this).val() == '') {
				$(this).val(search_text);
				$(this).removeClass('nav_search_box_string_entry');
			}
		}
	);
	
	// Now showing.
	function now_showing_get() {
		$.ajax({
			url: now_showing_ajax,
			beforeSend: function() {
				
			}
		}).done(function ( data ) {
			var now_showing_info = jQuery.parseJSON(data);
			var source = $("#now-showing-block-template").html();
			var template = Handlebars.compile(source);
			var now_showing_html = template(now_showing_info);
			$('#now_showing').html(now_showing_html);
		});
	}
	
	// Shows popup.
	shows_popup_get_status = false;
	shows_popup_fade_timer = null;
	$("#nav_shows_selector").hover(
		function() {
			//$("#nav_shows_popup").fadeToggle(200);
			clearTimeout(shows_popup_fade_timer);
			$("#nav_shows_popup").fadeIn(200);
			if (!shows_popup_get_status) {
				shows_popup_get();	
			}
		}
	);
	$("#nav_shows_selector").on({
		'mouseleave': function() {
			shows_popup_fade_timer = setTimeout(show_popup_close, 1000);
		}
	});
	
			
	$("#nav_shows_popup").hover(
		function() {
			clearTimeout(shows_popup_fade_timer);
		}
	);
	
	$("#nav_shows_popup").on({
		'mouseenter': function() {
			clearTimeout(shows_popup_fade_timer);
		},
		'mouseleave': function() {
			shows_popup_fade_timer = setTimeout(show_popup_close, 200);
		}
	});
	
	function shows_popup_get() {
		$.ajax({
			url: home_schedule_ajax,
			beforeSend: function() {
				
			}
		}).done(function ( data ) {
			var shows_list = jQuery.parseJSON(data);
			var source = $("#shows-popup-block-template").html();
			var template = Handlebars.compile(source);
			var shows_list_html = template(shows_list);
			$('#nav_shows_popup_content').html(shows_list_html);
			var popup_columns = $('#nav_shows_popup_content div.nav_shows_popup_content_column').length;
			$('#nav_shows_popup').removeClass('nav_shows_popup_column_2').addClass('nav_shows_popup_column_' + popup_columns);
			$('#nav_shows_popup_arrow').removeClass('nav_shows_popup_arrow_2').addClass('nav_shows_popup_arrow_' + popup_columns);
			shows_popup_get_status = true;
		});
	}
	
	function show_popup_close() {
		$("#nav_shows_popup").fadeOut(200);
	}
	
	// Back to top.
	$("#BackToTop").click(function () {
		$("html, body").animate({scrollTop: 0}, 100);
		return false;
	});
	
	now_showing_get();
});


//Javescript validation
function trim(str) { 
    if (str != null) {
        var i; 
        for (i=0; i<str.length; i++) {
            if (str.charAt(i)!=" ") {
                str=str.substring(i,str.length); 
                break;
            } 
        } 
    
        for (i=str.length-1; i>=0; i--) {
            if (str.charAt(i)!=" ") {
                str=str.substring(0,i+1); 
                break;
            } 
        } 
        
        if (str.charAt(0)==" ") {
            return ""; 
        } else {
            return str; 
        }
    }
}

function blank(a) { if(trim(a.value) == a.defaultValue) a.value = ""; }
function unblank(a) { if(trim(a.value) == "") a.value = a.defaultValue; }

function validateInfoOnSubmit() {
var frm = document.form1;
	if((trim(frm.txtName.value)=='Name :') || (trim(frm.txtName.value)==''))
	{
		alert("Please enter your name.");
		frm.txtName.focus();
		return false;
	}
	else if((trim(frm.txtEmail.value)=='E-mail :') || (trim(frm.txtEmail.value)==''))
	{
		alert("Please enter your email.");
		frm.txtEmail.focus();
		return false;
	}
	else if(trim(frm.txtEmail.value).search(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) ==-1)
	{
		alert("Please enter a valid email.");
		frm.txtEmail.value='';
		frm.txtEmail.focus();
		return false;
	}
	else if((trim(frm.txtCmnt.value)=='Comments :') || (trim(frm.txtCmnt.value)==''))
	{
		alert("Please enter your comments.");
		frm.txtCmnt.focus();
		return false;
	}
	else 
	return true;

}
function validateInfoOnSubmit1() {
var frm = document.form2;
	if((trim(frm.txtName1.value)=='Name :') || (trim(frm.txtName1.value)==''))
	{
		alert("Please enter your name.");
		frm.txtName1.focus();
		return false;
	}
	else if((trim(frm.txtEmail1.value)=='E-mail :') || (trim(frm.txtEmail1.value)==''))
	{
		alert("Please enter your email.");
		frm.txtEmail1.focus();
		return false;
	}
	else if(trim(frm.txtEmail1.value).search(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/) ==-1)
	{
		alert("Please enter a valid email.");
		frm.txtEmail1.value='';
		frm.txtEmail1.focus();
		return false;
	}
	else 
	return true;
}