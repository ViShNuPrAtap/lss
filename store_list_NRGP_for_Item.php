<? include("inc/store_header.php"); ?>
<script type="text/javascript">
function overlay(id) {
  el = document.getElementById("overlay");
	document.getElementById("hidden_overlay").value=id;
	el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";	
}
function getDataInDiv(value,divId,page,byControl)
{
	if(byControl=="NRGPDate")
		value=document.getElementById("NRGPDate").value;
	var strURL1=page+"?value="+value+"&byControl="+byControl;
	if(value!='')
	{
		var req = getXMLHTTP();
		if (req)
		{																					
				req.onreadystatechange = function() {
						if (req.readyState == 4) {
								if (req.status == 200)                         
										document.getElementById(divId).innerHTML=req.responseText;
								 else 
										alert("There was a problem while using XMLHTTP:\n" + req.statusText);
						}
					}            
				req.open("GET", strURL1, true);
				req.send(null);
		}
	}
}
</script>

<?
$Page = "store_list_NRGP_for_Item.php";
$PageTitle = "List NRGP For Item";
$PageFor = "NRGP For Item";
$PageKey = "NRGP_id";
$PageKeyValue = "";
$Message = "";

if(date('m') > 03){	$gFinYear = date('Y').'-'.(date('Y')+1);	}else{	$gFinYear = (date('Y')-1).'-'.date('Y');	}

if(isset($_GET["Message"])){
	$Message = $_GET["Message"];
}
if(isset($_POST["btn_del"]))
{
	$PageKeyValue  = $_POST["hidden_overlay"];
	$sql = "delete from ms_NRGP_master where $PageKey = '".$PageKeyValue."'";
	
	if(mysql_query ($sql))
	{
	 	$sqltrans = "delete from ms_NRGP_Item_transaction where  $PageKey = '".$PageKeyValue."'";
	 	if(mysql_query($sqltrans))
			$Message = "Record Sucessfully Deleted";
	}
	//$Message = "Order Sucessfully Deleted";
	redirect("$Page?Message=$Message");
}

?>
<?
$sql="select mm.NRGP_id,mm.NRGP_date,mm.supplier_id,mt.item_name from ms_NRGP_master mm,ms_NRGP_Item_transaction mt where mm.NRGP_id=mt.NRGP_id order by mm.NRGP_id asc";
$result=mysql_query($sql) or die("Error in : ".$sql."<br>".mysql_errno()." : ".mysql_error());
$rn=mysql_num_rows($result);

