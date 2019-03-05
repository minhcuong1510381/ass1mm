setTimeout(function() {
	$('#error').fadeOut('fast');
}, 2000);

function mySelectEncrypt(){
	var selectId = document.getElementById('algorithms').value;

	if(selectId == 3){
		$("#publicKey").css("display", "block");
		$("#privateKey").css("display", "block");
		$("#file").css("padding-top", "0");
		$(".content").css("height", "27em");
	}
	else{
		$("#publicKey").css("display", "none");
		$("#privateKey").css("display", "none");
		$("#file").css("padding-top", "30px");
		$(".content").css("height", "20em");
	}
}
function mySelectDecrypt(){
	var algorithmsID = document.getElementById('algorithms').value;

	if(algorithmsID == 3){
		$("#keyInput").css("display", "none");
		$("#file").css("padding-top","30px");
		$("#publicKey").css("display", "block");
		$("#privateKey").css("display", "block");
		$("#file").css("padding-top", "0");
		$("#button").css("padding-top", "30px");
		$(".content").css("height", "27em");
	}
	else{
		$("#publicKey").css("display", "none");
		$("#privateKey").css("display", "none");
		$("#keyInput").css("display", "block");
		$("#file").css("padding-top","0");
		$("#button").css("padding-top","0");
		$(".content").css("height", "20em");
	}
}