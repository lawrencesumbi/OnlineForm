<?php
require 'db.php';

$editMode = false;
$data = [];

if (isset($_GET['id'])) {
    $editMode = true;
    $id = (int) $_GET['id'];

    $sql = "
    SELECT 
        p.*, 
        d.spouse, d.spouse_dob, d.children, d.children_dob,
        d.beneficiaries, d.relationship, d.benef_dob,
        w.profession_business, w.date_started, w.self_earnings,
        w.foreign_address, w.ofw_earnings, w.membership,
        w.reference, w.spouse_income, w.agreement,
        c.printed_name, c.cert_signature, c.cert_date,
        c.right_thumb, c.right_index,
        f.business_code, f.monthly_contribution, f.start_payment,
        f.working_spouse, f.approved_msc, f.flexi_fund,
        f.received_signature, f.received_date,
        f.processed_signature, f.processed_date,
        f.reviewed_signature, f.reviewed_date
    FROM personal_data p
    LEFT JOIN dependents d ON p.id = d.personal_data_id
    LEFT JOIN work w ON p.id = w.personal_data_id
    LEFT JOIN certification c ON p.id = c.personal_data_id
    LEFT JOIN filled_sss f ON p.id = f.personal_data_id
    WHERE p.id = :id
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([':id' => $id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$data) {
        die('Record not found');
    }

    // Decode JSON
    $children      = json_decode($data['children'], true) ?? [];
    $children_dob  = json_decode($data['children_dob'], true) ?? [];
    $beneficiaries = json_decode($data['beneficiaries'], true) ?? [];
    $relationship  = json_decode($data['relationship'], true) ?? [];
    $benef_dob     = json_decode($data['benef_dob'], true) ?? [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SSS Form</title>
</head>
<body>


    
<form method="post" action="<?= $editMode ? 'update.php' : 'submit.php' ?>">

    <?php if ($editMode): ?>
        <input type="hidden" name="id" value="<?= $id ?>">
    <?php endif; ?>

    <?php
        $cs = $data['civil_status'] ?? '';
        $standard_cs = ['single', 'married', 'widowed', 'legally separated'];
        $isOther = !in_array(strtolower($cs), $standard_cs);
    ?>

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
            <div class="name">SS Number: <span class="required">*</span></div>
            <div class="input-div">
                <input type="text" name="sss_number" id="sss_number" placeholder="00-0000000-0" value="<?= htmlspecialchars($data['sss_number'] ?? '') ?>" required>
            </div>
        </div>
    </div>

<div class="margin-div">

        <div class="title-div">
            <h3>Part I - To Be Filled Out By The Registrant</h3>
        </div>

        <div class="title-div">
            <h3>A. Personal Data</h3>
        </div>

    <div class="personal-div">

        <div class="namedob-div">
            <div class="name-div">
                <div class="name">Name: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="text" class="fullname" name="name" placeholder="Lastname,       Firstname       Middlename       Suffix" value="<?= htmlspecialchars($data['name'] ?? '') ?>" required>
                </div>
            </div>

            <div class="dob-div">
                <div class="name">Date of Birth: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="date" name="name_dob" placeholder="Your answer" value="<?= $data['name_dob'] ?? '' ?>" required>
                </div>
            </div>
        </div>

        <div class="sexcstin-div">
            <div class="sex-div">
                <div class="name">Sex: <span class="required">*</span></div>
                <div class="sexinput-div">
                    <input type="radio" name="sex" value="male" required <?= ($data['sex'] ?? '') === 'male' ? 'checked' : '' ?>>Male
                    <input type="radio" name="sex" value="female" <?= ($data['sex'] ?? '') === 'female' ? 'checked' : '' ?>>Female
                </div>
            </div>
            <div class="cs-div">
                <div class="name">Civil Status: <span class="required">*</span></div>
                <div class="csinput-div">
                    <div class="radioinput-div">
                        <input type="radio" name="cs" value="single" required <?= ($data['civil_status'] ?? '') === 'single' ? 'checked' : '' ?>>Single
                        <input type="radio" name="cs" value="married" <?= ($data['civil_status'] ?? '') === 'married' ? 'checked' : '' ?>>Married
                        <input type="radio" name="cs" value="widowed" <?= ($data['civil_status'] ?? '') === 'widowed' ? 'checked' : '' ?>>Widowed
                        <input type="radio" name="cs" value="legally separated" <?= ($data['civil_status'] ?? '') === 'legally separated' ? 'checked' : '' ?>>Legally Separated
                        <input type="radio" name="cs" value="others" <?= $isOther ? 'checked' : '' ?>>Others
                    </div>
                    <div class="textinput-div">
                        <input type="text" id="otherText" name="cs_other" placeholder="Your Answer" value="<?= $isOther ? htmlspecialchars($cs) : '' ?>" <?= $isOther ? '' : 'disabled' ?>>
                    </div>
                </div>
            </div>
            <div class="tin-div">
                <div class="name">Tax Identification Number (If Any)</div>
                <div class="input-div">
                    <input type="text" name="tin" id="tin_number" placeholder="000-000-000" value="<?= htmlspecialchars($data['tin_number'] ?? '') ?>">
                </div>
            </div>
        </div>

        <div class="natrelpob-div">
            <div class="nationality-div">
                <div class="name">Nationality: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="text" name="nationality" placeholder="Your Answer" value="<?= htmlspecialchars($data['nationality'] ?? '') ?>" required>
                </div>
            </div>
            <div class="religion-div">
                <div class="name">Religion:</div>
                <div class="input-div">
                    <input type="text" name="religion" placeholder="Your Answer" value="<?= htmlspecialchars($data['nationality'] ?? '') ?>">
                </div>
            </div>
            <div class="pob-div">
                <div class="name">Place of Birth: <span class="required">*</span></div>
                <div class="pobcheck-div">
                    <div class="pobinput-div">
                        <input type="text" name="pob" id="pob" placeholder="(City/Municipality, Province)   (City, Country, if born outside the Philippines)" value="<?= htmlspecialchars($data['place_of_birth'] ?? '') ?>" required>
                    </div>
                    <div class="checkinput-div">
                        <input type="checkbox" id="sameAddress" name="same_address">The same with Home Address
                    </div>
                </div>
            </div>
        </div>

        <div class="addzip-div">
            <div class="address-div" id="addressDiv">
                <div class="name">Home Address: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="text" name="address" id="address" placeholder="(Rm./Flr./Unit No. & Bldg. Name) (House/Lot & Blk. No.) (Street Name) (Barangay/District) (City/Municipality) (Province) (Country)" value="<?= htmlspecialchars($data['home_address'] ?? '') ?>" required>
                </div>
            </div>
            <div class="zip-div">
                <div class="name">ZIP Code:</div>
                <div class="input-div">
                    <input type="text" id="zip" name="zip" placeholder="0000" value="<?= htmlspecialchars($data['zip_code'] ?? '') ?>">
                </div>
            </div>
        </div>

        <div class="contact-div">
            <div class="number-div">
                <div class="name">Mobile/Cellphone Number: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="text" id="mobile" name="mobile" placeholder="09XXXXXXXXX" value="<?= htmlspecialchars($data['mobile_number'] ?? '') ?>" required>
                </div>
            </div>
            <div class="email-div">
                <div class="name">Email Address: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" value="<?= htmlspecialchars($data['email_address'] ?? '') ?>" required>
                </div>
            </div>
            <div class="tel-div">
                <div class="name">Telephone Number:</div>
                <div class="input-div">
                    <input type="text" id="tel" name="tel" placeholder="032 255 1234" value="<?= htmlspecialchars($data['tel_number'] ?? '') ?>">
                </div>
            </div>
        </div>

        <div class="father-div">
            <div class="name">Father's Name:</div>
            <div class="input-div">
                <input type="text" class="fullname" name="father" placeholder="Lastname,       Firstname       Middlename       Suffix" value="<?= htmlspecialchars($data['fathers_name'] ?? '') ?>">
            </div>
        </div>

        <div class="mother-div">
            <div class="name">Mother's Maiden Name:</div>
            <div class="input-div">
                <input type="text" class="fullname" name="mother" placeholder="Lastname,       Firstname       Middlename       Suffix" value="<?= htmlspecialchars($data['mothers_name'] ?? '') ?>">
            </div>
        </div>

    </div>
    
        <div class="title-div">
            <h3>B. Dependent(s)/Beneficiary/ies</h3>
        </div>
    
    <div class="dependent-div">

        <div class="spouse-con">
            <div class="spouse-div">
                <div class="name">Spouse's Name:</div>
                <div class="input-div">
                    <input type="text" class="fullname" name="spouse" placeholder="Lastname,       Firstname       Middlename       Suffix" value="<?= htmlspecialchars($data['spouse'] ?? '') ?>">
                </div>
            </div>
            <div class="spousedob-div">
                <div class="name">Date of Birth:</div>
                <div class="input-div">
                    <input type="date" name="spouse_dob" placeholder="Your answer" value="<?= $data['spouse_dob'] ?? '' ?>">
                </div>
            </div>
        </div>

        <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="child-con">
            <div class="children-div">
                <div class="name">Child's Name:</div>
                <div class="input-div">
                    <input type="text" class="fullname" name="children[]" placeholder="Lastname,       Firstname       Middlename       Suffix" value="<?= htmlspecialchars($children[$i] ?? '') ?>">
                </div>
            </div>
            <div class="childdob-div">
                <div class="name">Date of Birth:</div>
                <div class="input-div">
                    <input type="date" name="children_dob[]" placeholder="Your answer" value="<?= $children_dob[$i] ?? '' ?>">
                </div>
            </div> 
        </div>
        <?php endfor; ?>
        
        <?php for ($i = 0; $i < 2; $i++): ?>
            <div class="beneficiaries-con">
                <div class="benif-div">
                    <div class="name">Other Beneficiaries (deceased):</div>
                    <div class="input-div">
                        <input type="text" class="fullname" name="beneficiaries[]" placeholder="Lastname,       Firstname       Middlename       Suffix" value="<?= htmlspecialchars($beneficiaries[$i] ?? '') ?>">
                    </div>
                </div>
                <div class="rel-div">
                    <div class="name">Relationship:</div>
                    <div class="input-div">
                        <input type="text" name="relationship[]" placeholder="Your Answer" value="<?= htmlspecialchars($relationship[$i] ?? '') ?>">
                    </div>
                </div>
                <div class="benefdob-div">
                    <div class="name">Date of Birth:</div>
                    <div class="input-div">
                        <input type="date" name="benef_dob[]" placeholder="Your answer" value="<?= $benef_dob[$i] ?? '' ?>">
                    </div>
                </div>
            </div>
        <?php endfor; ?>
        
    </div>

        <div class="title-div">
            <h3>C. For Self-Employed/Overseas Filipino Worker/Non Working Spouse</h3>
        </div>

    <div class="work-div">

        <div class="se-div">
            <div class="name">Self-Employed (SE)</div>
                <div class="sub-name">Profession/Business</div>
                <div class="input-div">
                    <input type="text" name="prof_bus" placeholder="Your Answer" value="<?= htmlspecialchars($data['profession_business'] ?? '') ?>">
                </div>
                <div class="sub-name">Year Prof./Business Started</div>
                <div class="input-div">
                    <input type="date" name="year_start" placeholder="Your Answer" value="<?= $data['date_started'] ?? '' ?>">
                </div>
                <div class="sub-name">Monthly Earnings</div>
                <div class="input-div">
                    <input type="text" class="money" name="self_earn" placeholder="P" value="<?= htmlspecialchars($data['self_earnings'] ?? '') ?>">
                </div>
        </div>

        <div class="ofw-div">
            <div class="name">Overseas Filipino Worker (OFW)</div>
                <div class="sub-name">Foreign Address</div>
                <div class="input-div">
                    <input type="text" name="for_add" placeholder="Your Answer" value="<?= htmlspecialchars($data['foreign_address'] ?? '') ?>">
                </div>
                <div class="sub-name">Monthly Earnings</div>
                <div class="input-div">
                    <input type="text" class="money" name="ofw_earnings" placeholder="P" value="<?= htmlspecialchars($data['ofw_earnings'] ?? '') ?>">
                </div>
                <div class="sub-name">Are you applying for membership in the Flexi-Fund Program?</div>
                <div class="memberinput-div">
                    <input type="radio" name="membership" value="yes" <?= ($data['membership'] ?? '') === 'yes' ? 'checked' : '' ?>>Yes
                    <input type="radio" name="membership" value="no" <?= ($data['membership'] ?? '') === 'no' ? 'checked' : '' ?>>No
                </div>
        </div>

        <div class="nws-div">
            <div class="name">Non-Working Spouse (NWS)</div>
                <div class="sub-name">SS No./Common Reference No. of Working Spouse</div>
                <div class="input-div">
                    <input type="text" id="crn_number" name="reference" placeholder="000000000000" value="<?= htmlspecialchars($data['reference'] ?? '') ?>">
                </div>
                <div class="sub-name">Monthly Income of Working Spouse</div>
                <div class="input-div">
                    <input type="text" class="money" name="spouse_income" placeholder="P" value="<?= htmlspecialchars($data['spouse_income'] ?? '') ?>">
                </div>
                <div class="sub-name">I agree with my spouse membership with SSS.</div>
                <div class="input-div">
                    <input type="text" name="agreement" placeholder="Signature over printed name" value="<?= htmlspecialchars($data['agreement'] ?? '') ?>">
                </div>
        </div>

    </div>

        <div class="title-div">
            <h3>D. Certification</h3>
        </div>

    <div class="certification-div">
        <div class="certify-div">
            <div class="sub-name">I certify that the information provided in this form are true and correct. <br> (If registrant cannot sign, affix fingerprints in the presence of an SSS personnel.)</div>
                <div class="sign-div">
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="text" name="printed_name" placeholder="Printed Name" value="<?= htmlspecialchars($data['printed_name'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="text" name="cert_signature" placeholder="Signature" value="<?= htmlspecialchars($data['cert_signature'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="date" name="cert_date" placeholder="Date" value="<?= $data['cert_date'] ?? '' ?>">
                        </div>
                    </div>
                </div>
        </div>
        <div class="finger-div">
            <div class="sub-name">Registrant is required to affix fingerprints</div>
            <div class="input-div">
                <input type="text" name="right_thumb" placeholder="Your right thumb" value="<?= htmlspecialchars($data['right_thumb'] ?? '') ?>">
                <input type="text" name="right_index" placeholder="Your right index" value="<?= htmlspecialchars($data['right_index'] ?? '') ?>">
            </div>
        </div>
    </div>
        
        <div class="title-div">
            <h3>Part II - To Be Filled Out By SSS</h3>
        </div>
        
    <div class="sssemployee-div">

        <div class="left-con">
            <div class="subleft-con">
                <div class="name">Business Code (For SE)</div>
                <div class="input-div">
                    <input type="text" name="business_code" placeholder="Your Answer" value="<?= htmlspecialchars($data['business_code'] ?? '') ?>">
                </div>
                <div class="name">Monthly Contribution (SE/OFW/NWS)</div>
                <div class="input-div">
                    <input type="text" class="money" name="monthly_contribution" placeholder="P" value="<?= htmlspecialchars($data['monthly_contribution'] ?? '') ?>">
                </div>
                <div class="name">Start of Payment (For SE/NWS)</div>
                <div class="input-div">
                    <input type="date" name="start_payment" placeholder="Your Answer" value="<?= $data['start_payment'] ?? '' ?>">
                </div>
            </div>
            <div class="subright-con">
                <div class="name">Working Spouse's MSC (For NWS)</div>
                <div class="input-div">
                    <input type="text" class="money" name="working_spouse" placeholder="P" value="<?= htmlspecialchars($data['working_spouse'] ?? '') ?>">
                </div>
                <div class="name">Approved MSC (For SE/OFW/NWS)</div>
                <div class="input-div">
                    <input type="text" class="money" name="approved_msc" placeholder="P" value="<?= htmlspecialchars($data['approved_msc'] ?? '') ?>">
                </div>
                <div class="name">Flexi-Fund Application (For OFW)</div>
                <div class="approvedinput-div">
                    <input type="radio" name="flexi_fund" value="approved" <?= ($data['flexi_fund'] ?? '') === 'approved' ? 'checked' : '' ?>>Approved
                    <input type="radio" name="flexi_fund" value="disapproved" <?= ($data['flexi_fund'] ?? '') === 'disappproved' ? 'checked' : '' ?>>Disapproved
                </div>
            </div>

        </div>

        <div class="right-con">
            <div class="subcenter-con">
                <div class="subleft-con">
                    <div class="name">Received by <br> (Representative Office/Partner Agent)</div>
                    <div class="sign-div">
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="text" name="received_signature" placeholder="Signature" value="<?= htmlspecialchars($data['received_signature'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="date" name="received_date" placeholder="Date & Time" value="<?= $data['received_date'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subright-con">
                    <div class="name">Received & Processed By <br> (MSS, Branch/Service Office)</div>
                    <div class="sign-div">
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="text" name="processed_signature" placeholder="Signature" value="<?= htmlspecialchars($data['processed_signature'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="date" name="processed_date" placeholder="Date & Time" value="<?= $data['processed_date'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="subbottom-con">
                <div class="name">Reviewed By <br> (MSS, Branch/Service Office)</div>
                <div class="sign-div">
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="text" name="reviewed_signature" placeholder="Signature" value="<?= htmlspecialchars($data['reviewed_signature'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="date" name="reviewed_date" placeholder="Date & Time" value="<?= $data['reviewed_date'] ?? '' ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="submit-div">
        <button type="submit">
            <?= $editMode ? 'Update' : 'Submit' ?>
        </button>
    </div>

</div>
</div>

</form>

<style>
body{background-color: rgb(218, 218, 218); width: 1180px; margin: 0 auto; font-family: Cambria; padding-top: 50px; padding-bottom: 50px;}
.bondpaper{width: 1180px; height: auto; background-color: white; padding-bottom: 20px;}
.margin-div{border: 3px solid black; margin-left: 20px; margin-right: 20px;}
.input-div input {width: 100%; font-size: 14px; box-sizing: border-box;}
.header-div{margin-left: 20px; margin-right: 20px; display: flex;}
.logo-div{width: 25%;}
.logo-div img{height: 80px; width: 80px; padding-top: 13px;}
.title-div{text-align: center; border: 1px solid #000000;}
.title-div h3{margin: 0;}
.top-div{width: 50%; text-align: center; margin-top: 5px; margin-bottom: 5px;}
.top-div h1{margin: 0; font-size: 25px;}
.sss-div{width: 25%; background-color: white; text-align: left; margin-top: 30px; margin-bottom: 30px; border: 3px solid black;}
.personal-div{border: 1px solid black;}
.namedob-div{display: flex; border: 1px solid black;}
.name-div{width: 75%; border-right: 2px solid black;}
.dob-div{width: 25%;}
.sexcstin-div{display: flex; border: 1px solid black;}
.sex-div{width: 17%; border-right: 2px solid black;}
.cs-div{width: 58%; border-right: 2px solid black;}
.csinput-div{display: flex; width: 100%;}
.radioinput-div{width: 72%;}
.textinput-div{width: 26%;}
.textinput-div input{width: 100%;}
.tin-div{width: 25%;}
.natrelpob-div{display: flex; border: 1px solid black;}
.nationality-div{width: 17%; border-right: 2px solid black;}
.religion-div{width: 17%; border-right: 2px solid black;}
.pob-div{width: 66%;}
.pobcheck-div{display: flex;}
.pobinput-div{width: 61%;}
.pobinput-div input{width: 100%;}
.checkinput-div{margin-left: 10px;}
.addzip-div{display: flex; border: 1px solid black;}
.address-div{width: 75%; border-right: 2px solid black;}
.zip-div{width: 25%;}
.contact-div{display: flex; border: 1px solid black;}
.number-div{width: 34%; border-right: 2px solid black;}
.email-div{width: 41%; border-right: 2px solid black;}
.tel-div{width: 25%;}
.father-div{border: 1px solid black;}
.mother-div{border: 1px solid black;}
.dependent-div{border: 1px solid black;}
.spouse-con{display: flex; border: 1px solid black;}
.spouse-div{width: 75%; border-right: 2px solid black;}
.spousedob-div{width: 25%;}
.child-con{display: flex; border: 1px solid black;}
.children-div{width: 75%; border-right: 2px solid black;}
.childdob-div{width: 25%;}
.beneficiaries-con{display: flex; border: 1px solid black;}
.benif-div{width: 55%; border-right: 2px solid black;}
.rel-div{width: 20%; border-right: 2px solid black;}
.benefdob-div{width: 25%;}
.work-div{border: 1px solid black; display: flex;}
.se-div{width: 20%; border-right: 2px solid black;}
.ofw-div{width: 45%; border-right: 2px solid black;}
.nws-div{width: 35%;}
.certification-div{border: 1px solid black; display: flex;}
.certify-div{width: 65%; border-right: 2px solid black;}
.finger-div{width: 35%;}
.sign-div{display: flex; width: 100%;}
.subsign-div{width: 50%;}
.sssemployee-div{border: 1px solid black; display: flex;}
.left-con{width: 50%; display: flex; border-right: 2px solid black;}
.right-con{width: 50%;}
.subcenter-con{display: flex;}
.subleft-con{width: 50%; border-right: 2px solid black; border-bottom: 2px solid black;}
.subright-con{width: 50%; border-bottom: 2px solid black;}
.subbottom-con{border-bottom: 3px solid #000000;}
.submit-div{border: 1px solid black; text-align: center; padding-top: 10px; padding-bottom: 10px; padding-right: 10px;}
.required{color: red; font-weight: bold; margin-left: 4px;}
.exit-div{width: 1180px; height: auto; background-color: blue; text-align: right;}
</style>

<script src="js/script.js"></script>

</body>
</html>