
function fnLaunchNanobar() {    
    const nanobar =  new Nanobar({
        classname   : 'my-class',
        id          : 'my-id',
        target      : document.getElementById('myDivId')
    });
    nanobar.go(100);
}

function fnValidateAgeAdd() {
	var dateBirth 	= new Date($('#appDateOfBirth').val());
	var dateNow 	= new Date(Date.now());
	var intAge 		= Math.floor((parseInt(Date.parse(dateNow)) - parseInt(Date.parse(dateBirth))) / (1000*60*60*24*365));
	return (parseInt(intAge));
}

function fnAddOnlineApplicant(){
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-submit.php',
		type: 'post',
		data: $('#frmAddOnlineApplicant').serialize(),
		dataType: 'html',
		beforeSend: function(xhr){
			if (fnValidateAgeAdd() < 18) {
				toastr.error('Applicant must be at least 18 years of age.');
				$('#appDateOfBirth').css('border-color','red');
				$('#_dob').effect('shake');
				xhr.abort();
			}
			if ($('#appPhoneNumber').val().length !== 16) {
				toastr.error('Phone number is invalid.');
				$('#appPhoneNumber').css('border-color','red');
				$('#_phone').effect('shake');
				xhr.abort();
			}
		},
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success("Successfully Saved.");
				$('#appDateOfBirth, #appPhoneNumber').css('border-color','');
				$('#appMunPB, #appMunHA').prop('disabled',true);
				$('#appBarPB, #appBarHA').prop('disabled',true);
				$('#frmAddOnlineApplicant')[0].reset();
			}else{
				$('#captcha').effect('pulsate');
				$('#captcha').css('border-color','red');
				toastr.error("Ooops! Wrong Captcha.");
			}
			console.log(result);
		}
	});
}

function fnGetProvinces(cmbProvince,cmbCityMun,cmbBrgy) {

	$.ajax({
		url: serverdir + '/php/query-address.php?q=province',
		type: 'get',
		cache: false,
		dataType: 'json',
		success: function(result) {
			if (result !== undefined) {
				var array = [];
				array.push('<option value="" selected disabled>Select Province *</option>');
				for (var i = 0; i < result.length; i++) {
					array.push('<option value = "'+result[i]['provincecode']+'">'+result[i]['provincedesc']+'</option>');
					cmbProvince.html(array);
				}
			}
			else {

			}
			// console.log(result);
		}
	});
}

function fnGetCityMuns(cmbProvince,cmbCityMun,cmbBrgy) {

	$.ajax({
		url: serverdir + '/php/query-address.php?q=citymun&code='+cmbProvince.val(),
		type: 'get',
		cache: false,
		dataType: 'json',
		success: function(result) {
			if (result !== undefined) {
				var array = [];
				array.push('<option value="" selected disabled>Select Municipality *</option>');
				for (var i = 0; i < result.length; i++) {
					array.push('<option value = "'+result[i]['citymuncode']+'">'+result[i]['citymundesc']+'</option>');
					cmbCityMun.html(array);
				}
			}
			else {

			}
			// console.log(result);
		}
	});
}

function fnGetBrgys(cmbProvince,cmbCityMun,cmbBrgy) {


	$.ajax({
		url: serverdir + '/php/query-address.php?q=brgy&code='+cmbCityMun.val(),
		type: 'get',
		cache: false,
		dataType: 'json',
		success: function(result) {
			if (result !== undefined) {
				var array = [];
				array.push('<option value="" selected disabled>Select Barangay *</option>');
				for (var i = 0; i < result.length; i++) {
					array.push('<option value = "'+result[i]['brgycode']+'">'+result[i]['brgydesc']+'</option>');
					cmbBrgy.html(array);
				}
			}
			else {

			}
			// console.log(result);
		}
	});
}

$(document).ready(function(){

    $('#change').click(function(event){
        $('#captcha-image').src ='php/captcha.php?rand='+Math.random();
    });

	$('#change').click(function(event){
		$('#captcha-image').attr('src', $('#captcha-image').attr('src')+'#');
	});

	$('#captcha').keyup(function(){
		if ($(this).val().length == 0) {
			$('#req').attr('hidden', false);
		}else{
			$('#req').attr('hidden', true);
		}
	});

    //Date Validation 

	$('#appDateOfBirth').on('change click',function(){
		var dateBirth 	= new Date($('#appDateOfBirth').val());
		var dateNow 	= new Date(Date.now());
		if (fnValidateAgeAdd() < 18) {
			$('#appDateOfBirth').css({'border-color':'red'});
		}
		else{
			$('#appDateOfBirth').css({'border-color':''});
		}
	});

	//Mask Phone Number
	$('#appPhoneNumber, #appPNPhoneNumber').mask('+63-999-999-9999',{placeholder: ''});

	//Form Submit
	$('#frmAddOnlineApplicant').on('submit', function(){
		fnAddOnlineApplicant();
	});
	// Place of Birth

	fnGetProvinces($('#appProvPB'),$('#appMunPB'),$('#appBarPB'));
	
	$('#appProvPB').on('change',function(){
		fnGetCityMuns($('#appProvPB'),$('#appMunPB'),$('#appBarPB'));
		$('#appMunPB').prop('disabled',false);
		$('#appBarPB').html('<option value="" selected disabled>Select Barangay</option>');
		$('#appBarPB').prop('disabled',true);
	});

	$('#appMunPB').on('change',function(){
		
		fnGetBrgys($('#appProvPB'),$('#appMunPB'),$('#appBarPB'));
		$('#appBarPB').prop('disabled',false);
	});

	// Home Address

	fnGetProvinces($('#appProvHA'),$('#appMunHA'),$('#appBarHA'));
	
	$('#appProvHA').on('change',function(){
		fnGetCityMuns($('#appProvHA'),$('#appMunHA'),$('#appBarHA'));
		$('#appMunHA').prop('disabled',false);
		$('#appBarHA').html('<option value="" selected disabled>Select Barangay</option>');
		$('#appBarHA').prop('disabled',true);
	});

	$('#appMunHA').on('change',function(){
		
		fnGetBrgys($('#appProvHA'),$('#appMunHA'),$('#appBarHA'));
		$('#appBarHA').prop('disabled',false);
	});

})