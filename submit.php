<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

// Helper function
function post($key) {
    return trim($_POST[$key] ?? '');
}


$sss_number     =   $_POST['sss_number'];
$name           =   $_POST['name'];
$name_dob       =   $_POST['name_dob'];
$sex            =   $_POST['sex'];
$civil_status   =   $_POST['cs'];
$tin_number     =   $_POST['tin'];
$nationality    =   $_POST['nationality'];
$religion       =   $_POST['religion'];
$place_of_birth =    $_POST['pob'] ?? NULL;
$home_address   =   $_POST['address'] ?? NULL;
$zip_code       =   $_POST['zip'];
$mobile_number  =   $_POST['mobile'];
$email_address  =   $_POST['email'];
$tel_number     =   $_POST['tel'];
$fathers_name   =   $_POST['father'];
$mothers_name   =   $_POST['mother'];



$spouse         =   $_POST['spouse'];
$spouse_dob     =   $_POST['spouse_dob'];
$children       =   $_POST['children'] ?? [];
$children_dob   =   $_POST['children_dob'] ?? [];
$beneficiaries  =   $_POST['beneficiaries'] ?? [];
$relationship   =   $_POST['relationship'] ?? [];
$benef_dob      =   $_POST['benef_dob'] ?? [];

$children_json      = json_encode($children, JSON_UNESCAPED_UNICODE);
$children_dob_json  = json_encode($children_dob, JSON_UNESCAPED_UNICODE);
$beneficiaries_json = json_encode($beneficiaries, JSON_UNESCAPED_UNICODE);
$relationship_json  = json_encode($relationship, JSON_UNESCAPED_UNICODE);
$benef_dob_json     = json_encode($benef_dob, JSON_UNESCAPED_UNICODE);



$profession_business    =   $_POST['prof_bus'];
$date_started           =   $_POST['year_start'];
$self_earnings          =   $_POST['self_earn'];
$foreign_address        =   $_POST['for_add'];
$ofw_earnings           =   $_POST['ofw_earnings'];
$membership             =   $_POST['membership'] ?? NULL;
$reference              =   $_POST['reference'];
$spouse_income          =   $_POST['spouse_income'];
$agreement              =   $_POST['agreement'];


$printed_name       =   $_POST['printed_name'];
$cert_signature     =   $_POST['cert_signature'];
$cert_date          =   $_POST['cert_date'];
$right_thumb        =   $_POST['right_thumb'];
$right_index        =   $_POST['right_index'];


$business_code          =   $_POST['business_code'];
$monthly_contribution   =   $_POST['monthly_contribution'];
$start_payment          =   $_POST['start_payment'];
$working_spouse         =   $_POST['working_spouse'];
$approved_msc           =   $_POST['approved_msc'];
$flexi_fund             =   $_POST['flexi_fund'] ?? NULL;
$received_signature     =   $_POST['received_signature'];
$received_date          =   $_POST['received_date'];
$processed_signature    =   $_POST['processed_signature'];
$processed_date         =   $_POST['processed_date'];
$reviewed_signature     =   $_POST['reviewed_signature'];
$reviewed_date          =   $_POST['reviewed_date'];


if (isset($_POST['same_address'])) {
    $home_address = $place_of_birth;
}


$civil_status = $_POST['cs'] ?? NULL;
$cs_other     = trim($_POST['cs_other'] ?? '');

// If "others" is selected, use the text input value
if ($civil_status === 'others' && $cs_other !== '') {
    $civil_status = $cs_other;
}






$sql = "INSERT INTO personal_data
(sss_number, name, name_dob, sex, civil_status, tin_number, nationality, religion, place_of_birth, home_address, zip_code, mobile_number, email_address, tel_number, fathers_name, mothers_name)
VALUES
(:sss_number, :name, :name_dob, :sex, :civil_status, :tin_number, :nationality, :religion, :place_of_birth, :home_address, :zip_code, :mobile_number, :email_address, :tel_number, :fathers_name, :mothers_name)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':sss_number'     => $sss_number,
    ':name'           => $name,
    ':name_dob'       => $name_dob,   
    ':sex'            => $sex,
    ':civil_status'   => $civil_status,
    ':tin_number'     => $tin_number,
    ':nationality'    => $nationality,
    ':religion'       => $religion,
    ':place_of_birth' => $place_of_birth,
    ':home_address'   => $home_address,
    ':zip_code'       => $zip_code,
    ':mobile_number'  => $mobile_number,
    ':email_address'  => $email_address,
    ':tel_number'     => $tel_number,
    ':fathers_name'   => $fathers_name,
    ':mothers_name'   => $mothers_name
]);

