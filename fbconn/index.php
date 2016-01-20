<script type="text/javascript">

    $(document).ready(function() {
        var width = $(window).width();
        if (width < 767) {
            document.getElementById('fb-auth').html = '<img src="../images/connect.png" />';
        }
        else
        {
            document.getElementById('fb-auth').html = '<img src="../images/fbconnect-desktop.png" />';
        }
    });
</script>
<div id="fb-root"></div>
<div id="user-info" style="color:#C8A340;"></div>
<div id="fb-auth"></div>
<script language="javascript" src="js/jquery-1.js"></script>
<script language="javascript" src="js/jquery_002.js"></script>
<script type="text/javascript">
    var loading_spinner_rectangle = '<img src="ajax-loader.gif"/>';
</script>
<script>
    window.fbAsyncInit = function() {
        FB.init({appId: '363974010402867',
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
                    var url = "demo2/add_userinfo.php";
                    $.post(
                            url,
                            {
                                id: response.id,
                                name: response.name,
                                first_name: response.first_name,
                                last_name: response.last_name,
                                gender: response.gender,
                                email: response.email,
                                linkurl: response.link,
                                username: response.username
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
                        userInfo.innerHTML = "";
                    });
                };
            } else {
                //user is not connected to your app or logged out
                var width = $(window).width();
                if (width < 767) {

                    button.innerHTML = '<img src="../images/connect.png" />';
                }
                else
                {
                    button.innerHTML = '<img src="../images/fbconnect-desktop.png" />';
                }
                button.onclick = function() {
                    FB.login(function(response) {
                        if (response.authResponse) {
                            FB.api('/me', function(response) {
                                /* userInfo.innerHTML = '<img src="https://graph.facebook.com/' 
                                 + response.id + '/picture">'  + '<br/>FBID : ' + response.id + '<br/>Name : ' +response.name + '<br/>EmailID : '+ response.email + '<br/>Gender : '+ response.gender;
                                 button.innerHTML = 'Logout';*/
                                userInfo.innerHTML = loading_spinner_rectangle;
                                var url = "demo2/add_userinfo.php";
                                $.post(
                                        url,
                                        {
                                            id: response.id,
                                            name: response.name,
                                            first_name: response.first_name,
                                            last_name: response.last_name,
                                            gender: response.gender,
                                            email: response.email,
                                            linkurl: response.link,
                                            username: response.username
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
                    }, {scope: 'email'});
                }
            }
        }

        // run once with current status and whenever the status changes
        FB.getLoginStatus(updateButton);
        FB.Event.subscribe('auth.statusChange', updateButton);
    };

    (function() {
        var e = document.createElement('script');
        e.async = true;
        e.src = document.location.protocol
                + '//connect.facebook.net/en_US/all.js';
        document.getElementById('fb-root').appendChild(e);
    }());

</script>