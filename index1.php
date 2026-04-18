<?php 
session_start();
if (isset($_SESSION['user_data']) && isset($_SESSION['user_data'])){
	if ($_SESSION['user_data']['email_verified']==1) {
		header('location:users-profile.php');

	}else{
		header('location:index.php');

	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<script src="https://accounts.google.com/gsi/client" async></script>
	<!-- <div id="g_id_onload"
	    data-client_id="929076671844-r5sskkt9uhqovdeg869sg67q42sn11ah.apps.googleusercontent.com"
	    data-callback="handleCredentialResponse"
	    data-auto_prompt="false">
	</div>
		<div class="g_id_signin"
		data-type="standard"
		data-size="large"
		data-theme="outline"
		data-text="sign_in_with"
		data-shape="rectangular"
		data-logo_alignment="left">
		</div> -->

	<div id="g_id_onload"
	     data-client_id="929076671844-r5sskkt9uhqovdeg869sg67q42sn11ah.apps.googleusercontent.com"
	     data-context="signin"
	     data-ux_mode="popup"
	     data-login_uri="http://localhost/fp/verify.php"
	     data-itp_support="true">
	</div>
	
	<div class="g_id_signin"
	     data-type="standard"
	     data-shape="rectangular"
	     data-theme="outline"
	     data-text="signin_with"
	     data-size="large"
	     data-logo_alignment="left">
	</div>


	<script src="jquery-3.7.1.min.js"></script>

	<script>
  	function handleCredentialResponse(response) {
		const responsePayload = decodeJwtResponse(response.credential);


		console.log("ID: " + responsePayload.sub);
		console.log('Full Name: ' + responsePayload.name);
		console.log('Given Name: ' + responsePayload.given_name);
		console.log('Family Name: ' + responsePayload.family_name);
		console.log("Image URL: " + responsePayload.picture);
		console.log("Email: " + responsePayload.email);

		var full_name = responsePayload.name;
		var given_name = responsePayload.given_name;
		var family_name = responsePayload.family_name;
		var image = responsePayload.picture;
		var email = responsePayload.email;
		// alert(email);
		$.ajax({
			url: 'verify.php', // Sample API
			type: 'POST',  // Method (GET or POST)
			dataType: 'json', // Expected data type from the server
			data:{
				full_name: full_name,
				given_name: given_name,
				family_name: family_name,
				image: image,
				email: email
			},
			success: function(response) {
			    console.log('Data received:', response);
			    var output = '<h3>Received Posts:</h3>';
			    // $.each(response, function(index, post) {
			    //     output += `<p><strong>${post.title}</strong><br>${post.body}</p>`;
			    // });
			    // alert(email);
			    // $('#response').html(output);  // Display the data in the response div
			    console.log(response.status);
			    if (response.status==="success") {
			    	window.location.href="https://stackoverflow.com/questions/22383608/sublime-text-3-deleting-code-when-i-hit-tab-key";
			    }
			},
			error: function(xhr, status, error) {
			    console.error('Request failed:', status, error);
			    $('#response').html('<p>Error fetching data. Please try again later.</p>');
			}
		});
	}

  function decodeJwtResponse(token) {
    let base64Url = token.split('.')[1];
    let base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    let jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
        return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
    }).join(''));

    return JSON.parse(jsonPayload);
  }
</script>
<body>
</html>