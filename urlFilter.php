<?php
header('Content-type: text/html; charset=UTF8');
//Code By Safe
function customError($errno, $errstr, $errfile, $errline){ 
  echo "<script>alert('<b>Error number:</b> [".$errno."],error on line ".$errline." in ".$errfile."<br />');</script>";
  die();
}

set_error_handler("customError",E_ERROR);

$getfilter="'|(and|or)\\b.+?(>|<|=|in|like)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

$postfilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

$cookiefilter="\\b(and|or)\\b.{1,6}?(=|>|<|\\bin\\b|\\blike\\b)|\\/\\*.+?\\*\\/|<\\s*script\\b|\\bEXEC\\b|UNION.+?SELECT|UPDATE.+?SET|INSERT\\s+INTO.+?VALUES|(SELECT|DELETE).+?FROM|(CREATE|ALTER|DROP|TRUNCATE)\\s+(TABLE|DATABASE)";

function StopAttack($StrFiltKey,$StrFiltValue,$ArrFiltReq){
	 if(is_array($StrFiltValue)){
		 $StrFiltValue=implode($StrFiltValue);
	 }  
	 if(preg_match("/".$ArrFiltReq."/is",$StrFiltValue)==1){   
			 echo "<script>alert('参数不合法!');</script>";
			 exit();
	 }      
}  

foreach($_GET as $key=>$value){ 
  StopAttack($key,$value,$getfilter);
}

foreach($_POST as $key=>$value){ 
  StopAttack($key,$value,$postfilter);
}

foreach($_COOKIE as $key=>$value){ 
  StopAttack($key,$value,$cookiefilter);
}

?>
