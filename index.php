<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Sumbi's Online Form Conversion</title>
</head>
<body>
    
<form method="post" action="submit.php">

<div class="bondpaper">

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
            <div class="name">SS Number:</div>
            <div class="input-div">
                <input type="text" name="sss_number" id="sss_number" placeholder="00-0000000-0">
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
                    <input type="text" class="fullname" name="name" placeholder="Lastname,       Firstname       Middlename       Suffix" required>
                </div>
            </div>

            <div class="dob-div">
                <div class="name">Date of Birth: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="date" name="name_dob" placeholder="Your answer" required>
                </div>
            </div>
        </div>

        <div class="sexcstin-div">
            <div class="sex-div">
                <div class="name">Sex: <span class="required">*</span></div>
                <div class="sexinput-div">
                    <input type="radio" name="sex" value="male" required>Male
                    <input type="radio" name="sex" value="female">Female
                </div>
            </div>
            <div class="cs-div">
                <div class="name">Civil Status: <span class="required">*</span></div>
                <div class="csinput-div">
                    <div class="radioinput-div">
                        <input type="radio" name="cs" value="single" required>Single
                        <input type="radio" name="cs" value="married">Married
                        <input type="radio" name="cs" value="widowed">Widowed
                        <input type="radio" name="cs" value="legally separated">Legally Separated
                        <input type="radio" name="cs" value="others">Others
                    </div>
                    <div class="textinput-div">
                        <input type="text" id="otherText" name="cs_other" placeholder="Your Answer" disabled>
                    </div>
                </div>
            </div>
            <div class="tin-div">
                <div class="name">Tax Identification Number (If Any)</div>
                <div class="input-div">
                    <input type="text" name="tin" id="tin_number" placeholder="000-000-000">
                </div>
            </div>
        </div>

        <div class="natrelpob-div">
            <div class="nationality-div">
                <div class="name">Nationality: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="text" name="nationality" placeholder="Your Answer" required>
                </div>
            </div>
            <div class="religion-div">
                <div class="name">Religion:</div>
                <div class="input-div">
                    <input type="text" name="religion" placeholder="Your Answer">
                </div>
            </div>
            <div class="pob-div">
                <div class="name">Place of Birth: <span class="required">*</span></div>
                <div class="pobcheck-div">
                    <div class="pobinput-div">
                        <input type="text" name="pob" id="pob" placeholder="(City/Municipality, Province)   (City, Country, if born outside the Philippines)" required>
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
                    <input type="text" name="address" id="address" placeholder="(Rm./Flr./Unit No. & Bldg. Name) (House/Lot & Blk. No.) (Street Name) (Barangay/District) (City/Municipality) (Province) (Country)" required>
                </div>
            </div>
            <div class="zip-div">
                <div class="name">ZIP Code:</div>
                <div class="input-div">
                    <input type="text" id="zip" name="zip" placeholder="0000">
                </div>
            </div>
        </div>

        <div class="contact-div">
            <div class="number-div">
                <div class="name">Mobile/Cellphone Number: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="text" id="mobile" name="mobile" placeholder="09XXXXXXXXX" required>
                </div>
            </div>
            <div class="email-div">
                <div class="name">Email Address: <span class="required">*</span></div>
                <div class="input-div">
                    <input type="email" id="email" name="email" placeholder="example@gmail.com" required>
                </div>
            </div>
            <div class="tel-div">
                <div class="name">Telephone Number:</div>
                <div class="input-div">
                    <input type="text" id="tel" name="tel" placeholder="032 255 1234">
                </div>
            </div>
        </div>

        <div class="father-div">
            <div class="name">Father's Name:</div>
            <div class="input-div">
                <input type="text" class="fullname" name="father" placeholder="Lastname,       Firstname       Middlename       Suffix">
            </div>
        </div>

        <div class="mother-div">
            <div class="name">Mother's Maiden Name:</div>
            <div class="input-div">
                <input type="text" class="fullname" name="mother" placeholder="Lastname,       Firstname       Middlename       Suffix">
            </div>
        </div>

    </div>
    
        <div class="title-div">
            <h3>B. Dependent(s)/Beneficiary/ies</h3>
        </div>
    
    <div class="dependent-div">

        <div class="spouse-con">
            <div class="spouse-div">
                <div class="name">Spouse: (Last Name) (First Name) (Middle Name) (Suffix)</div>
                <div class="input-div">
                    <input type="text" class="fullname" name="spouse" placeholder="Your Answer">
                </div>
            </div>
            <div class="spousedob-div">
                <div class="name">Date of Birth:</div>
                <div class="input-div">
                    <input type="date" name="spouse_dob" placeholder="Your answer">
                </div>
            </div>
        </div>

        <div class="child-con">
            <div class="children-div">
                <div class="name">Child/ren: (Last Name) (First Name) (Middle Name) (Suffix)</div>
                <div class="input-div">
                    <input type="text" class="fullname" name="children[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="childdob-div">
                <div class="name">Date of Birth:</div>
                <div class="input-div">
                    <input type="date" name="children_dob[]" placeholder="Your answer">
                </div>
            </div> 
        </div>

        <div class="child-con">
            <div class="children-div">
                <div class="input-div">
                    <input type="text" class="fullname" name="children[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="childdob-div">
                <div class="input-div">
                    <input type="date" name="children_dob[]" placeholder="Your answer">
                </div>
            </div>
        </div>

        <div class="child-con">
            <div class="children-div">
                <div class="input-div">
                    <input type="text" class="fullname" name="children[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="childdob-div">
                <div class="input-div">
                    <input type="date" name="children_dob[]" placeholder="Your answer">
                </div>
            </div>
        </div>

        <div class="beneficiaries-con">
            <div class="benif-div">
                <div class="name">Other Beneficiaries (deceased): (Last Name) (First Name) (Middle Name) (Suffix)</div>
                <div class="input-div">
                    <input type="text" class="fullname" name="beneficiaries[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="rel-div">
                <div class="name">Relationship:</div>
                <div class="input-div">
                    <input type="text" name="relationship[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="benefdob-div">
                <div class="name">Date of Birth:</div>
                <div class="input-div">
                    <input type="date" name="benef_dob[]" placeholder="Your answer">
                </div>
            </div>
        </div>

        <div class="beneficiaries-con">
            <div class="benif-div">
                <div class="input-div">
                    <input type="text" class="fullname" name="beneficiaries[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="rel-div">
                <div class="input-div">
                    <input type="text" name="relationship[]" placeholder="Your Answer">
                </div>
            </div>
            <div class="benefdob-div">
                <div class="input-div">
                    <input type="date" name="benef_dob[]" placeholder="Your answer">
                </div>
            </div>
        </div>
        
    </div>

        <div class="title-div">
            <h3>C. For Self-Employed/Overseas Filipino Worker/Non Working Spouse</h3>
        </div>

    <div class="work-div">

        <div class="se-div">
            <div class="name">Self-Employed (SE)</div>
                <div class="sub-name">Profession/Business</div>
                <div class="input-div">
                    <input type="text" name="prof_bus" placeholder="Your Answer">
                </div>
                <div class="sub-name">Year Prof./Business Started</div>
                <div class="input-div">
                    <input type="date" name="year_start" placeholder="Your Answer">
                </div>
                <div class="sub-name">Monthly Earnings</div>
                <div class="input-div">
                    <input type="text" class="money" name="self_earn" placeholder="P">
                </div>
        </div>

        <div class="ofw-div">
            <div class="name">Overseas Filipino Worker (OFW)</div>
                <div class="sub-name">Foreign Address</div>
                <div class="input-div">
                    <input type="text" name="for_add" placeholder="Your Answer">
                </div>
                <div class="sub-name">Monthly Earnings</div>
                <div class="input-div">
                    <input type="text" class="money" name="ofw_earnings" placeholder="P">
                </div>
                <div class="sub-name">Are you applying for membership in the Flexi-Fund Program?</div>
                <div class="memberinput-div">
                    <input type="radio" name="membership" value="yes">Yes
                    <input type="radio" name="membership" value="no">No
                </div>
        </div>

        <div class="nws-div">
            <div class="name">Non-Working Spouse (NWS)</div>
                <div class="sub-name">SS No./Common Reference No. of Working Spouse</div>
                <div class="input-div">
                    <input type="text" id="crn_number" name="reference" placeholder="000000000000">
                </div>
                <div class="sub-name">Monthly Income of Working Spouse</div>
                <div class="input-div">
                    <input type="text" class="money" name="spouse_income" placeholder="P">
                </div>
                <div class="sub-name">I agree with my spouse membership with SSS.</div>
                <div class="input-div">
                    <input type="text" name="agreement" placeholder="Signature over printed name">
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
                            <input type="text" name="printed_name" placeholder="Printed Name">
                        </div>
                    </div>
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="text" name="cert_signature" placeholder="Signature">
                        </div>
                    </div>
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="date" name="cert_date" placeholder="Date">
                        </div>
                    </div>
                </div>
        </div>
        <div class="finger-div">
            <div class="sub-name">Registrant is required to affix fingerprints</div>
            <div class="input-div">
                <input type="text" name="right_thumb" placeholder="Your right thumb">
                <input type="text" name="right_index" placeholder="Your right index">
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
                    <input type="text" name="business_code" placeholder="Your Answer">
                </div>
                <div class="name">Monthly Contribution (SE/OFW/NWS)</div>
                <div class="input-div">
                    <input type="text" class="money" name="monthly_contribution" placeholder="P">
                </div>
                <div class="name">Start of Payment (For SE/NWS)</div>
                <div class="input-div">
                    <input type="date" name="start_payment" placeholder="Your Answer">
                </div>
            </div>
            <div class="subright-con">
                <div class="name">Working Spouse's MSC (For NWS)</div>
                <div class="input-div">
                    <input type="text" class="money" name="working_spouse" placeholder="P">
                </div>
                <div class="name">Approved MSC (For SE/OFW/NWS)</div>
                <div class="input-div">
                    <input type="text" class="money" name="approved_msc" placeholder="P">
                </div>
                <div class="name">Flexi-Fund Application (For OFW)</div>
                <div class="approvedinput-div">
                    <input type="radio" name="flexi_fund" value="approved">Approved
                    <input type="radio" name="flexi_fund" value="disapproved">Disapproved
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
                                <input type="text" name="received_signature" placeholder="Signature">
                            </div>
                        </div>
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="date" name="received_date" placeholder="Date & Time">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="subright-con">
                    <div class="name">Received & Processed By <br> (MSS, Branch/Service Office)</div>
                    <div class="sign-div">
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="text" name="processed_signature" placeholder="Signature">
                            </div>
                        </div>
                        <div class="subsign-div">
                            <div class="input-div">
                                <input type="date" name="processed_date" placeholder="Date & Time">
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
                            <input type="text" name="reviewed_signature" placeholder="Signature">
                        </div>
                    </div>
                    <div class="subsign-div">
                        <div class="input-div">
                            <input type="date" name="reviewed_date" placeholder="Date & Time">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="submit-div">
        <button type="submit">Submit</button>
    </div>

</div>
</div>

</form>

<script src="js/script.js"></script>

</body>
</html>