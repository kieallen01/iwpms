
	   	<script type="text/javascript" src="../../plugins/jquery/jquery-3.2.1.js"></script>
	   	<script type="text/javascript">
	   		$(document).ready(function(){
	   			// SERVERDIR
	   			window.serverdir = 'http://'+'<?php echo gethostbyname(getHostName())?>'+'/iwpms';
	   		});	
	   	</script>
	    <script type="text/javascript" src="../../plugins/jqueryui/jquery-ui.js"></script>
	    <script type="text/javascript" src="../../plugins/popperjs/popper.min.js"></script>
	    <script type="text/javascript" src="../../plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	    <script type="text/javascript" src="../../plugins/bsadmin/js/bsadmin.js"></script>
	    <script type="text/javascript" src="../../plugins/datatables/datatablesjs/jquery.dataTables.min.js"></script>
	    <script type="text/javascript" src="../../plugins/datatables/datatablesjs/dataTables.bootstrap4.min.js"></script>
	    <script type="text/javascript">
	    	window.REMODAL_GLOBALS = {
			  NAMESPACE: 'remodal',
			  DEFAULTS: {
			    hashTracking: false,
			    closeOnOutsideClick: false
			  }
			};
	    	$(document).ready(function(){
	    		// NANOBAR
				function fnLaunchNanobar() {	
					const nanobar =  new Nanobar({
						classname	: 'my-class',
						id			: 'my-id',
						target		: document.getElementById('myDivId')
					});
					nanobar.go(100);
				}
				// TOASTER
				function fnToaster(){
					toastr.options = {
					"closeButton"		: false,
					"debug"				: false,
					"newestOnTop"		: true,
					"progressBar"		: true,
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
				}
	    	})
	    </script>
	    <script type="text/javascript" src="../../plugins/nanobar/nanobar.min.js"></script>
	    <script type="text/javascript" src="../../plugins/toastr/build/toastr.min.js"></script>
	    <script type="text/javascript" src="../../plugins/fakeLoader/fakeLoader.js"></script>
	    <script type="text/javascript" src="../../plugins/remodal/dist/remodal.min.js"></script>
	    <script type="text/javascript" src="../../plugins/alertify/alertify.min.js"></script>
	    <script type="text/javascript" src="../../plugins/jquery-mask/dist/jquery.mask.js"></script>
	    <script type="text/javascript" src="../../ajax/Auth.js"></script>
	    <script type="text/javascript" src="../../ajax/ApplicantSettings.js"></script>
	    <script type="text/javascript" src="../../ajax/TreasurySettings.js"></script>
	    <script type="text/javascript" src="../../ajax/UserManagement.js"></script>
	    <script type="text/javascript" src="../../ajax/SystemSettings.js"></script>
	    <script type="text/javascript" src="../../ajax/SignatoryManagement.js"></script>
	    <script type="text/javascript" src="../../ajax/User-Treasury.js"></script>
	    <script type="text/javascript" src="../../ajax/User-Court.js"></script>
	    <script type="text/javascript" src="../../ajax/User-Police.js"></script>
	    <script type="text/javascript" src="../../ajax/User-Health.js"></script>
	    
	</body>
</html>