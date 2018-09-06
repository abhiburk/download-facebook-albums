function statusChangeCallback(response) {
  if (response.status === 'connected') {
    console.log('Connected');
    getAlbum();
  } else {
    document.getElementById('status').innerHTML = 'Please log ' +
      'into this app.';
  }
}

function logout(){
  FB.logout(function(response) {
    window.location.replace("https://localhost/fbalbum");
    //window.location.replace("https://clapdust.com");
  });
}

  window.fbAsyncInit = function() {
    FB.init({
      appId      : ' XXX ',
      cookie     : true,  // enable cookies to allow the server to access 
                          // the session
      xfbml      : true,  // parse social plugins on this page
      version    : 'v2.8' // use graph api version 2.8
    });
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    }, {scope: 'email, user_photo'});
  };
  
  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  