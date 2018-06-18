<?php
    session_start();
    include('../includes/connection.php');

    if ($_POST['captcha'] == $_SESSION['cap_code']) {
        
        $fname      = ucwords($_POST["appFname"]);
        $mname      = ucwords($_POST["appMname"]);
        $lname      = ucwords($_POST["appLname"]);
        $gender     = $_POST["appGender"];
        $phone      = $_POST["appPhoneNumber"];
        $dob        = $_POST["appDateOfBirth"];
        $provPB     = $_POST["appProvPB"];
        $citymunPB  = $_POST["appMunPB"];
        $brgyPB     = $_POST["appBarPB"];
        $provHA     = $_POST["appProvHA"];
        $citymunHA  = $_POST["appMunHA"];
        $brgyHA     = $_POST["appBarHA"];
        $position   = ucwords($_POST["appPD"]);
        $cbname     = ucwords($_POST["appCBName"]);
        $cbaddress  = ucwords($_POST["appCBAdd"]);
        $empname    = ucwords($_POST["appEmpName"]);
        $pnname     = ucwords($_POST["appPNName"]);
        $pnaddress  = ucwords($_POST["appPNAdd"]);
        $pnphone    = ucwords($_POST["appPNPhoneNumber"]);


        $strAddOnlineApplicant = $conn->prepare("
            INSERT INTO
                tbl_applicant_information
            VALUES(
                null,
                '".$fname."',
                '".$mname."',
                '".$lname."',
                '".$gender."',
                '".$phone."',
                '".$dob."',
                '".$provPB."',
                '".$citymunPB."',
                '".$brgyPB."',
                '".$provHA."',
                '".$citymunHA."',
                '".$brgyHA."',
                '".$position."',
                '".$cbname."',
                '".$cbaddress."',
                '".$empname."',
                '".$pnname."',
                '".$pnaddress."',
                '".$pnphone."',
                ''
            )
        "); 

        $strAddOnlineRequirement = $conn->prepare("
            INSERT INTO
                tbl_applicant_requirement
            VALUES(null,0,0,0,0,0,0,0
            )");
            
        $strAddApplication = $conn->prepare("
            INSERT INTO
                tbl_application_details
            VALUES(null,'Online','".date('Y-m-d')."','N',''
            )");

        if ($strAddOnlineApplicant->execute()) {
            if ($strAddOnlineRequirement->execute()) {
                if ($strAddApplication->execute()) {
                    echo true;
                }else{
                    echo false;
                }
            }else{
                echo false;
            }
        }else{
            echo false;
        }

    } else {
        echo 0;
    }
?>