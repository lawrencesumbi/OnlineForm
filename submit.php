<?php
require 'db.php';

// Collect inputs safely
$full_name   = trim($_POST['name'] ?? '');
$dob         = $_POST['dob'] ?? '';
$sex         = $_POST['sex'] ?? '';
$cs          = $_POST['cs'] ?? '';
$cs_other    = trim($_POST['cs_other'] ?? '');
$nationality = trim($_POST['nationality'] ?? '');
$pob         = trim($_POST['pob'] ?? '');
$address     = trim($_POST['address'] ?? '');
$number      = trim($_POST['number'] ?? '');
$email       = trim($_POST['email'] ?? '');

// --- Civil Status Logic ---
if ($cs === 'others') {
    if ($cs_other === '') {
        die("Please specify civil status.");
    }
    $civil_status = $cs_other;
} else {
    $civil_status = $cs;
}

// --- Address Logic ---
if ($address === '') {
    // checkbox checked → assume same as place of birth
    $address = $pob;
}

// --- Basic validation ---
if ($full_name === '' || $dob === '' || $sex === '' || $civil_status === '') {
    die("Required fields are missing.");
}

// --- Insert to database ---
$sql = "INSERT INTO sss_members 
        (full_name, date_of_birth, sex, civil_status, nationality, place_of_birth, home_address, mobile_number, email)
        VALUES
        (:full_name, :dob, :sex, :civil_status, :nationality, :pob, :address, :number, :email)";

$stmt = $pdo->prepare($sql);

$stmt->execute([
    ':full_name'   => $full_name,
    ':dob'         => $dob,
    ':sex'         => $sex,
    ':civil_status'=> $civil_status,
    ':nationality' => $nationality,
    ':pob'         => $pob,
    ':address'     => $address,
    ':number'      => $number,
    ':email'       => $email
]);

echo "Form successfully submitted!";
