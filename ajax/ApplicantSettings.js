// ADDRESS FUNCTION

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


function fnAllApplicantsTable(){

	var strappendid = 'W - ';

	var tblApplicantManagement = $('#tblApplicantManagement').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-applicant.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'applicantid'},
			{'data':'fullname'},
			{'data':'gender'},
			{'data':'address'},
			{'data':'position'},
			{'data':null}
		],
		columnDefs: [ {
			targets: -1,
			data: null,
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-secondary" id="viewapplicant" data-remodal-target="modalViewApplicant" data-toggle="tooltip" data-placement="top" title="Click to view applicant information."><i class="ion-eye"></i> View</button>\
							<button class="btn btn-sm btn-secondary" id="editapplicant" data-remodal-target="modalEditApplicant" data-toggle="tooltip" data-placement="top" title="Click to edit applicant information."><i class="ion-compose"></i> Edit</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblApplicantManagement tbody').on('click', '#viewapplicant', function(){
		var dataId		= tblApplicantManagement.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];
		$.ajax({
			url: serverdir + '/php/query-applicant.php?query=VIEW',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#vappFname').val(result[1]['fname']);
					$('#vappMname').val(result[1]['mname']);
					$('#vappLname').val(result[1]['lname']);
					$('#vappAddHA').val(result[1]['homeaddress']);
					$('#vappGender').val(result[1]['gender']);
					$('#vappDOB').val(result[1]['dob']);
					$('#vappAddPB').val(result[0]['pobaddress']);
					$('#vappPhoneNumber').val(result[1]['phone']);
					$('#vappPD').val(result[1]['position']);
					$('#vappCBName').val(result[1]['cbname']);
					$('#vappCBAdd').val(result[1]['cbaddress']);
					$('#vappEmpName').val(result[1]['empname']);

					$('#vappPNName').val(result[1]['pnname']);
					$('#vappPNAdd').val(result[1]['pnaddress']);
					$('#vappPNPhoneNumber').val(result[1]['pnphone']);

				}
			}
		})
	});

	$('#tblApplicantManagement tbody').on('click', '#editapplicant', function(){
		var dataId		= tblApplicantManagement.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];
		$.ajax({
			url: serverdir + '/php/query-applicant.php?query=VIEW',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#txtHiddenApplicantId').val(result[1]['applicantid']);
					$('#eappFname').val(result[1]['fname']);
					$('#eappMname').val(result[1]['mname']);
					$('#eappLname').val(result[1]['lname']);
					$('#eappGender').val(result[1]['gender']);
					$('#eappDateOfBirth').val(result[1]['dob']);
					$('#eappPhoneNumber').val(result[1]['phone']);
					$('#eappPD').val(result[1]['position']);
					$('#eappCBName').val(result[1]['cbname']);
					$('#eappCBAdd').val(result[1]['cbaddress']);
					$('#eappEmpName').val(result[1]['empname']);

					$('#eappProvPB').val(result[0]['provcodepob']);

					$('#eappMunPB').html('<option value = '+result[0]['citymuncodepob']+'>'+result[0]['citymundescpob']+'</option>');
					$('#eappBarPB').html('<option value = '+result[0]['brgycodepob']+'>'+result[0]['brgydescpob']+'</option>');

					$('#eappProvHA').val(result[1]['provcodeha']);
					$('#eappMunHA').html('<option value = '+result[1]['citymuncodeha']+'>'+result[1]['citymundescha']+'</option>');
					$('#eappBarHA').html('<option value = '+result[1]['brgycodeha']+'>'+result[1]['brgydescha']+'</option>');

					$('#eappPNName').val(result[1]['pnname']);
					$('#eappPNAdd').val(result[1]['pnaddress']);
					$('#eappPNPhoneNumber').val(result[1]['pnphone']);
				}
				// console.log(result[1]['applicantid']);
			}
		})
	});

	//Requirement Checkbox Function
	$('#req1, #req2, #req3, #req4, #req5').on('change', function(){

		if ($('#req1').is(':checked')) {
			$('#label-req1').css({'color':'green'});
		}else{
			$('#label-req1').css({'color':''});
		}

		if ($('#req2').is(':checked')) {
			$('#label-req2').css({'color':'green'});
		}else{
			$('#label-req2').css({'color':''});
		}
		
		if ($('#req3').is(':checked')) {
			$('#label-req3').css({'color':'green'});
		}else{
			$('#label-req3').css({'color':''});
		}

		if ($('#req4').is(':checked')) {
			$('#label-req4').css({'color':'green'});
		}else{
			$('#label-req4').css({'color':''});
		}

		if ($('#req5').is(':checked')) {
			$('#label-req5').css({'color':'green'});
		}else{
			$('#label-req5').css({'color':''});
		}
	});
}

