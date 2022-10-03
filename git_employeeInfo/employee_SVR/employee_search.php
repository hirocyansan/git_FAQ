<?php
require_once("util.php");
require_once("function_em.php");
require_once("login_database.php");
setLocale(LC_ALL, 'English_United States.1252');

   
// echo "行番号:".__LINE__."<br />";
?>

<?php

// ----- $pageNumber=0にして他の設定値はそのまま書込（ファイルがなければデフォルト値設定） -----

// セッション開始
session_start();

// $filename = "..\parameters.txt";
$pageNumber = 0;
if (isset($_SESSION['parameters'])) {
	//$pageNumberのみ値変更して書き込み
//	$filename = "..\parameters.txt";
	$mergedData = $_SESSION['parameters'];
	$kwd = explode("#", $mergedData);
	$KwdSetStatus = $kwd[1];
	$searchType = $kwd[2];
	$kwdNamePrev = $kwd[3];
	$kwdMemberCodePrev = $kwd[4];
	$kwdRolePrev = $kwd[5];
	$kwdOfficePrev = $kwd[6];
	$kwdDepartmentPrev = $kwd[7];
	$kwdCompanyPrev = $kwd[8];
	$kwdMeadPrev = $kwd[9];
//	if ($orderType == null){ $orderType = 'orderAsc';} else { $orderType = $kwd[10];}
	$orderType = $kwd[10];
	$sortRule = $kwd[11];
} else{
// echo  "行番号:".__LINE__."<br />";
	$KwdSetStatus = 'kwdReset';
	$searchType = 'andSearch';
	$kwdNamePrev = "no_keyword";
	$kwdMemberCodePrev = "no_keyword";
	$kwdRolePrev = "no_keyword";
	$kwdOfficePrev = "no_keyword";
	$kwdDepartmentPrev = "no_keyword";
	$kwdCompanyPrev = "no_keyword";
	$kwdMeadPrev = "no_keyword";
	$orderType = 'orderAsc';
	$sortRule = 'no_keyword';
}
$mergedData = $pageNumber.'#'.$KwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
              $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
              $orderType.'#'.$sortRule;
$_SESSION['parameters'] = $mergedData;


