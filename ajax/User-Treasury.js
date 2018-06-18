
function arrSum(array) {
	var sum = 0;
	for (var i = 0; i < array.length; i++) {
		sum += parseFloat(array[i]['feecost']);
	}

	$('#feeTotal').val(sum);
}
	var tocollect = [];
	var tempID = 0;

function fnFeesOfApplicant(){


	$('#cmbAppFeeDescription').on('change', function(){
		$('#btnAddFeeDrop').prop('disabled',false);
		$('#appFeeId').val($('#cmbAppFeeDescription option:selected').data('id'));
		$('#appFeeCost').val($('#cmbAppFeeDescription option:selected').data('fee'));
		$('#btnAddFeeDrop').prop('disabled',false);
	});
	

	$('#tblListOfCollections tfoot').on('click', '#btnAddFeeDrop', function(){
		$('#appFeeId').val('');
		$('#appFeeCost').val('');
		$('#btnAddFeeDrop').prop('disabled',true);
		$('#tblListOfCollections tbody').empty();
		var feeid = $(this).closest('tr').find('#cmbAppFeeDescription option:selected').data('id');
		var feedesc = $(this).closest('tr').find('#cmbAppFeeDescription option:selected').text();
		var feecost = $(this).closest('tr').find('#cmbAppFeeDescription option:selected').data('fee');

		$("#cmbAppFeeDescription option:selected").attr('disabled','disabled');

		tempID++;
		selected = {
			'tempID' : tempID,
			'feeid'  : feeid,
			'feedesc': feedesc,
			'feecost': feecost
		};

		tocollect.push(selected);
		$.each(tocollect, function(i,val){
			$('#tblListOfCollections tbody').append(
				'<tr>'+
					"<td class='id'>"+val.feeid+'</td>'+
					'<td>'+val.feedesc+'</td>'+
					'<td>'+val.feecost+'</td>'+
					'<td><center><button type = "button" id = "btnRemoveFee" class = "btn btn-sm btn-default"><i class = "fa fa-fw fa-trash"></i></button></center></td>'+
				'</tr>'
			);
		});
		arrSum(tocollect);
		$('#cmbAppFeeDescription').prop('selectedIndex',0);
	});

	$('#tblListOfCollections tbody').on('click','#btnRemoveFee', function(event){

		var todelete = $(this).closest('tr').remove();
		var dataId	 = $(this).closest('tr').find('.id').text();

		$.each(tocollect,function(i,val){
			if (tocollect[i].tempID == val.tempID) {
				tocollect.splice(i,1);
				return false;
			}
		});
		$("#cmbAppFeeDescription option[value="+dataId+"]").attr('disabled',false);
	});
}

function fnLoadFees(){

	$.ajax({
		url: serverdir + '/php/query-fees.php?query=FEES',
		type: 'post',
		cache: false,
		dataType: 'json',
		success: function(data){
			if (data.length > 0) {
				var array = [];
				array.push('<option value="" selected disabled>Select Fee Desciption</option>');

				$.each(data, function(i,val){
					array.push('<option value = "'+val.feeid+'" data-fee = "'+val.feecost+'" data-id = "'+val.feeid+'">'+val.feedesc+'</option>');
				});

				$('#cmbAppFeeDescription').html(array);

			}else{
				toastr.error("Ooops! Something went wrong.");
			}
		}
	});
}

