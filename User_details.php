<?php
  error_reporting(0);
  include("inc/user_header.php");
  include("inc/dbconnection.php");
  require_once ("inc/function.php");

  $user_name = $_SESSION['user_mahima_session_user_name'];
  $SELECTuser = mysql_query("SELECT * FROM mpc_employee_master WHERE username ='$user_name'");
  $fetch_user = mysql_fetch_array($SELECTuser);
  $userId = $fetch_user['rec_id'];
  $ticket = $fetch_user['ticket_no'];
  $p = "User_details.php";
?>
<style type="text/css" media="screen">
    @import "tab/css/style.css";
    @import "tab/css/simpletabs.css";
</style>
<body onLoad="test();
        test_bonus();
        gratuity();">
          <?php
            $username             =  "";
            $first_name           =  "";
            $last_name            =  "";
            $father_husband_name  =  "";
            $address              =  "";
            $correspondance       =  "";
            $country              =  "";
            $state                =  "";
            $other_state          =  "";
            $city                 =  "";
            $other_city           =  "";
            $dob                  =  "";
            $pob                  =  "";
            $gender               =  "male";
            $eye                  =  "";
            $illness              =  "";
            $height               =  "";
            $height_inch          =  "";
            $weight               =  "";
            $phone_no             =  "";
            $mobile_no            =  "";
            $emergancy_contact    =  "";
            $email_id             =  "";
            $email_official       =  "";
            $employee_picture     =  "";
            $marital_status       =  "no";
            $marriage_date        =  "";
            $blood_group          =  "";
            $cast                 =  "";
            $category             =  "";
            $religion             =  "";
            $nationality          =  "";
            $reference            =  "";
            $reference_contact    =  "";
            $hobby                =  "";
            $habit                =  "";
            $pincode              =  "";
            $emp_edit_id          =  "";
            $period               =  "";
		  
          if (isset($_GET['unset'])) {
              unset($_SESSION['emp_id']);
              unset($_SESSION['emp_family']);
              unset($_SESSION['emp_education']);
              unset($_SESSION['emp_offical']);
              unset($_SESSION['emp_salary']);
              unset($_SESSION['marital_sta']);
              unset($_SESSION['esic_applicable']);
              unset($_SESSION['emp_experience_pre']);
              unset($_SESSION['emp_assest']);
              $ticket_no = "";
          }
          if (isset($_SESSION['user_mahima_session_user_name'])) {

              $user_name = $_SESSION['user_mahima_session_user_name'];
              $SELECTuser = mysql_query("SELECT * FROM mpc_employee_master WHERE username ='$user_name'");
              $fetch_user = mysql_fetch_array($SELECTuser);
              $emp_edit_id= $fetch_user['rec_id'];
              //$emp_edit_id                =   $_GET['emp_id'];
              $_SESSION['emp_id']         =   $emp_edit_id;
              $_SESSION['emp_family']     =   $emp_edit_id;
              $_SESSION['emp_education']  =   $emp_edit_id;
              $_SESSION['emp_offical']    =   $emp_edit_id;
              $_SESSION['emp_salary']     =   $emp_edit_id;
              $_SESSION['emp_experience_pre']  =  $emp_edit_id;
              $_SESSION['emp_assest']     =   $emp_edit_id;
          }
          if (isset($_SESSION['emp_id'])) {
              $emp_edit_id  = $_SESSION['emp_id'];
              $sql          = "SELECT * FROM " . $mysql_table_prefix . "employee_master where rec_id = '$emp_edit_id'";
              $result       = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
          
          if (mysql_num_rows($result) > 0) {
              $row                      = mysql_fetch_assoc($result);
              $ticket_no                = $row['ticket_no'];
              $empType                  = $row['empType'];
              $emp_rec_id               = $row['emp_id'];
              $username                 = $row['username'];
              $first_name               = $row['first_name'];
              $last_name                = $row['last_name'];
              $father_husband_name      = $row['father_husband_name'];
              $address                  = $row['address'];
              $correspondance           = $row['correspondance'];
              $country                  = $row['country'];
              $state                    = $row['state'];
              $other_state              = $row['other_state'];
              $city                     = $row['city'];
              $other_city               = $row['other_city'];
              $dob                      = $row['dob'];
              $pob                      = $row['pob'];
              $gender                   = $row['gender'];
              $eye                      = $row['eye'];
              $illness                  = $row['illness'];
              $height                   = $row['height'];
              $height_inch              = $row['height_inch'];
              $weight                   = $row['weight'];
              $phone_no                 = $row['phone_no'];
              $mobile_no                = $row['mobile_no'];
              $emergancy_contact        = $row['emergancy_contact'];
              $email_id                 = $row['email_id'];
              $email_official           = $row['email_official'];
              $employee_picture         = $row['employee_picture'];
              $marriage_date            = $row['marriage_date'];
              $blood_group              = $row['blood_group'];
              $cast                     = $row['cast'];
              $category                 = $row['category'];
              $religion                 = $row['religion'];
              $nationality              = $row['nationality'];
              $reference                = $row['reference'];
              $reference_contact        = $row['reference_contact'];
              $hobby                    = $row['hobby'];
              $habit                    = $row['habit'];
              $marital_status           = $row['marital_status'];
              $_SESSION['marital_sta']  = $marital_status;
              $pincode                  = $row['pincode'];
              $pan_no                   = $row['pan_no'];
              $period                   = $row['emp_period'];
              }
          }
          $father_name          = "";
          $father_dob           = "";
          $Dependant_father     = "Yes";
          $mother_name          = "";
          $mother_dob           = "";
          $Dependant_mother     = "Yes";
          $wife_name            = "";
          $wife_dob             = "";
          $Dependant_wife       = "Yes";
          $emp_family_edit      = "";
          if (isset($_SESSION['emp_family'])) {
              $emp_family_edit1 = $_SESSION['emp_family'];
              $sql              = "SELECT * FROM " . $mysql_table_prefix . "family_master where emp_id = '$emp_family_edit1' ORDER BY rec_id ASC";
              $result           = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $emp_family_edit = $_SESSION['emp_family'];
                  while ($row = mysql_fetch_array($result)) {

                      if (!empty($row['father_name'])) {
                          $father_name      = $row['father_name'];
                          $father_dob       = $row['father_dob'];
                          $Dependant_father = $row['Dependant_father'];
                      }
                      if (!empty($row['mother_name'])) {
                          $mother_name      = $row['mother_name'];
                          $mother_dob       = $row['mother_dob'];
                          $Dependant_mother = $row['Dependant_mother'];
                      }
                      if (!empty($row['wife_name'])) {
                          $wife_name        = $row['wife_name'];
                          $wife_dob         = $row['wife_dob'];
                          $Dependant_wife   = $row['Dependant_wife'];
                      }
                      if (!empty($row['child_name'])) {
                          $child_name       = $row['child_name'];
                          $child_gender     = $row['child_gender'];
                          $child_dependent  = $row['child_dependent'];
                          $child_dob        = $row['child_dob'];
                      }
                      $child_name       = explode(",", $child_name);
                      $child_gender     = explode(",", $child_gender);
                      $child_dependent  = explode(",", $child_dependent);
                      $child_dob        = explode(",", $child_dob);
                  }
              }
          }
          $qualification  = "";
          $university     = "";
          $duration       = "";
          $percentage     = "";
          $emp_education_edit = "";
		  //$hscsubject_explode =array();	
          if (isset($_SESSION['emp_education'])) {
              $emp_education_edit1 = $_SESSION['emp_education'];
              $sql    = "SELECT * FROM " . $mysql_table_prefix . "education_master where emp_id = '$emp_education_edit1'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $emp_education_edit = $_SESSION['emp_education'];
                  $row                = mysql_fetch_array($result);
                  $qualification      = $row['qualification'];
                  $university         = $row['university'];
                  $duration           = $row['duration'];
                  $percentage         = $row['percentage'];
                  $hscyear            = $row['hscyear'];
                  $hscboard           = $row['hscboard'];
                  $hscsubject         = $row['hscsubject'];
				          $hscsubject_explode = explode(',',$hscsubject);
				          $hscpercentage      = $row['hscpercentage'];
                  $diplomaqualification = $row['diplomaqualification'];
                  $diplomayear        = $row['diplomayear'];
                  $diplomauniversity  = $row['diplomauniversity'];
                  $diplomaduration    = $row['diplomaduration'];
                  $diplomapercentage  = $row['diplomapercentage'];
                  $diploma_specialization   = $row['diploma_specialization'];
                  $graduationqualification  = $row['graduationqualification'];
                  $graduationpassingyear    = $row['graduationpassingyear'];
                  $graduationuniversity     = $row['graduationuniversity'];
                  $grdurationDuration       = $row['grdurationDuration'];
                  $graduationpercentage     = $row['graduationpercentage'];
                  $graduation_specialization = $row['graduation_specialization'];
                  $mastergraduationqualification  = $row['mastergraduationqualification'];
                  $mastergraduationpassingyear    = $row['mastergraduationpassingyear'];
                  $mastergraduationuniversity     = $row['mastergraduationuniversity'];
                  $mastergraduationduration       = $row['mastergraduationduration'];
                  $mastergraduationpercentage     = $row['mastergraduationpercentage'];
                  $master_specialization          = $row['master_specialization'];
                  $other_qualification            = $row['other_qualification'];
                  $other_qualification_year       = $row['other_qualification_year'];
                  $ncvt_scvt                      = $row['ncvt_scvt'];
                  $other_university               = $row['other_university'];
                  $other_course_duration          = $row['other_course_duration'];
                  $other_course_percentage        = $row['other_course_percentage'];
                  $other_specialization           = $row['other_specialization'];
              }
          }
          if (isset($_SESSION['emp_experience_pre'])) {
              $emp_experience_edit1 = $_SESSION['emp_experience_pre'];
              $sql                  = "SELECT * FROM " . $mysql_table_prefix . "experience_master where emp_id=$emp_experience_edit1";
              $result               = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $emp_experience_edit  = $_SESSION['emp_experience_pre'];
                  $row                  = mysql_fetch_array($result);
                  $pre_employer_name    = $row['employer_name'];
                  $pre_employer_designation = $row['employer_designation'];
                  $Industry                 = $row['Industry'];
                  $experience_from          = $row['experince_from'];
                  $experience_to            = $row['experince_to'];
                  $relevent                 = $row['relevent'];
                  $salary                   = $row['salary'];
                  $file                     = $row['file'];
              }
			   }
          $date_joining = "";
          $plant        = "";
          $grade        = "";
          $employee_typ = "";
          $emp_category = "";
          $skill_level  = "";
          $reporting_authority_name = "";
          $emp_offical_edit = "";
          $dept_id          = "";
          $dep              = "";
          $designation_id   = "";
          $designation      = "";
          if (isset($_SESSION['emp_offical'])) {
              $emp_offical_edit1  = $_SESSION['emp_offical'];
              $sql                = "SELECT * FROM " . $mysql_table_prefix . "official_detail where emp_id = '$emp_offical_edit1'";
              $result             = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $emp_offical_edit = $_SESSION['emp_offical'];
                  $row              = mysql_fetch_array($result);
                  $date_joining     = $row['date_joining'];
                  $department       = $row['department'];
                  $designation      = $row['designation'];
                  $plant            = $row['plant'];
                  $grade            = $row['grade'];
                  $employee_typ     = $row['employee_typ'];
                  $skill_level      = $row['skill_level'];
                  $reporting_authority_name = $row['reporting_authority_name'];
              }
              // get pf details
              $sql = "SELECT * FROM  mpc_account_detail where emp_id  = '$emp_offical_edit1'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                while ($row   = mysql_fetch_array($result)) {
                  $pf_number  = $row['pf_number'];
                  $pf_nominee = $row['pf_nominee'];
                  $pf_rate    = $row['pf_rate'];
                  $date_pf    = $row['date_pf'];
                  $pf_relationship  = $row['pf_relationship'];
                  $bonus_rate       = $row['bonus_rate'];
                  $esic_applicable  = $row['esic_applicable'];
                  $_SESSION['esic_applicable'] = $esic_applicable;
                  $esic_rate          = $row['esic_rate'];
                  $esic_rate_employer = $row['esic_rate_employer'];
                  $esic_number        = $row['esic_number'];
                  $esic_nominee       = $row['esic_nominee'];
                  $esic_relationship  = $row['esic_relationship'];
                  $account_no         = $row['account_no'];
                  $bank_name          = $row['bank_name'];
                  $payment_mode       = $row['payment_mode'];
                  $pf_deduction       = $row['pf_deduction'];
                }
              }
              $sql    = "SELECT * FROM " . $mysql_table_prefix . "department_employee where emp_id = '$emp_offical_edit1' and to_date='00-00-0000'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $row      = mysql_fetch_array($result);
                  $dept_id  = $row['dept_id'];
                  $dep      = getdeptDetail('reference_id', 'rec_id', $dept_id);
              }
              
              $sql    = "SELECT * FROM " . $mysql_table_prefix . "designation_employee where emp_id = '$emp_offical_edit1' and to_date='00-00-0000'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $row            = mysql_fetch_array($result);
                  $designation_id = $row['designation_id'];
                  $emp_category   = getdesignationMaster('emp_category', 'rec_id', $designation_id);
              }
              
              $sql    = "SELECT * FROM  mpc_shift_detail where emp_id = '$emp_offical_edit1' and to_date='0000-00-00'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  while ($row = mysql_fetch_array($result)) {
                      $shift  = $row['shift'];
                  }
              }
              
              $sql    = "SELECT * FROM  mpc_weekly_off_employee where emp_id = '$emp_offical_edit1' and to_date='0000-00-00'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  while ($row = mysql_fetch_array($result)) {
                      $off_day = $row['off_day'];
                  }
              }
              
              $sql    = "SELECT * FROM  mpc_rotation_type_employee where emp_id = '$emp_offical_edit1' and to_date='0000-00-00'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  while ($row = mysql_fetch_array($result)) {
                      $rotation_type = $row['rotation_type'];
                  }
              }
              
              $sql    = "SELECT * FROM " . $mysql_table_prefix . "advance_employee where emp_id = '$emp_offical_edit1' ";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $row      = mysql_fetch_array($result);
                  $advance  = $row['advance'];
              }
              
              $sql    = "SELECT * FROM " . $mysql_table_prefix . "loan_employee where emp_id = '$emp_offical_edit1' ";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $row  = mysql_fetch_array($result);
                  $loan = $row['loan_amount'];
              }
          }
          if (isset($_POST['emp_offical'])) {
              $test         = $_POST['test'];
              $date_joining = $_POST['date_joining'];
              $date_joining = getdbdate($date_joining);
              $date_joining = str_replace("/", "-", $date_joining);
              $plant_name   = $_POST['plant_name'];
              $department   = $_POST['department'];
              $sub_department = $_POST['sub_department'];
              $grade          = $_POST['grade'];
              $authority_name = $_POST['authority_name'];
              $emp_type       = $_POST['emp_type'];
              $emp_category   = $_POST['emp_category'];
              $designation    = $_POST['designation'];
              $pf_no          = $_POST['pf_no'];
              $pf_rate        = $_POST['pf_rate'];
              $date_pf        = $_POST['date_pf'];
              $pf_nominee     = $_POST['pf_nominee'];
              $pf_relationship = $_POST['pf_relationship'];
              $pf_deduction    = $_POST['pf_deduction'];
              $bonus_rate      = $_POST['bonus_rate'];
              $esic_applicable = $_POST['esic_applicable'];
              $_SESSION['esic_applicable'] = $esic_applicable;
              $esic_no            = $_POST['esic_no'];
              $esic_rate          = $_POST['esic_rate'];
              $esic_rate_employer = $_POST['esic_rate_employer'];
              $esic_nominee       = $_POST['esic_nominee'];
              $esic_relationship  = $_POST['esic_relationship'];
              $ip                 =    $_SERVER['REMOTE_ADDR'];
              $rotation_type      = $_POST['rotation_type'];
              $shift              = $_POST['shift_duration'];
              $off_days           = $_POST['off_days'];
              $payment_mode       = $_POST['payment_mode'];
              $bank_name          = $_POST['bank_name'];
              $account_no         = $_POST['account_no'];
              $ip                 = $_SERVER['REMOTE_ADDR'];
              //ALL OFFICIAL INSERT  QUERY//				
              if ($emp_offical_edit == "") {
                //Remove     	pan_no  = '$pan_no', from the following query.
                $sql_insert_offical     = "insert into " . $mysql_table_prefix . "official_detail  set emp_id = '$test',date_joining = '$date_joining',plant= '$plant_name',department= '$sub_department',grade = '$grade',reporting_authority_name = '$authority_name',designation = '$designation',employee_typ = '$emp_type',emp_category = '$emp_category',InsertBy = '$grade',InsertDate = now(),IpAddress = '$ip'";
                $result_insert_offical  = mysql_query($sql_insert_offical) or die("Error in query:" . $sql_insert_offical . "<br>" . mysql_error() . "<br>" . mysql_errno());
              // PF DETAILS
                  $sql_check = "insert into " . $mysql_table_prefix . "account_detail set emp_id ='$test',pf_number ='$pf_no',
                      				  pf_nominee ='$pf_nominee',pf_rate ='$pf_rate',date_pf='$date_pf',pf_relationship ='$pf_relationship',
                                pf_deduction = '$pf_deduction',bonus_rate='$bonus_rate',esic_applicable='$esic_applicable',
                                esic_number ='$esic_no',esic_nominee ='$esic_nominee',esic_rate ='$esic_rate',esic_rate_employer ='$esic_rate_employer',esic_relationship ='$esic_relationship',
		           	                InsertBy ='$pf_no',InsertDate =now(),IpAddress ='$ip',payment_mode ='$payment_mode',
				                        bank_name ='$bank_name',account_no='$account_no'";
                  $result_check = mysql_query($sql_check) or die("Query Failed " . mysql_error());
// SHIFT DETAILS  INSERT QUERY//
                  $sql_check    = "insert into  " . $mysql_table_prefix . "shift_detail set emp_id  ='$test',rotation_type ='$rotation_type',shift='$shift_duration',InsertBy ='$emp_id',InsertDate =now(),IpAddress ='$ip',off_day = '$off_days'";
                  $result_check = mysql_query($sql_check) or die("Query Failed " . mysql_error());
//my code here //
                  $sql_check    = "insert into " . $mysql_table_prefix . "plant_employee set emp_id='$test',plant_id='$plant_name',from_date='0000-00-00',to_date='0000-00-00'";
                  $result_check = mysql_query($sql_check) or die("Query Failed" . mysql_error());
///End here   //
                  $sql_insert_emp_update  = "update " . $mysql_table_prefix . "employee_master  set date_joining = '$date_joining',department = '$department',sub_department = '$sub_department',designation = '$designation' where emp_id = '$test'";
                  $result_insert_empa     = mysql_query($sql_insert_emp_update) or die("Error in query:" . $sql_insert_emp_update . "<br>" . mysql_error() . "<br>" . mysql_errno());
                  $sql_insert_dept        = "insert into " . $mysql_table_prefix . "department_employee  set 
																						emp_id = '$test',
																						dept_id = '$sub_department',
																						from_date = now()";
                  mysql_query($sql_insert_dept) or die("Error in query:" . $sql_insert_dept . "<br>" . mysql_error() . "<br>" . mysql_errno());
                  $sql_insert_desi = "insert into " . $mysql_table_prefix . "designation_employee  set 
																			emp_id = '$test',
																			designation_id = '$designation',
																		  from_date = now()";
                  mysql_query($sql_insert_desi) or die("Error in query:" . $sql_insert_desi . "<br>" . mysql_error() . "<br>" . mysql_errno());
              } else {
                  //Remove the pan no. from the following....pan_no  = '$pan_no',
                  $sql_insert_offical = "update " . $mysql_table_prefix . "official_detail  set 
									                      date_joining = '$date_joining',
									                      plant= '$plant_name',
									                      department= '$department',
									                      grade = '$grade',
                      									reporting_authority_name = '$authority_name',
                      									designation = '$designation',
                      									employee_typ = '$emp_type',
                      									emp_category = '$emp_category',
                      									InsertBy = '$grade',
                      									InsertDate = now(),
                      									IpAddress = '$ip' where emp_id = '$test'";
                  $result_insert_offical = mysql_query($sql_insert_offical) or die("Error in query:" . $sql_insert_offical . "<br>" . mysql_error() . "<br>" . mysql_errno());
                  // 
                  $sql_check = "update " . $mysql_table_prefix . "account_detail set	
                              	emp_id ='$test',pf_number ='$pf_no',pf_nominee ='$pf_nominee',
                              	pf_rate ='$pf_rate',date_pf='$date_pf',pf_relationship ='$pf_relationship',
                              	pf_deduction = '$pf_deduction',	bonus_rate='$bonus_rate',esic_applicable='$esic_applicable',
                                esic_number ='$esic_no',esic_nominee ='$esic_nominee',esic_rate ='$esic_rate',
                                esic_rate_employer='$esic_rate_employer',esic_relationship ='$esic_relationship',
                              	InsertBy ='$pf_no',
																InsertDate =now(),
																IpAddress ='$ip',
																payment_mode ='$payment_mode',
																bank_name ='$bank_name',
																account_no='$account_no'
																where emp_id = '$test'";
                  $result_check           = mysql_query($sql_check) or die("Query Failed " . mysql_error());
                  $sql_insert_emp_update  = "update " . $mysql_table_prefix . "employee_master  set date_joining = '$date_joining',department = '$department',sub_department = '$sub_department',designation = '$designation' where emp_id = '$test'";
                  $result_insert_empa     = mysql_query($sql_insert_emp_update) or die("Error in query:" . $sql_insert_emp_update . "<br>" . mysql_error() . "<br>" . mysql_errno());
                  
                  $sql_check1             = "update " . $mysql_table_prefix . "department_employee set	
	   															           to_date  =now()
																	         where emp_id='$emp_education_edit' and to_date ='0000-00-00'";
                  $result_check1  = mysql_query($sql_check1) or die("Query Failed " . mysql_error());
                 
                  $sql_check      = "update " . $mysql_table_prefix . "plant_employee set
																	  plant_id='$plant_name',
																  	from_date='0000-00-00',
																	  to_date='0000-00-00'
																	  where emp_id = '$test'";
                  $result_check   = mysql_query($sql_check) or die("Query Failed" . mysql_error());
//End here
                  $sql_check      = "update " . $mysql_table_prefix . "department_employee set	
																					dept_id ='$sub_department',
																					from_date =now(),
																					to_date ='0000-00-00' where
																					emp_id  ='$emp_education_edit'";

                  $result_check1  = mysql_query($sql_check) or die("Query Failed " . mysql_error());


                  $sql_check1     = "update " . $mysql_table_prefix . "designation_employee set	
																				to_date  =now(),
																				designation_id ='$designation',
																				from_date =now(),
																				to_date ='0000-00-00'
																				where emp_id='$emp_education_edit'";

                  $result_check1  = mysql_query($sql_check1) or die("Query Failed " . mysql_error());


                  $sql_check1     = "update " . $mysql_table_prefix . "shift_detail set to_date  =now() where emp_id='$test' and to_date ='0000-00-00'";

                  $result_check1  = mysql_query($sql_check1) or die("Query Failed " . mysql_error());

                  $sql_check1     = "update " . $mysql_table_prefix . "rotation_type_employee set	
																    to_date  =now()
																    where emp_id='$emp_id' and to_date ='0000-00-00'";

                  $result_check1  = mysql_query($sql_check1) or die("Query Failed " . mysql_error());

                  $sql_check1     = "update " . $mysql_table_prefix . "weekly_off_employee set	
																    to_date  =now()
																    where emp_id='$emp_id' and to_date ='0000-00-00'";

                  $result_check1  = mysql_query($sql_check1) or die("Query Failed " . mysql_error());



                  // shift details
                  $sql_check      = "insert into  " . $mysql_table_prefix . "shift_detail set	
																    emp_id  ='$emp_id',
																    shift ='$shift',
																    from_date =now(),
																    to_date ='0000-00-00'";

                  $result_check   = mysql_query($sql_check) or die("Query Failed " . mysql_error());

                  // rotation type
                  $sql_check      = "insert into  " . $mysql_table_prefix . "rotation_type_employee set	
																    emp_id  ='$emp_id',
																    rotation_type ='$rotation_type',
																    from_date =now(),
																    to_date ='0000-00-00'";

                  $result_check   = mysql_query($sql_check) or die("Query Failed " . mysql_error());

                  //  weekly off
                  $sql_check      = "insert into  " . $mysql_table_prefix . "weekly_off_employee set	
																    emp_id  ='$emp_id',
																    off_day ='$weekly_off',
																    from_date =now(),
																    to_date ='0000-00-00'";

                  $result_check   = mysql_query($sql_check) or die("Query Failed " . mysql_error());
              }

              $_SESSION['emp_offical'] = $_SESSION['emp_id'];

              $mode                     = 'offical_profile';
          }

          if (isset($_SESSION['emp_salary'])) {



              $sql    = "SELECT * FROM " . $mysql_table_prefix . "salary_master where emp_id = '$emp_rec_id'";
              $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());
              if (mysql_num_rows($result) > 0) {
                  $emp_salary_edit        = $_SESSION['emp_salary'];
                  $row                    = mysql_fetch_array($result);
                  $leave_travel_allow     = $row['leave_travel_allow'];
                  $side_allowance         = $row['side_allowance'];
                  $hra                    = $row['hra'];
                  $basic                  = $row['basic'];
                  $convence               = $row['convence'];
                  $other_allowance        = $row['other_allowance'];
                  $other_deductions       = $row['other_deductions'];
                  $site_allowance         = $row['site_allowance'];
                  $tds                    = $row['tds'];
                  $medical                = $row['medical'];
                  $professional_tax       = $row['professional_tax'];
                  $celling                = $row['celling'];
                  $bonus                  = $row['bonus'];
                  $gratuity               = $row['gratuity'];
                  $total_deduction        = $row['total_deduction'];
                  $take_home              = $row['take_home'];
                  $total_salary           = $row['total_salary'];
                  $phone_allowance        = $row['phone'];
              }
          }

          if (isset($_SESSION['emp_assest'])) {
              $emp_assest_edit1 = $_SESSION['emp_assest'];
              $que              = mysql_query("SELECT * FROM `assets_detail` where emp_id='$emp_assest_edit1'");
              while ($row = mysql_fetch_array($que)) {
                  $emp_assest_edit  = $_SESSION['emp_assest'];
                  $vehicle          = $row['Vehicle'];
                  $registration_no  = $row['Registration'];
                  $model_no         = $row['Model'];
                  $vehicle_no       = $row['Vehicle_no'];
                  $laptop_detail    = $row['laptop'];
                  $all_details      = $row['tv'];
                  $assists_all      = $row['assist_all'];
                  $other            = $row['other'];
              }
          }

          $msg    =  '';
          $mode   =  '';

          $ip = $_SERVER['REMOTE_ADDR'];
          if (isset($_POST['Submit_emp'])) {
              if ($_POST['no_refresh'] == $_SESSION['no_refresh']) {
                  //echo "WARNING: Do not try to refresh the page.";
              } else {
                  ////////////////////login deatil
                  // random emp id genrate
                  $year = date("Y");
                  $sql  = "SELECT ticket_no FROM " . $mysql_table_prefix . "employee_master ORDER BY rec_id DESC LIMIT 1";
                  $result = mysql_query($sql) or die("Error in : " . $sql . "<br>" . mysql_errno() . " : " . mysql_error());

                  $row    = mysql_fetch_row($result);

                  if ($row == "") {
                      $emp_login = '101';
                  } else {
                      $emp_login = substr($row[0], 4);
                      $emp_login++;
                  }
                  $emp_login  = $year . $emp_login;
                  $empType    = $_POST['empType'] == 2 ? 'worker' : 'Staff';
                  $empType    = $_POST["emp_type"];
                  $first_name = $_POST['first_name'];
                  $last_name  = $_POST['last_name'];
                  $father_husband_name  = $_POST['father_husband_name'];
                  $address              = $_POST['address'];
                  $correspondance       = $_POST['correspondance'];
                  $country              = $_POST['country'];
                  $state                = isset($_POST['state']) ? $_POST['state'] : 0;
                  $other_state          = isset($_POST['txt_other_state']) ? $_POST['txt_other_state'] : "";
                  $other_city           = isset($_POST['other_city']) ? $_POST['other_city'] : "";
                  $city                 = isset($_POST['city_select']) ? $_POST['city_select'] : 0;
                  $dob                  = getdbDate($_POST['dob']);
                  $pob                  = $_POST['pob'];
                  $pin_code             = $_POST['pin_code'];
                  $gender               = $_POST['gender'];
                  $eye                  = $_POST['eye'];
                  $illness              = $_POST['illness'];
                  $height               = $_POST['height'];
                  $height_inch          = $_POST['height_inch'];
                  $weight               = $_POST['weight'];
                  $phone_no             = $_POST['phone_no'];
                  $mobile_no            = $_POST['mobile_no'];
                  $emergancy_contact    = $_POST['emergancy_contact'];
                  $email_id             = $_POST['email_id'];
                  $email_official       = $_POST['email_official'];
                  $marital              = $_POST['marital'];
                  $_SESSION['marital_sta']  = $marital;
                  $marr_date                = getdbDate(isset($_POST['marr_date']) ? $_POST['marr_date'] : "");
                  $blood_group              = $_POST['blood_group'];
                  $cast                     = $_POST['cast'];
                  $category                 = $_POST['category'];
                  $nationality              = $_POST['nationality'];
                  $reference                = $_POST['reference'];
                  $reference_contact        = $_POST['reference_contact'];
                  $hobby                    = $_POST['hobby'];
                  $habit                    = $_POST['habit'];
                  $religion                 = $_POST['religion'];
                  $username                 = "$first_name" . rand();
                  $password                 = rand();
                  $pan_no                   = $_POST['pan_no'];
                  $period                   = $_POST['period'];
                  if ($emp_edit_id == "") {
                      $sql_insert_personal  = "insert into " . $mysql_table_prefix . "employee_master set emp_id = '$emp_login',
			                                        ticket_no='$emp_login',father_husband_name ='$father_husband_name',address = '$address',correspondance='$correspondance',
			                                        country = '$country',state = '$state',other_state = '$other_state',city = '$city',other_city = '$other_city',pincode = '$pin_code',
			                                        dob = '$dob',pob ='$pob',gender = '$gender',eye ='$eye',illness = '$illness',height ='$height',height_inch='$height_inch',
			                                        weight = '$weight',phone_no = '$phone_no',mobile_no ='$mobile_no',emergancy_contact = '$emergancy_contact',email_id = '$email_id',
                                              email_official='$email_official',religion='$religion',marital_status = '$marital',marriage_date = '$marr_date',blood_group = '$blood_group',
                                              cast ='$cast',category ='$category',nationality = '$nationality',reference = '$reference',pan_no='$pan_no',emp_period='$period',
                                              reference_contact='$reference_contact',hobby='$hobby',habit='$habit'";
                      $result_insert_personal = mysql_query($sql_insert_personal) or die("Error in query:" . $sql_insert_personal . "<br>" . mysql_error() . "<br>" . mysql_errno());

                      $emp_rec_id             = mysql_insert_id();
                      $_SESSION['emp_id']     = $emp_rec_id;
                      $sql                    = "insert into mpc_login_master set Username = '$username',Password = '$password',UserType = 'User',IsActive= '1'";
                      $result_insert_personal = mysql_query($sql) or die("Error in query:" . $sql_insert_personal . "<br>" . mysql_error() . "<br>" . mysql_errno());

                      $sql_insert             = "update " . $mysql_table_prefix . "employee_master set emp_id = '$emp_rec_id' where rec_id = '$emp_rec_id'";
                      $result_insert          = mysql_query($sql_insert) or die("Error in query:" . $sql_insert . "<br>" . mysql_error() . "<br>" . mysql_errno());
                  } else {
                          $sql_insert_personal      = "update " . $mysql_table_prefix . "employee_master  set   empType ='$empType',first_name = '$first_name',last_name = '$last_name',address = '$address',correspondance ='$correspondance',country = '$country',state = '$state',other_state = '$other_state',city = '$city',other_city = '$other_city',pincode = '$pin_code',dob = '$dob',pob ='$pob',gender = '$gender',eye ='$eye',illness ='$illness',height ='$height',height_inch='$height_inch',weight ='$weight',phone_no = '$phone_no',mobile_no ='$mobile_no',emergancy_contact = '$emergancy_contact',email_id = '$email_id',email_official='$email_official',religion='$religion',marital_status = '$marital',marriage_date = '$marr_date',blood_group = '$blood_group',cast ='$cast',category = '$category',nationality = '$nationality',pan_no='$pan_no',emp_period='$period',	
                                                      reference = '$reference',reference_contact ='$reference_contact',hobby='$hobby',habit='$habit' where rec_id = '$emp_edit_id'";
					                  $result_insert_personal = mysql_query($sql_insert_personal) or die("Error in query:" . $sql_insert_personal . "<br>" . mysql_error() . "<br>" . mysql_errno());
                  }
                  if ($_FILES["emp_pic"]["name"] <> "") {
                      $filename      = $_FILES["emp_pic"]["name"];
                      $file_arr      = explode(".", $filename);
					            $file_ext      = strtolower($file_arr[sizeof($file_arr) - 1]);

					            if ($file_ext == 'jpg' || $file_ext == 'gif' || $file_ext == 'bmp' || $file_ext == 'jpeg') {
                          
                          $filename = str_replace(" ", "_", $filename); // Add _ inplace of blank space in file name, you can remove this line
                          $time     = time();
                          $file     = $time . "_" . $filename;
                          $up_file  = "employee_picture/" . $file;   // upload directory path is set
                          if (move_uploaded_file($_FILES['emp_pic']['tmp_name'], $up_file)) {     //  upload the file to the server
                              resize_image($up_file, '100', '100', 'false', "employee_picture/thumb/" . $file, 'false', 'false');
                              $flag = 1;
                              $sql_insert = "update " . $mysql_table_prefix . "employee_master set 
																						employee_picture = '$file'
																						where rec_id = '$emp_rec_id'";
                             $result_insert = mysql_query($sql_insert) or die("Error in query:" . $sql_insert . "<br>" . mysql_error() . "<br>" . mysql_errno());
                          } else {
                              $flag = 0;
                              $msg  = 'error in upload image file';
                          }
                      } else {
                          $flag   = 0;
                          $msg    = 'Please upload image file not ' . $file_ext;
                      }
                  }
                  $mode   = 'personal_detail';
              }
          }
          if (isset($_POST['emp_family'])) {

              if ($_POST['no_refresh'] == $_SESSION['no_refresh']) {                  
              } else {
                        $father_name        = $_POST['father_name'];
                        $Dependant_member1  = $_POST['Dependant_member1'];
                        $mother_name        = $_POST['mother_name'];
                        $Dependant_member2  = $_POST['Dependant_member2'];
                        $father_dob         = $_POST['father_dob'];
                        $mother_dob         = getdbDate($_POST['mother_dob']);
                        $wife_name          = $_POST['wife_name'];
                        $Dependant_member3  = $_POST['Dependant_member3'];
                        $wife_dob           = getdbDate($_POST['wife_dob']);
                        if (isset($_POST['child_name'])) {
                        }
                        $child_name   = $_POST['child_name'];
                        $count        = count($child_name);
                        $child_name   = implode(",", $child_name);
                        $child_dob    = $_POST['child_dob'];
                        
                        for ($i = 0; $i < $count; $i++) {
                            $child_dependent[] = $_POST['child_dependent' . $i][0];
                        }

                        $child_dependent = implode(",", $child_dependent);
                        for ($i = 0; $i < $count; $i++) {
                            $child_gender[] = $_POST['child_gender' . $i][0];
                        }
                        $child_gender = implode(",", $child_gender);
                        $child_dob    = implode(",", $child_dob);
                        if ($emp_family_edit == "") {
                            if (isset($_POST['child_name'])) {
                                $count = count($_POST['child_name']);
                            }
                        $sql_insert_family =  "insert into " . $mysql_table_prefix . "family_master  set emp_id = '" . $_SESSION['emp_id'] . "',father_name = '$father_name',father_dob = '$father_dob',
      					                              Dependant_father = '$Dependant_member1',mother_name = '$mother_name',mother_dob = '$mother_dob',Dependant_mother = '$Dependant_member2',wife_name = '$wife_name',
      					                              Dependant_wife = '$Dependant_member3',wife_dob = '$wife_dob',wife_occupation = '$wife_occupation',child_name='$child_name',child_gender='$child_gender',child_dependent='$child_dependent',child_dob='$child_dob'";


                        $result_family      = mysql_query($sql_insert_family) or die("Error in query:" . $sql_insert_family . "<br>" . mysql_error() . "<br>" . mysql_errno());
                        $emp_family         = mysql_insert_id();
                       } else {
                            $child_dob      = $_POST['child_dob'];
                            for ($i = 0; $i < $count; $i++) {
                                $child_dependent1[] = $_POST['child_dependent' . $i][0];
                            }
                            $child_dependent1 = implode(",", $child_dependent1);
                            for ($i = 0; $i < $count; $i++) {
                                $child_gender1[] = $_POST['child_gender' . $i][0];
                            }
                            $child_gender1          = implode(",", $child_gender1);
                            $child_dob              = implode(",", $child_dob);
                            $sql_insert_personal    = "update " . $mysql_table_prefix . "family_master  set father_name = '$father_name',father_dob = '$father_dob',Dependant_father = '$Dependant_member1',mother_name = '$mother_name',mother_dob = '$mother_dob',Dependant_mother = '$Dependant_member2',wife_name = '$wife_name',Dependant_wife = '$Dependant_member3',wife_dob = '$wife_dob',child_name='$child_name',child_gender = '$child_gender1',child_dependent = '$child_dependent1',child_dob = '$child_dob' where emp_id = '$emp_family_edit'";
                            $result_insert_personal = mysql_query($sql_insert_personal) or die("Error in query:" . $sql_insert_personal . "<br>" . mysql_error() . "<br>" . mysql_errno());
                        }
                        $_SESSION['emp_family'] = $_SESSION['emp_id'];
                        $mode                   = 'family_detail';
                    }
          }
          if (isset($_POST['emp_education'])) { 
              if ($_POST['no_refresh'] == $_SESSION['no_refresh']) {
                  
              } else {
                  $qualification  = $_POST['qualification'];
                  $university     = $_POST['university'];
                  $duration       = $_POST['duration'];
                  $percentage     = $_POST['percentage'];
                  $hscyear        = $_POST['hscyear'];
                  $hscboard       = $_POST['hscboard'];
                  $hscsubject     = $_POST['hscsubject'];
				          $hscpercentage  = $_POST['hscpercentage'];
                  $diplomaqualification = $_POST['diplomaqualification'];
                  $diplomayear        = $_POST['diplomayear'];
                  $diplomauniversity  = $_POST['diplomauniversity'];
                  $diplomaduration    = $_POST['diplomaduration'];
                  $diplomapercentage  = $_POST['diplomapercentage'];
                  $diploma_specialization   = $_POST['diploma_specialization'];
                  $graduationqualification  = $_POST['graduationqualification'];
                  $graduationpassingyear    = $_POST['graduationpassingyear'];
                  $graduationuniversity     = $_POST['graduationuniversity'];
                  $grdurationDuration       = $_POST['grdurationDuration'];
                  $graduationpercentage     = $_POST['graduationpercentage'];
                  $graduation_specialization      = $_POST['graduation_specialization'];
                  $mastergraduationqualification  = $_POST['mastergraduationqualification'];
                  $mastergraduationpassingyear    = $_POST['mastergraduationpassingyear'];
                  $mastergraduationuniversity     = $_POST['mastergraduationuniversity'];
                  $mastergraduationduration       = $_POST['mastergraduationduration'];
                  $mastergraduationpercentage     = $_POST['mastergraduationpercentage'];
                  $master_specialization          = $_POST['master_specialization'];
                  $other_qualification            = $_POST['other_qualification'];
                  $other_qualification_year       = $_POST['other_qualification_year'];
                  $ncvt_scvt                      = $_POST['ncvt_scvt'];
                  $other_university               = $_POST['other_university'];
                  $other_course_duration          = $_POST['other_course_duration'];
                  $other_course_percentage        = $_POST['other_course_percentage'];
                  $other_specialization           = $_POST['other_specialization'];
				  
				  if ($hscsubject != Null || $hscsubject != "") {
                      $hscsubject = implode(',',$hscsubject);
                  }
                  if ($emp_education_edit == "") {

                      $sql_insert_education = "insert into " . $mysql_table_prefix ."education_master set
                                              emp_id = '" . $_SESSION['emp_id'] . "',
                                              qualification = '$qualification',
                                              university = '$university',
                                              duration = '$duration',
                                              percentage = '$percentage',
                                              hscyear = '$hscyear',
                                              hscboard = '$hscboard',
                                              hscsubject = '$hscsubject',
                                              hscpercentage = '$hscpercentage',
                                              diplomaqualification = '$diplomaqualification',
                                              diplomayear = '$diplomayear',
                                              diplomauniversity = '$diplomauniversity',
                                              diplomaduration = '$diplomaduration',
                                              diplomapercentage = '$diplomapercentage',
                                              diploma_specialization = '$diploma_specialization',
                                              graduationqualification = '$graduationqualification',
                                              graduationpassingyear = '$graduationpassingyear',
                                              graduationuniversity = '$graduationuniversity',
                                              grdurationDuration = '$grdurationDuration',
                                              graduationpercentage = '$graduationpercentage',
                                              graduation_specialization = '$graduation_specialization',
                                              mastergraduationqualification = '$mastergraduationqualification',
                                              mastergraduationpassingyear = '$mastergraduationpassingyear',
                                              mastergraduationuniversity = '$mastergraduationuniversity',
                                              mastergraduationduration = '$mastergraduationduration',
                                              mastergraduationpercentage = '$mastergraduationpercentage',
                                              master_specialization = '$master_specialization',
                                              other_qualification = '$other_qualification',
                                              other_qualification_year = '$other_qualification_year',
                                              ncvt_scvt = '$ncvt_scvt',
                                              other_university = '$other_university',
                                              other_course_duration = '$other_course_duration',
                                              other_course_percentage = '$other_course_percentage',
                                              other_specialization = '$other_specialization'
                                              ";
                        					 
                      $result_family_education = mysql_query($sql_insert_education) or die("Error in query:" . $sql_insert_education . "<br>" . mysql_error() . "<br>" . mysql_errno());
				        } else {
                          $sql_insert_personal    = "update " . $mysql_table_prefix . "education_master set
                                                    qualification = '$qualification',
                                                    university = '$university',
                                                    duration = '$duration',
                                                    percentage = '$percentage', hscyear = '$hscyear', hscboard ='$hscboard', hscsubject ='$hscsubject', hscpercentage = '$hscpercentage', diplomaqualification = '$diplomaqualification', diplomayear = '$diplomayear', diplomauniversity = '$diplomauniversity', diplomaduration = '$diplomaduration', diplomapercentage = '$diplomapercentage',
                                                    diploma_specialization = '$diploma_specialization', graduationqualification = '$graduationqualification', graduationpassingyear = '$graduationpassingyear', graduationuniversity = '$graduationuniversity', grdurationDuration = '$grdurationDuration', graduationpercentage = '$graduationpercentage',
                                                    graduation_specialization = '$graduation_specialization', mastergraduationqualification = '$mastergraduationqualification', mastergraduationpassingyear = '$mastergraduationpassingyear', mastergraduationuniversity = '$mastergraduationuniversity', mastergraduationduration = '$mastergraduationduration', mastergraduationpercentage = '$mastergraduationpercentage', master_specialization = '$master_specialization',
                                                    other_qualification = '$other_qualification',
                                                    other_qualification_year = '$other_qualification_year',
                                                    ncvt_scvt = '$ncvt_scvt',
                                                    other_university = '$other_university',
                                                    other_course_duration = '$other_course_duration',
                                                    other_course_percentage = '$other_course_percentage',
                                                    other_specialization = '$other_specialization' where emp_id = '$emp_education_edit'";
                          $result_insert_personal = mysql_query($sql_insert_personal) or die("Error in query:" . $sql_insert_personal . "<br>" . mysql_error() . "<br>" . mysql_errno());
			                  }
                      $_SESSION['emp_education']  = $_SESSION['emp_id'];
                      $mode                       = 'education_detail';
				          }
          }

          if (isset($_POST['emp_experience_pre'])) {
          $pre_employee_id          = $_POST['employee_id'];
          $pre_employer_name        = $_POST['pre_employer_name'];
          $pre_employer_designation = $_POST['pre_employer_designation'];
          $Industry                 = $_POST['Industry'];
          $experince_from           = $_POST['experince_from'];
          $experince_to             = $_POST['experince_to'];
          $relevent                 = $_POST['relevent'];
          $salary                   = $_POST['salary'];
          $file_name                = $_FILES["file"]["name"];          
          if($file_name!='')
          {
            $file_arr = explode('.',$file_name);
            $file_ext = strtolower($file_arr[sizeof($file_arr) - 1]);
          if (($file_ext == 'pdf' || $file_ext == 'doc' || $file_ext == 'docx') && $_FILES["file"]["size"] < 500000)
          {
            $filename = str_replace(" ","_", $file_name);
            $time     = time();
            $file     = $time . "_" . $file_name;
            $up_file  = "upload/".$file;
            move_uploaded_file($_FILES['file']['tmp_name'],$up_file);  
            if ($emp_experience_edit == "") {
                  // current job
            $que = mysql_query("insert into mpc_experience_master values('','$pre_employee_id',
                  '$pre_employer_name','$pre_employer_designation',
                  '$Industry','$experince_from',
                  '$experince_to','$relevent',
                  '$salary','$file')");
            }else {
              $query = mysql_query("update mpc_experience_master set employer_name='$pre_employer_name',
                      employer_designation='$pre_employer_designation',
                      Industry='$Industry',experince_from='$experince_from',
                      experince_to='$experince_to',relevent='$relevent',salary='$salary',
                      file='$file' where emp_id='$pre_employee_id'");
            }
          }else{
                echo "error in uploading  file";
                 // While file is wrong then data is insert into database.
                if ($emp_experience_edit == "") {
                  // current job
                  $que = mysql_query("insert into mpc_experience_master values('','$pre_employee_id',
                        '$pre_employer_name','$pre_employer_designation',
                        '$Industry','$experince_from',
                        '$experince_to','$relevent',
                        '$salary')");
                  }else{
                        $query = mysql_query("update mpc_experience_master set employer_name='$pre_employer_name',
                                employer_designation='$pre_employer_designation',
                                Industry='$Industry',experince_from='$experince_from',
                                experince_to='$experince_to',relevent='$relevent',salary='$salary'
                                where emp_id='$pre_employee_id'");
                  }
          }
        }else{
              if ($emp_experience_edit == "") {
                  // current job
                  $que = mysql_query("insert into mpc_experience_master values('','$pre_employee_id',
                        '$pre_employer_name','$pre_employer_designation',
                        '$Industry','$experince_from',
                        '$experince_to','$relevent',
                        '$salary')");
                  }else{
                      $query = mysql_query("update mpc_experience_master set employer_name='$pre_employer_name',
                              employer_designation='$pre_employer_designation',
                              Industry='$Industry',experince_from='$experince_from',
                              experince_to='$experince_to',relevent='$relevent',salary='$salary'
                              where emp_id='$pre_employee_id'");
                  }
          }
          $_SESSION['emp_experience_pre'] = $_SESSION['emp_id'];
          $mode                           = 'experience_detail';        
      }
      if (isset($_POST['emp_salary'])) {
                    $basic    = $_POST['basic'];
                    $convence = $_POST['convence'];
                    $medical  = $_POST['medical'];
                    $hra      = $_POST['hra'];
                    $side_allowance   = $_POST['side_allowance'];
                    $phone_allowance  = $_POST['phone_allowance'];
                    $other_allowance  = $_POST['other_allowance'];
                    $tds              = $_POST['tds'];
                    $earning          = $_POST['earning'];
                    $take_home        = $_POST['take_home'];
                    $p_tax            = $_POST['p_tax'];
                    $advance          = $_POST['advance'];
                    $loan             = $_POST['loan'];
                    $other_gain       = $_POST['other_gain'];
                    $celling          = $_POST['cell'];
                    $bonus            = $_POST['bonus'];
                    $gratuity         = $_POST['gratuity'];
                    $deduction        = $_POST['deduction'];
                    $deduction1       = $_POST['deduction1'];
                    $deduc            = $deduction + $deduction1;

                    if ($emp_salary_edit == "") {
                        $sql_insert_education = "insert into " . $mysql_table_prefix . "salary_master set
                                                emp_id = '$emp_rec_id',
                                                basic = '$basic',
                                                leave_travel_allow = '$lta',
                                                hra = '$hra',
                                                side_allowance = '$side_allowance',
                                                convence = '$convence',
                                                other_allowance = '$other_allowance',
                                                tds = '$tds',
                                                other_deductions = '$other_gain',
                                                site_allowance = '$site_allowance',
                                                medical = '$medical',
                                                professional_tax = '$p_tax',
                                                from_date = now(),
                                                InsertBy = '',
                                                InsertDate = now(),
                                                IpAddress = '',
                                                celling = '$celling',
                                                phone = '$phone_allowance',
                                                take_home = '$earning',
                                                bonus = '$bonus',
                                                gratuity = '$gratuity',
                                                total_deduction = '$deduc',
                                                total_salary = '$total_salary'
                                                ";

                        $result_family_education = mysql_query($sql_insert_education) or die("Error in query:" . $sql_insert_education . "<br>" . mysql_error() . "<br>" . mysql_errno());

                        $sql_loan = "insert into " . $mysql_table_prefix . "loan_employee set
                                    emp_id = '$emp_rec_id',
                                    loan_amount = '$loan'";

                        mysql_query($sql_loan) or die("Error in query:" . $sql_loan . "<br>" . mysql_error() . "<br>" . mysql_errno());

                        $sql_advance = "insert into " . $mysql_table_prefix . "advance_employee set
                                        emp_id = '$emp_rec_id',
                                        advance = '$advance',
                                        ad_date = now()";

                        mysql_query($sql_advance) or die("Error in query:" . $sql_advance . "<br>" . mysql_error() . "<br>" . mysql_errno());
                    } else {

                        $sql_insert_education = "update " . $mysql_table_prefix . "salary_master set
                                                basic = '$basic',
                                                hra = '$hra',
                                                convence = '$convence',
                                                side_allowance = '$side_allowance',
                                                phone = '$phone_allowance',
                                                other_allowance = '$other_allowance'
                                                tds = '$tds',
                                                other_deductions = '$other_gain',
                                                site_allowance = '$site_allowance',
                                                medical = '$medical',
                                                gratuity = '$gratuity',
                                                professional_tax = '$p_tax',
                                               
                                                InsertBy = '',
                                                InsertDate = now(),
                                                IpAddress = '',
                                                celling = '$celling'
                                                where emp_id = '$emp_rec_id'";

                        $result_family_education  = mysql_query($sql_insert_education) or die("Error in query:" . $sql_insert_education . "<br>" . mysql_error() . "<br>" . mysql_errno());
                        $sql_loan                 = "update " . $mysql_table_prefix . "loan_employee set loan_amount = '$loan' where emp_id = '$emp_education_edit'";
                        mysql_query($sql_loan) or die("Error in query:" . $sql_loan . "<br>" . mysql_error() . "<br>" . mysql_errno());

                        $sql_advance = "update " . $mysql_table_prefix . "advance_employee
                                      set advance = '$advance', ad_date = now() where emp_id = '$emp_salary_edit'";
                    }
                    $_SESSION['emp_salary'] = $_SESSION['emp_id'];
                    $mode                   = 'salary_detail';
                }
                if (isset($_GET['mode'])) {
                    $mode = $_GET['mode'];
                }
              ?>
          <script type="text/javascript">
              function get_frm(str, str1, str2, str3)
              {
                  xmlHttp1 = GetXmlHttpObject();
                  if (xmlHttp1 == null)
                  {
                      alert("Browser does not support HTTP Request")
                      return
                  }

                  document.getElementById(str2).innerHTML = '<img src="images/loader.gif" border="0">';

                  var url = str
                  url = url + "?id = " + str1 + "&str = " + str3;
                  url = url + "&sid = " + Math.random()
                  xmlHttp1.onreadystatechange = function ()
                  {
                      if (xmlHttp1.readyState == 4 || xmlHttp1.readyState == "complete")
                      {
                          document.getElementById(str2).innerHTML = xmlHttp1.responseText;
                      }
                  };

                  xmlHttp1.open("GET", url, true)
                  xmlHttp1.send(null)
              }

              function get_frm1(str4, str5, str6, str7)
              {
                  xmlHttp = GetXmlHttpObject();
                  if (xmlHttp == null)
                  {
                      alert("Browser does not support HTTP Request")
                      return
                  }

                  document.getElementById(str6).innerHTML = '<img src="images/loader.gif" border="0">';

                  var url = str4
                  url     = url + "?id = " + str5 + "&str = " + str7;
                  url     = url + "&sid = " + Math.random()
                  xmlHttp.onreadystatechange = function ()
                  {
                      if (xmlHttp.readyState == 4 || xmlHttp.readyState == "complete")
                      {
                          document.getElementById(str6).innerHTML = xmlHttp.responseText;
                          document.getElementById('div_city').innerHTML = '<input type="text" name="other_city" id="other_city" value="" class="inputfield">';
                      }
                  };

                  xmlHttp.open("GET", url, true)
                  xmlHttp.send(null)
              }


              function GetXmlHttpObject()
              {
                  var objXMLHttp = null
                  if (window.XMLHttpRequest)
                  {
                      objXMLHttp = new XMLHttpRequest()
                  }
                  else if (window.ActiveXObject)
                  {
                      objXMLHttp = new ActiveXObject("Microsoft.XMLHTTP")
                  }
                  return objXMLHttp
              }

              var xmlHttp = GetXmlHttpObject();
              function check_email(str1, st) {

                  if (str1 != '')
                  {
                      xmlHttp.open('get', 'check_email.php?id=' + str1 + '&st=' + st);
                      document.getElementById('div_email').innerHTML = "<img src = 'images/loader.gif'>";
                      xmlHttp.onreadystatechange = handleMail;
                      xmlHttp.send(null);
                  }
              }

              function handleMail() {

                  if (xmlHttp.readyState == 4) {
                      var response = xmlHttp.responseText;
                      if (response == 0)
                      {
                          document.getElementById('div_email').innerHTML = "This Email already exists.Please choose other email";
                          document.getElementById('c_email').focus();
                          document.getElementById('c_email').value = '';
                      }
                      if (response == 1)
                      {
                          document.getElementById('div_email').innerHTML = "You can continue with this Email Id";
                      }
                  }
              }

              function show_div(str)
              {
                  document.getElementById(str).style.display = 'block';
              }

              function close_div(str)
              {
                  document.getElementById(str).style.display = 'none';
              }

              function MM_openBrWindow(theURL, winName, features)
              { //v2.0
                  window.open(theURL, winName, features);
              }

              function check_login_id(str1) {
                  if (str1 != '')
                  {
                      if (document.getElementById('empStaff').checked == true) {
                          var empType = 'Staff';
                      }
                      if (document.getElementById('empWorker').checked == true) {
                          var empType = 'worker';
                      }
                      var urlstr = 'id=' + str1 + '&empType=' + empType;
                      xmlHttp.open('get', 'check_login.php?id=' + str1 + '&empType=' + empType + '&act=username' + '&sid=' + Math.random());
                      document.getElementById('check_login').innerHTML = "<img src = 'images/loader.gif'>";
                      xmlHttp.onreadystatechange = handleusername;
                      xmlHttp.send(null);
                  }
              }
              function handleusername() {
                  if (xmlHttp.readyState == 4) {
                      var response = xmlHttp.responseText;
                      if (response == 0)
                      {
                          document.getElementById('check_login').innerHTML = "Login Id not available .Please choose other.";
                          document.getElementById('emp_login').focus();
                          document.getElementById('emp_login').value = '';
                      }
                      else
                      {
                          document.getElementById('check_login').innerHTML = "Login Id available";
                      }
                  }
              }
              function numcheck(str)
              {
                  for (i = 0; i < document.getElementById(str).value.length; i++)
                  {
                      var c = document.getElementById(str).value.substring(i, i + 1);
                      if (isDigit(c) == false)
                      {
                          document.getElementById(str).value = document.getElementById(str).value.substring(0, i);
                      }
                  }
              }
              function isDigit(c)
              {
                  var test = "" + c;
                  if (test == "0" || test == "1" || test == "2" || test == "3" || test == "4" || test == "5" || test == "6" || test == "7" || test == "8" || test == "9")
                  {
                      return true;
                  }
                  return false;
              }
          </script> 
          <script type="text/javascript" src="javascript/form.js"></script> 
          <script type="text/javascript" src="javascript/popup.js"></script> 
          <script language="JavaScript1.2">
              function valid_empoylee(personel_reg)
              {
                  return(
                          checkString(personel_reg.elements["first_name"], "First Name", false) &&
                          checkString(personel_reg.elements["last_name"], "Last Name", false)
                          );
              }

              function valid_customer1()
              {
                  if (document.getElementById("password").value.length > 10)
                  {
                      Popup.showModal('modal', null, null, {'screenColor': '#99ff99', 'screenOpacity': .6}, "Password Can Not Be More Than 10 Characters");
                      return false;
                  }
                  if (document.getElementById("country").value != "99")
                  {
                      if (document.getElementById("txt_other_state").value == "")
                      {
                          Popup.showModal('modal', null, null, {'screenColor': '#99ff99', 'screenOpacity': .6}, "Please Enter State");
                          return false;
                      }
                      if (document.getElementById("city").value == "")
                      {
                          Popup.showModal('modal', null, null, {'screenColor': '#99ff99', 'screenOpacity': .6}, "Please Enter City");
                          return false;
                      }
                  }
                  else
                  {
                      if (document.getElementById("state").value == "")
                      {
                          Popup.showModal('modal', null, null, {'screenColor': '#99ff99', 'screenOpacity': .6}, "Please Enter State");
                          return false;
                      }
                      if (document.getElementById("city_select").value == "")
                      {
                          Popup.showModal('modal', null, null, {'screenColor': '#99ff99', 'screenOpacity': .6}, "Please Enter City");
                          return false;
                      }
                  }
                  return true;
              }
          </script> 
          <!--      my script    --> 
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
          <script>
              $(document).ready(function () {
                  $("#w").hide();
                  var value_radio = $('input[name=marital]:radio:checked').val();
                  if (value_radio == 'yes') {
                     $("#ss").show();
                  } else {
                      $("#ss").hide();
                  }
                  $("#show").click(function () {
                      $("#ss").hide();
                  });
                  $("#hide").click(function () {
                      $("#ss").show();
                  });
              });
          </script>
          <!--Code for the brope down list in Eduction master--> 
          <script>
              function getSelectedValue(id) {
                  return $("#" + id).find("dt a span.value").html();
              }
              $(document).ready(function () {
                 $(".dropdown dt a").on('click', function () {
                      $(".dropdown dd ul").slideToggle('fast');
                  });
                  $(".dropdown dd ul li a").on('click', function () {
                      $(".dropdown dd ul").hide();
                  });
                 $(document).bind('click', function (e) {
                      var $clicked = $(e.target);
                      if (!$clicked.parents().hasClass("dropdown"))
                          $(".dropdown dd ul").hide();
                  });
                  $('.mutliSelect input[type="checkbox"]').on('click', function () {
                      var checkBox = document.getElementById('other').checked;
                      if (checkBox == true) {
                          $("#w").show();
                      }
                      else {
                          $("#w").hide();
                      }
                      /*_______________ Get text value_________________ */
                      $("#txt_save").click(function () {
                          var txt   = $("#txt_hscsubject").val();
                          var span  = document.getElementById('otherSub');
                          if (span != null) {
                              document.getElementById('otherSub').innerHTML = txt;
                              $(span.id).html(txt);
                              document.getElementById('other').value = txt;
                          }
                          else {
                              var html = '<span id="otherSub" title="' + txt + '">' + txt + ',</span>';
                              $('.multiSel').append(html);
                              $(".hida").hide();
                              document.getElementById('other').value = txt;
                          }
                      });
                      /*_________________End Of Function _______________________*/
                      var title = $(this).closest('.mutliSelect').find('input[type="checkbox"]').val(),
                                  title = $(this).val() + ",";
                      title     = $(this).val() + ",";
                      if ($(this).attr("value") == "other") {
                          var a = document.getElementById('hscsubject').val();
                      }
                      if ($(this).is(':checked')) {
                          var html = '<span title="' + title + '">' + title + '</span>';
                          $('.multiSel').append(html);
                          $(".hida").hide();
                      }
                      else {
                          $('span[title="' + title + '"]').remove();
                          var ret = $(".hida");
                          $('.dropdown dt a').append(ret);
                      }
                  });
              });
          </script>
          <!--My code end here-->
          <script>
              function marriage_date(radio_value)
              {
                  text_box = document.getElementById("marr_date");
                  if (radio_value.value == 'no')
                  {
                      text_box.disabled = true;
                  }
                  else
                  {
                      text_box.disabled = false;
                  }
              }
          </script> 
          <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
          <script>
              var jj = jQuery.noConflict();
              jj(document).ready(function () {
                  jj("#hide").click(function () {
                      jj(".wife_name").hide();
                  });
                  jj("#show").click(function () {
                      jj(".wife_name").show();
                  });
              });
          </script>
          <table width="98%" cellpadding="0" cellspacing="0" border="0" align="center">
              <tr>
                  <td align="left" valign="top" width="230px" style="padding-top:5px;">
                      <? include ("inc/snbuser.php"); ?>
                  </td>
                  <td style="padding-left:5px; padding-top:5px; float:left;">
                      <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                          <tr>
                              <td align="center" class="gray_bg"><img src="images/bullet.gif" width="15" height="22"/> &nbsp; Employee Registration Form</td>
                          </tr>
                          <tr bgcolor="#FFFFFF">
                              <td class="red"><?= $msg ?></td>
                          </tr>
                          <tr bgcolor="#FFFFFF">
                            <td style="vertical-align:top; padding-top:5px;">
                              <div class="simpleTabs">
                                <ul class="simpleTabsNavigation">
                                  <li><a <? 
                                          if (isset($_SESSION['emp_id']) or isset($_GET['emp_id'])) { ?>href="User_details.php" <?
                                              } if ($mode == '') {
                                                  echo 'class="current"';
                                              }
                                              ?>>Personal Detail</a></li>
                                  <li><a <? 
                                          if (isset($_SESSION['emp_id']) or isset($_GET['emp_id'])) { ?> href="User_details.php?mode=personal_detail"<?
                                              } if ($mode == 'personal_detail') {
                                                  echo 'class="current"';
                                              }
                                              ?>>Family Detail</a></li>
                                  <li><a <? 
                                          if (isset($_SESSION['emp_id']) or isset($_GET['emp_id'])) { ?> href="User_details.php?mode=family_detail"<?
                                              } if ($mode == 'family_detail') {
                                                  echo 'class="current"';
                                              }
                                              ?>>Academic Information</a></li>
                                  <li><a <? 
                                          if (isset($_SESSION['emp_id']) or isset($_GET['emp_id'])) { ?> href="User_details.php?mode=education_detail"<?
                                              } if ($mode == 'education_detail') {
                                                  echo 'class="current"';
                                              }
                                              ?>>Experience Detail</a></li>
      
                                  <li><a <? 
                                          if (isset($_SESSION['emp_id']) or isset($_GET['emp_id'])) { ?>href="User_details.php?mode=salary_details"<?
                                              } if ($mode == 'salary_details') {
                                                  echo 'class="current"';
                                              }
                                              ?>>Assets Details</a></li>
                                      </ul>
                                  </div>
                                  <!-- -------------------------------Employee-Profile-------------------------------------------->
                                  <div <?
                                        if ($mode == '') {
                                            echo 'class="current"';
                                        } else {
                                            echo 'class="simpleTabsContent"';
                                        }
                                  ?>>
                                      <form name="empolyee_profile" id="empolyee_profile" action="User_details.php" method="post" enctype="multipart/form-data" onSubmit="return valid_empoylee(this);">
                                          <table width="100%" cellpadding="2" cellspacing="2" border="0" align="center" class="border" style="padding-top:10px;">
                                              <tr>
                                                  <td width="100%" colspan="2" align="center">
                                                    <table cellpadding="0" cellspacing="0" border="0" align="center" class="loginbg">
                                                      <tr>
                                                        <td width="4%"></td>
                                                        <td  width="33%">
                                                          Select Employee Type
                                                          <span class="red">*</span>
                                                        </td>
                                                        <td>
                                                          <?php
                                                            $que = mysql_query("select type_name from mpc_employee_type_master");
                                                                   while ($row = mysql_fetch_array($que)) {
                                                                      if ($empType == $row['type_name']) {
                                                                          echo $row['type_name'];
                                                                      }
                                                                  }
                                                          ?>
                                                        </td>
                                                        <td width="4%"></td>
                                                        <label>
                                                           <td><input type="radio" name="period" id="01" value="0" <?php
                                                                if ($period == '0') {
                                                                      echo "checked";
                                                                  }
                                                                  ?> >
                                                            </td>
                                                            <td width="20%">Probational Period</td>
                                                        </label>
                                                        <label>
                                                            <td><input type="radio" name="period" id="period" value="1" <?php
                                                                  if ($period == '1') {
                                                                      echo "checked";
                                                                  }
                                                                  ?> >
                                                            </td>
                                                            <td>Conform</td>
                                                        </label>
                                                          <td width="23%" style="padding-left:15px;">Employee Code<span class="red">*</span></td>
                                                          <td width="">
                                                              <input type="text" name="emp_login" id="emp_login" style="width:150px; height:20px;" value="<?= @$ticket_no ?>" <?
                                                              if (isset($_SESSION['emp_id'])) {
                                                                  echo 'readonly="readonly"';
                                                              } else {
                                                                  echo 'readonly="readonly"';
                                                                  ?> onBlur="check_login_id(this.value);"<? } ?>>
                                                          </td>
                                                          <td width="30%"><div style="font-size:14px;" id="check_login"></div></td>
                                                      </tr>
                                                    </table>
                                                </td>
                                              </tr>
                                          <tr>
                                              <td><?php include("personal_detaill_test.php"); ?></td>
                                          </tr>
                                          <tr>
                                              <td colspan="2" style="text-align:center;"><input type="submit"  value="Next" name="Submit_emp" id="Submit_emp"/>
                                                  <?php
                                                  if (isset($_SESSION['emp_id'])) {
                                                      ?>
                                                  </td>
                                                  <?
                                              }
                                              ?>
                                          <input name="no_refresh" type="hidden" id="no_refresh" value="<?php echo uniqid(rand()); ?>" />
                                          </td>
                                          </table>
                                      </form>
                                  </div>
                                  <!-----------------------PERSONAL DETAILL ENDS HERE---------------------> 
                                  <!-- ---------------------Family Detail Starts here----------------- -->
                                  <?php include("family_detail_test.php"); ?>
                                  <!-----------------------Family Detail Ends Here---------------- --> 
                                  <!-- ---------------------Education Detail Start Here----------------- -->
                                  <?php include("education_detail_test.php"); ?>
                                  <!-----------------------Education Detail Ends Here ----------------------------> 
                                  <!-----------------------Experience Detail ------------------------>
                                  <?php include("experience_detail_test.php"); ?>
                                  <!-----------------------Experience Detail Ends Here------------------> 
                                  <?php include("assets_detail_test.php"); ?>
                                  </div>
                              </td>
                          </tr>
                      </table>
                  </td>
              </tr>
          </table>
          <DIV id=modal style="DISPLAY: none;">
              <div style="padding: 0px; background-color: rgb(37, 100, 192); visibility: visible; position: relative; width: 222px; height: 202px; z-index: 10002; opacity: 1;">
                  <div onClick="Popup.hide('modal')" style="padding: 0px; background: transparent url(./images/close.gif) no-repeat scroll 0%; visibility: visible; position: absolute; left: 201px; top: 1px; width: 20px; height: 20px; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; cursor: pointer; z-index: 10004;" id="adpModal_close"></div>
                  <div style="padding: 0px; background: transparent url(resize.gif) no-repeat scroll 0%; visibility: visible; position: absolute; width: 9px; height: 9px; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; cursor: nw-resize; z-index: 10003;" id="adpModal_rsize"></div>
                  <div style="padding: 0px; overflow: hidden; background-color: rgb(140, 183, 231); visibility: visible; position: absolute; left: 1px; top: 1px; width: 220px; height: 20px; font-family: arial; font-style: normal; font-variant: normal; font-weight: bold; font-size: 9pt; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(15, 15, 15); cursor: move;" id="adpModal_adpT"></div>
                  <div style="border-style: inset; border-width: 0px; padding: 8px; overflow: hidden; background-color: rgb(118, 201, 238); visibility: visible; position: absolute; left: 1px; top: 21px; width: 204px; height: 164px; font-family: MS Sans Serif; font-style: normal; font-variant: normal; font-weight: bold; font-size: 11pt; line-height: normal; font-size-adjust: none; font-stretch: normal; color: rgb(28, 94, 162);" id="adpModal_adpC">
                      <center>
                          <p>
                          <div id="div_message"></div>
                          </p>
                          <p style="font-size: 10px; color: rgb(253, 80, 0);">To gain access to the page behind the popup must be closed</p>
                      </center>
                  </div>
              </div>
          </DIV>
          <iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:5000; position:absolute; left:-500px; top:0px;"> </iframe>
          <? include ("inc/hr_footer.php"); ?>
      </body>