if($_SERVER['REQUEST_METHOD']=='POST') {

//	----- 検索結果を表示するページへ移行 -----  

	if (isset($_POST['startSearch'])){
		//  検索条件が入力されていない場合、トップに戻す
//		if ((es($_POST["kwdName"]) !== "")||(es($_POST["kwdMemberCode"]) !== "")
		if ((es($_POST["kwdName"]) !== "")
		||(es($_POST["kwdRole"]) !== "")||(es($_POST["kwdOffice"]) !== "")
		||(es($_POST["kwdDepartment"]) !=="")||(es($_POST["kwdCompany"]) !== "")
		||(es($_POST["kwdMead"]) !== "")){

		//$pageNumberのみ値変更して書き込み
//			$filename = "..\parameters.txt";
 			
			$mergedData = $_SESSION['parameters'];
			$kwd = explode("#", $mergedData);
			$KwdSetStatus = $kwd[1];
			$searchType = $kwd[2];
			$kwdNamePrev = $kwd[3];
			$kwdMemberCodePrev = $kwd[4];
			$kwdRolePrev = $kwd[5];
			$kwdOfficePrev = $kwd[6];
			$kwdDepartmentPrev = $kwd[7];
			$kwdCompanyPrev = $kwd[8];
			$kwdMeadPrev = $kwd[9];
//			if ($orderType == ""){ $orderType = 'orderAsc';} else { $orderType = $kwd[10];}
			$orderType = $kwd[10];
			$sortRule = $kwd[11];

			$pageNumber = 1;
			$mergedData = $pageNumber.'#'.$KwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
	        	          $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
	                      $orderType.'#'.$sortRule;

			$_SESSION['parameters'] = $mergedData;
		}else{
			//$pageNumberのみ値変更して書き込み
//			$filename = "..\parameters.txt";
			$mergedData = $_SESSION['parameters'];
			$kwd = explode("#", $mergedData);
			$KwdSetStatus = $kwd[1];
			$searchType = $kwd[2];
			$kwdNamePrev = $kwd[3];
			$kwdMemberCodePrev = $kwd[4];
			$kwdRolePrev = $kwd[5];
			$kwdOfficePrev = $kwd[6];
			$kwdDepartmentPrev = $kwd[7];
			$kwdCompanyPrev = $kwd[8];
			$kwdMeadPrev = $kwd[9];
//			if ($orderType == ""){ $orderType = 'orderAsc';} else { $orderType = $kwd[10];}
			$orderType = $kwd[10];
			$sortRule = $kwd[11];
			
			$pageNumber = 2;
			$mergedData = $pageNumber.'#'.$KwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
	        	          $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
	                      $orderType.'#'.$sortRule;
			$_SESSION['parameters'] = $mergedData;

		// ワーニング表示
	  		$errors[] = '検索キーワードが入力されていません。';
  			foreach($errors as $row){
  				echo "<label>", $row,  "</label>";
  			}
    //<!-- 戻るボタンのフォーム -->
  			echo " <form method=\"POST\" action=\"employee_search.php\">";
  			echo "<input type=\"submit\" value=\"トップへ戻る\"　name=\"return2Top\">";
  			echo "</form>";
		}
	}
	
// ----- パラメータクリアボタンが押された場合 -----

	if (isset($_POST['parameterClear'])){
		$pageNumber = 0;
		$KwdSetStatus = 'kwdReset';
		$searchType = 'andSearch';
		$kwdNamePrev = "no_keyword";
		$kwdMemberCodePrev = "no_keyword";
		$kwdRolePrev = "no_keyword";
		$kwdOfficePrev = "no_keyword";
		$kwdDepartmentPrev = "no_keyword";
		$kwdCompanyPrev = "no_keyword";
		$kwdMeadPrev = "no_keyword";
		$orderType = 'orderAsc';
		$sortRule = 'no_keyword';

		$mergedData = $pageNumber.'#'.$KwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
	                  $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
                      $orderType.'#'.$sortRule;
		$_SESSION['parameters'] = $mergedData;

//		$filename = "..\parameters.txt";
		if(isset($_SESSION['parameters'])){
			$mergedData = $_SESSION['parameters'];
		}
	}

// ----- トップページへ戻る -----  

	if (isset($_POST['return2Top'])){

		$GLOBALS['pageNumber'] = 0;	
		//$kwdSetStatus、$pageNumberのみ値変更して書き込み
//		$filename = "..\parameters.txt";
		$mergedData = $_SESSION['parameters'];
		$kwd = explode("#", $mergedData);
		$searchType = $kwd[2];
		$kwdNamePrev = $kwd[3];
		$kwdMemberCodePrev = $kwd[4];
		$kwdRolePrev = $kwd[5];
		$kwdOfficePrev = $kwd[6];
		$kwdDepartmentPrev = $kwd[7];
		$kwdCompanyPrev = $kwd[8];
		$kwdMeadPrev = $kwd[9];
//		if ($orderType == ""){ $orderType = 'orderAsc';} else { $orderType = $kwd[10];}
		$orderType = $kwd[10];
		$sortRule = $kwd[11];

		$kwdSetStatus = 'kwdSet';
		$pageNumber = 0;
		$mergedData = $pageNumber.'#'.$KwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
   	    		      $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
                      $orderType.'#'.$sortRule;
		$_SESSION['parameters'] = $mergedData;
	}

// ----- 検索ソフト終了、設定クリア -----  

	if  (isset($_POST['return2Close'])){
		// 設定データクリア
		$pageNumber = 0;
		$KwdSetStatus = 'kwdReset';
		$searchType = 'andSearch';
		$kwdNamePrev = "no_keyword";
		$kwdMemberCodePrev = "no_keyword";
		$kwdRolePrev = "no_keyword";
		$kwdOfficePrev = "no_keyword";
		$kwdDepartmentPrev = "no_keyword";
		$kwdCompanyPrev = "no_keyword";
		$kwdMeadPrev = "no_keyword";
		$orderType = 'orderAsc';
		$sortRule = 'no_keyword';
		
		$mergedData = $pageNumber.'#'.$KwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
        	          $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
                      $orderType.'#'.$sortRule;
		$_SESSION['parameters'] = $mergedData;
		//　セッションのクリア
		unset($_SESSION['parameters']);		

		exit('処理を終了します。お疲れさまでした。');
	}
 }
?>

<?php

// parameters.txtファイルがあれば読み出し、なければ初期値を設定してファイル生成

// $filename = "..\parameters.txt";
if (isset($_SESSION['parameters'])) {
	$mergedData = $_SESSION['parameters'];
	$kwd = explode("#", $mergedData);
	$pageNumber = (int)$kwd[0];
	$kwdSetStatus = $kwd[1];
	$searchType = $kwd[2];
	$kwdNamePrev = $kwd[3];
	$kwdMemberCodePrev = $kwd[4];
	$kwdRolePrev = $kwd[5];
	$kwdOfficePrev = $kwd[6];
	$kwdDepartmentPrev = $kwd[7];
	$kwdCompanyPrev = $kwd[8];
	$kwdMeadPrev = $kwd[9];
//	if ($orderType == ""){ $orderType = 'orderAsc';} else { $orderType = $kwd[10];}
	$orderType = $kwd[10];
	$sortRule = $kwd[11];
}else{
	$pageNumber = 0;
	$kwdSetStatus = 'kwdReset';
	$searchType = 'andSearch';
	$kwdNamePrev = "no_keyword";
	$kwdMemberCodePrev = "no_keyword";
	$kwdRolePrev = "no_keyword";
	$kwdOfficePrev = "no_keyword";
	$kwdDepartmentPrev = "no_keyword";
	$kwdCompanyPrev = "no_keyword";
	$kwdMeadPrev = "no_keyword";
	$orderType = 'orderAsc';
	$sortRule = 'no_keyword';
	$mergedData = $pageNumber.'#'.$kwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
                  $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
                  $orderType.'#'.$sortRule;
	$_SESSION['parameters'] = $mergedData;
}


