<?
include('inc/dbconnection.php');
include('inc/function.php');
$id="";
echo $id = $_GET["id"];die();
$basic="";
$leave_travel_allow="";
$hra="";
$side_allowance="";
$convence="";
$medical="";
$tds="";
$professional_tax ="";
$other_deductions="";
$total_deduction="";
$total_earning="";
$from_date="";
$sql = "SELECT * FROM  mpc_salary_master where emp_id  = '$id' and to_date='0000-00-00'";
$result = mysql_query ($sql) or die ("Error in : ".$sql."<br>".mysql_errno()." : ".mysql_error());
if(mysql_num_rows($result)>0)
{
	while($row = mysql_fetch_array($result))
	{
		$basic=$row['basic'];
		$leave_travel_allow=$row['leave_travel_allow'];
		$hra=$row['hra'];
		$side_allowance=$row['side_allowance'];
		$convence=$row['convence'];
		$medical=$row['medical'];
		$tds=$row['tds'];
		$professional_tax =$row['professional_tax'];
		$other_deductions=$row['other_deductions'];
		$from_date=$row['from_date'];		
	} 	
	$total_earning=$basic+$convence+$medical+$side_allowance+$leave_travel_allow+$hra;
}
?>
<div id="div_hide" style="display:block;" >
<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
	<tr>
    	<td colspan="2" class="blackHead">Salary Detail(Effective From date <?=getDatetime($from_date)?>)</td>
    </tr>
	<tr>
    	<td align="left">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
            	<tr>
                	<td width="49%" class="text_1">Basic</td>
                  <td width="51%"><?=$basic?></td>
              </tr>
            	<tr>
                	<td class="text_1">LTA</td>
                    <td><?=$leave_travel_allow?></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1">Professional Tax</td>
                  <td width="50%"><?=$professional_tax?></td>
              </tr>
                <tr>
                    <td class="text_1">TDS</td>
                    <td><?=$tds?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" >
            	<tr>
                	<td width="49%" class="text_1">HRA</td>
                  <td width="51%"><?=$hra?></td>
              </tr>
            	<tr>
                	<td class="text_1">Side Allowance</td>
                    <td><?=$side_allowance?></td>
                </tr>
            </table>
        </td>
        
        <td>
            <table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                        <?php   	if($basic >= 6500 ){	$pf=(getAccountDetail('pf_rate',$id)*6500)/100;} 
	else { $pf=(getAccountDetail('pf_rate',$id)*$basic)/100;}  ?>
                    <td width="50%" class="text_1">PF</td>
                    <td width="50%"><?php echo $pf;?></td>
              </tr>
                <tr>
                    <td class="text_1">ESI</td>
                    <td><?=$esi=round((getAccountDetail('esic_rate',$id)*$total_earning)/100,2);?></td>
                </tr>
            </table>
        </td>
    </tr>
        <tr>
    	<td>
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="49%" class="text_1">Convence</td>
                    <td width="51%"><?=$convence?></td>
              </tr>
                <tr>
                    <td class="text_1">Medical</td>
                    <td><?=$medical?></td>
                </tr>
            </table>
        </td>
        <td valign="top">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1">Other Deduction's</td>
                    <td width="50%"><?=$other_deductions?></td>
              </tr>
            </table>
        </td>
    </tr>
     <tr>
    	<td>
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="49%" class="text_1"><strong>Earnings</strong></td>
                    <td width="51%"><?=$total_earning?></td>
              </tr>
            </table>
        </td>
        <td valign="top">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1"><strong>Deduction's</strong></td>
                    <td width="50%"><? $total_deduction=$professional_tax+$tds+$other_deductions+$pf+$esi?><?=$total_deduction?></td>
              </tr>
            </table>
        </td>
    </tr>  
    <tr>
    	<td colspan="2" align="center">
        	<input type="button"  name="submit_pf" id="submit_pf" value="Change" onclick="show_div()"/>
            <input type="hidden" name="emp_id" id="emp_id" value="<?=$id?>"/>
        </td>
    </tr>
