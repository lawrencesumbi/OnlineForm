<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$id = (int) $_POST['id'];

try {
    $pdo->beginTransaction();

    /* =========================
       PERSONAL DATA
    ========================= */
    $stmt = $pdo->prepare("
        UPDATE personal_data SET
            last_name = :last_name,
            first_name = :first_name,
            middle_name = :middle_name,
            suffix = :suffix,
            sex = :sex,
            civil_status = :civil_status,
            birth_date = :birth_date,
            birth_place = :birth_place,
            address = :address,
            tin = :tin,
            sss = :sss,
            mobile = :mobile,
            email = :email
        WHERE id = :id
    ");

    $stmt->execute([
        ':last_name'    => $_POST['last_name'],
        ':first_name'   => $_POST['first_name'],
        ':middle_name'  => $_POST['middle_name'],
        ':suffix'       => $_POST['suffix'],
        ':sex'          => $_POST['sex'],
        ':civil_status' => $_POST['civil_status'],
        ':birth_date'   => $_POST['birth_date'],
        ':birth_place'  => $_POST['birth_place'],
        ':address'      => $_POST['address'],
        ':tin'          => $_POST['tin'],
        ':sss'          => $_POST['sss'],
        ':mobile'       => $_POST['mobile'],
        ':email'        => $_POST['email'],
        ':id'           => $id
    ]);

    /* =========================
       DEPENDENTS
    ========================= */
    $stmt = $pdo->prepare("
        UPDATE dependents SET
            spouse = :spouse,
            spouse_dob = :spouse_dob,
            children = :children,
            children_dob = :children_dob,
            beneficiaries = :beneficiaries,
            relationship = :relationship,
            benef_dob = :benef_dob
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

    /* =========================
       WORK
    ========================= */
    $stmt = $pdo->prepare("
        UPDATE work SET
            profession_business = :profession_business,
            date_started = :date_started,
            self_earnings = :self_earnings,
            foreign_address = :foreign_address,
            ofw_earnings = :ofw_earnings,
            membership = :membership,
            reference = :reference,
            spouse_income = :spouse_income,
            agreement = :agreement
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':profession_business' => $_POST['profession_business'],
        ':date_started'        => $_POST['date_started'],
        ':self_earnings'       => $_POST['self_earnings'],
        ':foreign_address'     => $_POST['foreign_address'],
        ':ofw_earnings'        => $_POST['ofw_earnings'],
        ':membership'          => $_POST['membership'],
        ':reference'           => $_POST['reference'],
        ':spouse_income'       => $_POST['spouse_income'],
        ':agreement'           => $_POST['agreement'],
        ':id'                  => $id
    ]);

    /* =========================
       CERTIFICATION
    ========================= */
    $stmt = $pdo->prepare("
        UPDATE certification SET
            printed_name = :printed_name,
            cert_signature = :cert_signature,
            cert_date = :cert_date,
            right_thumb = :right_thumb,
            right_index = :right_index
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':printed_name'  => $_POST['printed_name'],
        ':cert_signature'=> $_POST['cert_signature'],
        ':cert_date'     => $_POST['cert_date'],
        ':right_thumb'   => $_POST['right_thumb'],
        ':right_index'   => $_POST['right_index'],
        ':id'            => $id
    ]);

    /* =========================
       FILLED SSS (ADMIN)
    ========================= */
    $stmt = $pdo->prepare("
        UPDATE filled_sss SET
            business_code = :business_code,
            monthly_contribution = :monthly_contribution,
            start_payment = :start_payment,
            working_spouse = :working_spouse,
            approved_msc = :approved_msc,
            flexi_fund = :flexi_fund,
            received_signature = :received_signature,
            received_date = :received_date,
            processed_signature = :processed_signature,
            processed_date = :processed_date,
            reviewed_signature = :reviewed_signature,
            reviewed_date = :reviewed_date
        WHERE personal_data_id = :id
    ");

    $stmt->execute([
        ':business_code'         => $_POST['business_code'],
        ':monthly_contribution' => $_POST['monthly_contribution'],
        ':start_payment'        => $_POST['start_payment'],
        ':working_spouse'       => $_POST['working_spouse'],
        ':approved_msc'         => $_POST['approved_msc'],
        ':flexi_fund'           => $_POST['flexi_fund'],
        ':received_signature'   => $_POST['received_signature'],
        ':received_date'        => $_POST['received_date'],
        ':processed_signature'  => $_POST['processed_signature'],
        ':processed_date'       => $_POST['processed_date'],
        ':reviewed_signature'   => $_POST['reviewed_signature'],
        ':reviewed_date'        => $_POST['reviewed_date'],
        ':id'                   => $id
    ]);

    $pdo->commit();

    header("Location: list.php?updated=1");
    exit;

} catch (Exception $e) {
    $pdo->rollBack();
    die("Update failed: " . $e->getMessage());
}