if ($GLOBALS['pageNumber'] == 0){
	titleDisplay();
	topListDisplay();
//	allListDisplay();

echo "</div>";
// echo  '<p align="right">&copy;Copyright ADVANTEC Grp.SYSTEM Div. All right reserved. REV1.0</p>';
echo "</body>";
echo "</html>";

}else{		// 以下、$pageNumber = 1の処理 ----------------------------
	if ($GLOBALS['pageNumber'] == 1){
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<title>検索結果の表示</title>
<link href="style_post.css" rel="stylesheet">
<!-- テーブル用のスタイルシート -->
<link rel="stylesheet" type="text/css" href="style2.css" >
</head>
<body>
<body onContextmenu="window.alert('右クリックは禁止です');return false" oncopy="window.alert('ctrl+cは禁止');return false;">
<style type="text/css">
/* ページ全体を印刷させない場合 */
@media print {
    body { display: none !important; }
}
</style> 
<div>
<?php
    // フォーム入力の値を得る（keyword）、入力kwdの左右の空白を削除
  $errors = [];
  $GLOBALS['searchType'] = trim(es($_POST["searchType"]));
  $GLOBALS['orderType'] = trim(es($_POST["orderType"]));
  $GLOBALS['sortRule'] = trim(es($_POST["sortRule"]));


//  var_dump($GLOBALS['orderType']);
//  var_dump($GLOBALS['sortRule']);
 
  $kwdName = preg_replace('/^[ 　]+/u', '', es($_POST["kwdName"]));
  $kwdName = preg_replace('/[ 　]+$/u', '', $kwdName);
  $GLOBALS['kwdNamePrev'] = $kwdName;
  $kwdName = (array)setKwd($GLOBALS['kwdNamePrev']);
 $i = 0;
 do{
  	$kwdName[$i] = preg_replace('/^[ 　]+/u', '', $kwdName[$i]);
  	$kwdName[$i] = preg_replace('/[ 　]+$/u', '', $kwdName[$i]);
  	$i ++;
  } while ($i < count($kwdName));

// var_dump($kwdName);echo "<br/>\n";

//  $GLOBALS['kwdMemberCodePrev'] = es($_POST["kwdMemberCode"]);
  $GLOBALS['kwdMemberCodePrev'] = "";
  $kwdMemberCode = (array)setKwd($GLOBALS['kwdMemberCodePrev']);

  $kwdRole = preg_replace('/^[ 　]+/u', '', es($_POST["kwdRole"]));
  $kwdRole = preg_replace('/[ 　]+$/u', '', $kwdRole);
  $GLOBALS['kwdRolePrev'] = $kwdRole;
  $kwdRole = (array)setKwd($GLOBALS['kwdRolePrev']);
 $i = 0;
 do{
  	$kwdRole[$i] =preg_replace('/^[ 　]+/u', '', $kwdRole[$i]);
  	$kwdRole[$i] = preg_replace('/[ 　]+$/u', '', $kwdRole[$i]);
  	$i ++;
  } while ($i < count($kwdRole));

  $kwdOffice = preg_replace('/^[ 　]+/u', '', es($_POST["kwdOffice"]));
  $kwdOffice = preg_replace('/[ 　]+$/u', '', $kwdOffice);
  $GLOBALS['kwdOfficePrev'] = $kwdOffice;
  $kwdOffice = (array)setKwd($GLOBALS['kwdOfficePrev']);
 $i = 0;
 do{
  	$kwdOffice[$i] =preg_replace('/^[ 　]+/u', '', $kwdOffice[$i]);
  	$kwdOffice[$i] = preg_replace('/[ 　]+$/u', '', $kwdOffice[$i]);
  	$i ++;
  } while ($i < count($kwdOffice));

  $kwdDepartment = preg_replace('/^[ 　]+/u', '', es($_POST["kwdDepartment"]));
  $kwdDepartment = preg_replace('/[ 　]+$/u', '', $kwdDepartment);
  $GLOBALS['kwdDepartmentPrev'] = $kwdDepartment;
  $kwdDepartment = (array)setKwd($GLOBALS['kwdDepartmentPrev']);
 $i = 0;
 do{
  	$kwdDepartment[$i] =preg_replace('/^[ 　]+/u', '', $kwdDepartment[$i]);
  	$kwdDepartment[$i] = preg_replace('/[ 　]+$/u', '', $kwdDepartment[$i]);
  	$i ++;
  } while ($i < count($kwdDepartment));

  $kwdCompany = preg_replace('/^[ 　]+/u', '', es($_POST["kwdCompany"]));
  $kwdCompany = preg_replace('/[ 　]+$/u', '', $kwdCompany);
  $GLOBALS['kwdCompanyPrev'] = $kwdCompany;
  $kwdCompany = (array)setKwd($GLOBALS['kwdCompanyPrev']);
 $i = 0;
 do{
  	$kwdCompany[$i] =preg_replace('/^[ 　]+/u', '', $kwdCompany[$i]);
  	$kwdCompany[$i] = preg_replace('/[ 　]+$/u', '', $kwdCompany[$i]);
  	$i ++;
  } while ($i < count($kwdCompany));


  $kwdMead = preg_replace('/^[ 　]+/u', '', es($_POST["kwdMead"]));
  $kwdMead = preg_replace('/[ 　]+$/u', '', $kwdMead);
  $GLOBALS['kwdMeadPrev'] = $kwdMead;
  $kwdMead = (array)setKwd($GLOBALS['kwdMeadPrev']);
 $i = 0;
 do{
  	$kwdMead[$i] =preg_replace('/^[ 　]+/u', '', $kwdMead[$i]);
  	$kwdMead[$i] = preg_replace('/[ 　]+$/u', '', $kwdMead[$i]);
  	$i ++;
  } while ($i < count($kwdMead));
  
$originalKwdName = $kwdName; 
$originalKwdMemberCode = $kwdMemberCode; 
$originalKwdRole = $kwdRole; 
$originalKwdOffice = $kwdOffice; 
$originalKwdDepartment = $kwdDepartment; 
$originalKwdCompany = $kwdCompany; 
$originalKwdMead = $kwdMead; 

// ----- 検索結果を表示する前に設定データをファイルへ保存 -----

    $kwdSetStatus = 'kwdSet';
	$mergedData = $pageNumber.'#'.$kwdSetStatus.'#'.$searchType.'#'.$kwdNamePrev.'#'.$kwdMemberCodePrev.'#'.
                  $kwdRolePrev.'#'.$kwdOfficePrev.'#'.$kwdDepartmentPrev.'#'.$kwdCompanyPrev.'#'.$kwdMeadPrev.'#'.
                  $orderType.'#'.$sortRule;
                  
//    var_dump($mergedData);
	$_SESSION['parameters'] = $mergedData;

 echo ' <div class="Header1">';
 echo "<div>","<h1 align=\"center\">",'<font color ="444444">',"#### 検索結果 ####","</font></h1>","</div>"; 

   // 戻るボタンのフォーム 
   echo ' <form method="POST" action="">';

   echo '<ul>';
   echo "<nobr>",'<font color ="444444">',"■検索結果  (確認後)  ---->";

   // 入力したkwdは全てリセットをデフォルト設定

  echo '<input type="submit" class ="button1" value="トップへ戻る" name="return2Top">';
  echo '&nbsp;&nbsp;&nbsp;終了する場合は  ---->';echo '<input type="submit" class ="button1" value="終了" name="return2Close"></font></nobr>';
  echo '<ul><font color ="444444">';echo "<SPAN style=\"margin-left:-40px\">","■検索条件：  ";
  if ($GLOBALS['searchType'] ==="orSearch"){
  	echo 'ORサーチ'; 
  }else{
  	echo 'ANDサーチ';  
  }

if ($sortRule != 'no_keyword'){
	echo "&nbsp; &nbsp;&nbsp; &nbsp;◦並べ替え対象: $sortRule"; 
	if ($orderType == 'orderAsc'){ echo '&nbsp; &nbsp;◎昇順';} else { echo '&nbsp; &nbsp;◎降順';}
}
echo "</span>";echo "</li>";

   
//  入力されたキーワードの確認表示

if ($originalKwdName != 'no_keyword'){
  echo "<li>";echo "<span>"; echo  "検索キーワード(氏名)：　";	
  $i = 0;
  do{ echo $originalKwdName[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
  }while(count((array)$originalKwdName)> $i );
  echo "</span>";echo "</li>";
} else {
  echo  "<li>";echo "<span>"; echo  "検索キーワード(氏名):なし", "</span>";echo "</li>";		
}	

//if ($originalKwdMemberCode != false){
//  echo "<li>";echo "<span>"; echo  "検索キーワード(社員番号)：　";
//  $i = 0;
//  do{ echo $originalKwdMemberCode[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
//  }while(count((array)$originalKwdMemberCode)> $i );
//  echo "</span>";echo "</li>";
//} else {
//  echo  "<li>";echo "<span>"; echo  "検索キーワード(社員番号):なし","</span>";echo "</li>";	
//}

if ($originalKwdRole != 'no_keyword'){
  echo "<li>";echo "<span>"; echo  "検索キーワード(役職)：　";
  $i = 0;
  do{ echo $originalKwdRole[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
  }while(count((array)$originalKwdRole)> $i );
  echo "</span>";echo "</li>";
} else {
  echo  "<li>";echo "<span>"; echo  "検索キーワード(役職):なし","</span>";echo "</li>";	
}

if ($originalKwdDepartment != 'no_keyword'){
  echo "<li>";echo "<span>"; echo  "検索キーワード(部署)：　";
  $i = 0;
  do{ echo $originalKwdDepartment[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
  }while(count((array)$originalKwdDepartment)> $i );
  echo "</span>";echo "</li>";
} else {
  echo  "<li>";echo "<span>"; echo  "検索キーワード(部署):なし","</span>";echo "</li>";	
}

if ($originalKwdOffice != 'no_keyword'){
  echo "<li>";echo "<span>"; echo  "検索キーワード(事業所)：　";
  $i = 0;
  do{ echo $originalKwdOffice[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
  }while(count((array)$originalKwdOffice)> $i );
  echo "</span>";echo "</li>";
} else {
  echo  "<li>";echo "<span>"; echo  "検索キーワード(事業所):なし","</span>";echo "</li>";	
}

if ($originalKwdCompany != 'no_keyword'){
  echo "<li>";echo "<span>"; echo  "検索キーワード(会社)：　";
  $i = 0;
  do{ echo $originalKwdCompany[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
  }while(count((array)$originalKwdCompany)> $i );
  echo "</span>";echo "</li>";
} else {
  echo  "<li>";echo "<span>"; echo  "検索キーワード(会社):なし","</span>";echo "</li>";	
}

if ($originalKwdMead != 'no_keyword'){
  echo "<li>";echo "<span>"; echo  "検索キーワード(メールアドレス)：　";
  $i = 0;
  do{ echo $originalKwdMead[$i], '&nbsp; &nbsp; &nbsp; ';$i ++;
  }while(count((array)$originalKwdMead)> $i );
  echo "</span>";echo "</li>";
} else {
  echo  "<li>";echo "<span>"; echo  "検索キーワード(メールアドレス):なし","</span>";echo "</li>";	
}

  echo '</font></ul>';

 
   // テーブルのタイトル行
   	echo "<br/>\n";
	echo "<table class=\"info2\">";
  	echo "<tr>";
   	echo "<th class=\"th00\">", "No.", "</th>";
   	echo "<th class=\"th0\">", "氏名", "</th>";
//  	echo "<th class=\"th1\">", "社員番号", "</th>";
  	echo "<th class=\"th2\">", "役職", "</th>";
 	echo "<th class=\"th4\">", "部署", "</th>";  	
  	echo "<th class=\"th3\">", "事業所", "</th>";
  	echo "<th class=\"th5\">", "会社", "</th>";
  	echo "<th class=\"th6\">", "メールアドレス", "</th>";
//  	echo "<th class=\"th7\">", "電話番号", "</th>";
  	echo "</tr>";


 	echo "</table>"," </div>";
 	echo '<div class="Contents1">';
 	echo "<table class=\"info2\">";

	// SQLサーバに接続
  	list($pdo,$table_list) = connect2db(); 

$collateType = getCollateType();
if ($GLOBALS['searchType'] === "andSearch"){

	$sql = "";
    if ($kwdName[0] !== ""){
		foreach ($kwdName as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE((氏名 COLLATE $collateType LIKE '%". $row ."%')";
			 	$positionIndicator = 1;
			 }else { 
			 	$sql = $sql."OR (氏名 COLLATE $collateType LIKE '%". $row ."%')"; 
	 		}
		} 
	 	if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
	 }
//	$positionIndicator = 0;
//    if ($kwdMemberCode[0] !== ""){
//		foreach ($kwdMemberCode as $row) {
//			 if ( $sql == "") { 
//			 	$sql = " SELECT * FROM $table_list WHERE((社員番号 COLLATE $collateType LIKE '%". $row ."%')";
//			 	$positionIndicator = 1;
//			 }else { 
//			 	if ($positionIndicator == 1){
//			 		$sql = $sql."OR (社員番号 COLLATE $collateType LIKE '%". $row ."%')"; 
//			 	} else{
//			 		$sql = $sql."AND ((社員番号 COLLATE $collateType LIKE '%". $row ."%')"; 
//				 	$positionIndicator = 1;
//			 	}
//	 		}
//		} 
// 	if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
//	}
    $positionIndicator = 0;
    if ($kwdRole[0] !== ""){
		foreach ($kwdRole as $row) {
			 if ( $sql == ""){ 
			 	$sql = " SELECT * FROM $table_list WHERE((役職 COLLATE $collateType LIKE '%". $row ."%')";
			 	$positionIndicator = 1;
			 }else { 
			 	if ($positionIndicator == 1){
			 		$sql = $sql."OR (役職 COLLATE $collateType LIKE '%". $row ."%')"; 
			 	} else{
			 		$sql = $sql."AND ((役職 COLLATE $collateType LIKE '%". $row ."%')"; 
				 	$positionIndicator = 1;
			 	}
	 		}
		} 
 	if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
 	}
    $positionIndicator = 0;
    if ($kwdOffice[0] !== ""){
		foreach ($kwdOffice as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE((事業所 COLLATE $collateType LIKE '%". $row ."%')";
			 	$positionIndicator = 1;
			 }else { 
			 	if ($positionIndicator == 1){
			 		$sql = $sql."OR (事業所 COLLATE $collateType LIKE '%". $row ."%')"; 
			 	} else{
			 		$sql = $sql."AND ((事業所 COLLATE $collateType LIKE '%". $row ."%')"; 
				 	$positionIndicator = 1;
			 	}
	 		}
		}
 	if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
 	}
    $positionIndicator = 0;
    if ($kwdDepartment[0] !== ""){
		foreach ($kwdDepartment as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE((部署 COLLATE $collateType LIKE '%". $row ."%')";
			 	$positionIndicator = 1;
			 }else { 
			 	if ($positionIndicator == 1){
			 		$sql = $sql."OR (部署 COLLATE $collateType LIKE '%". $row ."%')"; 
			 	} else{
			 		$sql = $sql."AND ((部署 COLLATE $collateType LIKE '%". $row ."%')"; 
				 	$positionIndicator = 1;
			 	}
	 		}
		} 
 	if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
 	}
    $positionIndicator = 0;
    if ($kwdCompany[0] !== ""){
		foreach ($kwdCompany as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE((会社 COLLATE $collateType LIKE '%". $row ."%')";
			 	$positionIndicator = 1;
			 }else { 
			 	if ($positionIndicator == 1){
			 		$sql = $sql."OR (会社 COLLATE $collateType LIKE '%". $row ."%')"; 
			 	} else{
			 		$sql = $sql."AND ((会社 COLLATE $collateType LIKE '%". $row ."%')"; 
				 	$positionIndicator = 1;
			 	}
	 		}
		} 	
 		if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
	}
    $positionIndicator = 0;
    if ($kwdMead[0] != ""){
		foreach ($kwdMead as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE((メールアドレス COLLATE $collateType LIKE '%". $row ."%')";
			 	$positionIndicator = 1;
			 }else { 
			 	if ($positionIndicator == 1){
			 		$sql = $sql."OR (メールアドレス COLLATE $collateType LIKE '%". $row ."%')"; 
			 	} else{
			 		$sql = $sql."AND ((メールアドレス COLLATE $collateType LIKE '%". $row ."%')"; 
				 	$positionIndicator = 1;
			 	}
	 		}
		} 
 		if (substr_count($sql, '(') > substr_count($sql, ')')){ $sql = $sql. ')'; }
 	}

}else{

 // ------------- OR検索 -----------------
	 // 大文字小文字/全角半角を区別しないで比較　https://qiita.com/kazu56/items/6af85ffcf8d3954455ad
	$sql = "";
	if ($kwdName[0] != ""){
		foreach ($kwdName as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE(氏名 COLLATE $collateType LIKE '%". $row ."%')"; 
			 }else { 
			 	$sql = $sql."OR (氏名 COLLATE $collateType LIKE '%". $row ."%')";
			 }
		}
	}
//	if ($kwdMemberCode[0] != ""){	
//		foreach ($kwdMemberCode as $row) {
//			 if ( $sql == "") { 
//			 	$sql = " SELECT * FROM $table_list WHERE(社員番号=$row)"; 
//			 }else { 
//			 	$sql = $sql."OR (社員番号=$row)";
//			 }
//		}
//	}
	if ($kwdRole[0] != ""){
		foreach ($kwdRole as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE(役職 COLLATE $collateType LIKE '%". $row ."%')"; 
			 }else { 
			 	$sql = $sql."OR (役職 COLLATE $collateType LIKE '%". $row ."%')";
			 }
		}
	}
	if ($kwdOffice[0] != ""){
		foreach ($kwdOffice as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE(事業所 COLLATE $collateType LIKE '%". $row ."%')"; 
			 }else { 
			 	$sql = $sql."OR (事業所 COLLATE $collateType LIKE '%". $row ."%')";
			 }
		}
	}
	if ($kwdDepartment[0] != ""){
		foreach ($kwdDepartment as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE(部署 COLLATE $collateType LIKE '%". $row ."%')"; 
			 }else { 
			 	$sql = $sql."OR (部署 COLLATE $collateType LIKE '%". $row ."%')";
			 }
		}
	}
	if ($kwdCompany[0] != ""){	
		foreach ($kwdCompany as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE(会社 COLLATE $collateType LIKE '%". $row ."%')"; 
			 }else { 
			 	$sql = $sql."OR (会社 COLLATE $collateType LIKE '%". $row ."%')";
			 }
		}
	}
	if ($kwdMead[0] != ""){	
		foreach ($kwdMead as $row) {
			 if ( $sql == "") { 
			 	$sql = " SELECT * FROM $table_list WHERE(メールアドレス COLLATE $collateType LIKE '%". $row ."%')"; 
			 }else { 
			 	$sql = $sql."OR (メールアドレス COLLATE $collateType LIKE '%". $row ."%')";
			 }
		}
	}
	
}

//echo  "行番号:".__LINE__."<br />";
//echo '$sql =',$sql;echo "<br/\n>";
//echo '$sortRule =',$sortRule;echo "<br/\n>";
//echo '$orderType =',$orderType;echo "<br/\n>";

// 並べ替え　$sortRule(氏名、部署名等)、$orderType(昇順(ASC)降順(DESC))
if ($sortRule !== "") {
	if ($orderType == 'orderAsc') {
		$sql = $sql."ORDER BY $sortRule ASC";
	} else {
		$sql = $sql."ORDER BY $sortRule DESC";
	}
}
// var_dump($sql);

//	 $all_records = "SELECT * FROM $table_list";
    // プリペアドステートメントを作る
   	 $stm = $pdo->prepare($sql);
    // SQL文を実行する
   	 $stm->execute();
    // 結果の取得（連想配列で返す）、全てのレコード
    $temp_records = $stm->fetchAll(PDO::FETCH_ASSOC);



if ($GLOBALS['searchType'] === "orSearch"){


} else {

	// AND検索
	// 項目毎のOR検索
	$i = 1;
	do{
		$dummy_flag[$i] = 1;	$i ++; 
	} while($i < count($temp_records));
}

    // $selected_flag()=1）が含まれるレコードを表示
  foreach($temp_records as $key => $row){
   		echo "<tr>";
   		echo "<td class=\"th00\">", $key+1, "</td>";
   		echo "<td class=\"th0\">", es($row['氏名']), "</td>";
//    	echo "<td class=\"th1\">", es($row['社員番号']), "</td>";
    	echo "<td class=\"th2\">", es($row['役職']), "</td>";
    	echo "<td class=\"th4\">", es($row['部署']), "</td>";
		echo "<td class=\"th3\">", es($row['事業所']), "</td>";
    	echo "<td class=\"th5\">", es($row['会社']), "</td>";
//    	echo "<td class=\"th6\">", es($row['メールアドレス']), "</td>";
    	echo "<td class=\"th6\">", "<a href=",'"mailto:',es($row['メールアドレス']),'"',">",es($row['メールアドレス']),"</a>", "</td>";
//    	echo "<td class=\"th7\">", es($row['電話番号']), "</td>";

   		echo "</tr>";
  }
  echo "</table>";
  if (!isset($key)){ 
  	echo "<br/>\n";echo "<br/>\n";
  	echo "<div>","<h3 align=\"center\">",'<font color ="3f5170">',"条件に合致する情報はヒットしませんでした。。。","</font></h3>","</div>"; }
	
 }  // line260

  }  // line173に対するカッコ