function fnValidateAgeAdd() {
	var dateBirth 	= new Date($('#appDateOfBirth').val());
	var dateNow 	= new Date(Date.now());
	var intAge 		= Math.floor((parseInt(Date.parse(dateNow)) - parseInt(Date.parse(dateBirth))) / (1000*60*60*24*365));
	return (parseInt(intAge));
}

function fnValidateAgeEdit() {
	var dateBirth 	= new Date($('#eappDateOfBirth').val());
	var dateNow 	= new Date(Date.now());
	var intAge 		= Math.floor((parseInt(Date.parse(dateNow)) - parseInt(Date.parse(dateBirth))) / (1000*60*60*24*365));
	return (parseInt(intAge));
}

function fnAddWalkinApplicant(){
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-applicant.php?query=ADD',
		type: 'post',
		data: $('#frmAddWalkinApplicant').serialize(),
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
			if ($('#appPNPhoneNumber').val().length !== 16) {
				toastr.error('Phone number is invalid.');
				$('#appPNPhoneNumber').css('border-color','red');
				$('#_pnphone').effect('shake');
				xhr.abort();
			}
		},
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success("Successfully Saved.");
				$('#tblApplicantManagement').DataTable().ajax.reload();
				$('#tblReqManagementList').DataTable().ajax.reload();
				$('#appDateOfBirth, #appPhoneNumber').css('border-color','');
				$('#appMunPB, #appMunHA').prop('disabled',true);
				$('#appBarPB, #appBarHA').prop('disabled',true);
				$('#frmAddWalkinApplicant')[0].reset();
			}else{
				fnLaunchNanobar();
				toastr.error("Ooops! Something went wrong.");
			}
			console.log(result);
		}
	});
}

function fnEditWalkinApplicant(){
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-applicant.php?query=EDIT',
		type: 'post',
		data: $('#frmEditWalkinApplicant').serialize(),
		dataType: 'html',
		beforeSend: function(xhr){
			if (fnValidateAgeEdit() < 18) {
				toastr.error('Applicant must be at least 18 years of age.');
				$('#eappDateOfBirth').css('border-color','red');
				$('#_edob').effect('shake');
				xhr.abort();
			}
			if ($('#eappPhoneNumber').length == 15) {
				toastr.error('Phone number is invalid.');
				$('#eappPhoneNumber').css('border-color','red');
				$('#_ephone').effect('shake');
				xhr.abort();
			}
		},
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success("Successfully Saved.");
				$('#tblApplicantManagement').DataTable().ajax.reload();
				$('#tblReqManagementList').DataTable().ajax.reload();
				$('#eappDateOfBirth, #eappPhoneNumber').css('border-color','');
				$('[data-remodal-id=modalEditApplicant]').remodal().close();
			}else{
				fnLaunchNanobar();
				toastr.error("Ooops! Something went wrong.");
			}
			// console.log(result);
		}
	});
}

