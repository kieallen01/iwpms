function fnListOfFees(){
	var tblListOfFees = $('#tblListOfFees').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-fees.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'fee_id'},
			{'data':'fee_desc'},
			{'data':'fee_cost'},
			{'data':'date_created'},
			{'data':null}
		],
		columnDefs: [ {
			targets: -1,
			data: null,
			defaultContent: '<center>\
							<button id="editfee" class="btn btn-sm btn-secondary" data-remodal-target="modalEditFee"><i class="ion ion-compose"></i> Edit</button>\
							<button id="deletefee" class="btn btn-sm btn-secondary"><i class="fa fa-trash"></i> Remove</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	// EDIT FEE

	$('#tblListOfFees tbody').on('click', '#editfee', function(){
		var dataID = tblListOfFees.row( $(this).parents('tr') ).data();
		var fee_id = dataID['fee_id'];

		$.ajax({
			url: serverdir + '/php/query-fees.php?query=VIEW',
			type: 'post',
			data: {'fee_id':fee_id},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#efeedescription').val(result[0]['fee_desc']);
					$('#efee').val(result[0]['fee']);
					$('#hiddenFeeId').val(result[0]['fee_id']);
				}
			}
		});
	});

	// DELETE FEE

	$('#tblListOfFees tbody').on('click', '#deletefee', function(){

		var dataID 		= tblListOfFees.row( $(this).parents('tr') ).data();
		var fee_id  	= dataID['fee_id'];
		var fee_desc	= dataID['fee_desc'];

		alertify.confirm('','Are you sure you want to remove '+'"'+fee_desc+'" ?', function(){ 

			$.ajax({
				url: serverdir + '/php/query-fees.php?query=REMOVE',
				type: 'post',
				data: {'fee_id':fee_id,'fee_desc':fee_desc},
				dataType: 'html',
				success: function(result){
					if (result == true) {
						fnLaunchNanobar();
						toastr.success("Fee Successfully Deleted.");
						$('#tblListOfFees').DataTable().ajax.reload();
						// console.log(result);
					}else{
						fnLaunchNanobar();
						toastr.error("Ooops! Something went wrong.");
						// console.log(result);
					}
				}

			});

		}, function(){toastr.error('Cancelled.');}).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});
	});
}

function fnAddFees(){

	event.preventDefault();

	$.ajax({
		url: serverdir + '/php/query-fees.php?query=ADD',
		type: 'post',
		data: $('#frmAddFee').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {

				fnLaunchNanobar();
				toastr.success("Successfully Saved");
				$('#frmAddFee')[0].reset();
				$('#tblListOfFees').DataTable().ajax.reload();
				console.log(result);
			
			}else{

				fnLaunchNanobar();
				toastr.error("Ooops! Something went wrong.");
				console.log(result);
			}

		}
	});

}

function fnEditFees(){
	event.preventDefault();

	$.ajax({
		url: serverdir + '/php/query-fees.php?query=EDIT',
		type: 'post',
		data: $('#frmEditFee').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success('Successfully Saved.');
				$('#tblListOfFees').DataTable().ajax.reload();
				$('[data-remodal-id=modalEditFee]').remodal().close();
				console.log(result);
			}else{
				fnLaunchNanobar();
				toastr.error('Ooops! Something went wrong.');
				console.log(result);
			}
		}
	});
}

function fnListOfPenalty(){
	var tblListOfPenaltyRate = $('#tblListOfPenaltyRate').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-penalty.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'penalty_id'},
			{'data':'penalty_desc'},
			{'data':'penalty_rate'},
			{'data':'penalty_deadline'},
			{'data':null},			
			{'data':'penalty_status',
				render: function(data,type,meta){
					if(data == 1){
						return '<center style="padding-top:00px;"><label class="switch"><input id="deactivate" type="checkbox"><span class="slider round"></span></label></center>';
					}else{
						return '<center style="padding-top:00px;"><label class="switch"><input id="activate" type="checkbox" checked><span class="slider round"></span></label></center>';
					}
				}
			}
		],
		columnDefs: [ {
			targets: -2,
			data: null,
			defaultContent: '<center>\
								<button id="viewpenalty" class="btn btn-sm btn-secondary" data-remodal-target="modalViewPenalty"><i class="ion ion-eye"></i> View</button>\
								<button id="editpenalty" class="btn btn-sm btn-secondary" data-remodal-target="modalEditPenalty"><i class="ion ion-compose"></i> Edit</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	$('#tblListOfPenaltyRate tbody').on('click', '#viewpenalty', function(){

		var dataID		= tblListOfPenaltyRate.row( $(this).parents('tr') ).data();
		var penalty_id	= dataID['penalty_id'];

		$.ajax({
			url: serverdir + '/php/query-penalty.php?query=VIEW',
			type: 'post',
			data: {'penalty_id':penalty_id},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#vpendescription').val(result[0]['penalty_desc']);
					$('#vpenrate').val(result[0]['penalty_rate']);
					$('#vpendate').val(result[0]['penalty_deadline']);
				}
				console.log(result);
			}
		})
	});

	$('#tblListOfPenaltyRate tbody').on('click', '#editpenalty', function(){

		var dataID		= tblListOfPenaltyRate.row( $(this).parents('tr') ).data();
		var penalty_id	= dataID['penalty_id'];

		$.ajax({
			url: serverdir + '/php/query-penalty.php?query=VIEW',
			type: 'post',
			data: {'penalty_id':penalty_id},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#hiddenPenaltyId').val(result[0]['penalty_id']);
					$('#ependescription').val(result[0]['penalty_desc']);
					$('#epenrate').val(result[0]['penalty_rate']);
					$('#ependate').val(result[0]['penalty_deadline']);
				}
				console.log(result);
			}
		})

	});
}

function fnAddPenalty(){

	event.preventDefault();

	$.ajax({
		url: serverdir + '/php/query-penalty.php?query=ADD',
		type: 'post',
		data: $('#frmAddPenaltyRate').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success("Successfully Saved");
				$('#frmAddPenaltyRate')[0].reset();
				$('#tblListOfPenaltyRate').DataTable().ajax.reload();
				console.log(result);
			
			}else{

				fnLaunchNanobar();
				toastr.error("Ooops! Something went wrong.");
				console.log(result);
			}

		}
	});
}

function fnEditPenalty(){
	event.preventDefault();

	$.ajax({
		url: serverdir + '/php/query-penalty.php?query=EDIT',
		type: 'post',
		data: $('#frmEditPenalty').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success('Successfully Saved.');
				$('#tblListOfPenaltyRate').DataTable().ajax.reload();
				$('[data-remodal-id=modalEditPenalty]').remodal().close();
				console.log(result);
			}else{
				fnLaunchNanobar();
				toastr.error('Ooops! Something went wrong.');
				console.log(result);
			}
		}
	});
}

$(document).ready(function(){
	// Load Table
	fnListOfFees();
	fnListOfPenalty();

	// Add Fee

	$('#frmAddFee').submit(function(event){
		fnAddFees();
	});

	$('#frmAddPenaltyRate').submit(function(event){
		fnAddPenalty();
	});

	$('#frmEditFee').submit(function(event){
		fnEditFees();
	});

	$('#frmEditPenalty').submit(function(event){
		fnEditPenalty();
	});

})