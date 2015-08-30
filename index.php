<?php
ini_set("display_errors","off");
/* MySql Connect */
require_once("sql_connect.php");
/* End Mysql Connect  */
/* Php Function */
function Display_error($arr1,$arr2=null,$arr3=null){
  exit(json_encode("result"=>$arr1,$arr2=>$arr3));
}
function new_Purchase($product){
  
}
/* End Function */ 
if(isset($_GET["do"])):
define(__do__,mysql_real_escape_string($_GET["do"]),true);
if(__do__=="purchase"){
  if(isset($_GET["product"],$_GET["phone"],$_GET["token"])):
    define(__topup__,$_GET["product"],true);
    define(__token__,mysql_real_escape_string($_GET["token"]),true);
    $info=array(
      'price'=>trim(__topup__),
      'phone'=>trim($_GET["phone"]),
      'token'=>trim($_GET["token"]),
      'product'=>"Truemoney : ".trim(__topup__)
    );
    $urltoken=mysql_fetch_array(mysql_query("SELECT * FROM table WHERE token = '__token__'"));
    if($urltoken["credit"]>trim(__topup__)){
      if($urltoken["block"]==true){Display_error("urltoken_block");}
      $purchase=new_Purchase(__topup__);
      Display_error("purchase_success");
    }else{Display_error("getmore_credit");}
  endif;
}
endif;
?>