function fnRequirementManagementTable(){
	var tblReqManagementList = $('#tblReqManagementList').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-requirement-management.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'applicantid'},
			{'data':'fullname'},
			{'data':'gender'},
			{'data':'address'},
			{'data':'position'},
			{'data':null}
		],
		columnDefs: [ {
			targets: -1,
			data: null,
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-secondary" id="viewapplicantR" data-remodal-target="modalViewApplicantR" title="Click to view applicant checklist."><i class="ion-eye"></i> View</button>\
							<button class="btn btn-sm btn-secondary" id="editapplicantR" data-remodal-target="modalEditApplicantR" title="Click to edit applicant checklist."><i class="fa fa-edit"></i> Edit</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblReqManagementList tbody').on('click', '#viewapplicantR', function(){
		var dataId		= tblReqManagementList.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];

		$.ajax({
			url: serverdir + '/php/query-requirement-management.php?query=VIEW',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#vappFullname').val(result[1]['fullname']);
					$('#vappAddHA').val(result[1]['homeaddress']);
					$('#vappGender').val(result[1]['gender']);
					$('#vappDOB').val(result[1]['dob']);
					$('#vappAddPB').val(result[0]['pobaddress']);
					$('#vappPhoneNumber').val(result[1]['phone']);
					$('#vappPD').val(result[1]['position']);
					$('#vappCBName').val(result[1]['cbname']);
					$('#vappCBAdd').val(result[1]['cbaddress']);
					$('#vappEmpName').val(result[1]['empname']);

					if (result[2]['req1'] == 1) {
						$('#vreq1').css('color','green');
					}else{
						$('#vreq1').css('color','');
					}

					if (result[2]['req2'] == 1) {
						$('#vreq2').css('color','green');
					}else{
						$('#vreq2').css('color','');
					}

					if (result[2]['req3'] == 1) {
						$('#vreq3').css('color','green');
					}else{
						$('#vreq3').css('color','');
					}

					if (result[2]['req4'] == 1) {
						$('#vreq4').css('color','green');
					}else{
						$('#vreq4').css('color','');
					}

					if (result[2]['req5'] == 1) {
						$('#vreq5').css('color','green');
					}else{
						$('#vreq5').css('color','');
					}
				}
			}
		});
	});

	$('#tblReqManagementList tbody').on('click', '#editapplicantR', function(){
		var dataId		= tblReqManagementList.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];

		$.ajax({
			url: serverdir + '/php/query-requirement-management.php?query=VIEW',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#txtHiddenApplicantIdR').val(result[0]['applicantid']);
					$('#eappFullname').val(result[1]['fullname']);
					$('#eappAddHA').val(result[1]['homeaddress']);
					$('#eappGender').val(result[1]['gender']);
					$('#eappDOB').val(result[1]['dob']);
					$('#eappAddPB').val(result[0]['pobaddress']);
					$('#eappPhoneNumber').val(result[1]['phone']);
					$('#eappPD').val(result[1]['position']);
					$('#eappCBName').val(result[1]['cbname']);
					$('#eappCBAdd').val(result[1]['cbaddress']);
					$('#eappEmpName').val(result[1]['empname']);

					if (result[2]['req1'] == 1) {
						$('#ereq1').prop('checked',true);
						$('#label-ereq1').css('color','green');
					}else{
						$('#ereq1').prop('checked',false);
						$('#label-ereq1').css('color','');
					}

					if (result[2]['req2'] == 1) {
						$('#ereq2').prop('checked',true);
						$('#label-ereq2').css('color','green');
					}else{
						$('#ereq2').prop('checked',false);
						$('#label-ereq2').css('color','');
					}

					if (result[2]['req3'] == 1) {
						$('#ereq3').prop('checked',true);
						$('#label-ereq3').css('color','green');
					}else{
						$('#ereq3').prop('checked',false);
						$('#label-ereq3').css('color','');
					}

					if (result[2]['req4'] == 1) {
						$('#ereq4').prop('checked',true);
						$('#label-ereq4').css('color','green');
					}else{
						$('#ereq4').prop('checked',false);
						$('#label-ereq4').css('color','');
					}

					if (result[2]['req5'] == 1) {
						$('#ereq5').prop('checked',true);
						$('#label-ereq5').css('color','green');
					}else{
						$('#ereq5').prop('checked',false);
						$('#label-ereq5').css('color','');
					}
				}
			}
		});
	});


	//Requirement Checkbox Function
	$('#ereq1, #ereq2, #ereq3, #ereq4, #ereq5').on('change', function(){

		if ($('#ereq1').is(':checked')) {
			$('#label-ereq1').css({'color':'green'});
		}else{
			$('#label-ereq1').css({'color':''});
		}

		if ($('#ereq2').is(':checked')) {
			$('#label-ereq2').css({'color':'green'});
		}else{
			$('#label-ereq2').css({'color':''});
		}
		
		if ($('#ereq3').is(':checked')) {
			$('#label-ereq3').css({'color':'green'});
		}else{
			$('#label-ereq3').css({'color':''});
		}

		if ($('#ereq4').is(':checked')) {
			$('#label-ereq4').css({'color':'green'});
		}else{
			$('#label-ereq4').css({'color':''});
		}

		if ($('#ereq5').is(':checked')) {
			$('#label-ereq5').css({'color':'green'});
		}else{
			$('#label-ereq5').css({'color':''});
		}
	});

}

