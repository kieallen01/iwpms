<?php
    session_start();
    include ('../../includes/connection.php');

    if(!$_SESSION['login']){
        header('location: ../../index.php');
    }
    if ($_SESSION['user_level'] !== "Administrator") {
        header('location: ../404.php');
    }
?>


<?php include('../header.php');?>
    
    <div class="d-flex align-items-stretch">
            
        <!-- Sidebar Include -->
        
        <?php include("../sidebar.php");?>

        <div class="content p-4">
            <div>
                <a href="index.php" id="dashboard"><span class="fa fa-fw fa-dashboard"></span></a>&nbsp;&nbsp;<span id="systitle">Administrator's Dashboard</span>
                <span id="bauang">
                	<span class="pull-right" id="date">
                		<span class="fa fa-fw fa-calendar"></span> 
                		<?php echo date('F m\, Y');?>
                	</span>
            	</span>
            </div>
            <br>
            <div class="row">

                <div class="col-lg-3 col-xs-6">

                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>
                                <?php
                                    $selectApplicant = "SELECT * FROM tbl_applicant_information";
                                    $selectApplicantResult = $conn->query($selectApplicant);
                                    $rows = $selectApplicantResult->rowCount();
                                    echo $rows;
                                ?>
                            </h3>
                            <p>
                                Applicants 
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person"></i>
                        </div>
                        <a href="#" class="card-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>

                </div>

                <div class="col-lg-3 col-xs-6">

                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>
                                <?php
                                    $selectApplicant = "SELECT * FROM tbl_application_details WHERE fld_released_date != 'N'";
                                    $selectApplicantResult = $conn->query($selectApplicant);
                                    $rows = $selectApplicantResult->rowCount();
                                    echo $rows;
                                ?>
                            </h3>
                            <p>
                                Individual Work Permits
                            </p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-document-text"></i>
                        </div>
                        <a href="#" class="card-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>

                </div>

                <div class="col-lg-3 col-xs-6">

                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>
                                0
                            </h3>
                            <p>
                                Identification Card
                            </p>
                        </div>
                        <div class="icon" style="margin-bottom: 20px;">
                            <i class="fa fa-id-badge"></i>
                        </div>
                        <a href="#" class="card-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>

                </div>

                <div class="col-lg-3 col-xs-6">

                    <div class="small-box bg-light">
                        <div class="inner">
                            <h3>
                                <?php
                                    $selectApplicant = $conn->query("SELECT SUM(fld_fee_cost) FROM tbl_fees_collection");
                                    while ($data=$selectApplicant->fetch(PDO::FETCH_BOTH)) {
                                        echo number_format($data[0]);
                                    }

                                ?>
                            </h3>
                            <p>
                                Collections
                            </p>
                        </div>
                        <div class="icon">
                            <i style="margin-right:10px;">&#8369; </i>
                        </div>
                        <a href="#" class="card-box-footer">
                            More info <i class="fa fa-arrow-circle-right"></i>
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </div>
<?php include("../footer.php");?>
