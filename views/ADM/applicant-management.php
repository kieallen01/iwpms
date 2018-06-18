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
                    <a class="btn btn-nav app btn-sm btn-default bg-light active" id="applicant-management-tab" data-toggle="tab" href="#applicant-management" role="tab" aria-controls="applicant-management" aria-selected="false"><span class="fa fa-fw fa-users"></span> Applicant Management</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav app btn-sm btn-default bg-light" id="add-new-applicant-tab" data-toggle="tab" href="#add-new-applicant" role="tab" aria-controls="add-new-applicant" aria-selected="true"><span class="fa fa-fw fa-plus"></span> Add New Applicant</a>
                </li>

            </ul>
            <br>
            <div class="tab-content" id="myTabContent">

                <div class="tab-pane fade show active" id="applicant-management" role="tabpanel" aria-labelledby="applicant-management-tab">
                    <div class="row">
                        <div class="col">
                            <div class="card card-panel">
                                <div class="card-header"><span class="fa fa-fw fa-list"></span> List of All Applicant </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblApplicantManagement" class="table table-bordered nowrap" cellspacing = "0" width = "100%">
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

                <div class="tab-pane fade" id="add-new-applicant" role="tabpanel" aria-labelledby="add-new-applicant-tab">
                    <!-- Add New Applicant -->
                    <div class="card card-panel">
                        <div class="card-header"><span class="ion-person-add"></span> Add New Applicant</div>
                        <div class="card-body">
                            <form id="frmAddWalkinApplicant">
                            <!-- <form action="../../php/query-applicant.php?query=ADD" method="post"> -->
                                <div class="row">
                                    <div class="col">
                                        <p class="modal-label">Personal Information</p>
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appFname" name = "appFname" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" placeholder="First Name *" aria-label="appFname" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appMname" name = "appMname" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" placeholder="Middle Name" aria-label="appMname" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appLname" name = "appLname" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" placeholder="Last Name *" aria-label="appLname" aria-describedby="basic-addon1" required="">
                                        </div>


                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-intersex"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appGender" name="appGender" required="">
                                                <option value="" selected disabled>Select Gender *</option>
                                                <option value="Male">Male</option>
                                                <option value="Female">Female</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-3" id="_phone">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appPhoneNumber" name = "appPhoneNumber" placeholder="+63-999-999-9999 *" aria-label="appPhoneNumber" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <p class="modal-label">Work Information</p>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appPD" name = "appPD" placeholder="Position / Designation *" aria-label="appPD" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info-circle"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appCBName" name = "appCBName" placeholder="Business / Company Name *" aria-label="appCBName" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appCBAdd" name = "appCBAdd" placeholder="Business / Company Address *" aria-label="appCBAdd" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appEmpName" name = "appEmpName" placeholder="Employer Name *" aria-label="appEmpName" aria-describedby="basic-addon1" required="">
                                        </div>

                                    </div>
                                    
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-8">
                                                <label for="">Date Of Birth : *</label>
                                                <div class="input-group input-group-sm mb-3" id="_dob">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control form-control-sm" id = "appDateOfBirth" name = "appDateOfBirth" value='<?php $date = strtotime(date('Y-m-d').'-18 year'); echo date('Y-m-d', $date);?>' aria-label="appDateOfBirth" aria-describedby="basic-addon1" required="">
                                                </div>
                                            </div>

                                            <div class="col-4" style="padding-left: 0px !important;">
                                                <label for="">Age</label>
                                                <div class="input-group input-group-sm mb-3" id="_age">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="basic-addon1"><i class="fa fa-birthday-cake"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control form-control-sm" value="18" id = "appAge" name = "appAge" min="0" readonly="">
                                                </div>
                                            </div>
                                        </div>


                                        <label for="">Place of Birth </label>
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appProvPB" name="appProvPB" required="">
                                                <option value="" selected disabled>Select Province *</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appMunPB" name="appMunPB" required="" disabled="">
                                                <option value="" selected disabled>Select Municipality *</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appBarPB" name="appBarPB" required="" disabled="">
                                                <option value="" selected disabled>Select Barangay *</option>
                                            </select>
                                        </div>

                                        <label for="">Home Address </label>
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appProvHA" name="appProvHA" required="" >
                                                <option value="" selected disabled>Select Province *</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appMunHA" name="appMunHA"  required="" disabled="">
                                                <option value="" selected disabled>Select Municipality *</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-map-marker"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appBarHA" name="appBarHA"  required="" disabled="">
                                                <option value="" selected disabled>Select Barangay *</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col">
                                        <label>Person to notify in case of emergency</label>
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appPNName" name = "appPNName" placeholder="Full Name *" aria-label="appPNName" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-home"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appPNAdd" name = "appPNAdd" placeholder="Address *" aria-label="appPNAdd" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-phone"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "appPNPhoneNumber" name = "appPNPhoneNumber" placeholder="+63-999-999-9999 *" aria-label="appPNPhoneNumber" aria-describedby="basic-addon1" required="">
                                        </div>                                        
                                        <br>
                                        <p class="modal-label">Requirement Checklist</p>

                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" value="" id="req1" name="req1" required="">
                                            <label class="form-check-label add" id="label-req1" for="req1">
                                                Barangay Clearance & Cedula <span style="color:red;">*</span>
                                            </label>
                                        </div>

                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" value="" id="req2" name="req2">
                                            <label class="form-check-label add" id="label-req2" for="req2">
                                                Municipal Treasury Office Receipt
                                            </label>
                                        </div>

                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" value="" id="req3" name="req3">
                                            <label class="form-check-label add" id="label-req3" for="req3">
                                                Municipal Trial Court Clearance
                                            </label>
                                        </div>

                                        <div class="form-check mb-1">
                                            <input class="form-check-input" type="checkbox" value="" id="req4" name="req4">
                                            <label class="form-check-label add" id="label-req4" for="req4">
                                                Police Clearance
                                            </label>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="checkbox" value="" id="req5" name="req5">
                                            <label class="form-check-label add" id="label-req5" for="req5">
                                                Municipal Health Office
                                            </label>
                                        </div>
                                    </div>
                                </div> 
                                <center>
                                    <button class= "btn btn-sm btn-secondary" style="width: 49%;" type = "reset" name = "btnClearApplicant" id = "btnClearApplicant"><small><span class="fa fa-refresh"></span> </small> Clear</button>                      
                                    <button class= "btn btn-sm btn-secondary" style="width: 49%;" type = "submit" name = "btnAddApplicant" id = "btnAddApplicant"><small><span class="fa fa-paper-plane"></span> </small> Submit</button>                      
                                </center>
                            </form>
                        </div>
                    </div>

                </div>

                <!-- MODAL VIEW APPLICANT INFORMATION -->

                <div id="remodal-view-applicant" class="remodal" data-remodal-id="modalViewApplicant">
                    <div class="card-header"><span class="fa fa-eye"></span> View Applicant Information<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                    <div class="card-body">
                        <p class="modal-label">Personal Information</p>
                        <div class="input-group input-group-sm mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text view" id="basic-addon1">First Name</span>
                            </div>
                            <input type="text" class="form-control form-control-sm view-show" id = "vappFname" name = "vappFname" aria-label="vappFname" aria-describedby="basic-addon1" disabled="">
                        </div>

                        <div class="input-group input-group-sm mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text view" id="basic-addon1">Middle Name</span>
                            </div>
                            <input type="text" class="form-control form-control-sm view-show" id = "vappMname" name = "vappMname" aria-label="vappMname" aria-describedby="basic-addon1" disabled="">
                        </div>

                        <div class="input-group input-group-sm mb-1">
                            <div class="input-group-prepend">
                                <span class="input-group-text view" id="basic-addon1">Last Name</span>
                            </div>
                            <input type="text" class="form-control form-control-sm view-show" id = "vappLname" name = "vappLname" aria-label="vappLname" aria-describedby="basic-addon1" disabled="">
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

                        <div class="row">

                            <div class="col">
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

                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Employer Name</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view-show" id = "vappEmpName" name = "vappEmpName" aria-label="vappEmpName" aria-describedby="basic-addon1" disabled="">
                                </div>
                            </div>

                            <div class="col">      
                                <p class="modal-label">Person to notify in case of emergency</p>
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Fullname</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view-show" id = "vappPNName" name = "vappPNName" aria-label="vappPNName" aria-describedby="basic-addon1" disabled="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Address</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view-show" id = "vappPNAdd" name = "vappPNAdd" aria-label="vappPNAdd" aria-describedby="basic-addon1" disabled="">
                                </div>

                                <div class="input-group input-group-sm mb-1" id="_pnphone">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Phone number</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view-show" id = "vappPNPhoneNumber" name = "vappPNPhoneNumber" aria-label="vappPNPhoneNumber" aria-describedby="basic-addon1" disabled="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MODAL EDIT APPLICANT INFORMATION -->

                <div id="remodal-edit-applicant" class="remodal" data-remodal-id="modalEditApplicant">
                    <div class="card-header"><span class="fa fa-edit"></span> Edit Applicant Information<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                    <div class="card-body">
                        <form id="frmEditWalkinApplicant">
                            <input type="hidden" id="txtHiddenApplicantId" name="txtHiddenApplicantId">
                            <p class="modal-label">Personal Information</p>
                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">First Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view" id = "eappFname" name = "eappFname" aria-label="eappFname" aria-describedby="basic-addon1" autofocus required>
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Middle Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view" id = "eappMname" name = "eappMname" aria-label="eappMname" aria-describedby="basic-addon1" required>
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Last Name</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view" id = "eappLname" name = "eappLname" aria-label="eappLname" aria-describedby="basic-addon1" required>
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Home Address</span>
                                </div>

                                <select class="custom-select form-control-sm" id="eappProvHA" name="eappProvHA" required="" >
                                    
                                </select>

                                <select class="custom-select form-control-sm" id="eappMunHA" name="eappMunHA"  required="">
                                    
                                </select>

                                <select class="custom-select form-control-sm" id="eappBarHA" name="eappBarHA"  required="">
                                    
                                </select>
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Gender</span>
                                </div>
                                <select class="custom-select form-control-sm" id="eappGender" name="eappGender" required="">
                                    <option value="" selected disabled>Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>                            
                            </div>

                            <div class="input-group input-group-sm mb-1" id="_edob">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Date of Birth</span>
                                </div>
                                <input type="date" class="form-control form-control-sm view" id = "eappDateOfBirth" name = "eappDateOfBirth" aria-label="eappDateOfBirth" aria-describedby="basic-addon1" required>
                            </div>

                            <div class="input-group input-group-sm mb-1">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Place of Birth</span>
                                </div>
                                <select class="custom-select form-control-sm" id="eappProvPB" name="eappProvPB" required="">
            
                                </select>

                                <select class="custom-select form-control-sm" id="eappMunPB" name="eappMunPB" required="">
                                    
                                </select>

                                <select class="custom-select form-control-sm" id="eappBarPB" name="eappBarPB" required="">
                                    
                                </select>

                            </div>

                            <div class="input-group input-group-sm mb-3" id="_ephone">
                                <div class="input-group-prepend">
                                    <span class="input-group-text view" id="basic-addon1">Phone Number</span>
                                </div>
                                <input type="text" class="form-control form-control-sm view" id = "eappPhoneNumber" name = "eappPhoneNumber" aria-label="eappPhoneNumber" aria-describedby="basic-addon1">
                            </div>
                            <div class="row">

                                <div class="col">   
                                    <p class="modal-label">Work Information</p>
                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Position</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappPD" name = "eappPD" aria-label="eappPD" aria-describedby="basic-addon1" required>
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Company Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappCBName" name = "eappCBName" aria-label="eappCBName" aria-describedby="basic-addon1" required>
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Address</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappCBAdd" name = "eappCBAdd" aria-label="eappCBAdd" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Employer Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappEmpName" name = "eappEmpName" aria-label="eappEmpName" aria-describedby="basic-addon1">
                                    </div>
                                </div>

                                <div class="col">
                                    <p class="modal-label">Person to notify in case of emergency </p>
                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Fullname</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappPNName" name = "eappPNName" aria-label="eappPNName" aria-describedby="basic-addon1" required="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Address</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappPNAdd" name = "eappPNAdd" aria-label="eappPNAdd" aria-describedby="basic-addon1" required="">
                                    </div>

                                    <div class="input-group input-group-sm mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Phone Number</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eappPNPhoneNumber" name = "eappPNPhoneNumber" aria-label="eappPNPhoneNumber" aria-describedby="basic-addon1" required="">
                                    </div>
                                </div>
                            </div> 
                            <button class="btn btn-sm btn-secondary" type="submit" style="width: 100%"><span class="fa fa-paper-plane"></span> Submit</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php include("../footer.php");?>