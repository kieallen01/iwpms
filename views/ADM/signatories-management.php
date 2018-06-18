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
                    <a class="btn btn-nav btn-sm btn-default bg-light active" style="cursor: auto;" id="signatories-management-tab" data-toggle="tab" href="#signatories-management" role="tab" aria-controls="signatories-management" aria-selected="true"><span class="fa fa-fw fa-pencil"></span> Signatories Management</a>
                </li>
            </ul>

            <br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="fee-management" role="tabpanel" aria-labelledby="fee-management-tab">
                    <div id="divFeeManagement" class="row">
                        <div class="col-md-4">
                        <form id = "frmAddSignatory">
                            <!-- <form action="../../php/query-signatories.php" method="post">-->                            
                                <div class="card card-panel">
                                    <div class="card-header"><span class="fa fa-plus"></span> Add Signatories</div>
                                    <div class="card-body">                           
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-home"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="signatoryoffice" name="signatoryoffice" required="">
                                                <option value="">Select Office *</option>
                                                <option value="Office of the Mayor">Office of the Mayor</option>
                                                <option value="Premits and Licensing Office">Premits and Licensing Office</option>
                                                <option value="Treasury Office">Treasury Office</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces"  id = "sfname" name = "sfname" placeholder="First Name *" aria-label="sfname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "smname" name = "smname" placeholder="Middle Name *" aria-label="smname" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "slname" name = "slname" placeholder="Last Name *" aria-label="slname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces"  id = "sposition" name = "sposition" placeholder="Position *" aria-label="sposition" aria-describedby="basic-addon1" required>
                                        </div>

                                        <center>
                                            <button class= "btn btn-sm btn-secondary" style="width:100%;" type = "submit" name = "btnAddSignatory" id = "btnAddSignatory"><small><span class="fa fa-paper-plane"></span> </small> Submit</button>      
                                        </center>
                                    </div>
                                </div>
                            </form> 
                        </div>

                        <div class="col-md-8">
                            <div class="card card-panel">
                                <div class="card-header"><span class="fa fa-list"></span> List of Signatories</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblListOfSignatories" class="table table-bordered nowrap" cellspacing = "0" width = "100%">                                 
                                            <thead>
                                                 <tr>
                                                     <th>ID</th>
                                                     <th>Office</th>
                                                     <th>Fullname</th>
                                                     <th>Position</th>
                                                     <th>Action</th>
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

                        <!-- MODAL VIEW SIGNATORY INFO -->

                         <div id="remodal-view-Signatory" class="remodal small" data-remodal-id="modalViewSignatory">
                            <div class="card-header"><span class="fa fa-eye"></span> View Signatory<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Office</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vsoffice" name = "vsoffice" aria-label="slname" aria-describedby="basic-addon1" readonly="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Fullname</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vsfullname" name = "vsfullname" aria-label="vsfullname" aria-describedby="basic-addon1" readonly="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Position</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vsposition" name = "vsposition" aria-label="slname" aria-describedby="basic-addon1" readonly="">
                                </div>
                            </div>
                        </div>

                        <!-- MODAL EDIT SIGNATORY INFO -->

                         <div id="remodal-edit-signatory" class="remodal small" data-remodal-id="modalEditSignatory">
                            <div class="card-header"><span class="fa fa-edit"></span> Edit Signatory<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <form id="frmEditSignatory">
                                <!-- <form action="../../php/query-fees.php?query=EDIT" method="post"> -->
                                    <input type="hidden" id="hiddenSignatoryId" name="hiddenSignatoryId">

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Signatory Office</span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="esignatoryoffice" name="esignatoryoffice" required="">
                                                <option value="">Select Office</option>
                                                <option value="Office of the Mayor">Office of the Mayor</option>
                                                <option value="Premits and Licensing Office">Premits and Licensing Office</option>
                                                <option value="Treasury Office">Treasury Office</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">First Name</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces"  id = "esfname" name = "esfname" placeholder="First Name" aria-label="esfname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Middle Name</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "esmname" name = "esmname" placeholder="Middle Name" aria-label="esmname" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Last Name</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "eslname" name = "eslname" placeholder="Last Name" aria-label="eslname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Position</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces"  id = "esposition" name = "esposition" placeholder="Position" aria-label="esposition" aria-describedby="basic-addon1" required>
                                        </div>
                                    <button type="submit" class="btn btn-sm btn-secondary" style="width: 100%"><span class="fa fa-fw fa-paper-plane"></span>Submit</button>
                                </form>
                            </div>
                        </div>                  
                    </div> 
                </div>
            </div>                    
        </div>
    </div>
<?php include("../footer.php");?>