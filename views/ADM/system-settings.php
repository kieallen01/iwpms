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
                    <a class="btn btn-nav btn-sm btn-default bg-light active" id="user-management-tab" data-toggle="tab" href="#user-management" role="tab" aria-controls="user-management" aria-selected="true"><span class="fa fa-fw fa-user"></span> User Management</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav btn-sm btn-default bg-light" id="backup-tab" data-toggle="tab" href="#backup" role="tab" aria-controls="backup" aria-selected="false"><span class="fa fa-fw fa-database"></span> Backup Database</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav btn-sm btn-default bg-light" id="restore-tab" data-toggle="tab" href="#restore" role="tab" aria-controls="restore" aria-selected="false"><span class="fa fa-fw fa-refresh"></span> Restore Database</a>
                </li>

                <li class="nav-item">
                    <a class="btn btn-nav btn-sm btn-default bg-light" id="activitylog-tab" data-toggle="tab" href="#activitylog" role="tab" aria-controls="activitylog" aria-selected="false"><span class="fa fa-fw fa-list"></span> Activity Log</a>
                </li>
            </ul>
   
            <br>
            <div class="tab-content" id="myTabContent">
            
                <div class="tab-pane fade show active" id="user-management" role="tabpanel" aria-labelledby="user-management-tab">
                    <div id="divUserManagement" class="row">
                        <div class="col">
                            <form id = "frmAddUser">
                            <!-- <form action="../../php/query-user-management.php" method="post">    -->                             
                                <div class="card card-panel">
                                    <div class="card-header"><span class="ion-person-add"></span> Add New User</div>
                                    <div class="card-body">
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-users"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="userlevel" name="userlevel" required="">
                                                <option value="">Select User Level</option>
                                                <option value="Administrator">Administrator</option>
                                                <option value="MTO">MTO</option>
                                                <option value="MTC">MTC</option>
                                                <option value="MHO">MHO</option>
                                                <option value="MPO">MPO</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces"  id = "fname" name = "fname" placeholder="First Name" aria-label="fname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "mname" name = "mname" placeholder="Middle Name" aria-label="mname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-fw fa-info"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "lname" name = "lname" placeholder="Last Name" aria-label="lname" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div id="_username" class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-user"></i></span>
                                            </div>
                                            <input type="text" class="form-control form-control-sm" pattern=".{6,}" title="Username should be six or more characters" id = "username" name = "username" placeholder="Username" aria-label="username" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-lock"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-sm" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" id = "password" name = "password" placeholder="Password" aria-label="password" aria-describedby="basic-addon1" required>
                                        </div>

                                        <div id="_rpassword" class="input-group input-group-sm mb-2">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-refresh"></i></span>
                                            </div>
                                            <input type="password" class="form-control form-control-sm" id = "rpassword" name = "rpassword" placeholder="Re-Enter Password" aria-label="rpassword" aria-describedby="basic-addon1" required>                     
                                        </div> 
                                        <center>
                                            <button class= "btn btn-sm btn-secondary" style="width:49%;" type = "reset" name = "btnClearUser" id = "btnClearUser"><small><span class="fa fa-refresh"></span> </small> Clear</button>      
                                            <button class= "btn btn-sm btn-secondary" style="width:49%;" type = "submit" name = "btnAddUser" id = "btnAddUser"><small><span class="fa fa-paper-plane"></span> </small> Submit</button>      
                                        </center>
                        
                                    </div>
                                </div>
                            </form> 
                        </div>

                        <div class="col">
                            <div class="card card-panel">
                                <div class="card-header"><span class="fa fa-list"></span> List of System Users</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblSystemUsers" class="table table-bordered nowrap" cellspacing = "0" width = "100%">
                                             <thead>
                                                 <tr>
                                                     <th>Username</th>
                                                     <th>Usergroup</th>
                                                     <th>Name</th>
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

                        <!-- VIEW USER MODAL -->

                        <div id="remodal-view-user" class="remodal small" data-remodal-id="modalViewUser">
                            <div class="card-header"><span class="fa fa-eye"></span> View User<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">User Level</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vuserlevel" name = "vuserlevel" aria-label="vuserlevel" aria-describedby="basic-addon1" disabled="">
                                </div>
                                
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Username</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vusername" name = "vusername" aria-label="vusername" aria-describedby="basic-addon1" disabled="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">First Name</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vfname" name = "vfname" aria-label="vfname" aria-describedby="basic-addon1" disabled="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Middle Name</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vmname" name = "vmname"  aria-label="vmname" aria-describedby="basic-addon1" disabled="">
                                </div>

                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Last Name</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vlname" name = "vlname" aria-label="vlname" aria-describedby="basic-addon1" disabled="">
                                </div>
                                
                                <div class="input-group input-group-sm mb-1">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text view" id="basic-addon1">Account Status</span>
                                    </div>
                                    <input type="text" class="form-control form-control-sm view" id = "vstatus" name = "vstatus" aria-label="vstatus" aria-describedby="basic-addon1" disabled="">
                                </div>
                            </div>
                        </div>
                        
                        <!-- EDIT USER MODAL -->
                       <div id="remodal-edit-user" class="remodal small" data-remodal-id="modalEditUser">
                            <div class="card-header"><span class="fa fa-edit"></span> Edit User<button data-remodal-action="close" class="btn remodal-close pull-right"></button></div>
                            <div class="card-body">
                                <form id="frmEditUser">
                                    <input type="hidden" id="hiddenUsername" name="hiddenUsername">
                                    
                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Username</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" id = "eusername" name = "eusername" aria-label="eusername" aria-describedby="basic-addon1" disabled="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">First Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "efname" name = "efname" aria-label="efname" aria-describedby="basic-addon1" required="">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Middle Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "emname" name = "emname"  aria-label="emname" aria-describedby="basic-addon1" required="">
                                    </div>

                                    <div class="input-group input-group-sm mb-2">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">Last Name</span>
                                        </div>
                                        <input type="text" class="form-control form-control-sm view" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" id = "elname" name = "elname" aria-label="elname" aria-describedby="basic-addon1">
                                    </div>

                                    <div class="input-group input-group-sm mb-1">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text view" id="basic-addon1">User Level</span>
                                        </div>
                                        <select class="custom-select form-control-sm" id="euserlevel" name="euserlevel" autofocus="" required="">
                                            <option value="">Select User Level</option>
                                            <option value="Administrator">Administrator</option>
                                            <option value="MTO">MTO</option>
                                            <option value="MTC">MTC</option>
                                            <option value="MHO">MHO</option>
                                            <option value="MPO">MPO</option>
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-sm btn-secondary" style="width: 100%"><span class="fa fa-fw fa-paper-plane"></span>Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>                     
                </div>

                <div class="tab-pane fade" id="config" role="tabpanel" aria-labelledby="config-tab">
                    <div id="divConfig">

                    </div>
                </div>

                <div class="tab-pane fade" id="backup" role="tabpanel" aria-labelledby="backup-tab">
                    <div id="divBackup" class="row">
                        <div class="col"></div>
                        <div class="col-md-6">
                            <div class="card card-panel">
                                <div class="card-body">
                                    <center><img src="../../includes/img/backup.png" id="backup"></center><br>
                                    <form id="frmBackup" enctype="multipart/form-data">
                                        <center><button type="button" class="btn btn-sm btn-secondary" id="btnBackup" name="btnBackup"><span class="ion-archive"></span> Backup Database</button></center>
                                    </form>
                                </div>
                            </div>
                        </div>   
                        <div class="col"></div>                        
                    </div>
                </div>

                <div class="tab-pane fade" id="restore" role="tabpanel" aria-labelledby="restore-tab">
                    <div id="divRestore" class="row">
                        <div class="col"></div>
                        <div class="col-md-6">
                            <div class="card card-panel">
                                <div class="card-body">
                                    <center><img src="../../includes/img/restore.png" id="restore"></center>
                                    <form id="frmRestore">
                                    <!-- <form id="frmRestore" action="../../php/query-database.php?query=RESTORE" method="post" enctype="multipart/form-data"> -->
                                        <center>
                                            <label class="control-label"><input id="input-1" type="file" accept=".sql" name="sql" id="sql" required=""></label>
                                            <button type="submit" name="restore" class="btn btn-sm btn-secondary"><span class="ion-loop"></span> Restore Database</button>
                                        </center>                             
                                    </form>
                                </div>
                            </div>
                        </div>   
                        <div class="col"></div>                        
                    </div>
                </div>

                <div class="tab-pane fade" id="activitylog" role="tabpanel" aria-labelledby="activitylog-tab">
                    <div id="divListActivityLog" class="row">
                        <div class="col">
                            <div class="card card-panel">
                                <div class="card-header"><span class="fa fa-list"></span> List of System Activity</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="tblActivityLog" class="table table-bordered nowrap" cellspacing = "0" width = "100%">
                                             <thead>
                                                 <tr>
                                                     <th>Username</th>
                                                     <th>Activity</th>
                                                     <th>Date</th>
                                                     <th>Time</th>
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