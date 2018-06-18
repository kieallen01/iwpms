<?php
	session_start();
    
    if(!$_SESSION['login']){
        header('location:index.php');
    }
?>

<?php include('../header.php');?>
    
    <div class="d-flex">
        
        <!-- Sidebar Include -->
        
        <div class="sidebar bg-light">
		    
		    <ul class="list-unstyled">

                <li id="main-nav"><center> MAIN NAVIGATION </center></li>
		        
		        <li><a href="index.php"><i class="fa fa-fw fa-list"></i> List of All Applicant</a></li>

		        <li><a href="treasury-settings.php"><i class="fa fa-fw fa-gears"></i> Treasury Settings</a></li> 

		        <li><a href="#" data-remodal-target="modalCollection"><i class="fa fa-fw fa-file"></i> Collection Report</a></li>

		    </ul>
		</div>

        <div class="content p-4">
            <a href="index.php" id="dashboard"><span class="fa fa-fw fa-money"></span></a>&nbsp;&nbsp;<span id="systitle">Municipal Treasury Office</span>
            <span id="bauang">
            	<span class="pull-right" id="date">
            		<span class="fa fa-fw fa-calendar"></span> 
            		<?php echo date('F m\, Y');?>
            	</span>
        	</span>
            <hr>

            <div class="row">
                <div class="col mb-2">
                    <div class="card card-panel">
                        <div class="card-header">
                            <span class="fa fa-fw fa-list"></span> Applicants List for Treasury

                            <span class="pull-right">

                                <div class="input-group input-group-sm mb-1">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text filter" id="basic-addon1">Applicants with : </span>
                                    </div>

                                    <select class="custom-select form-control-sm" id="filterMto" name="filterMto">
                                        <option value="0">On Process Requirement</option>
                                        <option value="1">Completed This Requirement</option>
                                    </select>    

                                </div>
                            </span>
                        </div>
                        <div class="card-body">
                            <div id="mtoOnProcess" class="table-responsive">
                                <table id="tblTreasuryApplicantList" class="table table-bordered dt-responsive nowrap" cellspacing = "0" width = "100%">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Name</th>
                                             <th>Gender</th>
                                             <th>Address</th>
                                             <th>Designation</th>
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         
                                     </tbody>
                                </table>
                            </div>

                            <div id="mtoComplete" class="table-responsive" hidden>
                                <table id="tblTreasuryApplicantListComplete" class="table table-bordered dt-responsive nowrap" cellspacing = "0" width = "100%">
                                     <thead>
                                         <tr>
                                             <th>ID</th>
                                             <th>Name</th>
                                             <th>Gender</th>
                                             <th>Address</th>
                                             <th>Designation</th>
                                             <th>Status</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         
                                     </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>

            <!-- MODAL VIEW APPLICANT REQUIREMENT -->
            <div id="remodal-view-applicantT" class="remodal" data-remodal-id="modalViewApplicantT">
                <div class="card-header"><span class="fa fa-eye"></span> View Applicant Requirement Checklist<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="modal-label">Personal Information</p>
                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Fullname</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappFullname" name = "vappFname" aria-label="vappFname" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Home Address</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappAddHA" name = "vappAddHA" aria-label="vappAddHA" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Gender</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappGender" name = "vappGender" aria-label="vappGender" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Date of Birth</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappDOB" name = "vappDOB" aria-label="vappDOB" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Place of Birth</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappAddPB" name = "vappAddPB" aria-label="vappAddPB" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-3" id="_phone">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Phone Number</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappPhoneNumber" name = "vappPhoneNumber" aria-label="vappPhoneNumber" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <p class="modal-label">Work Information</p>
                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Position</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappPD" name = "vappPD" aria-label="vappPD" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Company Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappCBName" name = "vappCBName" aria-label="vappCBName" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Address</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappCBAdd" name = "vappCBAdd" aria-label="vappCBAdd" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Employer Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "vappEmpName" name = "vappEmpName" aria-label="vappEmpName" aria-describedby="basic-addon1" disabled="">
                            </div>
                        </div>

                        <div class="col-6" style="text-align: left;">
                            <p class="modal-label"> Requirement Checklist </p>
                            <ul class="form-check mb-0 view">
                                <li value="" id="vreq1" name="vreq1" class="vr">
                                    <label class="form-check-label" id="label-vreq1" for="vreq1">
                                        Barangay Clearance & Cedula
                                    </label>
                                </li>
                            </ul>

                            <ul class="form-check mb-0 view">
                                <li value="" id="vreq2" name="vreq2" class="vr">
                                    <label class="form-check-label" id="label-vreq2" for="vreq2">
                                        Municipal Treasury Office
                                    </label>
                                </li>
                            </ul>

                            <ul class="form-check mb-0 view">
                                <li value="" id="vreq3" name="vreq3" class="vr">
                                    <label class="form-check-label" id="label-vreq3" for="vreq3">
                                        Municipal Trial Court Clearance
                                    </label>
                                </li>
                            </ul>

                            <ul class="form-check mb-0 view">
                                <li value="" id="vreq4" name="vreq4" class="vr">
                                    <label class="form-check-label" id="label-vreq4" for="vreq4">
                                        Police Clearance
                                    </label>
                                </li>
                            </ul>

                            <ul class="form-check mb-0 view">
                                <li value="" id="vreq5" name="vreq5" class="vr">
                                    <label class="form-check-label" id="label-vreq5" for="vreq5">
                                        Municipal Health Office
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODAL EDIT APPLICANT REQUIREMENT -->
            <div id="remodal-update-requirementT" class="remodal" data-remodal-id="modalUpdateRequirementT">
                <div class="card-header"><span class="fa fa-edit"></span> Update Applicant Requirement Treasury<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="modal-label">Personal Information</p>
                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <label class="input-group-text view" id="basic-addon1">Fullname</label>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappFullname" name = "eappFname" aria-label="eappFname" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Home Address</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappAddHA" name = "eappAddHA" aria-label="eappAddHA" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Date of Birth</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappDOB" name = "eappDOB" aria-label="eappDOB" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-3" id="_phone">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Phone Number</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappPhoneNumber" name = "eappPhoneNumber" aria-label="eappPhoneNumber" aria-describedby="basic-addon1" disabled="">
                            </div>
                        </div>

                        <div class="col-6" style="text-align: left !important;">
                            <p class="modal-label">Work Information</p>
                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Position</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappPD" name = "eappPD" aria-label="eappPD" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Company Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappCBName" name = "eappCBName" aria-label="eappCBName" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Address</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappCBAdd" name = "eppCBAdd" aria-label="eappCBAdd" aria-describedby="basic-addon1" disabled="">
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Employer Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappEmpName" name = "eappEmpName" aria-label="eappEmpName" aria-describedby="basic-addon1" disabled="">
                            </div>  
                        </div>
                    </div>
                    <form id="frmUpdateRequirementsT">
                        <!-- <form action="../../php/query-payments.php" method="post"> -->
                        <div class="row">
                            <div class="col">
                                <input type="hidden" id="txtHiddenApplicantIdT" name="txtHiddenApplicantIdT">
                                <p class="modal-label"> Fee Information</p>
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">OR Number</span>
                                    </div>
                                    <input style="font-size: 20px !important;" type="text" class="form-control form-control-sm" id = "feeORNumber" name = "feeORNumber" aria-label="feeORNumber" aria-describedby="basic-addon1" required="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Total Fees</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm" id = "feeTotal" name = "feeTotal" aria-label="feeTotal" placeholder="0.00" aria-describedby="basic-addon1" readonly="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Penalty (25%)</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "feePenalty" name = "feePenalty" aria-label="feePenalty" placeholder="0.00"  aria-describedby="basic-addon1" readonly="">
                                </div>

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Payment Date</span>
                                    </div>
                                    <input type="date" class="form-control form-control-sm" value="<?php echo date('Y-m-d')?>" id = "feeDateOfPayment" name = "feeDateOfPayment" aria-label="feeDateOfPayment" aria-describedby="basic-addon1">
                                </div>
                            </div>
                        </div>                                
                        
                        <div class="row">
                            <div class="col">
                                <p class="modal-label"> List of Fees</p>
                                <div class="table-responsive">
                                    <table id = "tblListOfCollections" class="table table-bordered nowrap" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Fee Id</th>
                                                <th>Fee Description</th>
                                                <th>Cost</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <input type = "text" class="form-control form-control-sm drop" id = "appFeeId" name = "appFeeId" min = "0" step = "0.01" readonly>
                                                </td>

                                                <td>
                                                    <select class="custom-select form-control-sm" id="cmbAppFeeDescription" name="cmbAppFeeDescription">

                                                    </select>
                                                </td>

                                                <td>
                                                    <input type = "number" class="form-control form-control-sm drop" id = "appFeeCost" name = "appFeeCost" min = "0" step = "0.01" readonly>
                                                </td>

                                                <td>
                                                    <center>
                                                        <button type = "button" id = "btnAddFeeDrop" name = "btnAddFeeDrop" class = "btn btn-sm btn-default" disabled="">
                                                            <i class = "fa fa-fw fa-plus"></i>
                                                        </button>
                                                    </center>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <center>
                                    <button class="btn btn-sm btn-secondary" style="width: 100%;" type="submit" id="btnUpdateRequirementR" name="btnUpdateRequirementR"><span class="fa fa-fw fa-paper-plane"></span> Submit</button>
                                </center>
                            </div>
                        </div>
                    </form>       
                </div>
            </div>

            <div id="remodal-collection-report" class="remodal small" data-remodal-id="modalCollection">
                <div class="card-header"><span class="fa fa-id-card"></span> Collection Report<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                <div class="card-body">
                    <form id="frmCollectionMTO">
                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text view" id="basic-addon1">Date From</span>
                            </div>
                            <input type="date" class="form-control form-control-sm view" id = "collectiondatefrom" name = "collectiondatefrom" value='<?php echo date('Y-m-d');?>' aria-label="collectiondatefrom" aria-describedby="basic-addon1" required="">
                        </div>

                        <div class="input-group input-group-sm mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text view" id="basic-addon1">Date To</span>
                            </div>
                            <input type="date" class="form-control form-control-sm view" id = "collectiondateto" name = "collectiondateto" value='<?php echo date('Y-m-d');?>' aria-label="collectiondateto" aria-describedby="basic-addon1" required="">
                        </div>
                        <button class="btn btn-sm btn-secondary" type="submit"><span class="fa fa-print"></span> Generate Report</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php");?>