function fnAllApplicantsTreasury(){
	var tblTreasuryApplicantList = $('#tblTreasuryApplicantList').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-applicant-treasury.php?query=TABLE',
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
							<button class="btn btn-sm btn-secondary" id="viewrequirementT" data-remodal-target="modalViewApplicantT" title="Click to view applicant requirement."><i class="ion-eye"></i> View</button>\
							<button class="btn btn-sm btn-secondary" id="updaterequirementT" data-remodal-target="modalUpdateRequirementT" title="Click to update applicant requirement."><i class="fa fa-check"></i> Approve</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblTreasuryApplicantList tbody').on('click', '#viewrequirementT', function(){
		var dataId		= tblTreasuryApplicantList.row( $(this).parents('tr') ).data();
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



	$('#tblTreasuryApplicantList tbody').on('click', '#updaterequirementT', function(){
		var dataId		= tblTreasuryApplicantList.row( $(this).parents('tr') ).data();
		var applicantid	= dataId['applicantid'];

		$.ajax({
			url: serverdir + '/php/query-check-penalty.php',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result!== undefined) {
					$('#feePenalty').val(result[0]['penalty']);
				}
			}
		});

		$.ajax({
			url: serverdir + '/php/query-requirement-management.php?query=VIEW',
			type: 'post',
			data: {'applicantid':applicantid},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#txtHiddenApplicantIdT').val(result[0]['applicantid']);
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
				}
			}
		});

	});
}

function fnAllApplicantsTreasuryComplete(){
	var tblTreasuryApplicantListComplete = $('#tblTreasuryApplicantListComplete').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-applicant-treasury.php?query=COMPLETE',
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

function fnUpdateRequirementT(){
	var applicantid = $('#txtHiddenApplicantIdT').val();
	var ornumber	= $('#feeORNumber').val();
	var paymentdate	= $('#feeDateOfPayment').val();
	var total 		= $('#feeTotal').val();
	var penaltyfee  = $('#feePenalty').val();

	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-applicant-treasury.php?query=UPDATES',
		type: 'post',
		data: {
			'applicantid':applicantid,
			'ornumber':ornumber,
			'paymentdate':paymentdate,
			'total':total,
			'penaltyfee':penaltyfee,
			'tocollect':tocollect
		},
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success("Approve Requirement Successful.");
				$('#tblTreasuryApplicantList').DataTable().ajax.reload();
				$('#tblTreasuryApplicantListComplete').DataTable().ajax.reload();
				$('[data-remodal-id=modalUpdateRequirementT]').remodal().close();
			}else{
				fnLaunchNanobar();
				toastr.error('Ooops! Something went wrong.');
			}
			console.log(result);
		}
	});
}

function fnListOfCollections(){

	var logdatefrom = $('#collectiondatefrom').val();
	var logdateto = $('#collectiondateto').val();
	
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-reports.php?query=COLLMTO',
		type: 'post',
		data: $('#frmCollectionMTO').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				window.open(serverdir + '/php/generate-collections.php?datefrom='+logdatefrom+'&dateto='+logdateto);	
				console.log(result);
			}else{
				toastr.error('No results found.');
				console.log(result);
			}
		}
	});
}

$(document).ready(function(){

	//Load Fee Appending Function
	fnFeesOfApplicant();
	//Load Fee Query for Dropdown
	fnLoadFees();

	//Load Table for All Applicant
	fnAllApplicantsTreasury();
	fnAllApplicantsTreasuryComplete();

	setInterval(function(){
		$('#tblTreasuryApplicantList, #tblTreasuryApplicantListComplete').DataTable().ajax.reload();
	},5000);

	$('#frmUpdateRequirementsT').on('submit', function(event){
		fnUpdateRequirementT();
		var applicantid = $('#txtHiddenApplicantIdT').val();
		var ornumber	= $('#feeORNumber').val();
		var paymentdate	= $('#feeDateOfPayment').val();
		var total 		= $('#feeTotal').val();
		var penaltyfee  = $('#feePenalty').val();

		window.open(serverdir + '/php/generate-receipt.php?applicantid='+applicantid+'&ornumber='+ornumber+'&paymentdate='+paymentdate+'&total='+total+'&penaltyfee='+penaltyfee);
	});

	$('#filterMto').on('change',function(){

		var onprocess = $('#mtoOnProcess');
		var complete  = $('#mtoComplete');
		var filter    = $(this).val();

		if (filter == 0) {
			complete.attr('hidden', true);
			onprocess.attr('hidden', false);
		}else{
			complete.attr('hidden', false);
			onprocess.attr('hidden', true);
		}

	});

	$('#frmCollectionMTO').on('submit', function(event){
		fnListOfCollections();
	});
});