function fnEditApplicantRequirement(){
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-requirement-management.php?query=EDIT',
		type: 'post',
		data: $('#frmEditRequirements').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success("Update Requirement Successful.");
				$('#tblReqManagementList').DataTable().ajax.reload();
				$('[data-remodal-id=modalEditApplicantR]').remodal().close();
			}else{
				fnLaunchNanobar();
				toastr.error('Ooops! Something went wrong.');
			}
		}
	});
}

function fnOnlineApplicantsTable(){
	var tblOnlineApplicantList = $('#tblOnlineApplicantList').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-online-applicant.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'applicantid'},
			{'data':'fullname'},
			{'data':'gender'},
			{'data':'address'},
			{'data':'position'},
			{'data':null}
		],
		columnDefs: [ {
			targets: -1,
			data: null,
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-success" id="approveOnline" title="Click to approve online applicant application."><i class="fa fa-fw fa-check"></i> Approve Application</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblOnlineApplicantList tbody').on('click', '#approveOnline', function(){
		var dataId		= tblOnlineApplicantList.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];
		var applicantfullname = dataId['fullname'];

		alertify.confirm('','Are you sure you want to approve "'+ applicantfullname +'" online application?', function(){ 
			
			$.ajax({
				url: serverdir + '/php/query-online-applicant.php?query=APPROVE',
				type: 'post',
				data: {'applicantid':applicantid},
				dataType: 'json',
				success: function(result){
					if (result == true) {
						fnLaunchNanobar();
						toastr.success("SMS Notification Sent");
						toastr.success("Approval Successfull.");
						$('#tblOnlineApplicantList').DataTable().ajax.reload();
						$('#tblReqManagementList').DataTable().ajax.reload();
					}else{
						fnLaunchNanobar();
						toastr.error("Ooops! Somethingw went wrong.");
					}
				}
			});

		}, null).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});

	});

}

function fnRenewalApplicantsTable(){
	var tblRenewalApplicantList = $('#tblRenewalApplicantList').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-renewal-applicant.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'applicantid'},
			{'data':'fullname'},
			{'data':'gender'},
			{'data':'address'},
			{'data':'position'},
			{'data':null}
		],
		columnDefs: [ {
			targets: -1,
			data: null,
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-success" id="approveRenewal" title="Click to renew applicant application."><i class="fa fa-fw fa-check"></i>Approve Renewal</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblRenewalApplicantList tbody').on('click', '#approveRenewal', function(){
		var dataId		= tblRenewalApplicantList.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];

		alertify.confirm('','Are you sure you want to approve renewal applicant application?', function(){ 
			
			$.ajax({
				url: serverdir + '/php/query-renewal-applicant.php?query=APPROVE',
				type: 'post',
				data: {'applicantid':applicantid},
				dataType: 'json',
				success: function(result){
					if (result == true) {
						fnLaunchNanobar();
						toastr.success("Approval Successfull.");
						$('#tblRenewalApplicantList').DataTable().ajax.reload();
						$('#tblReqManagementList').DataTable().ajax.reload();
					}else{
						fnLaunchNanobar();
						toastr.error("Ooops! Something went wrong.");
					}
				}
			});

		}, null).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});
	});
}