$personal_data_id = $pdo->lastInsertId();




$sql2 = "INSERT INTO dependents
(personal_data_id, spouse, spouse_dob, children, children_dob, beneficiaries, relationship, benef_dob)
VALUES
(:personal_data_id, :spouse, :spouse_dob, :children, :children_dob, :beneficiaries, :relationship, :benef_dob)";

$stmt2 = $pdo->prepare($sql2);
$stmt2->execute([
    ':personal_data_id' => $personal_data_id,
    ':spouse'           => $spouse,
    ':spouse_dob'       => $spouse_dob,
    ':children'         => $children_json,
    ':children_dob'     => $children_dob_json,
    ':beneficiaries'    => $beneficiaries_json,
    ':relationship'     => $relationship_json,
    ':benef_dob'        => $benef_dob_json
]);






$sql3 = "INSERT INTO work
(personal_data_id, profession_business, date_started, self_earnings, foreign_address, ofw_earnings, membership, reference, spouse_income, agreement)
VALUES
(:personal_data_id, :profession_business, :date_started, :self_earnings, :foreign_address, :ofw_earnings, :membership, :reference, :spouse_income, :agreement)";

$stmt3 = $pdo->prepare($sql3);

$stmt3->execute([
    ':personal_data_id'    => $personal_data_id,
    ':profession_business' => $profession_business,
    ':date_started'        => $date_started,
    ':self_earnings'       => $self_earnings,
    ':foreign_address'     => $foreign_address,
    ':ofw_earnings'        => $ofw_earnings,
    ':membership'          => $membership,
    ':reference'           => $reference,
    ':spouse_income'       => $spouse_income,
    ':agreement'           => $agreement
]);




$sql4 = "INSERT INTO certification
(personal_data_id, printed_name, cert_signature, cert_date, right_thumb, right_index)
VALUES
(:personal_data_id, :printed_name, :cert_signature, :cert_date, :right_thumb, :right_index)";

$stmt4 = $pdo->prepare($sql4);

$stmt4->execute([
    ':personal_data_id' => $personal_data_id,
    ':printed_name'     => $printed_name,
    ':cert_signature'   => $cert_signature,
    ':cert_date'        => $cert_date,
    ':right_thumb'      => $right_thumb,
    ':right_index'      => $right_index
]);



$sql5 = "INSERT INTO filled_sss
(personal_data_id, business_code, monthly_contribution, start_payment, working_spouse, approved_msc, flexi_fund,
 received_signature, received_date, processed_signature, processed_date, reviewed_signature, reviewed_date)
VALUES
(:personal_data_id, :business_code, :monthly_contribution, :start_payment, :working_spouse, :approved_msc, :flexi_fund,
 :received_signature, :received_date, :processed_signature, :processed_date, :reviewed_signature, :reviewed_date)";


$stmt5 = $pdo->prepare($sql5);

$stmt5->execute([
    ':personal_data_id'      => $personal_data_id,  // from lastInsertId()
    ':business_code'         => $business_code,
    ':monthly_contribution'  => $monthly_contribution,
    ':start_payment'         => $start_payment,
    ':working_spouse'        => $working_spouse,
    ':approved_msc'          => $approved_msc,
    ':flexi_fund'            => $flexi_fund,
    ':received_signature'    => $received_signature,
    ':received_date'         => $received_date,
    ':processed_signature'   => $processed_signature,
    ':processed_date'        => $processed_date,
    ':reviewed_signature'    => $reviewed_signature,
    ':reviewed_date'         => $reviewed_date
]);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Successful</title>
</head>
<body>
    <div class="inner-con">
        <div class="check-icon">
            <img src="img/greencheck.png" alt="check-icon">
        </div>
        <div class="suctext-div">
            <h1>Submission Successful!</h1>
            <p>We have received your information and will process it shortly. Thank you.</p>
        </div>
        <div class="back-div">
            <a href="index.html"><button type="button">Back to Form</button></a>
        </div>
    </div>
<style>
body{background-color: rgb(218, 218, 218); width: 1180px; margin: 0 auto; font-family: Cambria; padding-top: 50px; padding-bottom: 50px;}
.inner-con{width: 590px; margin: 0 auto; height: auto; background-color: white; padding-top: 30px; padding-bottom: 30px; border-radius: 10px;}
.check-icon{text-align: center;}
.check-icon img{height: 100px; width: 100px;}
.suctext-div{text-align: center;}
.back-div{text-align: center;}
</style>
</body>
</html>
