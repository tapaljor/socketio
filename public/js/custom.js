from = 11;
function session_checking() {
    $.post("activitytime.php");
}
//Every after 7 mins (60*7) after browswer is inactive run activitytime.php where it logs out properly
setInterval(session_checking, 1000*470);

function loadmore() {

	$.ajax ({
		type: "POST",
		url: "loadmore.php",
		data: { from: from },
		beforeSend: function() {
			$(".loading").html("<span>Loading...</span>");
		},
		success: function(data) {
			$(".loading").hide();//hiding loading once content loaded
			$("#loadmore").append(data);
			from += 10;
		},
	});
}
function check_username(username) {

	$.ajax ({
		type: "POST",
		url: "check_username.php",
		data: { username: username },

		success: function(data) {

			data = JSON.parse(data);
			if(data.success === 0) {
				$(".validate_username").html('<span style="color: red;">Already taken<span>');
				$(".btn").hide();
			} 
			else if ( data.success === 3) {
				$(".validate_username").html('<span style="color: red;">Alpha numeric only<span>');
				$(".btn").hide();
			}
			else {
				$(".validate_username").html('<span style="color: green;">Available<span>');
				$(".btn").show();
			}
		},
	});
}
function change_pass() {

	var x = document.getElementById('password1');
	if (x.style.display === 'none') {
    		x.style.display = 'block';
	} else {
    		x.style.display = 'none';
   	}
}
function compare_password(password, re_password) {

	var password = password.value;
	var re_password = re_password.value;

	if(password != re_password) {
		$(".validate_password").html('<span style="color: red;">Password mismatched</span>');
		$(".btn").hide();
	} else {
		$(".validate_password").html('<span style="color: green;">Password matched</div>');
		$(".btn").show();
	}
}
function search_username(ming) {
	$.ajax ({
		type: "POST",
		url: "search_username.php",
		data: {ming: ming},
		success: function(data) {
			$("#loadmore").html(data);
		}
	});
}
function search_country(obj) {

	var ming1 = obj.value;

	$.ajax ({
		type: "POST",
		url: "search_country.php",
		data: { ming: ming1 },
		success: function(data) {
			$("#country").html(data);
		}
	});
	return false;
}
function morefiles(id1) {

	$.ajax ({
		type: "POST",
		url: "morefiles.php",
		data: { id: id1 },
		success:function(data) {
			$("#morefiles").html(data);
		}
	});
	return false;
}

function likedislike(loginidhash1, likeridhash1, type1) {
	$.ajax ({
		type: "POST",
		url: "likedislike.php",
		data: { loginidhash: loginidhash1, likeridhash: likeridhash1, type: type1 },

		success: function(data) {
			$(".likedislike").html(data);
		}
	});
}
function getlistregion(code) {

	$.ajax ({
		type: "POST",
		url: "getlistregion.php",
		data: { code: code },
		beforeSend: function(data) {
			$("#listregion").load("loading.html");
		},	
		success:function(data) {
			$("#listregion").html(data);
		}
	});
	return false;
}
function readtc() {
	$("#tc").show();
}
