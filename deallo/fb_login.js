window.fbAsyncInit = function() {
    FB.init({
        appId      : '1313076462137331',
        cookie     : true,
        xfbml      : true,
        version    : 'v2.10'
    });
    FB.AppEvents.logPageView();   
};

/*
            (function(d, s, id){
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) {return;}
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
*/

(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=1313076462137331";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function statusChangeCallback(response) {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me?fields=first_name,last_name,email', function(response) {
        console.log('Successful login for: ' + response.name);

        document.getElementById('name').innerHTML = response.first_name + ' ' + response.last_name;
        document.getElementById('email').innerHTML = response.email;

        document.getElementById('name').style.display = block;
        document.getElementById('email').style.display = block;
        document.getElementById('loginBtn').style.display = none;
        document.getElementById('logoutBtn').style.display = block;
    });
}

function logout(response) {
    FB.logout(function(response) {
        document.getElementById('name').style.display = none;
        document.getElementById('email').style.display = none;
        document.getElementById('loginBtn').style.display = block;
        document.getElementById('logoutBtn').style.display = none;
    });

    FB.getLoginStatus(function(response) {
        if (response && response.status === 'connected') {
            FB.logout(function(response) {
                document.location.reload();
            });
        }
    });
}
