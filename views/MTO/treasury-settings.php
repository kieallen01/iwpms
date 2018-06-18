<?php
    session_start();

    if(!$_SESSION['login']){
        header('location: ../../index.php');
    }
?>

<?php include("../header.php");?>

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

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="btn btn-nav btn-sm btn-default bg-light active" id="fee-management-tab" data-toggle="tab" href="#fee-management" role="tab" aria-controls="fee-management" aria-selected="true"><span class="fa fa-fw fa-money"></span> Fee Management</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav btn-sm btn-default bg-light" id="penalty-management-tab" data-toggle="tab" href="#penalty-management" role="tab" aria-controls="penalty-management" aria-selected="true"><span class="fa fa-fw fa-calendar"></span> Penalty Management</a>
                </li>
            </ul>

            <br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="fee-management" role="tabpanel" aria-labelledby="fee-management-tab">
                    <div id="divFeeManagement" class="row">
                        <div class="col-md-4">
                        <form id = "frmAddFee">
                            <!-- <form action="../../php/query-fees.php" method="post">  -->                               
                                <div class="card card-panel">
                                    <div class="card-header"><span class="fa fa-plus"></span> Add Fee</div>
                                    <div class="card-body">

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "feedescription" name = "feedescription" placeholder="Desciption" aria-label="feedescription" aria-describedby="basic-addon1" required autofocus>
                                        </div>

                                        <div id="_username" class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-money"></i></span>
                                            </div>
                                            <input type="number" min="1" class="form-control form-control-sm" id = "fee" name = "fee" placeholder="0.00" aria-label="fee" aria-describedby="basic-addon1" required>
                                        </div>
                                        
                                        <button class= "btn btn-sm btn-secondary" style="width:100%;" type = "submit" name = "btnAddPayment" id = "btnAddPayment"><small><span class="fa fa-paper-plane"></span> </small> Submit</button>      

                                    </div>
                                </div>
                            </form> 
                        </div>
                        
                        <!-- MODAL VIEW FEE INFO -->

                         <div id="remodal-view-fee" class="remodal small" data-remodal-id="modalViewFee">
                            <div class="card-header"><span class="fa fa-eye"></span> View Fee<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Fee Desciption</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vfeedescription" name = "vfeedescription" aria-label="vfeedescription" aria-describedby="basic-addon1" disabled="" autofocus>
                                </div>

                                <div id="_username" class="input-group input-group-sm mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Fee</span>
                                    </div>
                                    <input type="number" min="1" class="form-control form-control-sm view" id = "vfee" name = "vfee"  aria-label="vfee" aria-describedby="basic-addon1" disabled="">
                                </div>
                            </div>
                        </div>

                        <!-- MODAL EDIT FEE INFO -->

                         <div id="remodal-edit-fee" class="remodal small" data-remodal-id="modalEditFee">
                            <div class="card-header"><span class="fa fa-edit"></span> Edit Fee<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <form id="frmEditFee">
                                <!-- <form action="../../php/query-fees.php?query=EDIT" method="post"> -->
                                    <input type="hidden" id="hiddenFeeId" name="hiddenFeeId">
                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Fee Desciption</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "efeedescription" name = "efeedescription" aria-label="efeedescription" aria-describedby="basic-addon1" autofocus required>
                                    </div>

                                    <div id="_username" class="input-group input-group-sm mb-4">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Fee</span>
                                        </div>
                                        <input type="number" min="1" class="form-control form-control-sm view" id = "efee" name = "efee"  aria-label="efee" aria-describedby="basic-addon1" required>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-secondary" style="width: 100%"><span class="fa fa-fw fa-paper-plane"></span>Submit</button>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card card-panel">
                                <div class="card-header"><span class="fa fa-list"></span> List of Fees</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblListOfFees" class="table table-bordered nowrap" cellspacing = "0" width = "100%">                                 
                                            <thead>
                                                 <tr>
                                                     <th>ID</th>
                                                     <th>Fee Desciption</th>
                                                     <th>Fee</th>
                                                     <th>Date Created</th>
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
                <div class="tab-pane fade show" id="penalty-management" role="tabpanel" aria-labelledby="penalty-management-tab">
                    <div id="divFeeManagement" class="row">

                        <div class="col-md-4">
                            <form id = "frmAddPenaltyRate">
                                <!-- <form action="../../php/query-fees.php" method="post">  -->                               
                                <div class="card card-panel">
                                    <div class="card-header"><span class="fa fa-plus"></span> Add Penalty Rate</div>
                                    <div class="card-body">
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" id = "penaltydescription" name = "penaltydescription" placeholder="Desciption" aria-label="penaltyrate" aria-describedby="basic-addon1" required autofocus>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-percent"></i></span>
                                            </div>
                                            <input type="number" min="1" max="100" class="form-control form-control-sm" id = "penaltyrate" name = "penaltyrate" placeholder="Penalty Rate" aria-label="penaltyrate" aria-describedby="basic-addon1" required autofocus>
                                        </div>

                                        <div id="_username" class="input-group input-group-sm mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control form-control-sm" id = "penaltydeadline" name = "penaltydeadline" value="<?php echo date('Y-m-d');?>" aria-label="penaltydeadline" aria-describedby="basic-addon1" required>
                                        </div>
                                        
                                        <button class= "btn btn-sm btn-secondary" style="width:100%;" type = "submit" name = "btnAddPenalty" id = "btnAddPenalty"><small><span class="fa fa-paper-plane"></span> </small> Submit</button>      
                                    </div>
                                </div>
                            </form> 
                        </div >

                        <div class="col-md-8">
                            <div class="card card-panel">
                                <div class="card-header"><span class="fa fa-list"></span> List of Penalty Rate</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblListOfPenaltyRate" class="table table-bordered nowrap" cellspacing = "0" width = "100%">                                 
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Description</th>
                                                    <th>Rate</th>
                                                    <th>Penalty Deadline</th>
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

                        <!-- MODAL VIEW PENALTY INFO -->

                         <div id="remodal-view-penalty" class="remodal small" data-remodal-id="modalViewPenalty">
                            <div class="card-header"><span class="fa fa-eye"></span> View Penalty<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Description</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vpendescription" name = "vpendescription" aria-label="vpendescription" aria-describedby="basic-addon1" disabled="" autofocus>
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Penalty Rate</span>
                                    </div>
                                    <input type="text" min="1" class="form-control form-control-sm view" id = "vpenrate" name = "vpenrate"  aria-label="vpenrate" aria-describedby="basic-addon1" disabled="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Penalty Date</span>
                                    </div>
                                    <input type="text" min="1" class="form-control form-control-sm view" id = "vpendate" name = "vpendate"  aria-label="vpendate" aria-describedby="basic-addon1" disabled="">
                                </div>
                            </div>
                        </div>

                        <!-- MODAL EDIT FEE INFO -->

                        <div id="remodal-edit-penalty" class="remodal small" data-remodal-id="modalEditPenalty">
                            <div class="card-header"><span class="fa fa-edit"></span> Edit Penalty<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <form id="frmEditPenalty">
                                <!-- <form action="../../php/query-penalty.php?query=EDIT" method="post"> -->
                                    <input type="hidden" id="hiddenPenaltyId" name="hiddenPenaltyId">
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Description</span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm view" id = "ependescription" name = "ependescription" aria-label="ependescription" aria-describedby="basic-addon1" required="" autofocus>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Penalty Rate</span>
                                            </div>
                                            <input type="number" min="1" max="100" class="form-control form-control-sm view" id = "epenrate" name = "epenrate"  aria-label="epenrate" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text view" id="basic-addon1">Penalty Date</span>
                                            </div>
                                            <input type="date" min="1" class="form-control form-control-sm view" id = "ependate" name = "ependate"  aria-label="ependate" aria-describedby="basic-addon1" required="">
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