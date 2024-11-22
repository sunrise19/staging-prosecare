
<?php 
    $TITLE = "Patient Sign Up"; include('Commons/header.php');
    if(!isset($_REQUEST["WithAuth"])){
        header('Location: ./AccountType');
    }
?>
<style>
    
    .f-card {
        padding: 10px;
        border-radius: 9px;
        box-shadow: 0 4px 19px rgb(0 0 0 / 12%);
    }

    .little_text {
        background: #eee;
        padding: 5px 22px;
        margin-bottom: 10px;
        display: inline-block;
        border-radius: 10px;
    }

</style>

<div>
    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <?php include('Commons/sidebar.php');?>

            <div class="col-xl-6" style=" max-height: 100vh; overflow: auto; ">

                <!-- <img src="assets/images/top_right.svg" alt="" class="top_right">
                <img src="assets/images/bottom_right.svg" alt="" class="bottom_right"> -->

                <div class="auth-full-page-content p-md-5 p-4" style=" padding-bottom: 0 48px !important; ">
                    <div class="w-100">

                        <div class="d-flex flex-column h-100">
                            
                            <div class="my-auto col-xl-10 col-md-12 justify-content-center mx-auto full-form">
                                
                                <div class="align-center">
                                    <h1 class="text-primary text-center mb-1">Patient Sign Up</h1>
                                    <p class="text-center font-size-15 form_stage">Step 1 of 3 &bull; Personal details.</p>
                                </div>
    
                                <div class="mt-4 col-xl-11 col-md-12 justify-content-center mx-auto full-form">
                                    <form>
        
                                        <!-- START OF STAGE 1 -->
                                        <div id="stage1" class="sforms">

                                            <div class="stage_container">
                                                <div class="stage_back">&larr; Back</div>
                                            </div>

                                            <div class="form_stage_holder mt-3 mb-4">
                                                <span class="form_stage_circle active">1</span>
                                                <span class="form_stage_circle">2</span>
                                                <span class="form_stage_circle">3</span>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="i-g-block-label">First Name</label>
                                                <div class="input-group outlined">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-user font-size-17 button-icon"></i></button> -->
                                                    <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="fname" placeholder="Enter First Name">
                                                </div>
                                            </div>
                                           
                                            <div class="mb-3">
                                                <label class="i-g-block-label">Last Name</label>
                                                <div class="input-group outlined">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-user font-size-17 button-icon"></i></button> -->
                                                    <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="lname" placeholder="Enter Last Name">
                                                </div>
                                            </div>

                                            <div class="mb-3">

                                                <label class="i-g-block-label">Date of Birth</label>
                                            
                                                <!-- <div style="text-align: left">
                                                    <span class="little_text">Date of Birth</span>
                                                </div> -->
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-cake font-size-17 button-icon"></i></button> -->
                                                    <!-- <input type="number" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="day" placeholder="Day"> -->
                                                    <select class="form-select parent-outline" id="day">
                                                        <option disabled selected>Day</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                        <option value="6">6</option>
                                                        <option value="7">7</option>
                                                        <option value="8">8</option>
                                                        <option value="9">9</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                        <option value="20">20</option>
                                                        <option value="21">21</option>
                                                        <option value="22">22</option>
                                                        <option value="23">23</option>
                                                        <option value="24">24</option>
                                                        <option value="25">25</option>
                                                        <option value="26">26</option>
                                                        <option value="27">27</option>
                                                        <option value="28">28</option>
                                                        <option value="29">29</option>
                                                        <option value="30">30</option>
                                                        <option value="31">31</option>
                                                    </select>
                                                    <select style="flex: 2.3;" class="form-select parent-outline" id="month">
                                                        <option disabled selected>Month</option>
                                                        <option value="January">January</option>
                                                        <option value="February">February</option>
                                                        <option value="March">March</option>
                                                        <option value="April">April</option>
                                                        <option value="May">May</option>
                                                        <option value="June">June</option>
                                                        <option value="July">July</option>
                                                        <option value="August">August</option>
                                                        <option value="September">September</option>
                                                        <option value="October">October</option>
                                                        <option value="November">November</option>
                                                        <option value="December">December</option>
                                                    </select>
                                                    <select class="form-select parent-outline" id="year">
                                                        <option disabled selected>Year</option>
                                                        <option value="1930">1930</option>
                                                        <option value="1931">1931</option>
                                                        <option value="1932">1932</option>
                                                        <option value="1933">1933</option>
                                                        <option value="1934">1934</option>
                                                        <option value="1935">1935</option>
                                                        <option value="1936">1936</option>
                                                        <option value="1937">1937</option>
                                                        <option value="1938">1938</option>
                                                        <option value="1939">1939</option>
                                                        <option value="1940">1940</option>
                                                        <option value="1941">1941</option>
                                                        <option value="1942">1942</option>
                                                        <option value="1943">1943</option>
                                                        <option value="1944">1944</option>
                                                        <option value="1945">1945</option>
                                                        <option value="1946">1946</option>
                                                        <option value="1947">1947</option>
                                                        <option value="1948">1948</option>
                                                        <option value="1949">1949</option>
                                                        <option value="1950">1950</option>
                                                        <option value="1951">1951</option>
                                                        <option value="1952">1952</option>
                                                        <option value="1953">1953</option>
                                                        <option value="1954">1954</option>
                                                        <option value="1955">1955</option>
                                                        <option value="1956">1956</option>
                                                        <option value="1957">1957</option>
                                                        <option value="1958">1958</option>
                                                        <option value="1959">1959</option>
                                                        <option value="1960">1960</option>
                                                        <option value="1961">1961</option>
                                                        <option value="1962">1962</option>
                                                        <option value="1963">1963</option>
                                                        <option value="1964">1964</option>
                                                        <option value="1965">1965</option>
                                                        <option value="1966">1966</option>
                                                        <option value="1967">1967</option>
                                                        <option value="1968">1968</option>
                                                        <option value="1969">1969</option>
                                                        <option value="1970">1970</option>
                                                        <option value="1971">1971</option>
                                                        <option value="1972">1972</option>
                                                        <option value="1973">1973</option>
                                                        <option value="1974">1974</option>
                                                        <option value="1975">1975</option>
                                                        <option value="1976">1976</option>
                                                        <option value="1977">1977</option>
                                                        <option value="1978">1978</option>
                                                        <option value="1979">1979</option>
                                                        <option value="1980">1980</option>
                                                        <option value="1981">1981</option>
                                                        <option value="1982">1982</option>
                                                        <option value="1983">1983</option>
                                                        <option value="1984">1984</option>
                                                        <option value="1985">1985</option>
                                                        <option value="1986">1986</option>
                                                        <option value="1987">1987</option>
                                                        <option value="1988">1988</option>
                                                        <option value="1989">1989</option>
                                                        <option value="1990">1990</option>
                                                        <option value="1991">1991</option>
                                                        <option value="1992">1992</option>
                                                        <option value="1993">1993</option>
                                                        <option value="1994">1994</option>
                                                        <option value="1995">1995</option>
                                                        <option value="1996">1996</option>
                                                        <option value="1997">1997</option>
                                                        <option value="1998">1998</option>
                                                        <option value="1999">1999</option>
                                                        <option value="2000">2000</option>
                                                        <option value="2001">2001</option>
                                                        <option value="2002">2002</option>
                                                        <option value="2003">2003</option>
                                                        <option value="2004">2004</option>
                                                        <option value="2005">2005</option>
                                                        <option value="2006">2006</option>
                                                        <option value="2007">2007</option>
                                                        <option value="2008">2008</option>
                                                        <option value="2009">2009</option>
                                                        <option value="2010">2010</option>
                                                        <option value="2011">2011</option>
                                                        <option value="2012">2012</option>
                                                        <option value="2013">2013</option>
                                                        <option value="2014">2014</option>
                                                        <option value="2015">2015</option>
                                                        <option value="2016">2016</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2019">2019</option>
                                                        <option value="2020">2020</option>
                                                        <option value="2021">2021</option>
                                                    </select>
                                                    <!-- <input type="number" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="year" placeholder="Year"> -->
                                                </div>

                                            </div>


                                            <div class="mb-3">
                                                <label class="i-g-block-label">Age</label>
                                                <div class="input-group outlined">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-user font-size-17 button-icon"></i></button> -->
                                                    <input type="number" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="age" placeholder="Enter Age">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">Gender</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <select class="form-select parent-outline" id="gender">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">Level of Education</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <select class="form-select parent-outline" id="education">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Uneducated">Uneducated</option>
                                                        <option value="Primary">Primary</option>
                                                        <option value="Secondary">Secondary</option>
                                                        <option value="Tertiary">Tertiary</option>
                                                        <option value="other">Others</option>
                                                    </select>
                                                    <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="eeducation" placeholder="Enter Level of Education">
                                                </div>
                                            </div>

                                            <div class="mb-3 d-none">
                                                <label class="i-g-block-label">PIN (Personal Identifier Number)</label>
                                                <div class="input-group outlined">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-user font-size-17 button-icon"></i></button> -->
                                                    <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="pin" placeholder="Enter PIN">
                                                </div>
                                            </div>
                                    
                                        
                                        </div>
                                        <!-- END OF STAGE 1 -->


                                        <!-- START OF STAGE 2 -->
                                        <div id="stage2" class="sforms" style="display: none">

                                            <div class="stage_container">
                                                <div class="stage_back">&larr; Back</div>
                                            </div>


                                            <div class="form_stage_holder mt-3 mb-4">
                                                <span class="form_stage_circle">1</span>
                                                <span class="form_stage_circle active">2</span>
                                                <span class="form_stage_circle">3</span>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">Phone Number</label>
                                                <div class="input-group outlined">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-phone font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline col-3" style=" flex: 0.3; " id="code">
                                                        <!-- <option disabled selected>Ã°Å¸Å¡Â© &bull;&bull;&bull;</option> -->
                                                        <option value="+234">🇳🇬 +234</option>
                                                    </select>
                                                    <input type="number" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="phone" placeholder="80 1234 5678">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">Country</label>
                                                <div class="input-group outlined" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="country">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Nigeria">Nigeria</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">State of Residence</label>
                                                <div class="input-group outlined" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map-pin font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="state">
                                                        <option disabled selected>Select an option</option>
                                                        <option disabled>Select Country First</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">LGA (Local Government Area)</label>
                                                <div class="input-group outlined" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="lga">
                                                        <option disabled selected>Select an option</option>
                                                        <option disabled>Select State First</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="mb-3">
                                                <label class="i-g-block-label">Ethnicity</label>
                                                <div class="input-group outlined">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-map font-size-17 button-icon"></i></button> -->
                                                    <input type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="ethnicity" placeholder="Enter Ethnicity">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">Religion</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-home-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="religion">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Christianity">Christianity</option>
                                                        <option value="Islam">Islam</option>
                                                        <option value="Traditional">Traditional</option>
                                                        <option value="other">Others</option>
                                                    </select>
                                                    <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="ereligion" placeholder="Enter Religion">
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="i-g-block-label">Monthly Income Level</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-home-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="income">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="<200000">Less than ₦200,000</option>
                                                        <option value="<200000-500000">₦200,000 - ₦500,000</option>
                                                        <option value="<500000-1000000">₦500,000 - ₦1,000,000</option>
                                                        <option value=">1000000">Above ₦1,000,000</option>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- END OF STAGE 2 -->
                                        

                                        <!-- START OF STAGE 3 -->
                                        <div id="stage3" class="sforms" style="display: none">
                                            
                                            <div class="stage_container">
                                                <div class="stage_back">&larr; Back</div>
                                            </div>


                                            <div class="form_stage_holder mt-3 mb-4">
                                                <span class="form_stage_circle">1</span>
                                                <span class="form_stage_circle">2</span>
                                                <span class="form_stage_circle active">3</span>
                                            </div>

                                            
                                            <div class="mb-3">
                                                <label class="i-g-block-label">Cancer Type</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-home-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="cancer">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Breast">Breast</option>
                                                        <option value="Head and Neck">Head and Neck</option>
                                                        <option value="Male Pelvic">Male Pelvic</option>
                                                        <option value="Female Pelvic">Female Pelvic</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="i-g-block-label">Type of Device Used</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-home-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="device">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Smartphone">Smartphone</option>
                                                        <option value="Tablet">Tablet</option>
                                                        <option value="Computer">Computer</option>
                                                        <option value="other">Others</option>
                                                    </select>
                                                    <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="edevice" placeholder="Enter Type of Device">
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="i-g-block-label">Who Will Report Your Side Effects?</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-home-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="reporter">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Self">Self</option>
                                                        <option value="Caregiver">Caregiver</option>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="mb-3">
                                                <label class="i-g-block-label">Relationship With Caregiver</label>
                                                <div class="input-group outlined px-2" style="height: 62.59px;">
                                                    <!-- <button class="btn btn-transparent" type="button" disabled><i class="bx bx-home-alt font-size-17 button-icon"></i></button> -->
                                                    <select class="form-select parent-outline" id="relationship">
                                                        <option disabled selected>Select an option</option>
                                                        <option value="Self">Self</option>
                                                        <option value="Spouse">Spouse</option>
                                                        <option value="Child">Child</option>
                                                        <option value="Sibling">Sibling</option>
                                                        <option value="Parents">Parents</option>
                                                        <option value="other">Others</option>
                                                    </select>
                                                    <input style="flex: 3.3; display:none" type="text" autocomplete="off" class="form-control form-control-lg parent-outline font-size-14" id="erelationship" placeholder="Enter Relationship With Caregiver">
                                                </div>
                                            </div>

                                        
                                        </div>
                                        <!-- END OF STAGE 3 -->
                                    
                                        <div class="mt-5 d-grid">
                                            <button class="btn btn-primary btn-lg waves-effect waves-light" type="submit" id="patient_sign_up">Proceed to Step 2</button>
                                        </div>
        
                                    </form>

                                    <div class="mt-3 text-center login_link">
                                        <p class="font-size-15">Lost? <a href="./AccountType" class="fw-medium text-primary">Go Home</a> </p>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container-fluid -->
</div>

<?php include('Commons/footer.php');?>
<script>var AUTH = '<?php if(isset($_REQUEST["WithAuth"])){echo $_REQUEST["WithAuth"];}?>'</script>
<script src="assets/js/places.js"></script>
<script src="assets/js/patientsignup.js"></script>