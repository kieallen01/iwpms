function fnLoader(){
	$("#fakeLoader").fakeLoader({
		timeToHide:14000, 
		zIndex:"999",
		spinner:"spinner3",
		bgColor:"white"
	});
}

function fnActivityLogTable(){
	var tblActivityLog = $('#tblActivityLog').DataTable({
		responsive: true,
		ajax:{
			url: serverdir + '/php/query-log.php',
			dataSrc: '',
			processing: true,
			serverside: true,
		},
		columns: [
			{'data':'username'},
			{'data':'activity'},
			{'data':'date'},
			{'data':'time'},
		],
		deferRender: true,
		pageLength: 5
	});
}

function fnBackup(){

	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-database.php?query=BACKUP',
		type: 'post',
		data: $('#frmBackup').serialize(),
		dataType: 'html',
		success: function(result) {
			if (result == true) {
				fnLaunchNanobar();
				toastr.success('Backup Successful.');
			}else {
				toastr.error('Database backup failed.');
			}
			console.log(result);
		}
	});

}

function fnRestore(){

	var form = $('#frmRestore')[0];
	var formData = new FormData(form);

	event.preventDefault();

	$.ajax({
	    url: serverdir + "/php/query-database.php?query=RESTORE",
	    type: "POST",
	    processData: false,
	    contentType: false,
	    data: formData,
		success: function(result) {
			if (result == true) {
				fnLaunchNanobar();
				toastr.success('Restore Successful.');
				$('#frmRestore')[0].reset();	
				
			}else {
				toastr.error('Database Restore failed.');
				$('#frmRestore')[0].reset();
				
			}
			console.log(result);
		}

	});

}

function fnActivityLogReport(){

	var logdatefrom = $('#dateFrom').val();
	var logdateto = $('#dateTo').val();
	
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-reports.php?query=LOG',
		type: 'post',
		data: $('#frmGenerateListReport').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				window.open(serverdir + '/php/generate-activity-log.php?datefrom='+logdatefrom+'&dateto='+logdateto);	
			}else{
				toastr.error('No results found.');
				$(this)[0].reset();
			}
		}
	});

}

function fnListOfIWPReport(){

	var logdatefrom = $('#dateFrom').val();
	var logdateto = $('#dateTo').val();
	
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-reports.php?query=IWP',
		type: 'post',
		data: $('#frmGenerateListReport').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				window.open(serverdir + '/php/generate-applicant-with-iwp.php?datefrom='+logdatefrom+'&dateto='+logdateto);	
			}else{
				toastr.error('No results found.');
			}
		}
	});
}

function fnListOfIDReport(){

	var logdatefrom = $('#dateFrom').val();
	var logdateto = $('#dateTo').val();
	
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-reports.php?query=ID',
		type: 'post',
		data: $('#frmGenerateListReport').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				window.open(serverdir + '/php/generate-applicant-with-id.php?datefrom='+logdatefrom+'&dateto='+logdateto);	
			}else{
				toastr.error('No results found.');
			}
		}
	});

}

function fnCollectionLists(){

	var logdatefrom = $('#dateFrom').val();
	var logdateto = $('#dateTo').val();
	
	event.preventDefault();
	$.ajax({
		url: serverdir + '/php/query-reports.php?query=COLL',
		type: 'post',
		data: $('#frmGenerateListReport').serialize(),
		dataType: 'html',
		success: function(result){
			if (result == true) {
				window.open(serverdir + '/php/generate-collections.php?datefrom='+logdatefrom+'&dateto='+logdateto);	
			}else{
				toastr.error('No results found.');
			}
		}
	});

}




$(document).ready(function(){	

	//Submit Forms
	$('#btnBackup').on('click', function(){
		alertify.confirm('','Are you sure you want to backup your database?', function(){ 
				fnBackup();
		}, null).set({'movable':false, 'labels':{ok:'Confirm', cancel:'Cancel'}, 'closable':false});
	});

	$('#frmRestore').on('submit', function(){
		fnLoader();
		fnRestore();
	});

	$('#frmGenerateListReport').on('submit', function(event){
		var selectReport = $('#cmbListReport').val();

		if (selectReport == '0') {
			fnListOfIDReport();
		}else if (selectReport == '1' ) {
			fnListOfIWPReport();
		}else if (selectReport == '2' ) {
			fnCollectionLists();
		}else if (selectReport == '3' ) {
			fnActivityLogReport();
		}
	});

	// Table
		fnActivityLogTable();
})