</table>
</div>
<div id="div_show" style="display:none;"> 
<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
	<tr>
    	<td colspan="2" class="blackHead">Salary Detail</td>
    </tr>
	<tr>
    	<td align="left">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
            	<tr>
                	<td width="49%" class="text_1">Basic</td>
                  <td width="51%"><input type="text" name="salary_basic" id="salary_basic" style="width:180px; height:20px;" value="<?=$basic?>" onblur="sum_salary()"/></td>
              </tr>
            	<tr>
                	<td class="text_1">LTA</td>
                    <td><input type="text" name="salary_lta" id="salary_lta" style="width:180px; height:20px;" value="<?=$leave_travel_allow?>" onblur="sum_salary()"/></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1">Professional Tax</td>
                  <td width="50%"><input type="text" name="professional_tax" id="professional_tax" style="width:180px; height:20px;" value="<?=$professional_tax?>" onblur="sum_salary()"/></td>
              </tr>
                <tr>
                    <td class="text_1">TDS</td>
                    <td><input type="text" name="tds" id="tds" style="width:180px; height:20px;" value="<?=$tds?>" onblur="sum_salary()"/></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td>
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" >
            	<tr>
                	<td width="49%" class="text_1">HRA</td>
                  <td width="51%"><input type="text" name="salary_hra" id="salary_hra" style="width:180px; height:20px;" value="<?=$hra?>" onblur="sum_salary()"/></td>
              </tr>
            	<tr>
                	<td class="text_1">Side Allowance</td>
                    <td><input type="text" name="side_allowance" id="side_allowance" style="width:180px; height:20px;" value="<?=$side_allowance?>" onblur="sum_salary()"/></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1">PF</td>
                    <td width="50%">

                    <input type="hidden" name="pf_rate" id="pf_rate" value="<?=getAccountDetail('pf_rate',$id)?>"/>
        <?php if($basic >= 6500 ){	$pf=(getAccountDetail('pf_rate',$id)*6500)/100;} 
	else { $pf=(getAccountDetail('pf_rate',$id)*$basic)/100;}  ?>
					<input type="text" name="pf_value" id="pf_value" style="width:180px; height:20px;" value="<?php echo  $pf;?>" disabled="disabled"/></td>
              </tr>
                <tr>
                    <td class="text_1">ESI</td>
                    <td>
                    <input type="hidden" name="esi_rate" id="esi_rate" value="<?=getAccountDetail('esic_rate',$id)?>"/>
                    <input type="text" name="esi_value" id="esi_value" style="width:180px; height:20px;" value="<?=$esi=round((getAccountDetail('esic_rate',$id)*$total_earning)/100,2);?>" disabled="disabled"/></td>
                </tr>
            </table>
        </td>
    </tr>
        <tr>
    	<td>
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="49%" class="text_1">Convence</td>
                    <td width="51%"><input type="text" name="convence" id="convence" style="width:180px; height:20px;" value="<?=$convence?>" onblur="sum_salary()"/></td>
              </tr>
                <tr>
                    <td class="text_1">Medical</td>
                    <td><input type="text" name="medical" id="medical" style="width:180px; height:20px;" value="<?=$medical?>" onblur="sum_salary()"/></td>
                </tr>
            </table>
        </td>
        <td valign="top">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1">Other Deduction's</td>
                    <td width="50%"><input type="text" name="other_deduction" id="other_deduction" style="width:180px; height:20px;" value="<?=$other_deductions?>" onblur="sum_salary()"/></td>
              </tr>
              <tr>
                    <td width="50%" class="text_1">Effective Date</td>
                    <td width="50%"><form name="frm_emp_list" id="frm_emp_list"><input type="text" name="from_date" id="from_date" style="width:130px; height:20px;" value="<?=getDatetime($from_date)?>"/>	 <a href="javascript:void(0)" onclick="gfPop.fPopCalendar(document.frm_emp_list.from_date);"><img name="popcal" align="absbottom" src="./calendar/calbtn.gif" width="27" height="22" border="0" alt=""/></a> </form>
                    </td>
              </tr>
            </table>
        </td>
    </tr>
     <tr>
    	<td>
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="49%" class="text_1"><strong>Earnings</strong></td>
                    <td width="51%"><input type="text" name="total_earning" id="total_earning" style="width:180px; height:20px;" value="<?=$total_earning?>" disabled="disabled"/></td>
              </tr>
            </table>
        </td>
        <td valign="top">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0">
                <tr>
                    <td width="50%" class="text_1"><strong>Deduction's</strong></td>
                    <td width="50%"><? $total_deduction=$professional_tax+$tds+$other_deductions+$pf+$esi?><input type="text" name="total_deduction" id="total_deduction" style="width:180px; height:20px;" value="<?=$total_deduction?>" disabled="disabled"/></td>
              </tr>
            </table>
        </td>
    </tr>  
    <tr>
    	<td colspan="2" align="center">
        	<input type="image" src="images/btn_submit.png" name="submit_salary" id="submit_salary" value="Submit" onclick="post_frm_long('salary_update.php',document.getElementById('salary_basic').value,'div_detail',document.getElementById('salary_lta').value,document.getElementById('convence').value,document.getElementById('medical').value,document.getElementById('salary_hra').value,document.getElementById('side_allowance').value,document.getElementById('professional_tax').value,document.getElementById('tds').value,document.getElementById('other_deduction').value,'<?=$id?>',document.getElementById('from_date').value)"/>
            <input type="hidden" name="emp_id" id="emp_id" value="<?=$id?>"/>
            <input type="hidden" name="update" id="update" value="<?=$id?>"/>
        </td>
    </tr>
</table>
</div>