?>

</div>
<!-- <p align="right">&copy;Copyright ADVANTEC Grp.SYSTEM Div. All right reserved.</p> -->
</body>
</html>


<?php
function titleDisplay(){
?>

<body onContextmenu="window.alert('右クリックは禁止です');return false" oncopy="window.alert('ctrl+cは禁止');return false;">
<style type="text/css">
/* ページ全体を印刷させない場合 */
@media print {
    body { display: none !important; }
}
</style>
<?php
 	echo '<title>社員情報検索サービス</title>';
 	echo '<!-- テーブル用のスタイルシート -->';
 	echo '<link rel="stylesheet" type="text/css" href="style2.css" >'; 
 	echo '<form method="POST" action="" >';
 	echo '<label><div>Welcome to</div></label>';
 	echo '<div><h1 class="title">社員情報検索&emsp;<font color="#FF0000" size=3><strong>【コピペ、印刷は禁止です！】</strong></font></h1>'; 
 	echo '<ul class="comment">';
        echo ' <li>検索キーワードとして複数の検索項目（氏名、役職、・・・）を入力することができます。</li>';
        echo ' <li>検索項目夫々に複数入力（氏名なら「鈴木、山田」のように）が可能です。<br>';
        echo ' 【例１】「検索タイプ：◎ANDサーチ」「役職：係長、課長」「会社：TRK、KTS」を選択するとTRKまたはKTSの全ての<br>';
        echo '        　係長または課長が検索されます。<br>';

        echo ' 【例２】「検索タイプ：◎ORサーチ」いずれか１つの検索項目（氏名、役職、・・・）にのみ検索キーワードを入力して利用ください。<br>';
        echo ' 　　　　「氏名：鈴木、山田」を選択すると、全ての鈴木さんと山田さんが検索されます。';
        echo ' </li>';
  		echo ' <li>前回の検索条件が表示されている場合↓、修正・追記して再検索できます。</li>';
		echo ' <li>その他、詳しい使い方は<a href="https://advantec-group.ent.box.com/file/880193629766" target="_blank" ><font color="#0000FF">こちら</font></a>を参照ください。';
		echo ' </li>';
		echo '<li>ご意見・感想は<a href="https://teams.microsoft.com/l/channel/19%3a6c80530927a6448d92df72e8200c10de%40thread.skype/99_FAQ%25E3%2581%2594%25E6%2584%258F%25E8%25A6%258B%25E3%2580%2581%25E3%2581%2594%25E8%25A6%2581%25E6%259C%259B?groupId=f18c3001-63c7-4e7a-aa5b-df8e8ffe8090&tenantId=d5935491-ded4-4e26-b831-3fe9ed3b5445" target="_blank" ><font color="#0000FF">こちら</font></a>までお願いします。';
		echo ' </li>';
		echo '<li><span style="white-space: nowrap;">検索タイプ、並べ替え条件、キーワードを入力後 ->&nbsp;';
		echo '<input type="submit" class="button0" value="検索スタート" name="startSearch">';
		echo '</span>';
  		echo '<span style="white-space: nowrap;">&emsp;検索条件をクリア ->&nbsp;</span>';
  		echo '<input type="submit" class="button0" value="検索条件クリア" name="parameterClear">';
		echo '</span>';
		echo ' </li>';
		echo '<li>最終データ更新日：2022年9月1日';
		echo ' </li>';		
  		echo ' </ul>';
}

