<?php
    session_start();

    if(!$_SESSION['login']){
        header('location: ../../index.php');
    }
    if ($_SESSION['user_level'] !== "Administrator") {
        header('location: ../404.php');
    }
?>

<?php include("../header.php");?>

    <div class="d-flex">

        <!-- Sidebar Include -->
        
        <?php include("../sidebar.php");?>

        <div class="content p-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">

                <li class="nav-item">
                    <a class="btn btn-nav app btn-sm btn-default bg-light active" id="requirement-management-list-tab" data-toggle="tab" href="#requirement-management-list" role="tab" aria-controls="requirement-management-list" aria-selected="false"><span class="fa fa-fw fa-file-text"></span> Requirement Management</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav app btn-sm btn-default bg-light" id="online-applicant-list-tab" data-toggle="tab" href="#online-applicant-list" role="tab" aria-controls="online-applicant-list" aria-selected="false"><span class="ion ion-earth"></span> Approve Online Applicant</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav app btn-sm btn-default bg-light" id="renewal-applicant-list-tab" data-toggle="tab" href="#renewal-applicant-list" role="tab" aria-controls="renewal-applicant-list" aria-selected="false"><span class="ion ion-refresh"></span> Approve Renewal Applicant</a>
                </li>

            </ul>
            <br>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="requirement-management-list" role="tabpanel" aria-labelledby="requirement-management-list-tab">
                    <div class="row">
                        <div class="col">
                            <div class="card card-panel">
                                <div class="card-header">
                                    <span class="fa fa-fw fa-list"></span> List of All Applicant
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblReqManagementList" class="table table-bordered nowrap" cellspacing = "0" width = "100%">
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
                </div>

                <!-- MODAL VIEW APPLICANT REQUIREMENT -->
                <div id="remodal-view-applicantR" class="remodal" data-remodal-id="modalViewApplicantR">
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
                <div id="remodal-view-applicantR" class="remodal" data-remodal-id="modalEditApplicantR">
                    <div class="card-header"><span class="fa fa-edit"></span> Edit Applicant Requirement Checklist<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
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
                                <form id="frmEditRequirements">
                                    <p class="modal-label">Requirement Checklist </p>
                                    <input type="hidden" id="txtHiddenApplicantIdR" name="txtHiddenApplicantIdR">

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="ereq1" name="ereq1" required="">
                                        <label class="form-check-label" id="label-ereq1" for="ereq1">
                                            Barangay Clearance & Cedula
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="ereq2" name="ereq2">
                                        <label class="form-check-label" id="label-ereq2" for="ereq2">
                                            Municipal Treasury Office
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="ereq3" name="ereq3">
                                        <label class="form-check-label" id="label-ereq3" for="ereq3">
                                            Municipal Trial Court Clearance
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="ereq4" name="ereq4">
                                        <label class="form-check-label" id="label-ereq4" for="ereq4">
                                            Police Clearance
                                        </label>
                                    </div>

                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="checkbox" id="ereq5" name="ereq5">
                                        <label class="form-check-label" id="label-ereq5" for="ereq5">
                                            Municipal Health Office
                                        </label>
                                    </div>
                                    <br>
                                    <center>
                                        <button class="btn btn-sm btn-default" style="width: 100%;" type="submit" id="btnEditRequirements" name="btnEditRequirements"><span class="fa fa-fw fa-paper-plane"></span> Submit</button>
                                    </center>
                                </form>                                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade" id="online-applicant-list" role="tabpanel" aria-labelledby="online-applicant-list-tab">
                    <div class="row">
                        <div class="col">
                            <div class="card card-panel">
                                <div class="card-header">
                                    <span class="fa fa-fw fa-list"></span> List of Online Applicants to Approve
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblOnlineApplicantList" class="table table-bordered nowrap" cellspacing = "0" width = "100%">
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
                </div>

                <div class="tab-pane fade" id="renewal-applicant-list" role="tabpanel" aria-labelledby="renewal-applicant-list-tab">
                    <div class="row">
                        <div class="col">
                            <div class="card card-panel">
                                <div class="card-header">
                                    <span class="fa fa-fw fa-list"></span> List of Renewal Applicants to Approve
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblRenewalApplicantList" class="table table-bordered nowrap" cellspacing = "0" width = "100%">
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
                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php");?>