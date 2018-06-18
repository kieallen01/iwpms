<?php
	session_start();
    if(!$_SESSION['login']){
        header('location:index.php');
    }
    if ($_SESSION['user_level'] !== "MHO") {
	header('location: ../404.php');
    }
?>

<?php include('../header.php');?>
    
    <div class="d-flex">

        <div class="content p-4">
            <a href="index.php" id="dashboard"><span class="fa fa-fw fa-home"></span></a>&nbsp;&nbsp;<span id="systitle">Municipal Health Office</span>
            <span id="bauang">
            	<span class="pull-right" id="date">
            		<span class="fa fa-fw fa-calendar"></span> 
            		<?php echo date('F m\, Y');?>
            	</span>
        	</span>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card card-panel">
                        <div class="card-header">
                            <span class="fa fa-fw fa-list"></span> Applicants List for MHO
                            <span class="pull-right">
                                <div class="input-group input-group-sm mb-1">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text filter" id="basic-addon1">Applicants with : </span>
                                    </div>

                                    <select class="custom-select form-control-sm" id="filterMho" name="filterMho">
                                        <option value="0">On Process Requirement</option>
                                        <option value="1">Completed This Requirement</option>
                                    </select>    

                                </div>        
                            </span>
                        </div>
                        <div class="card-body">
                            <div id="mhoOnProcess" class="table-responsive">
                                <table id="tblHealthApplicantList" class="table table-bordered dt-responsive nowrap" cellspacing = "0" width = "100%">
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

                            <div id="mhoComplete" class="table-responsive" hidden>
                                <table id="tblHealthApplicantListComplete" class="table table-bordered dt-responsive nowrap" cellspacing = "0" width = "100%">
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
                        </div>
                    </div>
                </div> 
            </div>

            <!-- MODAL VIEW APPLICANT REQUIREMENT -->
            <div id="remodal-view-applicantH" class="remodal" data-remodal-id="modalViewApplicantH">
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
            <div id="remodal-update-requirementH" class="remodal" data-remodal-id="modalUpdateRequirementH">
                <div class="card-header"><span class="fa fa-edit"></span> Update Applicant Requirement Checklist<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
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

                            <div class="input-group input-group-sm mb-2">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Home Address</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view-show" id = "eappAddHA" name = "eappAddHA" aria-label="eappAddHA" aria-describedby="basic-addon1" disabled="">
                            </div>

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

                        <div class="col-6" style="text-align: left !important;">
                            <form id="frmUpdateRequirementsH">
                                <p class="modal-label"> Requirement Checklist </p>
                                <input type="hidden" id="txtHiddenApplicantIdR" name="txtHiddenApplicantIdR">

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="ereq1" name="ereq1" disabled="">
                                    <label class="form-check-label" id="label-ereq1" for="ereq1">
                                        Barangay Clearance & Cedula
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="ereq2" name="ereq2" disabled="">
                                    <label class="form-check-label" id="label-ereq2" for="ereq2">
                                        Municipal Treasury Office
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="ereq3" name="ereq3" disabled="">
                                    <label class="form-check-label" id="label-ereq3" for="ereq3">
                                        Municipal Trial Court Clearance
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="ereq4" name="ereq4" disabled="">
                                    <label class="form-check-label" id="label-ereq4" for="ereq4">
                                        Police Clearance
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="ereq5" name="ereq5" disabled="">
                                    <label class="form-check-label" id="label-ereq5" for="ereq5">
                                        Municipal Health Office
                                    </label>
                                </div>
                                <br>
                                <center>
                                    <button class="btn btn-sm btn-secondary" style="width: 100%;" type="button" id="btnUpdateRequirementH" name="btnUpdateRequirementH"><span class="fa fa-fw fa-paper-plane"></span> Approve</button>
                                </center>
                            </form>                                    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php");?>