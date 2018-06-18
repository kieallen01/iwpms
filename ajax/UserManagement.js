
function fnCheckPassword(){

	var password = $('#password').val();
	var rpassword = $('#rpassword').val();

	if ((password !== rpassword) && rpassword.length !== 0) {
		$('#rpassword').css({'border-color':'red'});
	}else{
		$('#rpassword').css({'border-color':''});
	}
}

function fnUsersTable(){
	var tblSystemUsers = $('#tblSystemUsers').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-user-management.php?query=TABLE',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'username'},
			{'data':'user_level'},
			{'data':'fullname'},
			{'data':null},
			{'data':'account_status',
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
			defaultContent: '\
							<center>\
							<button class="btn btn-sm btn-secondary" id="viewuser" data-remodal-target="modalViewUser"><i class="ion-eye"></i> View</button>\
							<button class="btn btn-sm btn-secondary" id="edituser" data-remodal-target="modalEditUser"><i class="ion-compose"></i> Edit</button>\
							</center>',
			orderable: false
		},{
			searchable: false
		}],
		pageLength: 5
	});

	// DEACTIVATE USER 

	$('#tblSystemUsers tbody').on('click','#deactivate', function(event){
		var dataId 	 = tblSystemUsers.row( $(this).parents('tr') ).data();
		var username = dataId['username'];
		
		$.ajax({
			url: serverdir + '/php/query-user-management.php?query=DEAC0',
			type:'post',
			data:{'username':username},
			dataType: 'html',
			success: function(result){

				if (result == "ACTIVE") {

					alertify.confirm('','You are currently logged in. This action will log you out and your account will be disabled. Do you wish to continue?', function(){ 

						$.ajax({
							url:serverdir + '/php/query-user-management.php?query=DEAC1',
							type: 'post',
							data: {'username':username},
							dataType: 'html',
							success: function(result){
								if (result == 1) {
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
								}else{

									console.log(result);
									// toastr.error("Ooops! Something went wrong.");

								}
							}
						});	

					},
					function(){

						$('#tblSystemUsers').DataTable().ajax.reload();

					}).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});

				}

				else if (result == true) {
					fnLaunchNanobar();
					toastr.clear();
					toastr.error('User Account Deactivated');
					$('#tblSystemUsers').DataTable().ajax.reload();
				}else{
					fnLaunchNanobar();
					toastr.error('Ooops! Something went wrong.');
				}
			}
		});

	});

	// ACTIVATE USER

	$('#tblSystemUsers tbody').on('click','#activate', function(event){

		var dataId 	 = tblSystemUsers.row( $(this).parents('tr') ).data();
		var username = dataId['username'];
		
		$.ajax({
			url: serverdir + '/php/query-user-management.php?query=ACTI',
			type:'post',
			data:{'username':username},
			dataType: 'html',
			success: function(result){
				if (result == true) {
					fnLaunchNanobar();
					toastr.clear();
					toastr.success('User Account Activated');
					$('#tblSystemUsers').DataTable().ajax.reload();
				}else{
					fnLaunchNanobar();
					toastr.error('Ooops! Something went wrong.');
				}
			}
		});

	});

	// VIEW USER INFO

	$('#tblSystemUsers tbody').on('click','#viewuser', function(event){

		var dataId    = tblSystemUsers.row( $(this).parents('tr')).data();
		var username  = dataId['username'];

		$.ajax({
			url: serverdir + '/php/query-user-management.php?query=VIEW',
			type:'post',
			data:{'username':username},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					$('#vuserlevel').val(result[0]['user_level']);
					$('#vusername').val(result[0]['username']);
					$('#vfname').val(result[0]['user_fname']);
					$('#vmname').val(result[0]['user_mname']);
					$('#vlname').val(result[0]['user_lname']);

					if(result[0]['user_status'] == '1'){
						$('#vstatus').val('Active');
						$('#vstatus').css({'color':'green'});
					}else{
						$('#vstatus').val('Deactivated');
						$('#vstatus').css({'color':'red'});
					}
				}
			}
		});
	});

	// EDIT USER INFO

	$('#tblSystemUsers tbody').on('click','#edituser', function(event){

		var dataId 	 = tblSystemUsers.row( $(this).parents('tr') ).data();
		var username = dataId['username'];

		$.ajax({
			url: serverdir + '/php/query-user-management.php?query=VIEW',
			type:'post',
			data:{'username':username},
			dataType: 'json',
			success: function(result){
				if (result !== undefined) {
					
					$('#hiddenUsername').val(result[0]['username']);
					$('#euserlevel').val(result[0]['user_level']);
					$('#eusername').val(result[0]['username']);
					$('#efname').val(result[0]['user_fname']);
					$('#emname').val(result[0]['user_mname']);
					$('#elname').val(result[0]['user_lname']);
				}
			}
		});
	})

}

function fnAddUser(){
	event.preventDefault();

	if ($('#password').val() == $('#rpassword').val()) {
		$.ajax({
			url: serverdir + '/php/query-user-management.php?query=ADD',
			type: 'post',
			data: $('#frmAddUser').serialize(),
			dataType: 'html',
			success: function(result){
				if (result == true) {

					fnLaunchNanobar();
					toastr.success('Successfully Saved');
					$('#frmAddUser')[0].reset();
					$('#tblSystemUsers').DataTable().ajax.reload();

				}else if (result == 'EXIST'){
					
					fnLaunchNanobar();
					toastr.error('Ooops! Username already exist.');
					$('#username').css({'border-color': 'red'});
					$('#_username').effect('shake');
					setTimeout(function(){
						$('#username').css({'border-color': ''});
					},500);		

				}else{

					fnLaunchNanobar();
					toastr.error('Ooops! Something went wrong.');
					$('#frmAddUser')[0].reset();
					
				}
			}
		});
	}else{
		fnLaunchNanobar();
		toastr.error('Ooops! Password did not match.');
		$('#_rpassword').effect('shake');
	}
	
}

function fnEditUser(){
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-user-management.php?query=EDIT',
		type: 'post',
		data: $('#frmEditUser').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				$('#tblSystemUsers').DataTable().ajax.reload();
				$('[data-remodal-id=modalEditUser]').remodal().close();
				fnLaunchNanobar();
				toastr.success('Successfully Saved');
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

	// setInterval(function(){
	// 	$('#tblSystemUsers').DataTable().ajax.reload();
	// },5000);

	// Load Tables
	fnUsersTable();

	// Validation

	$('#rpassword').bind('change keyup', function(){
		fnCheckPassword();
	});

	// Submit Functions

	$('#frmAddUser').submit(function(event){
		fnAddUser();
	});

	$('#frmEditUser').submit(function(event){
		fnEditUser();
	});

})