function topListDisplay(){


// -- 検索タイプのデフォルト値設定 --
 echo '<table class="info">';
 echo '<tr align="center"><th>検索タイプ</th><td><label><input type="radio" name="searchType" value="andSearch"'; checked("andSearch", $GLOBALS['searchType']); echo ">AND サーチ &nbsp;&nbsp;</label>";
 echo '<label><input type="radio" name="searchType" value="orSearch"';checked("orSearch", $GLOBALS['searchType']); echo ">OR サーチ</label></td></tr>";


echo '<tr><th>並べ替え</th><td><select name="sortRule" style="border:none;font-size:20px;" ><font color ="444444"><option value="" align="center">&emsp;&emsp;並べ替え対象の選択&emsp;&emsp;</option><option value="氏名" align="center"';  
selected("氏名", $GLOBALS['sortRule']);echo '>氏名</option><option value="役職" align="center"'; 
selected("役職", $GLOBALS['sortRule']);echo '>役職</option><option value="部署" align="center"'; 
selected("部署", $GLOBALS['sortRule']);echo '>部署</option><option value="事業所" align="center"';  
selected("事業所", $GLOBALS['sortRule']);echo '>事業所</option><option value="会社" align="center"'; 
selected("会社", $GLOBALS['sortRule']);echo '>会社</option><option value="メールアドレス" align="center"'; 
selected("メールアドレス", $GLOBALS['sortRule']);echo '>メールアドレス</option></font>';

echo '<label><input type="radio" name="orderType" value="orderAsc"';
checked("orderAsc", $GLOBALS['orderType']);echo '>昇順 &nbsp;&nbsp;</label>
          <label><input type="radio" name="orderType" value="orderDesc"'; 
checked("orderDesc", $GLOBALS['orderType']);echo '>降順</label></td></tr>';


if ($GLOBALS['kwdSetStatus'] != "kwdSet"){
 	echo '<tr><th>氏名</th><td><input type="text" name="kwdName" style="border:none;font-size:20px;" placeholder="鈴木、山田 etc." size=40></td></tr>';
 	echo '<tr><th>役職</th><td><input type="text" name="kwdRole" style="border:none;font-size:20px;" placeholder="課長、部長 etc." size=40></td></tr>';
 	echo '<tr><th>部署</th><td><input type="text" name="kwdDepartment" style="border:none;font-size:20px;" placeholder="濾紙開発部、経理部 etc." size=40></td></tr>';
 	echo '<tr><th>事業所</th><td><input type="text" name="kwdOffice" style="border:none;font-size:20px;" placeholder="新潟工場、東京営業所 etc." size=40></td></tr>';
 	echo '<tr><th>会社</th><td><input type="text" name="kwdCompany" style="border:none;font-size:20px;" placeholder="KTS、TRK etc." size=40></td></tr>';
 	echo '<tr><th>メールアドレス</th><td><input type="text" style="border:none;font-size:20px;" name="kwdMead" placeholder="***@advantec.co.jp etc." size=40></td></tr>';
} else { 
 	echo '<tr><th>氏名</th><td><input type="text" name="kwdName" style="border:none;font-size:20px;"size=40 value=',$GLOBALS['kwdNamePrev'],'></td></tr>'; 
 	echo '<tr><th>役職</th><td><input type="text" name="kwdRole" style="border:none;font-size:20px;" size=40 value=',$GLOBALS['kwdRolePrev'],'></td></tr>';
 	echo '<tr><th>事業所</th><td><input type="text" name="kwdOffice" style="border:none;font-size:20px;" size=40 value=',$GLOBALS['kwdOfficePrev'],'></td></tr>';
 	echo '<tr><th>部署</th><td><input type="text" name="kwdDepartment" style="border:none;font-size:20px;" size=40 value=',$GLOBALS['kwdDepartmentPrev'],'></td></tr>';
 	echo '<tr><th>会社</th><td><input type="text" name="kwdCompany" style="border:none;font-size:20px;" size=40 value=',$GLOBALS['kwdCompanyPrev'],'></td></tr>';
 	echo '<tr><th>メールアドレス</th><td><input type="text" style="border:none;font-size:20px;" name="kwdMead" size=40 value=',$GLOBALS['kwdMeadPrev'],'></td></tr>';
}
 	echo '</table>';
 	echo '</form>';
}

