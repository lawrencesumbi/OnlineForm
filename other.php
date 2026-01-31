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


$children      = json_decode($user['children'] ?? '[]', true);
$children_dob  = json_decode($user['children_dob'] ?? '[]', true);
$beneficiaries = json_decode($user['beneficiaries'] ?? '[]', true);
$relationship  = json_decode($user['relationship'] ?? '[]', true);
$benef_dob     = json_decode($user['benef_dob'] ?? '[]', true);


$children      = is_array($children) ? $children : [];
$children_dob  = is_array($children_dob) ? $children_dob : [];
$beneficiaries = is_array($beneficiaries) ? $beneficiaries : [];
$relationship  = is_array($relationship) ? $relationship : [];
$benef_dob     = is_array($benef_dob) ? $benef_dob : [];


$user = array_merge([

    'spouse'        => null,
    'spouse_dob'    => null,
    'children'      => json_encode([]),
    'children_dob'  => json_encode([]),
    'beneficiaries' => json_encode([]),
    'relationship'  => json_encode([]),
    'benef_dob'     => json_encode([]),

    'profession_business' => null,
    'date_started'        => null,
    'self_earnings'       => null,
    'foreign_address'     => null,
    'ofw_earnings'        => null,
    'membership'          => null,
    'reference'           => null,
    'spouse_income'       => null,
    'agreement'           => null,

    'printed_name'   => null,
    'cert_signature' => null,
    'cert_date'      => null,
    'right_thumb'    => null,
    'right_index'    => null,

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


function calculateAge($birthDateString)
{
    if (empty($birthDateString)) return "N/A";
    $birthDate = new DateTime($birthDateString);
    $today = new DateTime('today');
    $interval = $birthDate -> diff($today);
    return $interval->y;
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
    </div>

<div class="margin-div">

<div class="con-1">
    <div class="personal_data"> 
        <h2>A. PERSONAL DATA</h2>
        <p style="display: none;"><strong>ID:</strong> <?= htmlspecialchars($user['id']) ?></p>
        <p><strong>Name:</strong> <?= htmlspecialchars($user['name']) ?></p>
        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($user['name_dob']) ?></p>
        <p><strong>Home Address:</strong> <?= htmlspecialchars($user['home_address']) ?></p>
        <p><strong>Age:</strong> <?= calculateAge($user['name_dob']) ?></p>
        
        
    </div>
</div>

<div class="button-con">
    <a href="admin.php"><button type="button">Back to Table</button></a>
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