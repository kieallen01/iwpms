
function fnSignatoryTable(){
	var tblListOfSignatories = $('#tblListOfSignatories').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-signatories.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'signatory_id'},
			{'data':'signatory_office'},
			{'data':'signatory_fullname'},
			{'data':'signatory_position'},
			{'data':null},
			{'data':'signatory_status',
				render: function(data,type,meta){
					if(data == 1){
						return '<center><label class="switch"><input id="deactivate" type="checkbox"><span class="slider round"></span></label></center>';
					}else{
						return '<center><label class="switch"><input id="activate" type="checkbox" checked><span class="slider round"></span></label></center>';
					}
				}
			}
		],
		columnDefs: [ {
			targets: -2,
			data: null,
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-secondary" id="viewSignatory" data-remodal-target="modalViewSignatory"><i class="ion-eye"></i> View</button>\
							<button class="btn btn-sm btn-secondary" id="editSignatory" data-remodal-target="modalEditSignatory"><i class="ion-compose"></i> Edit</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	//VIEW SIGNATORY

	$('#tblListOfSignatories tbody').on('click', '#viewSignatory', function(){

		var dataID			= tblListOfSignatories.row( $(this).parents('tr') ).data();
		var signatory_id	= dataID['signatory_id'];

		$.ajax({
			url: serverdir + '/php/query-signatories.php?query=VIEW',
			type: 'post',
			data: {'signatory_id':signatory_id},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#vsoffice').val(result[0]['signatory_office']);
					$('#vsfullname').val(result[0]['signatory_fullname']);
					$('#vsposition').val(result[0]['signatory_position']);
				}
			}
		})

	});

	//EDIT SIGNATORY

	$('#tblListOfSignatories tbody').on('click', '#editSignatory', function(){

		var dataID		 = tblListOfSignatories.row( $(this).parents('tr') ).data();
		var signatory_id = dataID['signatory_id'];

		$.ajax({
			url: serverdir + '/php/query-signatories.php?query=VIEW',
			type: 'post',
			data: {'signatory_id':signatory_id},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#hiddenSignatoryId').val(result[0]['signatory_id']);
					$('#esignatoryoffice').val(result[0]['signatory_office']);
					$('#esfname').val(result[0]['signatory_fname']);
					$('#esmname').val(result[0]['signatory_mname']);
					$('#eslname').val(result[0]['signatory_lname']);
					$('#esposition').val(result[0]['signatory_position']);
				}
			}
		})
	});

	// DEACTIVATE SIGNATORY 

	$('#tblListOfSignatories tbody').on('click','#deactivate', function(event){
		var dataId 	 	 = tblListOfSignatories.row( $(this).parents('tr') ).data();
		var signatory_id = dataId['signatory_id'];
		
		$.ajax({
			url: serverdir + '/php/query-signatories.php?query=DEAC',
			type:'post',
			data:{'signatory_id':signatory_id},
			dataType: 'html',
			success: function(result){
				if (result == true) {
					fnLaunchNanobar();
					toastr.clear();
					toastr.error('Signatory Status Deactivated');
					$('#tblListOfSignatories').DataTable().ajax.reload();
				}else{
					fnLaunchNanobar();
					toastr.error('Ooops! Something went wrong.');
				}

				console.log(result);
			}
		});
	});

	//ACTIVATE SIGNATORY

	$('#tblListOfSignatories tbody').on('click','#activate', function(event){
		var dataId 	 	 = tblListOfSignatories.row( $(this).parents('tr') ).data();
		var signatory_id = dataId['signatory_id'];
		
		$.ajax({
			url: serverdir + '/php/query-signatories.php?query=ACTI',
			type:'post',
			data:{'signatory_id':signatory_id},
			dataType: 'html',
			success: function(result){
				if (result == true) {
					fnLaunchNanobar();
					toastr.clear();
					toastr.success('Signatory Status Activated');
					$('#tblListOfSignatories').DataTable().ajax.reload();
				}else{
					fnLaunchNanobar();
					toastr.error('Ooops! Something went wrong.');
				}

				console.log(result);
			}
		});
	});
}

function fnAddSignatory(){

	event.preventDefault();

	$.ajax({
		url: serverdir + '/php/query-signatories.php?query=ADD',
		type: 'post',
		data: $('#frmAddSignatory').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {

				fnLaunchNanobar();
				toastr.success("Successfully Saved");
				$('#frmAddSignatory')[0].reset();
				$('#tblListOfSignatories').DataTable().ajax.reload();
				console.log(result);
			
			}else if(result == "EXIST"){
				fnLaunchNanobar();
				toastr.error("Signatory is already in used.");
				console.log(result);
			}else{
				fnLaunchNanobar();
				toastr.error("Ooops! Something went wrong.");
				console.log(result);
			}

		}
	});
}

function fnEditSignatory(){
	event.preventDefault();

	$.ajax({
		url: serverdir + '/php/query-signatories.php?query=EDIT',
		type: 'post',
		data: $('#frmEditSignatory').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				fnLaunchNanobar();
				toastr.success('Successfully Saved.');
				$('#tblListOfSignatories').DataTable().ajax.reload();
				$('[data-remodal-id=modalEditSignatory]').remodal().close();
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

	//LOAD TABLE
	fnSignatoryTable();

	//SUBMIT FORMS
	$('#frmAddSignatory').submit(function(event){
		fnAddSignatory();
	});

	$('#frmEditSignatory').submit(function(event){
		fnEditSignatory();
	});

})