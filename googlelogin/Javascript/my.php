<head>
<script src="jquery-3.1.1.min.js"></script>
    <meta name="google-signin-client_id" content="10458197325-ccrnltgudmn2mcut2mp0bjcvmj38p25j.apps.googleusercontent.com">
	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
</head>
<body>
<style>

		.profile{
			border: 3px solid #B7B7B7;
			padding: 10px;
			margin-top: 10px;
			width: 350px;
			background-color: #F7F7F7;
			height: 160px;
		}
		.profile p{margin: 0px 0px 10px 0px;}
		.head{margin-bottom: 10px;}
		.head a{float: right;}
		.profile img{width: 100px;float: left;margin: 0px 10px 10px 0px;}
		.proDetails{float: left;}

</style>



<script>

function onSuccess(googleUser) {
    var profile = googleUser.getBasicProfile();
    gapi.client.load('plus', 'v1', function () {
        var request = gapi.client.plus.people.get({
            'userId': 'me'
        });
        //Display the user details
        request.execute(function (resp) {
			
            var profileHTML = '<div class="profile"><div class="head">Welcome '+resp.name.givenName+'! <a href="javascript:void(0);" onclick="signOut();">Sign out</a></div>';
            profileHTML += '<img src="'+resp.image.url+'"/><div class="proDetails"><p>'+resp.displayName+'</p><p>'+resp.emails[0].value+'</p><p>'+resp.gender+'</p><p>'+resp.id+'</p><p><a href="'+resp.url+'">View Google+ Profile</a></p></div></div>';
			$('.userContent').html(profileHTML);
            $('#gSignIn').slideUp('slow');
			  console.log('ID: ' + resp.id);
			  console.log('Display Name: ' + resp.displayName);
			  console.log('Image URL: ' + resp.image.url);
			  console.log('Profile URL: ' + resp.url);
			  console.log( resp);
			  var json =  JSON.stringify(resp);
			   $('.userContent2').html(json);
			  
        
		});
    });
}
function onFailure(error) {
    alert(error);
}
function renderButton() {
    gapi.signin2.render('gSignIn', {
        'scope': 'profile email  openid https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/user.phonenumbers.read https://www.googleapis.com/auth/admin.directory.user  https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/plus.me https://www.googleapis.com/auth/userinfo.email', //https://www.googleapis.com/auth/drive.metadata.readonly
        'width': 240,
        'height': 50,
        'longtitle': true,
        'theme': 'dark',
        'onsuccess': onSuccess,
        'onfailure': onFailure
    });
}
function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
		  console.log('Sign-in failed: ' + auth2); 
        $('.userContent').html('');
        $('#gSignIn').slideDown('slow');
    });
}

</script>


<!-- HTML for render Google Sign-In button -->
<div id="gSignIn"></div>
<!-- HTML for displaying user details -->
<div class="userContent"></div>
<div class="userContent2"></div>
</body>