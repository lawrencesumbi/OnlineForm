<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = (int) $_POST['id'];

// Handle civil status "others"
$civil_status = $_POST['cs'] ?? null;
$cs_other     = trim($_POST['cs_other'] ?? '');
if ($civil_status === 'others' && $cs_other !== '') {
    $civil_status = $cs_other;
}

try {
    $pdo->beginTransaction();

    // =========================
    // PERSONAL DATA
    // =========================
    $stmt = $pdo->prepare("
        UPDATE personal_data SET
            sss_number     = :sss_number,
            name           = :name,
            name_dob       = :name_dob,
            sex            = :sex,
            civil_status   = :civil_status,
            tin_number     = :tin_number,
            nationality    = :nationality,
            religion       = :religion,
            place_of_birth = :place_of_birth,
            home_address   = :home_address,
            zip_code       = :zip_code,
            mobile_number  = :mobile_number,
            email_address  = :email_address,
            tel_number     = :tel_number,
            fathers_name   = :fathers_name,
            mothers_name   = :mothers_name
        WHERE id = :id
    ");

    $stmt->execute([
        ':sss_number'     => $_POST['sss_number'],
        ':name'           => $_POST['name'],
        ':name_dob'       => $_POST['name_dob'],
        ':sex'            => $_POST['sex'],
        ':civil_status'   => $civil_status,
        ':tin_number'     => $_POST['tin'],
        ':nationality'    => $_POST['nationality'],
        ':religion'       => $_POST['religion'],
        ':place_of_birth' => $_POST['pob'],
        ':home_address'   => $_POST['address'],
        ':zip_code'       => $_POST['zip'],
        ':mobile_number'  => $_POST['mobile'],
        ':email_address'  => $_POST['email'],
        ':tel_number'     => $_POST['tel'],
        ':fathers_name'   => $_POST['father'],
        ':mothers_name'   => $_POST['mother'],
        ':id'             => $id
    ]);

    // =========================
    // DEPENDENTS
    // =========================
    $stmt = $pdo->prepare("
        UPDATE dependents SET
            spouse        = :spouse,
            spouse_dob    = :spouse_dob,
            children      = :children,
            children_dob  = :children_dob,
            beneficiaries = :beneficiaries,
            relationship  = :relationship,
            benef_dob     = :benef_dob
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':spouse'        => $_POST['spouse'],
        ':spouse_dob'    => $_POST['spouse_dob'],
        ':children'      => json_encode($_POST['children'] ?? []),
        ':children_dob'  => json_encode($_POST['children_dob'] ?? []),
        ':beneficiaries' => json_encode($_POST['beneficiaries'] ?? []),
        ':relationship'  => json_encode($_POST['relationship'] ?? []),
        ':benef_dob'     => json_encode($_POST['benef_dob'] ?? []),
        ':id'            => $id
    ]);

    // =========================
    // WORK
    // =========================
    $stmt = $pdo->prepare("
        UPDATE work SET
            profession_business = :profession_business,
            date_started        = :date_started,
            self_earnings       = :self_earnings,
            foreign_address     = :foreign_address,
            ofw_earnings        = :ofw_earnings,
            membership          = :membership,
            reference           = :reference,
            spouse_income       = :spouse_income,
            agreement           = :agreement
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':profession_business' => $_POST['prof_bus'],
        ':date_started'        => $_POST['year_start'],
        ':self_earnings'       => $_POST['self_earn'],
        ':foreign_address'     => $_POST['for_add'],
        ':ofw_earnings'        => $_POST['ofw_earnings'],
        ':membership'          => $_POST['membership'] ?? null,
        ':reference'           => $_POST['reference'],
        ':spouse_income'       => $_POST['spouse_income'],
        ':agreement'           => $_POST['agreement'],
        ':id'                  => $id
    ]);

    // =========================
    // CERTIFICATION
    // =========================
    $stmt = $pdo->prepare("
        UPDATE certification SET
            printed_name  = :printed_name,
            cert_signature= :cert_signature,
            cert_date     = :cert_date,
            right_thumb   = :right_thumb,
            right_index   = :right_index
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':printed_name'   => $_POST['printed_name'],
        ':cert_signature' => $_POST['cert_signature'],
        ':cert_date'      => $_POST['cert_date'],
        ':right_thumb'    => $_POST['right_thumb'],
        ':right_index'    => $_POST['right_index'],
        ':id'             => $id
    ]);

    // =========================
    // FILLED SSS
    // =========================
    $stmt = $pdo->prepare("
        UPDATE filled_sss SET
            business_code        = :business_code,
            monthly_contribution = :monthly_contribution,
            start_payment        = :start_payment,
            working_spouse       = :working_spouse,
            approved_msc         = :approved_msc,
            flexi_fund           = :flexi_fund,
            received_signature   = :received_signature,
            received_date        = :received_date,
            processed_signature  = :processed_signature,
            processed_date       = :processed_date,
            reviewed_signature   = :reviewed_signature,
            reviewed_date        = :reviewed_date
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':business_code'        => $_POST['business_code'],
        ':monthly_contribution' => $_POST['monthly_contribution'],
        ':start_payment'        => $_POST['start_payment'],
        ':working_spouse'       => $_POST['working_spouse'],
        ':approved_msc'         => $_POST['approved_msc'],
        ':flexi_fund'           => $_POST['flexi_fund'] ?? null,
        ':received_signature'   => $_POST['received_signature'],
        ':received_date'        => $_POST['received_date'],
        ':processed_signature'  => $_POST['processed_signature'],
        ':processed_date'       => $_POST['processed_date'],
        ':reviewed_signature'   => $_POST['reviewed_signature'],
        ':reviewed_date'        => $_POST['reviewed_date'],
        ':id'                   => $id
    ]);

    $pdo->commit();

} catch (Exception $e) {
    $pdo->rollBack();
    die("Update failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Updated Successfully</title>
</head>
<body>
    <div class="inner-con">
        <div class="check-icon">
            <img src="img/greencheck.png" alt="check-icon">
        </div>
        <div class="suctext-div">
            <h1>Updated Successfully!</h1>
            <p>We have updated your information and will process it shortly. Thank you.</p>
        </div>
        <div class="back-div">
            <a href="admin.php"><button type="button">Back to Table</button></a>
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