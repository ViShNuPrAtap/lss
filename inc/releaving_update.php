<link rel="stylesheet" href="css/BeatPicker.min.css"/>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/BeatPicker.min.js"></script>
<? include ("inc/dbconnection.php");?>
<? include ("inc/function.php");?>
<?
$date_releaving = "";
$reason_realeaving = "";
$emp_id = "";
$id=$_POST["str1"];
if(isset($_POST["str4"]))
{
	$date_releaving = getdbDateSepretoe($_POST["str4"]);
	$reason_realeaving = $_POST["str5"];
	$emp_id = $_POST["str6"];
}

//echo $weekly_off;
if($id==1)
{
 $sql_check1 = "update ".$mysql_table_prefix."account_detail set	
																date_releaving  ='$date_releaving',
																reason_realeaving='$reason_realeaving'
																where emp_id='$emp_id'";
																
$result_check1=mysql_query($sql_check1) or die ("Query Failed ".mysql_error());

?>
<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
	<tr>
    	<td colspan="2" class="blackHead">Releaving Detail</td>
        
    </tr>
	<tr>
    	<td align="left" valign="top">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
            	<tr>
                	<td class="text_1">Date of Leaving</td>
                    <td><?=$date_releaving=getDatetime($date_releaving)?></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
                <tr>
                    <td class="text_1" valign="top">Reason</td>
                    <td><?=$reason_realeaving?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td colspan="2" align="center">
        	<a onclick="post_frm('releaving_update.php','0','div_update_releave','','<?=$date_releaving?>','<?=$reason_realeaving?>','<?=$emp_id?>')">Edit</a>
            <input type="hidden" name="emp_id" id="emp_id" value="<?=$emp_id?>"/>
        </td>
    </tr>
</table>
<?
} else if($id==0)
{
?>
        <form action="" method="post" name="frm_releaving" id="frm_releaving">
	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
	<tr>
    	<td colspan="2" class="blackHead">Releaving Detail</td>
    </tr>
	<tr>
    	<td align="left" valign="top">
        	<table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
            	<tr>
                	<td class="text_1">Date of Leaving</td>
                    
                    <!-- my code -->
                     <!--<td><input type="text" name="releaving_date" id="releaving_date" style="width:150px; height:20px;" value="<?=getDatetime($date_releaving)?>" data-beatpicker="true" data-beatpicker-position="['right','*']" data-beatpicker-format="['DD','MM','YYYY']" /></td> --> 
                    <!--My code End Here -->
                    
                    <td><input type="text" name="releaving_date" id="releaving_date" style="width:180px; height:20px;" readonly="readonly" value="<?//=getDatetime($date_releaving)?>" data-beatpicker="true" data-beatpicker-position="['right','*']" data-beatpicker-format="['DD','MM','YYYY']" />
                   <a href="javascript:void(0)" onclick="gfPop.fPopCalendar(document.frm_releaving.releaving_date);"><img name="popcal" align="absbottom" src="./calendar/calbtn.gif" width="27" height="22" border="0" alt=""/></a></td>
                </tr>
            </table>
        </td>
        <td>
            <table width="100%" cellpadding="2" cellspacing="2" align="center" border="0" class="border">
                <tr>
                    <td class="text_1" valign="top">Reason</td>
                    <td><textarea name="releaving_reason" id="releaving_reason" rows="4" cols="35"><?=$reason_realeaving?></textarea></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
    	<td colspan="2" align="center">
        	<a onclick="post_frm('releaving_update.php','1','div_update_releave','',document.getElementById('releaving_date').value,document.getElementById('releaving_reason').value,'<?=$emp_id?>')"><img src="images/btn_submit.png" border="0"/></a>
            <input type="hidden" name="emp_id" id="emp_id" value="<?=$emp_id?>"/>
        </td>
    </tr>
</table>
</form>
<?
}
?>