?>
<table width="98%" cellpadding="0" cellspacing="0" align="center" border="0">
  <tr>
    <td align="left" valign="top" width="230px" style="padding-top:5px;" >
    	<? include ("inc/store_snb.php"); ?>
    </td>
    <td style="padding-left:5px; padding-top:5px;" valign="top">
      <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
        <tr>
          <td align="center" class="gray_bg">
            <img src="images/bullet.gif" width="15" height="22"/> &nbsp; List NRGP For Item
          </td>
        </tr>
        <tr>
          <td valign="top">
            <table align="center" width="100%" cellpadding="0" cellspacing="0" border="0">
              <tr>
                <td align="center" class="border">
                   <div id="div_message" style="color:#399;font-size:16px;font-weight:bold;"><?=$Message?></div>
                    <table align="center" width="100%" border="1" class="table1 text_1">
                      <tr>
                        <td align="center" colspan="4"><b>Search Items</b></td>
                      </tr>
                      <tr>
                        <td align="left"><b>NRGP No.</b></td>
                        <td align="left">
                          <input type="text" name="NRGP_id" id="NRGP_id" onkeyup="getDataInDiv(this.value,'getItemsInDiv','store_get_list_NRGP_for_Item.php','NRGP_id')" />
                        </td>
                        <td align="left"><b>Supplier</b></td>
                        <td align="left">
                        <select name="supplier_id" id="supplier_id" style="width:145px;" onchange="getDataInDiv(this.value,'getItemsInDiv','store_get_list_NRGP_for_Item.php','Supplier')">
                            <option value="0"></option>
                            <?
                            $sql_sup= "select * from ms_supplier order by name asc";
                            $res_sup = mysql_query ($sql_sup) or die ("Invalid query : ".$sql_sup."<br>".mysql_errno()." : ".mysql_error());
                            if(mysql_num_rows($res_sup)>0)
                            {
                              while($row_sup = mysql_fetch_array($res_sup))
                              {
                              ?>
                                <option value="<?= $row_sup['supplier_id']?>"><?= $row_sup['name']?></option>
                              <?
                              }
                            }	
                            ?>
                          </select>
                        </td>
                       </tr>
                       <tr>
                        <td align="left"><b>NRGP Date</b></td>
                        <td align="left">
                          <input type="text" name="NRGPDate" id="NRGPDate"/>
                            <a href="javascript:void(0)" HIDEFOCUS
                              onClick="gfPop.fPopCalendar(document.getElementById('NRGPDate'));return false;">
                              <img name="popcal" align="absbottom" src="./calendar/calbtn.gif" width="34" height="22" border="0" alt="">
                            </a> 
                          <input type="button" id="btnOk" name="btnOk" value="Ok" onclick="getDataInDiv('','getItemsInDiv','store_get_list_NRGP_for_Item.php','NRGPDate')"/>
                        </td>
                        <td align="left"><b>Item Name</b></td>
                        <td align="left">
                        <input name="item_id" id="item_id" type="text" style="width:145px;" onkeyup="getDataInDiv(this.value,'getItemsInDiv','store_get_list_NRGP_for_Item.php','ItemName')"/>
                        </td>
                      </tr>
                      <tr>
                        <td align="left"><b>Department</b></td>
                        <td align="left" colspan="3">
                        	<select name="department_id" id="department_id" style="width:145px;" onchange="getDataInDiv(this.value,'getItemsInDiv','store_get_list_NRGP_for_Item.php','Department')">
                            <option value="0"></option>
                            <?
                            $sql_D= "select * from ms_department order by name asc";
                            $res_D = mysql_query ($sql_D) or die ("Invalid query : ".$sql_D."<br>".mysql_errno()." : ".mysql_error());
                            if(mysql_num_rows($res_D)>0)
                            {
                              while($row_D = mysql_fetch_array($res_D))
                              {
                              ?>
                                <option value="<?= $row_D['department_id']?>"><?= $row_D['name']?></option>
                              <?
                              }
                            }	
                            ?>
                          </select>
                        </td>
                      </tr>
                    </table>
                    <div id="getItemsInDiv" style="margin:0 auto;width:100%;overflow:auto;height:800px">
                      <table align="center" width="100%" border="1" class="table1 text_1">
                        <tr>
                          <td class="gredBg">S.No.</td>
                          <td class="gredBg">NRGP No.</td>
                          <td class="gredBg">NRGP Date</td>
                          <td class="gredBg">Supplier</td>
                          <td class="gredBg">Item Name</td>
                          <td width="4%" class="gredBg">View</td>  
                          <td width="4%" class="gredBg">Edit</td>
                          <td width="4%" class="gredBg">Delete</td>
                       </tr>	
                        <?  
                        if(mysql_num_rows($result)>0)
                        {
                          $sno = 1;$oldid = "";$count =1;
                          while($row=mysql_fetch_array($result))
                          {	
                            $sql_idate="select * from ms_NRGP_master where insert_date='".date('Y-m-d')."' and NRGP_id='".$row['NRGP_id']."'";
                            $res_idate=mysql_query($sql_idate);	
                            $row_idate=mysql_fetch_array($res_idate);
                            $insert_date=$row_idate['insert_date'];
                            ?>
                            <tr <? if ($sno%2==1) { ?> bgcolor="#F5F2F1" <? } ?>>
                              <td align="center"><?=$sno?></td>
                              <td align="center"><?= $row['NRGP_id']?></td>
                              <td align="center"><?=getDateFormate($row['NRGP_date']);?></td>
                              <td align="left" style="padding-left:5px">
                              <?
                                $sql_sup= "select * from ms_supplier where supplier_id='".$row['supplier_id']."'";
                                $res_sup = mysql_query ($sql_sup) or die (mysql_error());
                                $row_sup = mysql_fetch_array($res_sup);
                                echo $row_sup['name'];
                               ?>
                              </td>
                              <td align="left" style="padding-left:5px"><?= $row['item_name']?></td>
                              <?
                              if($row['NRGP_id']!=$oldid)
                              {
                                $oldid = $row['NRGP_id'];
                                $count=1;
                              }
                              $sql_tr="select * from ms_NRGP_Item_transaction where NRGP_id='".$oldid."'";
                              $res_tr=mysql_query($sql_tr);
                              $row_count=mysql_num_rows($res_tr);
                              if($count==1)
                              {
                                ?>
                                 <td align="center" rowspan="<?=$row_count?>">
                                   <a href="store_view_NRGP_for_Item.php?NRGP_id=<?=$row["NRGP_id"]?>">
                                    <img src="images/search-icon.gif" alt="View" title="View" border="0" />
                                   </a>
                                  </td> 
                                <?
                                if($SessionUserType=='Administrator' || (date('Y-m-d')==$insert_date))
                                {
                                ?>
                                <td align="center" rowspan="<?=$row_count?>">
                                  <a href="store_add_NRGP_for_Item.php?NRGP_id=<?=$row["NRGP_id"]?>&mode=edit">
                                    <img src="images/icon_edit.gif" alt="Edit" title="Edit" border="0" />
                                  </a>
                                </td>
                                <td align="center" rowspan="<?=$row_count?>">
                                  <a href="javascript:;" onClick="overlay(<?=$row["NRGP_id"]?>);">
                                  <img src="images/delete_icon.gif" alt="Delete" title="Delete" border="0">
                                  </a>
                                </td>
                                  <?
                                }
                                else
                                {
                                ?>
                                 <td rowspan="<?=$row_count?>"></td>
                                 <td rowspan="<?=$row_count?>"></td>   
                                <?
                                }
                              }
                              $count++;
                            ?>                                     
                           </tr>
                          <?
                           $sno++;
                          }	
                        }
                        else
                        {
                          ?>
                            <tr><td align="center" colspan="8"><b>No Record Found.</b></td></tr>
                          <?
                        }
                        ?>
                      </table>      
                    </div>
                  </td>
               </tr>
            </table>
          </td>
        </tr>  
      </table> 
    </td>
	</tr>
</table> 
<iframe width=168 height=190 name="gToday:normal:agenda.js" id="gToday:normal:agenda.js" src="calendar/ipopeng.htm" scrolling="no" frameborder="0" style="border:2px ridge; visibility:visible; z-index:999; position:absolute; left:-500px; top:0px;">
</iframe> 
<div id="overlay">
     <div class="form_msg">
          <p>Are you sure to delete this Record</p>
          <form name="frm_del" action="<?=$_SERVER['PHP_SELF']?>" method="post">
          <input type="hidden" name="hidden_overlay" id="hidden_overlay" value="" />
          <input type="submit" name="btn_del" value="Yes" />
          <input type="button" onClick="overlay();" name="btn_close" value="No" />
          </form>
     </div>
</div>

<? 
include("inc/hr_footer.php");
?>