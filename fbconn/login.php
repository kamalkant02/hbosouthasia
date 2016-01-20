<?php /*?><!DOCTYPE html>
<html>
<body>
<div id="fb-root"></div>
<a href="#" onclick="getEmail();return false;">Get Email</a>
<script src="https://connect.facebook.net/en_US/all.js"></script>
<script>
  FB.init({ appId: '288377454639280', status: true, cookie: true, xfbml : true });

  function getEmail() {  
  
    FB.login(function(response) {
	
      if (response.session && response.scope) {
        FB.api('/me', function(response) {
      console.log('Good to see you, ' + response.name + '.');
    });
      }
    } , {scope:'email'}); 
}
</script>
</body>
</html><?php */?>

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
<p><button id="fb-auth">Login</button></p>
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
			fbid : response.id,
			fbname : response.name,
			fbemail : response.email,
			fbgender : response.gender
		},
		function(data) {
			userInfo.innerHTML = data;
		}
		);
		//button.innerHTML = 'Logout';
      });
      button.onclick = function() {
        FB.logout(function(response) {
          var userInfo = document.getElementById('user-info');
          userInfo.innerHTML="";
    });
      };
    } else {
      //user is not connected to your app or logged out
      button.innerHTML = 'Login';
      button.onclick = function() {
        FB.login(function(response) {
      if (response.authResponse) {
            FB.api('/me', function(response) {
          var userInfo = document.getElementById('user-info');
          userInfo.innerHTML = 
                '<img src="https://graph.facebook.com/' 
            + response.id + '/picture" style="margin-right:5px"/>' 
            + '<br/>FBID : ' + response.id + '<br/>Name : ' +response.name + '<br/>EmailID : '+ response.email;
        });    
          } else {
            //user cancelled login or did not grant authorization
          }
        }, {scope:'email'});    
      }
    }
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