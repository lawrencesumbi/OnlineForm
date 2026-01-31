<?php
require 'db.php';

$sql = "SELECT 
            id,
            sss_number,
            name,
            name_dob,
            sex,
            civil_status,
            nationality,
            mobile_number,
            email_address
        FROM personal_data
        ORDER BY id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sss_number = trim($_POST['sss_number']);

// ==========================
// Fetch Personal Data + Dependents + Work + Certification + Filled SSS
// ==========================
$stmt = $pdo->prepare("
    SELECT 
        pd.*,
        d.spouse, d.spouse_dob, d.children, d.children_dob, d.beneficiaries, d.relationship, d.benef_dob,
        w.profession_business, w.date_started, w.self_earnings, w.foreign_address, w.ofw_earnings, w.membership, w.reference, w.spouse_income, w.agreement,
        c.printed_name, c.cert_signature, c.cert_date, c.right_thumb, c.right_index,
        f.business_code, f.monthly_contribution, f.start_payment, f.working_spouse, f.approved_msc, f.flexi_fund, f.received_signature, f.received_date, f.processed_signature, f.processed_date, f.reviewed_signature, f.reviewed_date
    FROM personal_data pd
    LEFT JOIN dependents d ON d.personal_data_id = pd.id
    LEFT JOIN work w ON w.personal_data_id = pd.id
    LEFT JOIN certification c ON c.personal_data_id = pd.id
    LEFT JOIN filled_sss f ON f.personal_data_id = pd.id
    WHERE pd.sss_number = :sss_number
    LIMIT 1
");

$stmt->execute([':sss_number' => $sss_number]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: landing.php?error=SSS_NumberNotFound");
    exit;
}

// ==========================
// Decode JSON fields safely
// ==========================
$children      = json_decode($user['children'] ?? '[]', true);
$children_dob  = json_decode($user['children_dob'] ?? '[]', true);
$beneficiaries = json_decode($user['beneficiaries'] ?? '[]', true);
$relationship  = json_decode($user['relationship'] ?? '[]', true);
$benef_dob     = json_decode($user['benef_dob'] ?? '[]', true);

// Ensure arrays
$children      = is_array($children) ? $children : [];
$children_dob  = is_array($children_dob) ? $children_dob : [];
$beneficiaries = is_array($beneficiaries) ? $beneficiaries : [];
$relationship  = is_array($relationship) ? $relationship : [];
$benef_dob     = is_array($benef_dob) ? $benef_dob : [];

// ==========================
// Provide default values for all optional fields to prevent undefined index warnings
// ==========================
$user = array_merge([
    // Dependents
    'spouse'        => null,
    'spouse_dob'    => null,
    'children'      => json_encode([]),
    'children_dob'  => json_encode([]),
    'beneficiaries' => json_encode([]),
    'relationship'  => json_encode([]),
    'benef_dob'     => json_encode([]),
    // Work
    'profession_business' => null,
    'date_started'        => null,
    'self_earnings'       => null,
    'foreign_address'     => null,
    'ofw_earnings'        => null,
    'membership'          => null,
    'reference'           => null,
    'spouse_income'       => null,
    'agreement'           => null,
    // Certification
    'printed_name'   => null,
    'cert_signature' => null,
    'cert_date'      => null,
    'right_thumb'    => null,
    'right_index'    => null,
    // Filled SSS
    'business_code'        => null,
    'monthly_contribution' => null,
    'start_payment'        => null,
    'working_spouse'       => null,
    'approved_msc'         => null,
    'flexi_fund'           => null,
    'received_signature'   => null,
    'received_date'        => null,
    'processed_signature'  => null,
    'processed_date'       => null,
    'reviewed_signature'   => null,
    'reviewed_date'        => null
], $user);
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
        <h2>A. PERSONAL DATA</h2>
        <p style="display: none;"><strong>ID:</strong> <?= htmlspecialchars($user['id']) ?></p>
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
        <h2>B. DEPENDENTS/BENEFICIARIES</h2>
        <p><strong>Spouse's Name:</strong> <?= htmlspecialchars($user['spouse']) ?></p>
        <p><strong>Spouse's Birthdate:</strong> <?= htmlspecialchars($user['spouse_dob']) ?></p>
        <p><strong>Children:</strong></p>
        <?php if (!empty($children)): ?>
            <ul>
                <?php foreach ($children as $index => $child): ?>
                    <li>
                        <?= htmlspecialchars($child) ?>
                        <?= htmlspecialchars($children_dob[$index] ?? 'N/A') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>None</p>
        <?php endif; ?>
        <p><strong>Beneficiaries:</strong></p>
        <?php if (!empty($beneficiaries)): ?>
            <ul>
                <?php foreach ($beneficiaries as $i => $name): ?>
                    <li>
                        Name: <?= htmlspecialchars($name) ?><br>
                        Relationship: <?= htmlspecialchars($relationship[$i] ?? 'N/A') ?><br>
                        Date of Birth: <?= htmlspecialchars($benef_dob[$i] ?? 'N/A') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>None</p>
        <?php endif; ?>
    </div>
</div>
<div class="con-2">
    <div class="work">
        <h2>C. FOR WORKERS</h2>
        <p><strong>Profession/Business:</strong> <?= htmlspecialchars($user['profession_business'] ?? 'N/A') ?></p>
        <p><strong>Year Started:</strong> <?= htmlspecialchars($user['date_started'] ?? 'N/A') ?></p>
        <p><strong>Monthly Earnings (Self-employed):</strong> <?= htmlspecialchars($user['self_earnings'] ?? 'N/A') ?></p>
        <p><strong>Foreign Address (OFW):</strong> <?= htmlspecialchars($user['foreign_address'] ?? 'N/A') ?></p>
        <p><strong>OFW Earnings:</strong> <?= htmlspecialchars($user['ofw_earnings'] ?? 'N/A') ?></p>
        <p><strong>Membership:</strong> <?= htmlspecialchars($user['membership'] ?? 'N/A') ?></p>
        <p><strong>Reference:</strong> <?= htmlspecialchars($user['reference'] ?? 'N/A') ?></p>
        <p><strong>Spouse Income:</strong> <?= htmlspecialchars($user['spouse_income'] ?? 'N/A') ?></p>
        <p><strong>Agreement:</strong> <?= htmlspecialchars($user['agreement'] ?? 'N/A') ?></p>
    </div>
    <div class="certification">
        <h2>D. CERTIFICATION</h2>
        <p><strong>Printed Name:</strong> <?= htmlspecialchars($user['printed_name'] ?? 'N/A') ?></p>
        <p><strong>Signature:</strong> <?= htmlspecialchars($user['cert_signature'] ?? 'N/A') ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($user['cert_date'] ?? 'N/A') ?></p>
        <p><strong>Right Thumb:</strong> <?= htmlspecialchars($user['right_thumb'] ?? 'N/A') ?></p>
        <p><strong>Right Index:</strong> <?= htmlspecialchars($user['right_index'] ?? 'N/A') ?></p>
    </div>
</div>
<div class="con-3">
    <div class="filled">
        <h2>II. TO BE FILLED OUT BY SSSS</h2>
        <p><strong>Business Code:</strong> <?= htmlspecialchars($user['business_code'] ?? 'N/A') ?></p>
        <p><strong>Monthly Contribution:</strong> <?= htmlspecialchars($user['monthly_contribution'] ?? 'N/A') ?></p>
        <p><strong>Start of Payment:</strong> <?= htmlspecialchars($user['start_payment'] ?? 'N/A') ?></p>
        <p><strong>Working Spouse:</strong> <?= htmlspecialchars($user['working_spouse'] ?? 'N/A') ?></p>
        <p><strong>Approved MSC:</strong> <?= htmlspecialchars($user['approved_msc'] ?? 'N/A') ?></p>
        <p><strong>Flexi Fund:</strong> <?= htmlspecialchars($user['flexi_fund'] ?? 'N/A') ?></p>
    </div>
    <div class="by">
        <br><br>
        <p><strong>Received By (Signature):</strong> <?= htmlspecialchars($user['received_signature'] ?? 'N/A') ?></p>
        <p><strong>Received Date:</strong> <?= htmlspecialchars($user['received_date'] ?? 'N/A') ?></p>
        <p><strong>Processed By (Signature):</strong> <?= htmlspecialchars($user['processed_signature'] ?? 'N/A') ?></p>
        <p><strong>Processed Date:</strong> <?= htmlspecialchars($user['processed_date'] ?? 'N/A') ?></p>
        <p><strong>Reviewed By (Signature):</strong> <?= htmlspecialchars($user['reviewed_signature'] ?? 'N/A') ?></p>
        <p><strong>Reviewed Date:</strong> <?= htmlspecialchars($user['reviewed_date'] ?? 'N/A') ?></p>
    </div>
</div>
<div class="button-con">
    <a href="index.php?id=<?= $user['id'] ?>">
        <button>Edit</button>
    </a>
    <a href="delete.php?id=<?= (int)$user['id'] ?>" 
       onclick="return confirm('Are you sure you want to delete this record?');">
        <button>Delete</button>
    </a>
    
</div>


</div>

</div>

<style>
body{background-color: rgb(218, 218, 218); width: 1000px; margin: 0 auto; font-family: Cambria; padding-top: 50px; padding-bottom: 50px;}
.bondpaper{width: 1000px; height: auto; background-color: white; padding-bottom: 20px;}
.margin-div{width: 955px; height: auto; border: 3px solid black; margin-left: 20px; margin-right: 20px;}
.exit-div{width: 1000px; height: auto; background-color: blue; text-align: right;}
.header-div{margin-left: 20px; margin-right: 20px; display: flex; padding-top: 5px; padding-bottom: 5px;}
.logo-div{width: 25%;}  
.logo-div img{height: 80px; width: 80px; padding-top: 9px;}
.top-div{width: 50%; text-align: center; margin-top: 5px; margin-bottom: 5px;}
.top-div h1{margin: 0; font-size: 25px;}    
.sss-div{width: 25%; text-align: center; padding-top: 25px;}
.sss-div p{margin: 0;}
.con-1, .con-2, .con-3{width: 100%; height: auto; display: flex;}
.personal_data{width: 50%;}
.personal_data p, h2{margin: 10px;}
.dependent{width: 50%;}
.dependent p, h2{margin: 10px;}
.dependent li{margin: 10px;}
.work {width: 50%;}
.work p, h2{margin: 10px;}
.certification {width: 50%;}
.certification p, h2{margin: 10px;}
.filled{width: 50%;}
.filled p, h2{margin: 10px}
.by{width: 50%;}
.by p{margin: 10px;}
.button-con{height: 20px; text-align: center; border-top: 3px solid black; padding-top: 10px; padding-bottom: 10px;}

</style>
    
</body>
</html>