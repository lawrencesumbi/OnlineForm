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

/* =========================
   PART I – PERSONAL DATA
========================= */
$data = [
    'sss_number'     => post('sss'),
    'full_name'      => post('name'),
    'date_of_birth'  => post('dob'),
    'sex'            => post('sex'),
    'civil_status'   => post('cs') === 'others' ? post('cs_other') : post('cs'),
    'tin'            => post('tin'),
    'nationality'    => post('nationality'),
    'religion'       => post('religion'),
    'place_of_birth' => post('pob'),
    'home_address'   => post('address'),
    'zip_code'       => post('zip'),
    'mobile_number'  => post('number'),
    'email'          => post('email'),
    'telephone'      => post('tel'),
    'father_name'    => post('father'),
    'mother_name'    => post('mother'),

/* =========================
   PART II – DEPENDENTS
========================= */
    'spouse_name'    => post('spouse'),
    'spouse_dob'     => post('spousedob'),
    'children'       => implode(' | ', $_POST['children'] ?? []),
    'children_dob'   => implode(' | ', $_POST['childdob'] ?? []),
    'beneficiary'    => post('benif'),
    'beneficiary_rel'=> post('rel'),
    'beneficiary_dob'=> post('benifdob'),

/* =========================
   PART III – WORK INFO
========================= */
    'profession'     => post('prof_bus'),
    'year_started'   => post('year_star'),
    'monthly_se'     => post('monthly_se'),
    'foreign_address'=> post('foradd'),
    'monthly_ofw'    => post('monthly_ofw'),
    'flexi_member'   => post('membership'),
    'working_ref'    => post('reference'),
    'monthly_nws'    => post('monthly_nws'),
    'agreement'      => post('agree'),

/* =========================
   PART IV – CERTIFICATION
========================= */
    'printed_name'   => post('printed'),
    'signature'      => post('signature'),
    'signed_date'    => post('date'),
    'fingerprint'    => post('right'),

/* =========================
   SSS SECTION
========================= */
    'business_code'  => post('bc'),
    'monthly_contri' => post('monthly_business'),
    'start_payment'  => post('payment'),
    'working_msc'    => post('working'),
    'approved_msc'   => post('approved'),
    'flexi_status'   => post('flexi')
];

// BASIC REQUIRED VALIDATION
if ($data['full_name'] === '' || $data['date_of_birth'] === '' || $data['sex'] === '') {
    die('Required fields missing.');
}

/* =========================
   INSERT QUERY
========================= */
$sql = "INSERT INTO sss_members (
    sss_number, full_name, date_of_birth, sex, civil_status, tin,
    nationality, religion, place_of_birth, home_address, zip_code,
    mobile_number, email, telephone, father_name, mother_name,
    spouse_name, spouse_dob, children, children_dob,
    beneficiary, beneficiary_rel, beneficiary_dob,
    profession, year_started, monthly_se,
    foreign_address, monthly_ofw, flexi_member,
    working_ref, monthly_nws, agreement,
    printed_name, signature, signed_date, fingerprint,
    business_code, monthly_contri, start_payment,
    working_msc, approved_msc, flexi_status
) VALUES (
    :sss_number, :full_name, :date_of_birth, :sex, :civil_status, :tin,
    :nationality, :religion, :place_of_birth, :home_address, :zip_code,
    :mobile_number, :email, :telephone, :father_name, :mother_name,
    :spouse_name, :spouse_dob, :children, :children_dob,
    :beneficiary, :beneficiary_rel, :beneficiary_dob,
    :profession, :year_started, :monthly_se,
    :foreign_address, :monthly_ofw, :flexi_member,
    :working_ref, :monthly_nws, :agreement,
    :printed_name, :signature, :signed_date, :fingerprint,
    :business_code, :monthly_contri, :start_payment,
    :working_msc, :approved_msc, :flexi_status
)";

$stmt = $pdo->prepare($sql);
$stmt->execute($data);

echo "✅ Form successfully submitted!";