function fnPrintPermitTable(){
	var tblPrintPermit = $('#tblPrintPermit').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-applicant-permit.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'applicantid'},
			{'data':'fullname'},
			{'data':'gender'},
			{'data':'address'},
			{'data':'position'},
			{'data':null}
		],
		columnDefs: [ {
			targets: -1,
			data: null,
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-secondary" id="printidR" data-remodal-target="modalApplicantIdR" title="Click to print applicant ID."><i class="fa fa-id-card"></i> ID</button>\
							<button class="btn btn-sm btn-secondary" id="printpermitR" title="Click to print applicant permit."><i class="fa fa-print"></i> IWP</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblPrintPermit tbody').on('click','#printpermitR', function(){
		var dataId		= tblPrintPermit.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];

		alertify.confirm('','Generate Individual Working Permit ?', function(){ 

			$.ajax({
				url: serverdir + '/php/query-applicant.php?query=REL_DATE',
				type: 'post',
				data: {'applicantid': applicantid},
				dataType: 'html',
				success: function(result){

					if (result == true) {
						window.open(serverdir + '/php/generate-permit.php?applicantid='+applicantid);
					}else{
						fnLaunchNanobar();
						toastr.error("Ooops! Something went wrong.");
					}

				}
			})


		}, null).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});
	});

	$('#tblPrintPermit tbody').on('click', '#printidR', function(){
		var dataId		= tblPrintPermit.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];

		var imageSrc;
		$.ajax({
			url: serverdir + '/php/query-applicant.php?query=VIEW',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#txtHiddenApplicantId, #txtHiddenApplicantIdImage').val(result[0]['applicantid']);
					$('#vappFullname').val(result[1]['fname']+' '+result[1]['mname']+' '+result[1]['lname']);
					$('#vappCompanyname').val(result[1]['cbname']);
					$('#vappPosition').val(result[1]['position']);
					$('#vappAddress').val(result[1]['homeaddress']);
					$('#vappPNNameId').val(result[1]['pnname']);
					$('#vappPNAddId').val(result[1]['pnaddress']);
					$('#vappPNPhoneNumberId').val(result[1]['pnphone']);
					imageSrc = '../../includes/img/applicant-images/'+result[1]['image'];

					if (result[1]['image'] == "") {
						$('#imageUpload').attr('src', '../../includes/img/applicant-images/blank.jpg');
						$('#btnImageSave, #inputImage').attr('hidden',false);
						$('#btnImageChange, #btnGenerateID, #btnCancel').attr('hidden',true);

					}else{
						$('#imageUpload').attr('src', '../../includes/img/applicant-images/'+result[1]['image']);
						$('#btnImageSave, #inputImage, #btnCancel').attr('hidden',true);
						$('#btnImageChange, #btnGenerateID').attr('hidden',false);
					}
				}
			}
		})

		$('#btnCancel').on('click',function(){
			$('#btnImageSave, #inputImage, #btnCancel').attr('hidden',true);
			$('#inputImage').val('');
			$('#btnImageChange, #btnGenerateID').attr('hidden',false);
			$('#imageUpload').attr('src', imageSrc);
		});

	});
}

function fnViewUploadImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#imageUpload').attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function fnSaveImage(){

    event.preventDefault();

    var applicantid = $('#txtHiddenApplicantIdImage').val();

    $.ajax({
        url: serverdir + '/php/query-reports.php?query=UPLOAD',
        type: 'post',
        data: new FormData($('#frmSaveImage')[0]),
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
        	if (result==true) {
        		fnLaunchNanobar();
        		toastr.success('Image Successfully Saved.');

				$('#inputImage,#btnImageSave, #btnCancel').attr('hidden',true);

				$('#btnImageChange, #btnGenerateID').attr('hidden',false);

        		$('#tblPrintPermit').DataTable().ajax.reload();

        		$('#frmSaveImage')[0].reset();
			}
        }
    });
}

