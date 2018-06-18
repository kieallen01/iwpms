<?php
    session_start();

    if(!$_SESSION['login']){
        header('location: ../../index.php');
    }
    if ($_SESSION['user_level'] !== "Administrator") {
        header('location: ../404.php');
    }
?>

<?php include('../header.php');?>
    
    <div class="d-flex">
        
        <!-- Sidebar Include -->
        
        <?php include("../sidebar.php");?>

        <div class="content p-4">

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="btn btn-nav btn-sm btn-default bg-light active" style="cursor: auto;"><span class="fa fa-fw fa-file"></span> Generate Reports</a>
                </li>
            </ul>

            <br>
            <div class="row">
                <div class="col">
                    <div class="card card-panel">
                        <div class="card-body">
                            <form id="frmGenerateListReport">
                                <div class="row">
                                    <div class="col">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><span class="fa fa-file"></span></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="cmbListReport" name="cmbListReport" required="">
                                                <option value="" selected disabled>Select Report</option>
                                                <option value="0">List of Applicants with ID</option>
                                                <option value="1">List of Applicants with IWP</option>
                                                <option value="2">List of Collection Report</option>
                                                <option value="3">List of Activity Log</option>
                                            </select>    
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text report-date" id="basic-addon1">Date From: </span>
                                            </div>
                                            <input type="date" class="form-control form-control-sm" id = "dateFrom" name = "dateFrom" aria-label="dateFrom" value="<?php echo date('Y-m-d');?>" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text report-date" id="basic-addon1">Date To: </span>
                                            </div>
                                            <input type="date" class="form-control form-control-sm" id = "dateTo" name = "dateTo" aria-label="dateTo" value="<?php echo date('Y-m-d');?>" aria-describedby="basic-addon1" required>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <center>
                                            <button type="submit" class="btn btn-sm btn-secondary" id="btnGenerate" name="btnGenerate" style="width: 100%;"><span class="fa fa-fw fa-print"></span> Generate</button>
                                        </center>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <div class="card card-panel">
                        <div class="card-header"><span class="fa fa-fw fa-print"></span> List of Applicant with Complete Requirements</div>
                        <div class="card-body">
                            <table id="tblPrintPermit" class="table table-bordered dt-responsive nowrap" cellspacing = "0" width = "100%">
                                 <thead>
                                     <tr>
                                         <th>ID</th>
                                         <th>Name</th>
                                         <th>Gender</th>
                                         <th>Address</th>
                                         <th>Designation</th>
                                         <th>Generate</th>
                                     </tr>
                                 </thead>
                                 <tbody>
                                     
                                 </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- REMODAL ID REPORT -->

                <div id="remodal-idcard-report" class="remodal" data-remodal-id="modalApplicantIdR">
                    <div class="card-header"><span class="fa fa-id-card"></span> Identification Card<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-4">
                                    <!-- <form action="../../php/query-reports.php?query=UPLOAD" method="post" enctype="multipart/form-data"> -->
                                    <form id="frmSaveImage" name="frmSaveImage" action="javascript:;" method="post" enctype="multipart/form-data">
                                        
                                        <input type="hidden" id="txtHiddenApplicantIdImage" name="txtHiddenApplicantIdImage"> 
                                        
                                        <img class="mb-4" id="imageUpload" src="" alt="Image" width="100%" height="230"><br>
                                        
                                        <input class="form-control form-control-sm mb-1" type='file' accept="image/*" id="inputImage" name="inputImage" required="" hidden>
                                                                  
                                        <button type="button" class="btn btn-sm btn-default" id="btnImageChange" name="btnImageChange" style="width: 100%;" hidden><span class="fa fa-file-photo-o"></span> Change Image</button>

                                        <button type="submit" class="btn btn-sm btn-default mb-1" id="btnImageSave" name="btnImageSave" style="width: 100%;" hidden><span class="fa fa-save"></span> Save Image</button>                                    
                                        <button type="button" class="btn btn-sm btn-default mb-1" id="btnCancel" name="btnCancel" style="width: 100%;" hidden><span class="fa fa-close"></span> Cancel</button>

                                    </form>
                                </div>

                                <div class="col-8">
                                    <p class="modal-label">Applicant Information</p>
                                    <input type="hidden" id="txtHiddenApplicantId" name="txtHiddenApplicantId">
                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Full Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappFullname" name = "vappFullname" aria-label="vappFullname" aria-describedby="basic-addon1" disabled="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Company Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappCompanyname" name = "vappCompanyname" aria-label="vappCompanyname" aria-describedby="basic-addon1" disabled="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Position</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappPosition" name = "vappPosition" aria-label="vappPosition" aria-describedby="basic-addon1" disabled="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Address</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappAddress" name = "vappAddress" aria-label="vappAddress" aria-describedby="basic-addon1" disabled="">
                                    </div>
                                    <br>
                                    <p class="modal-label">Person to notify in case of emergency</p>
                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Fullname</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappPNNameId" name = "vappPNNameId" aria-label="vappPNNameId" aria-describedby="basic-addon1" disabled="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Address</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappPNAddId" name = "vappPNAddId" aria-label="vappPNAddId" aria-describedby="basic-addon1" disabled="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1" id="_pnphone">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Phone number</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view-show" id = "vappPNPhoneNumberId" name = "vappPNPhoneNumberId" aria-label="vappPNPhoneNumber" aria-describedby="basic-addon1" disabled="">
                                    </div>
                                </div>
                            </div>  
                            <br>
                            <button style="width: 100%;" type="button" id="btnGenerateID" name="btnGenerateID" class="btn btn-sm btn-default" hidden><span class="fa fa-print"></span> Generate ID</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include("../footer.php");?>
