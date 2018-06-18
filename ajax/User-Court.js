function fnAllApplicantsTrial(){
	var tblTrialApplicantList = $('#tblTrialApplicantList').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-applicant-trial.php?query=TABLE',
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
							<button class="btn btn-sm btn-secondary" id="viewrequirementC" data-remodal-target="modalViewApplicantC" title="Click to view applicant requirement."><i class="ion-eye"></i> View</button>\
							<button class="btn btn-sm btn-secondary" id="updaterequirementC" data-remodal-target="modalUpdateRequirementC" title="Click to update applicant requirement."><i class="fa fa-check"></i> Approve</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblTrialApplicantList tbody').on('click', '#viewrequirementC', function(){
		var dataId		= tblTrialApplicantList.row( $(this).parents('tr') ).data();
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

	$('#tblTrialApplicantList tbody').on('click', '#updaterequirementC', function(){
		var dataId		= tblTrialApplicantList.row( $(this).parents('tr') ).data();
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
						$('#ereq4').prop('disabled',true);
						$('#label-ereq4').css('color','green');

					}else{

						$('#ereq4').prop('checked',false);
						$('#ereq4').prop('disabled',true);
						$('#label-ereq4').css('color','');

					}

					if (result[2]['req5'] == 1) {

						$('#ereq5').prop('checked',true);
						$('#ereq5').prop('disabled',true);
						$('#label-ereq5').css('color','green');

					}else{

						$('#ereq5').prop('checked',false);
						$('#ereq5').prop('disabled',true);
						$('#label-ereq5').css('color','');
					}
				}
			}
		});

	});
}

function fnAllApplicantsTrialComplete(){
	var tblTrialApplicantListComplete = $('#tblTrialApplicantListComplete').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-applicant-trial.php?query=COMPLETE',
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
								<span style="color:green;font-weight:bold;">COMPLETE</span>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});
}

$(document).ready(function(){

	//Load Table
	fnAllApplicantsTrial();
	fnAllApplicantsTrialComplete();

	//Reload Table 5s
	setInterval(function(){
		$('#tblTrialApplicantList, #tblTrialApplicantListComplete').DataTable().ajax.reload();
	},5000);


	$('#btnUpdateRequirementT').on('click', function(event){

		$('[data-remodal-id=modalUpdateRequirementC]').remodal().close();
		
		alertify.confirm('','Are you sure you want to approve applicant/s requirement ?', function(){ 
			
			event.preventDefault();
			$.ajax({
				url: serverdir + '/php/query-applicant-trial.php?query=UPDATES',
				type: 'post',
				data: $('#frmUpdateRequirementsC').serialize(),
				dataType: 'html',
				success: function(result){
					if (result == true) {
						fnLaunchNanobar();
						toastr.success("Approve Requirement Successful.");
						$('#tblTrialApplicantList').DataTable().ajax.reload();
						$('#tblTrialApplicantListComplete').DataTable().ajax.reload();
						$('[ data-remodal-id=modalUpdateRequirementC]').remodal().close();
					}else{
						fnLaunchNanobar();
						toastr.error('Ooops! Something went wrong.');	
					}
					console.log(result);
				}
			});

		}, function(){toastr.error('Cancelled');}).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});

	});

	$('#filterMtc').on('change',function(){

		var onprocess = $('#mtcOnProcess');
		var complete  = $('#mtcComplete');
		var filter    = $(this).val();

		if (filter == 0) {
			complete.attr('hidden', true);
			onprocess.attr('hidden', false);
		}else{
			complete.attr('hidden', false);
			onprocess.attr('hidden', true);
		}

	});

});