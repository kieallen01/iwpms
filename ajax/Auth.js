
function fnLaunchNanobar() {	
	const nanobar =  new Nanobar({
		classname	: 'my-class',
		id			: 'my-id',
		target		: document.getElementById('myDivId')
	});
	nanobar.go(100);
}
function fnLoader(){
	$("#fakeLoader").fakeLoader({
		timeToHide:2000, 
		zIndex:"999",
		spinner:"spinner3",
		bgColor:"rgb(0,0,0,0)"
	});
}
function fnLoaderOut(){
	$("#fakeLoader").fakeLoader({
		timeToHide:2500, 
		zIndex:"999",
		spinner:"spinner3",
		bgColor:"white"
	});
}

function fnLogin(){
	event.preventDefault();
	$.ajax({
		type: 'post',
		url: serverdir + '/php/query-auth.php?query=LOGIN',
		data: $('#frmLogin').serialize(),
		dataType: 'json',
		success: function(result){
			console.log(result);
			if (result !== 0) {
				$('#frmLogin').effect('drop');
				setTimeout(function(){
					fnLoader();
				},600);
				
				if (result[0]['user_level'] == 'Administrator') {
					setTimeout(function(){
						self.location = serverdir + '/views/ADM/index.php'
					},3000);
				}else if(result[0]['user_level'] == 'MTO'){
					setTimeout(function(){
						self.location = serverdir + '/views/MTO/index.php'
					},3000);
				}else if(result[0]['user_level'] == 'MTC'){
					setTimeout(function(){
						self.location = serverdir + '/views/MTC/index.php'
					},3000);
				}else if(result[0]['user_level'] == 'MPO'){
					setTimeout(function(){
						self.location = serverdir + '/views/MPO/index.php'
					},3000);
				}else if(result[0]['user_level'] == 'MHO'){
					setTimeout(function(){
						self.location = serverdir + '/views/MHO/index.php'
					},3000);
				}
			}else{
				$("#frmLogin").effect("pulsate");
				toastr.error('Invalid Username or Password.');
			}
		}
	});
}

function fnLogout(){
	$.ajax({
		url: serverdir + '/php/query-auth.php?query=LOGOUT',
		dataType: 'html',
		success: function(result){
			fnLoaderOut();
			setTimeout(function(){
				self.location = serverdir + '/index.php'
			},1800);
		}
	});
}

$(document).ready(function(){

	toastr.options = {
	"closeButton"		: false,
	"debug"				: false,
	"newestOnTop"		: true,
	"progressBar"		: false,
	"positionClass"		: "toast-top-center",
	"preventDuplicates"	: true,
	"onclick"			: null,
	"showDuration"		: "300",
	"hideDuration"		: "1000",
	"timeOut"			: "3000",
	"extendedTimeOut"	: "1000",
	"showEasing"		: "swing",
	"hideEasing"		: "linear",
	"showMethod"		: "fadeIn",
	"hideMethod"		: "fadeOut"
	}

$('#frmLogin').submit(function(event) {
	fnLogin();
});

$('#logout').on('click', function(){
	fnLogout();
})

})