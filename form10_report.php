<? include ("inc/hr_header.php"); ?>
<!--<link rel="stylesheet" href="css/BeatPicker.min.css"/>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/BeatPicker.min.js"></script>  -->
<script>
  $(function() {
    //$( "#dob" ).datepicker();
	$('.footer').hide();
  });
</script>
<?
$msg ='';
$plant="";
$dep="";
$dept_id="";
?>
<?
if(isset($_GET['start']))
{
	if($_GET['start']=='All')
	{
		$start = 0;
	}
	else
	{
		$start = $_GET['start'];
	}
}
else
{
	$start = 0;
}		
if(isset($_POST['txt_from_date']))
{	
	 $txt_from_date =$_POST['txt_from_date'];
}	
else if(isset($_GET['txt_to_date']))
{	
	$txt_to_date =$_GET['txt_to_date'];
}

$employee_type="";
$department="";
$sub_department="";
$plant_name="";
$ticket_id="";
$select_string= "";
$table_list= "";
$where_string="";
if(isset($_POST["employee_type"]) and isset($_POST["ticket_id"]) and isset($_POST["department"]) and isset($_POST["sub_department"])
and isset($_POST["plant_name"]))
{
	if(($_POST["employee_type"]!=""))
	{	
		$select_string=",mpc_designation_employee.*,mpc_designation_master.*";
		$employee_type=$_POST["employee_type"];
		$table_list= ",mpc_designation_employee,mpc_designation_master";
		$where_string.="and mpc_designation_employee.emp_id =mpc_employee_master.rec_id and mpc_designation_employee.designation_id=mpc_designation_master.rec_id and mpc_designation_master.emp_category='$employee_type' and mpc_designation_employee.to_date='0000-00-00'";
	}
	if($_POST["ticket_id"]!="")
	{
		$select_string= "";
		$ticket_id=$_POST["ticket_id"];
		$table_list.= "";
		$where_string.="and mpc_employee_master.ticket_no ='$ticket_id'";
	}
	if($_POST["department"]!="" and $_POST["sub_department"]=="")
	{	
		$select_string= ",mpc_department_employee.*,mpc_department_master.*";
		$department=$_POST["department"];
		$table_list.= ",mpc_department_employee,mpc_department_master";
		
		$where_string.="and mpc_department_employee.emp_id =mpc_employee_master.rec_id and mpc_department_master.reference_id ='$department' and mpc_department_employee.to_date='0000-00-00' and mpc_department_master.rec_id=mpc_department_employee.dept_id";
	}
		if($_POST["sub_department"]!="")
	{
		$select_string= ",mpc_department_employee.*";	
		$department=$_POST["department"];
		$sub_department=$_POST["sub_department"];
		$table_list.= ",mpc_department_employee";
		
		$where_string.="and mpc_department_employee.emp_id =mpc_employee_master.rec_id and mpc_department_employee.dept_id ='$sub_department' and mpc_department_employee.to_date='0000-00-00'";
	}
		if($_POST["plant_name"]!="")
	{	
		$select_string= ",mpc_plant_employee.*";
		$plant_name=$_POST["plant_name"];
		$table_list.= ",mpc_plant_employee";
		
		$where_string.="and mpc_plant_employee.emp_id =mpc_employee_master.rec_id and mpc_plant_employee.plant_id ='$plant_name' and mpc_plant_employee.to_date='0000-00-00'";
	}
}
if(isset($_POST["btn_submit_x"]))
{			
	 $sql_prj = "select 
	 					DAY(mpc_official_detail.date_joining) as 'Day',
						MONTH(mpc_official_detail.date_joining) as 'Month',
						YEAR(mpc_official_detail.date_joining) as 'Year',
						mpc_official_detail.date_joining,
						mpc_employee_master.rec_id as id,
						mpc_employee_master.ticket_no,
						mpc_employee_master.first_name,
						mpc_employee_master.last_name,
						mpc_official_detail.emp_id,
						mpc_employee_master.dob 
						,mpc_account_detail.emp_id,mpc_account_detail.date_releaving  
						
						$select_string 
						
						from ".$mysql_table_prefix."employee_master,
						".$mysql_table_prefix."official_detail
 						,mpc_account_detail
						
						$table_list 
						
						where 
						
						".$mysql_table_prefix."employee_master.rec_id != '' and 
						".$mysql_table_prefix."employee_master.rec_id = ".$mysql_table_prefix."official_detail.emp_id and
						".$mysql_table_prefix."official_detail.date_joining between '".getdbDateSepretoe($txt_from_date)."' and '".getdbDateSepretoe($txt_to_date)."'  and mpc_employee_master.rec_id=mpc_account_detail.emp_id and mpc_account_detail.date_releaving ='0000-00-00' 
						$where_string  order by mpc_employee_master.ticket_no ASC";
	
	//echo $sql_prj;
	$result_prj = mysql_query($sql_prj) or die("Error in Query :".$sql_prj."<br>".mysql_error().":".mysql_errno());
}

