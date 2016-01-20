<!DOCTYPE html> 
<html xmlns:fb="https://www.facebook.com/2008/fbml">
  <head> 
    <title> 
      New JavaScript SDK
    </title> 
  </head> 
<body> 
    
<div id="fb-root"></div>
<h2>Connect With Social </h2>
<br />
<div id="user-info"></div>
<p><div id="fb-auth"><img src="../images/connect.png" /></div></p>
<script language="javascript" src="js/jquery-1.js"></script>
<script language="javascript" src="js/jquery_002.js"></script>
<script type="text/javascript">
	var loading_spinner_rectangle = '<img src="ajax-loader.gif"/>';
</script>

<script>
window.fbAsyncInit = function() {
  FB.init({ appId: '363974010402867', 
        status: true, 
        cookie: true,
        xfbml: true,
        oauth: true});

  function updateButton(response) {
    var button = document.getElementById('fb-auth');
<?php if($_GET['action'] == 'connect') { ?>	
    if (response.authResponse) {
	  	//user is already logged in and connected
      var userInfo = document.getElementById('user-info');
      FB.api('/me', function(response) {
	         /* userInfo.innerHTML = '<img src="https://graph.facebook.com/' 
      + response.id + '/picture">'  + '<br/>FBID : ' + response.id + '<br/>Name : ' +response.name + '<br/>EmailID : '+ response.email + '<br/>Gender : '+ response.gender;
        button.innerHTML = 'Logout';*/
	   userInfo.innerHTML = loading_spinner_rectangle;
	  var url = "add_userinfo.php";
	  $.post(
		url,
		{
			id : response.id,
			name : response.name,
			first_name : response.first_name,
			last_name : response.last_name,
			gender : response.gender,
			email : response.email,
			linkurl : response.link,
			username : response.username
		},
		function(data) {
			userInfo.innerHTML = data;
		}
		);
		button.innerHTML = '';
      });
      button.onclick = function() {
        FB.logout(function(response) {
          var userInfo = document.getElementById('user-info');
          userInfo.innerHTML="";
    });
      };  
    } else {
      //user is not connected to your app or logged out
         button.onclick = function() {
		FB.login(function(response) {
      if (response.authResponse) {
            FB.api('/me', function(response) {
	         /* userInfo.innerHTML = '<img src="https://graph.facebook.com/' 
      + response.id + '/picture">'  + '<br/>FBID : ' + response.id + '<br/>Name : ' +response.name + '<br/>EmailID : '+ response.email + '<br/>Gender : '+ response.gender;
        button.innerHTML = 'Logout';*/
	   userInfo.innerHTML = loading_spinner_rectangle;
	  var url = "add_userinfo.php";
	  $.post(
		url,
		{
			id : response.id,
			name : response.name,
			first_name : response.first_name,
			last_name : response.last_name,
			gender : response.gender,
			email : response.email,
			linkurl : response.link,
			username : response.username
		},
		function(data) {
			userInfo.innerHTML = data;
		}
		);
		button.innerHTML = '';
      });    
          } else {
            //user cancelled login or did not grant authorization
          }
        }, {scope:'email'});    
      }
    }
<?php } else { ?>
 if (response.authResponse) {
	  	//user is already logged in and connected
      var userInfo = document.getElementById('user-info');
      FB.api('/me', function(response) {
	   
	  });
      button.onclick = function() {
          window.location.href="index.php?action=connect";
      };  
    } else {
		window.location.href="index.php?action=connect";
	}
<?php } ?>
  }

  // run once with current status and whenever the status changes
  FB.getLoginStatus(updateButton);
  FB.Event.subscribe('auth.statusChange', updateButton);    
};
    
(function() {
  var e = document.createElement('script'); e.async = true;
  e.src = document.location.protocol 
    + '//connect.facebook.net/en_US/all.js';
  document.getElementById('fb-root').appendChild(e);
}());

</script>
</body> 
</html>