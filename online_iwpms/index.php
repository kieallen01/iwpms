<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>IWP Management System</title>
        <link rel = "icon" type = "image/ico" href ="seal.png">
        <link rel="stylesheet" type="text/css" href="plugins/bootstrap/dist/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="plugins/custom.css">
        <link rel="stylesheet" type="text/css" href="plugins/font-awesome/css/font-awesome.min.css">
        
        <link rel="stylesheet" type="text/css" href="plugins/toastr/build/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="plugins/ionicons/css/ionicons.css">
        <link rel="stylesheet" type="text/css" href="plugins/fakeLoader/fakeLoader.css">
    </head>
    <body id="body" onload="fnLaunchNanobar();">
        <div class="container"><br>
            <a href="index.php"><img src="seal.png" height="45" width="45"></a>&nbsp;&nbsp;<span id="systitle">Individual Working Permit Management System<small id="gov">Local Government of Bauang La Union</small></span>
            <!-- Add New Online Applicant -->
            <div class="row" style="padding-top:10px;">
                <div class="col-1"></div>
                <div class="col-10">
                    <div class="card card-panel">
                        <div class="card-header"><span class="ion-edit"></span> Individual Working Permit Registration Form</div>
                        <div class="card-body">
                            <form id="frmAddOnlineApplicant">
                               <div class="row">
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="">Personal Information :</label>
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
                                            <input type="text" class="form-control form-control-sm" id = "appMname" name = "appMname" pattern="[A-Za-z ]+" title="Must only contain letters and spaces" placeholder="Middle Name *" aria-label="appMname" aria-describedby="basic-addon1">
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

                                        <label>Work Information :</label>

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
                                    
                                    <div class="col-lg-4 col-sm-12">
                                        <label for="">Date Of Birth *</label>
                                        <div class="input-group input-group-sm mb-3" id="_dob">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control form-control-sm" id = "appDateOfBirth" name = "appDateOfBirth" value='<?php echo date('Y-m-d');?>' aria-label="appDateOfBirth" aria-describedby="basic-addon1" required="">
                                        </div>

                                        <label for="">Place of Birth :</label>
                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appProvPB" name="appProvPB" required="">
                                                <option value="" selected disabled>Select Province *</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appMunPB" name="appMunPB" required="" disabled="">
                                                <option value="" selected disabled>Select Municipality *</option>
                                            </select>
                                        </div>

                                        <div class="input-group input-group-sm mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-address-card"></i></span>
                                            </div>
                                            <select class="custom-select form-control-sm" id="appBarPB" name="appBarPB" required="" disabled="">
                                                <option value="" selected disabled>Select Barangay *</option>
                                            </select>
                                        </div>

                                        <label for="">Home Address :</label>
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

                                    <div class="col-lg-4 col-sm-12">
                                        <label class="modal-label">Identification Card Information</label>
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

                                        <p class="modal-label" style="font-size:11px;text-align: center;">Person to notify in case of emergency <i>*</i></p>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col">
                                        <label>Note: Please enter the contents of the image before submitting.</label>
                                        <div class="input-group mb-2">
                                             <div class="input-group-append">
                                                <img src="php/captcha.php" id="captcha-image">
                                            </div>               
                                            <input type="text" class="form-control form-control-sm" name="captcha" id="captcha" maxlength="6" required="" />
                                            <div class="input-group-append">
                                                <button type = "button" class="btn btn-sm btn-secondary" id="change" style="font-size: 12px;width: 100%;"><span class="fa fa-refresh"></span> Change Captcha</button>
                                            </div>
                                        
                                        </div>
                                        <button class= "btn btn-sm btn-info" style="width: 100%;" type = "submit" name = "submit" id = "submit"><small><span class="fa fa-paper-plane"></span> </small> Submit</button>                      
                                    </div>
                                </div>                        
                            </form>
                            <div id="cap_status"></div>
                		</div>
                    </div>
                </div>
                <div class="col-1"></div>
            </div>
        </div>

        <script type="text/javascript" src="plugins/jquery/jquery-3.2.1.js"></script>
        <script type="text/javascript">
            $(document).ready(function(){
                // SERVERDIR
                window.serverdir = 'http://'+'<?php echo gethostbyname(getHostName())?>'+'/online_iwpms';

                //TOASTR
                toastr.options = {
                "closeButton"       : false,
                "debug"             : false,
                "newestOnTop"       : true,
                "progressBar"       : false,
                "positionClass"     : "toast-top-right",
                "preventDuplicates" : true,
                "onclick"           : null,
                "showDuration"      : "300",
                "hideDuration"      : "1000",
                "timeOut"           : "3000",
                "extendedTimeOut"   : "1000",
                "showEasing"        : "swing",
                "hideEasing"        : "linear",
                "showMethod"        : "fadeIn",
                "hideMethod"        : "fadeOut"
                }
            }); 
        </script>
        <script type="text/javascript" src="plugins/jqueryui/jquery-ui.js"></script>
        <script type="text/javascript" src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="plugins/popperjs/popper.min.js"></script>
        <script type="text/javascript" src="plugins/nanobar/nanobar.min.js"></script>
        <script type="text/javascript" src="plugins/toastr/build/toastr.min.js"></script>
        <script type="text/javascript" src="plugins/fakeLoader/fakeLoader.min.js"></script>
        <script type="text/javascript" src="plugins/jquery-mask/dist/jquery.mask.js"></script>
        <script type="text/javascript" src="ajax/fnApplicantSettings.js"></script> 
    </body>
</html>
