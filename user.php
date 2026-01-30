<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Invalid request');
}

$sss_number = trim($_POST['sss_number']);

$stmt = $pdo->prepare("
    SELECT * 
    FROM personal_data 
    WHERE sss_number = :sss_number
");

$stmt->execute([
    ':sss_number' => $sss_number
]);

$stmt = $pdo->prepare("
    SELECT 
        p.*,
        d.spouse
    FROM personal_data p
    LEFT JOIN dependents d 
        ON d.personal_data_id = p.id
    WHERE p.sss_number = :sss
    LIMIT 1
");

$stmt->execute(['sss' => $sss_number]);


$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('SSS Number not found');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>

<div class="bondpaper">

<div class="exit-div">
    <a href="landing.php"><button type="button">X</button></a>
</div>

    <div class="header-div">
        <div class="logo-div">
            <img src="img/logo.jpg" alt="logo">
        </div>
        <div class="top-div">
            <h1>SOCIAL SECURITY SYSTEM</h1>
            <h1>PERSONAL RECORD</h1>
            <h1>FOR ISSUANCE OF SS NUMBER</h1>
        </div>
        <div class="sss-div">
            <p>SS Number:</p>
            <p style="font-size: 22px; font-weight: bold;"><?= htmlspecialchars($user['sss_number']) ?></p>
        </div>
    </div>

<div class="margin-div">

<div class="con-1">
    <div class="personal_data">
        <h3>A. PERSONAL DATA</h3>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user['name_dob']) ?></p>
        <p><strong>Sex:</strong> <?= htmlspecialchars($user['sex']) ?></p>
        <p><strong>Civil Status:</strong> <?= htmlspecialchars($user['civil_status']) ?></p>
        <p><strong>TIN Number:</strong> <?= htmlspecialchars($user['tin_number']) ?></p>
        <p><strong>Nationality:</strong> <?= htmlspecialchars($user['nationality']) ?></p>
        <p><strong>Religion:</strong> <?= htmlspecialchars($user['religion']) ?></p>
        <p><strong>Place of Birth:</strong> <?= htmlspecialchars($user['place_of_birth']) ?></p>
        <p><strong>Home Address:</strong> <?= htmlspecialchars($user['home_address']) ?></p>
        <p><strong>ZIP Code:</strong> <?= htmlspecialchars($user['zip_code']) ?></p>
        <p><strong>Mobile Number:</strong> <?= htmlspecialchars($user['mobile_number']) ?></p>
        <p><strong>Email Address:</strong> <?= htmlspecialchars($user['email_address']) ?></p>
        <p><strong>Telephone Number:</strong> <?= htmlspecialchars($user['tel_number']) ?></p>
        <p><strong>Father's Name:</strong> <?= htmlspecialchars($user['fathers_name']) ?></p>
        <p><strong>Mother's Name:</strong> <?= htmlspecialchars($user['mothers_name']) ?></p>
    </div>
    <div class="dependent">
        <h3>B. DEPENDENTS/BENEFICIARIES</h3>
        <p><strong>Spouse's Name:</strong> <?= htmlspecialchars($user['spouse']) ?></p>
        
    </div>
</div>


</div>

</div>

<style>
body{background-color: rgb(218, 218, 218); width: 1000px; margin: 0 auto; font-family: Cambria; padding-top: 50px; padding-bottom: 50px;}
.bondpaper{width: 1000px; height: 1135px; background-color: white; padding-bottom: 20px;}
.margin-div{width: 955px; height: 1000px; border: 3px solid black; margin-left: 20px; margin-right: 20px;}
.exit-div{width: 1000px; height: auto; background-color: blue; text-align: right;}
.header-div{margin-left: 20px; margin-right: 20px; display: flex; padding-top: 5px; padding-bottom: 5px;}
.logo-div{width: 25%;}  
.logo-div img{height: 80px; width: 80px; padding-top: 9px;}
.top-div{width: 50%; text-align: center; margin-top: 5px; margin-bottom: 5px;}
.top-div h1{margin: 0; font-size: 25px;}    
.sss-div{width: 25%; text-align: center; padding-top: 25px;}
.sss-div p{margin: 0;}
.con-1{width: 100%; height: auto; background-color: red; display: flex;}
.personal_data{width: 50%; background-color: yellow;}
.personal_data p{margin: 10px;}
.personal_data h3{text-align: center;}
.dependent{width: 50%; background-color: green;}
.dependent p{margin: 10px;}
.dependent h3{text-align: center;}
</style>
    
</body>
</html>