function allListDisplay(){
//
// SQLから全レコードを読み出して表示する
//
//SQLサーバに接続する
  list($pdo,$table_list) = connect2db(); 
  try { 
    // SQL文を作る（全レコード）
    	$sql = "SELECT * FROM $table_list";
      // プリペアドステートメントを作る
    	$stm = $pdo->prepare($sql);
    // SQL文を実行する
    	$stm->execute();
    // 結果の取得（連想配列で返す）
    	$result = $stm->fetchAll(PDO::FETCH_ASSOC);

   // テーブルのタイトル行
   	echo "<br/>\n";echo "<br/>\n";echo "<br/>\n";
 	echo "<div>","<h1 align=\"center\">","全社員リスト","</h1>","</div>"; 
	echo "<table class=\"info2\">";
  	echo "<tr>";
   	echo "<th class=\"th00\">", "No.", "</th>";
   	echo "<th class=\"th0\">", "氏名", "</th>";
// 	echo "<th class=\"th1\">", "社員番号", "</th>";
  	echo "<th class=\"th2\">", "役職", "</th>";
  	echo "<th class=\"th3\">", "事業所", "</th>";
 	echo "<th class=\"th4\">", "部署", "</th>";  	
  	echo "<th class=\"th5\">", "会社", "</th>";
  	echo "<th class=\"th6\">", "メールアドレス", "</th>";
// 	echo "<th class=\"th7\">", "電話番号", "</th>";
  	echo "</tr>","</table>";

  // 値を取り出して行に表示する
  	foreach ($result as $key => $row){
    // １行ずつテーブルに入れる
    	echo "<tr>";
    	
   		echo "<td class=\"th00\">", $key+1, "</td>";
   		echo "<td class=\"th0\">", es($row['氏名']), "</td>";
//    	echo "<td class=\"th1\">", es($row['社員番号']), "</td>";
    	echo "<td class=\"th2\">", es($row['役職']), "</td>";
		echo "<td class=\"th3\">", es($row['事業所']), "</td>";
    	echo "<td class=\"th4\">", es($row['部署']), "</td>";
    	echo "<td class=\"th5\">", es($row['会社']), "</td>";
    	echo "<td class=\"th6\">", es($row['メールアドレス']), "</td>";
//    	echo "<td class=\"th7\">", es($row['電話番号']), "</td>";
   		echo "</tr>";
  	}
  	echo "</table>";
    	} catch (Exception $e) {
    		echo '<span class="error">エラーがありました。</span><br>';
    		echo $e->getMessage();
    		exit();
  	}
}

 echo "</div>";

?>