?>
<style>
select,input[type="text"]{height:36px !important; width:185px !important;margin:5px 0;}
</style>
<table width="98%" cellpadding="0" cellspacing="0" align="center" border="0">
    <tr>
    	<td align="left" valign="top" width="230px" style="padding-top:5px;">
			<? include ("inc/snb.php"); ?>
        </td>       
        <td style="padding-left:5px; padding-top:5px;" valign="top">
        	<table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
            	<tr>
                	<td align="center" class="gray_bg">&nbsp; <a href="#" style="text-decoration:none;color:gray;">Report-> </a>form-10 report</td>
                </tr>
                <tr>
                	<td valign="top">
                        <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
                            <tr>
                                <td>
                                    <table width="100%" cellpadding="0" cellspacing="0" align="center" border="0">
                                        <tr>
                                            <td class="red"><?=$msg?></td>
                                         </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-top:5px;" bgcolor="#f3fbd2">
                                                     <tr>
                                                        <td style="padding-top:10px;" align="center">
                                                        	<form name="frm_month" id="frm_month" action="" method="post">
                                                                <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
                                                                    <tr>
                                                                        <td colspan="8">
                                                                            <table align="left">
                                                                                <tr>                                                                  
                                                                                    <td align="left" class="text_1"><b>From Date</b></td>
                                                                                    <td align="center">
                                                                                        <input type="text"
             name="txt_from_date" id="txt_from_date" value="" style="width:100px; height:20px;" data-beatpicker="true"/>
                                                                                    </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                    <td align="left" class="text_1"><b>To Date</b></td>
                                                                                    <td align="left">
                                                                                        <input type="text"
             name="txt_to_date" id="txt_to_date" value="" style="width:100px; height:20px;" data-beatpicker="true"/>
                                                                                    </td>
                                                                                    </tr>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                     <tr> 
                                                                        <td class="text_1" colspan="2">
                                                                            <b>Filter By:</b>
                                                                        </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td class="text_1">
                                                                             <b>Emp Type</b></td>
                                                                             <td>
                                                                             <select name="employee_type" id="employee_type">
                                                                            <option value="">---Select---</option>
                                                     <?php 
												$que=mysql_query("select type_name from mpc_employee_type_master");
												
												while($row=mysql_fetch_array($que))
												 {
												 ?>
                                                   <option value="<?php echo $row['type_name']?>" <?php if ($employee_type == $row['type_name']) {
                                                                                    echo 'selected="selected"';
                                                                                } ?> ><?php  echo $row['type_name'];  ?> </option>
										<?php } ?>
                                       </select>
                                                                        </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td class="text_1">
                                                                            <b>Department</b></td>
																			<td><?
                                                                                     $sql = "SELECT * FROM mpc_department_master where reference_id='0' order by department_name";
                                                                                     $result = mysql_query($sql) or die("Error in sql : ".$sql." : ".mysql_errno()." : ".mysql_error());
                                                                                     ?>
                                                                                <select name="department" id="department" style="width:150px; height:25px;" onChange="get_frm('get_department.php',this.value,'div_sub_dept','sub_department');">
                                                                                    <option value="">Select</option>
                                                                                     <?
                                                                                  while ($row=mysql_fetch_array($result))
                                                                                    {	?>
                                                                                           <option value="<?=$row['rec_id']?>" <? if($row['rec_id']==$department){?> selected="selected" <? } ?>><?=$row["department_name"]?></option>
                                                                                    <?  }	?>
                                                                                </select>
                                                                        </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td class="text_1">
                                                                           <b> Sub Department</b></td>
                                                                            <td>
                                                                             <div id="div_sub_dept">
                                                                               
                                                                            <select name="sub_department" id="sub_department" style="width:150px; height:25px;" onChange="">
                                                                                <option value="">Select</option>
                                                                                 
                                                                            </select>
                                                                            </div>
                                                                        </td>
                                                                        </tr>
                                                                        <tr>
                                                                        <td class="text_1">
                                                                           <b>Plant</b></td>
																			<td><?
                                                                                 $sql = "SELECT * FROM mpc_plant_master order by plant_name";
                                                                                 $result = mysql_query($sql) or die("Error in sql : ".$sql." : ".mysql_errno()." : ".mysql_error());
                                                                                 ?>
                                                                            <select name="plant_name" id="plant_name" style="width:150px; height:25px;">
                                                                                <option value="">Select</option>
                                                                                 <?
                                                                              while ($row=mysql_fetch_array($result))
                                                                                {	?>
                                                                                       <option value="<?=$row['rec_id']?>" <? if($row['rec_id']==$plant_name){?> selected="selected" <? } ?>><?=$row["plant_name"]?></option>
                                                                                <?  }	?>
                                                                            </select>
                                                                        </td>
                                                                        
                                                                    </tr> 
                                                                    <tr>
                                                                        <td colspan="6" align="center" style="padding-top:5px;">
                                                                            <input name="no_refresh" type="hidden" id="no_refresh" value="<?php echo uniqid(rand()); ?>" />
                                                                            <input type="image" src="images/btn_view.jpg" name="btn_submit" id="btn_submit" value="View"/>
                                                                            <a href="javascript:;" onClick="document.location='form10_report.php';">
                                                                                <img src="images/submit_button_Mahima.jpg" name="over" border="0">
                                                                            </a>
                                                                        </td>
                                                                    </tr>     
                                                                </table>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top" style="padding-top:5px;">
                                                <table align="center" width="100%" cellpadding="1" cellspacing="1" border="0" style="border:1px solid #E4E4E4;">
                                                       <?  
                                                    if(isset($_POST["btn_submit_x"]) or isset($_GET['month']))
                                                        {
                                                        if(mysql_num_rows($result_prj)>0)
                                                        {
                                                        $sno = $start+1;
                                                        ?>
                                                   <tr>
                                                  		 <td align="right">
                                                         	<form action="print_month_wise_attendance.php" method="post" name="frm_print" id="frm_print" target="_blank">
                                                            	<input type="hidden" name="print_month" id="print_month" value="<?=$month?>"/>
                                                                <input type="hidden" name="print_year" id="print_year" value="<?=$year?>"/>
                                                                <input type="hidden" name="print_employee_type" id="print_employee_type" value="<?=$employee_type?>"/>
                                                                <input type="hidden" name="print_ticket_id" id="print_ticket_id" value="<?=$ticket_id?>"/>
                                                                <input type="hidden" name="print_department" id="print_department" value="<?=$department?>"/>
                                                                <input type="hidden" name="print_sub_department" id="print_sub_department" value="<?=$sub_department?>"/>
                                                                <input type="hidden" name="print_plant_name" id="print_plant_name" value="<?=$plant_name?>"/>
                                                            	 <input type="image" src="images/btn_print.jpg" name="btn_submit" id="btn_submit" value="View"/>
                                                            </form>
                                                         </td>
                                                   </tr> 
                                                   <tr>
                                                        <td align="center">
                                                        
                                                      	<div id="div_attandance_list" style="overflow:scroll;height:500px;width:100%">
                                                            <table align="center" cellpadding="0" width="100%" cellspacing="0" class="table1" border="1">
                                                            	 <thead id="table_header">

                                                              <tr class="gredBg">
                                                                <td width="5%" align="center"><b>S.No.</b></td>
                                                                <td width="5%" align="center"><b>Emp Id</b></td>
                                                                <td width="5%" align="center"><b>Employee Name</b></td>
                                                                <td width="15%" align="center"><b>Father Name</b></td>
																<td width="5%" align="center"><b>Designation</b></td>
                                                                <td width="5%" align="center"><b>Grade</b></td>
                                                                <td width="5%" align="center"><b>S.Type</b></td>
                                                                <td width="5%" align="center"><b>Category</b></td>
                                                                <td width="5%" align="center"><b>Basic</b></td>
                                                                <td width="5%" align="center"><b>Join Dt.</b></td>
                                                                <td width="5%" align="center"><b>DBO</b></td>
                                                              </tr>
                                                                </thead>
																<tbody id="table_body"> 

																<?
                                                                while($row=mysql_fetch_array($result_prj))
                                                                {
																	$total_salary_basic=0;
																	
																	$emp_id=$row['id'];
																
																
																?>
                                                                

                                                               <tr style="background-color:<? if ($sno%2==1) { ?> #F8F8F8 <? } ?>"  class="tableTxt">
                                                                <td width="5%" align="center"><?=$sno?></td>
                                                                <td width="5%" align="center"><?=$row["ticket_no"]?></td>
                                                                <td width="5%" align="center"><?=$row['first_name']?> <?=$row['last_name']?></td>
                                                                <td width="15%" align="left"><?=getfamilyDetail('father_name',$emp_id)?>&nbsp;</td>
                                                                <td width="15%" align="left">
                                                                <?=getdesignationMaster('designation_name','rec_id',getdesignationDetail('designation_id',$emp_id,getdbDateSepretoe($txt_from_date)));?>&nbsp;
                                                                </td>
                                                                <td width="15%" align="left">
                                                                <?=getofficeDetail('grade',$emp_id);?>&nbsp;
                                                                </td>
                                                                <td width="15%" align="left">
                                                                <?=getofficeDetail('employee_typ',$emp_id);?>&nbsp;
                                                                </td>
                                                                <td width="15%" align="left">
                                                                <?=getdesignationMaster('emp_category','rec_id',getdesignationDetail('designation_id',$emp_id,getdbDateSepretoe($txt_from_date)));?>&nbsp;
                                                                </td>
                                                                <td width="15%" align="left">
                                                                <?=getSalaryDetail('basic',$emp_id,getdbDateSepretoe($txt_from_date));?>&nbsp;
                                                                </td>
                                                                <td width="15%" align="left">
                                                                <?=getDatetime(getofficeDetail('date_joining',$emp_id));?>&nbsp;
                                                                </td>
                                                                <td width="15%" align="left">
                                                                <?=getDatetime($row['dob'])?>&nbsp;
                                                                </td>
                                                              </tr>
                                                              
                                                                <?
																	$sno++;
																}	
																?>	
                                                                </tbody>													 
                                                            </table>                                                             </div>  
                                                        </td>
                                                   </tr> 
                                                    <?
                                                     }	 
                                                     else
                                                     {
                                                     ?>
                                                     <tr class="table_rows">
                                                        <td align="center" colspan="8">No records found</td>
                                                      </tr>
                                                     <?
                                                      }
                                                    } 
                                                      ?>          	
                                               </table>
                                          </td>
                                       </tr>
                                   </table>
                               </td>
                           </tr>
                        </table> 
                        </div>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;">
</iframe>   
<? include ("inc/hr_footer.php"); ?>	