$(document).ready(function(){
	
	$('#btnImageChange').on('click',function(){
		$('#btnImageSave, #inputImage, #btnCancel').attr('hidden',false);
		$('#btnImageChange, #btnGenerateID').attr('hidden',true);
	});

	$('#inputImage').on('change', function(){
		fnViewUploadImage(this);
	})

	// Refresh Table Every 5 sec
	setInterval(function(){
		$('#tblApplicantManagement').DataTable().ajax.reload();
		$('#tblReqManagementList').DataTable().ajax.reload();
		$('#tblOnlineApplicantList').DataTable().ajax.reload();
		$('#tblRenewalApplicantList').DataTable().ajax.reload();
		$('#tblPrintPermit').DataTable().ajax.reload();
	},5000);

	$('#appDateOfBirth').on('change click',function(){
		var dateBirth 	= new Date($('#appDateOfBirth').val());
		var dateNow 	= new Date(Date.now());

		if (fnValidateAgeAdd() < 18) {
			$('#appDateOfBirth').css({'border-color':'red'});
		}
		else{
			$('#appDateOfBirth').css({'border-color':''});
		}

		if (fnValidateAgeAdd()<0) {
			$('#appAge').val() = 0;
		}else{
			$('#appAge').val(fnValidateAgeAdd());
		}
	});

	$('#eappDateOfBirth').on('change click',function(){
		var dateBirth 	= new Date($('#eappDateOfBirth').val());
		var dateNow 	= new Date(Date.now());
		if (fnValidateAgeEdit() < 18) {
			$('#eappDateOfBirth').css({'border-color':'red'});
		}
		else{
			$('#eappDateOfBirth').css({'border-color':''});
		}
	});

	//Mask Phone Number
	$('#appPhoneNumber, #eappPhoneNumber, #eappPNPhoneNumber, #appPNPhoneNumber').mask('+63-999-999-9999',{placeholder: ''});

	//Load Tables
	fnAllApplicantsTable();
	fnRequirementManagementTable();
	fnOnlineApplicantsTable();
	fnRenewalApplicantsTable();
	fnPrintPermitTable();

	//Form Submit
	$('#frmAddWalkinApplicant').on('submit', function(event){
		fnAddWalkinApplicant();
	});

	$('#frmEditWalkinApplicant').on('submit', function(event){
		fnEditWalkinApplicant();
	});

	$('#frmEditRequirements').on('submit', function(event){
		fnEditApplicantRequirement();
	});

	$('#frmSaveImage').on('submit', function(event){
		fnSaveImage(); 
	});

	//Form Clear

	$('#btnClearApplicant').click(function(){
		$('#appDateOfBirth, #appPhoneNumber').css('border-color','');
		$('#appMunPB, #appMunHA').prop('disabled',true);
		$('#appBarPB, #appBarHA').prop('disabled',true);
		$('#frmAddWalkinApplicant')[0].reset();
	});


	$('#btnGenerateID').on('click', function(event){
		var applicantid = $('#txtHiddenApplicantId').val();
		$('[data-remodal-id=modalApplicantIdR]').remodal().close();
		
		alertify.confirm('','Generate Identification Card ?', function(){
			 
			window.open(serverdir + '/php/generate-id.php?applicantid='+applicantid);

		},null).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});
		
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

	// Edit Place of Birth

	fnGetProvinces($('#eappProvPB'),$('#eappMunPB'),$('#eappBarPB'));
	
	$('#eappProvPB').on('change',function(){
		fnGetCityMuns($('#eappProvPB'),$('#eappMunPB'),$('#eappBarPB'));
		$('#eappMunPB').prop('disabled',false);
		$('#eappBarPB').html('<option value="" selected disabled>Select Barangay</option>');
		$('#eappBarPB').prop('disabled',true);
	});

	$('#eappMunPB').on('change',function(){
		
		fnGetBrgys($('#eappProvPB'),$('#eappMunPB'),$('#eappBarPB'));
		$('#eappBarPB').prop('disabled',false);
	});

	// Edit Home Address

	fnGetProvinces($('#eappProvHA'),$('#eappMunHA'),$('#eappBarHA'));
	
	$('#eappProvHA').on('change',function(){
		fnGetCityMuns($('#eappProvHA'),$('#eappMunHA'),$('#eappBarHA'));
		$('#eappMunHA').prop('disabled',false);
		$('#eappBarHA').html('<option value="" selected disabled>Select Barangay</option>');
		$('#eappBarHA').prop('disabled',true);
	});

	$('#eappMunHA').on('change',function(){
		
		fnGetBrgys($('#eappProvHA'),$('#eappMunHA'),$('#eappBarHA'));
		$('#eappBarHA').prop('disabled',false);
	});

})