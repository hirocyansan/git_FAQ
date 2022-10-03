<?php
require_once("util.php");
require_once("func.php");
require_once("login_database.php");
setLocale(LC_ALL, 'English_United States.1252');
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
<div>
 <div class="Header2">
 <div><h1 align="center">#### 検索結果 ####</h1></div>  
<?php
  // フォーム入力の値を得る（keyword）
  $errors = [];
  $search_type = $_POST["search_type"];
  $kwd = array($_POST["kwd"]);
  if ($kwd[0] === ""){
  	$errors[] = '検索キーワードが入力されていません。';
  }else{  	
	  if (strpos($kwd[0],"、") != false){
  		$kwd = explode( "、" ,$kwd[0]);  
  	  }else{
  		if(strpos($kwd[0],",") != false){
  			$kwd = explode( "," ,$kwd[0]);  
  	    }else{
  			if(strpos($kwd[0]," ") != false){
  				$kwd = explode( " " ,$kwd[0]);  
  	    	}else{
  				if(strpos($kwd[0],"　") != false){
  					$kwd = explode( "　" ,$kwd[0]);  
  				}
			}
		}
	}
  }
?>
<?php
  // エラーがあったとき
  if (count($errors)>0){
  	echo '<ol class = "error">';
  	foreach($errors as $row){
  		echo "<label>", $row,  "</label>";
  	}
    //<!-- 戻るボタンのフォーム -->
  echo " <form method=\"POST\" action=\"read_sql_and_search.php\">";
  echo "<input type=\"submit\" value=\"トップへ戻る\">";
  echo "</form>";
  }else{


$original_kwd = $kwd; 

// $kwd入力があった場合のみ以下の検索処理
if ($kwd !=  ""){
  

// SQLサーバに接続
//  $pdo = connect2db(); 
  list($pdo,$table_list) = connect2db(); 
   //<!-- 戻るボタンのフォーム -->
   echo " <form method=\"POST\" action=\"read_sql_and_search.php\">";
  echo "<nobr>", "■検索結果  (確認後)  ====>   ";
  echo "<input type=\"submit\" value=\"トップへ戻る\">",  "</nobr>";
  // 検索条件を画面表示
  echo "<ul>";echo "<li>"; echo "<span>";  echo "検索条件：  ";
  if ($search_type ==="or_search"){
  	echo 'ORサーチ'; echo "<br/>\n";
  }else{
  	echo 'ANDサーチ'; echo "<br/>\n";
  }
  echo "</span>"; echo "</li>";
  echo "<li>";echo "<span>"; echo  "検索キーワード"."【".count($original_kwd)."】"."：　";
  foreach($original_kwd as $row){
  	echo $row, '&nbsp; &nbsp; &nbsp; ';
  }
	echo "</span>";echo "</li>"; 
  	echo "</ul>"; echo "</form>";


  // テーブルのタイトル行
	echo "<table>"; 
  	echo "<tr class=tr0>";
   	echo "<th class=td1 align=center>", "番号", "</th>";
  	echo "<th class=td3>", "問い合わせ内容", "</th>";
  	echo "<th class=td4>", "回答", "</th>";
  	echo "<th class=td6 align=center>", "カテゴリー", "</th>";
  	echo "</tr>";
	echo "</table>";

echo " </div>";
echo '<div class="Contents2">';
	
    // SQL文を作る（キーワード検索）

   if ($search_type === "and_search"){

 // ------------- AND検索処理 -----------------
		 // 大文字小文字/全角半角を区別しないで比較　https://qiita.com/kazu56/items/6af85ffcf8d3954455ad
		$sql = "";
		foreach ($kwd as $key => $row) {
		 if ( $sql == "") { 
		 	$sql = " SELECT * FROM $table_list WHERE((quest collate utf8_unicode_ci LIKE '%". $row ."%') 
		 										OR (ans collate utf8_unicode_ci LIKE '%". $row ."%'))"; 
		 }else { 
		 	$sql = $sql."AND ((quest collate utf8_unicode_ci LIKE '%". $row ."%') 
		 					OR (ans collate utf8_unicode_ci LIKE '%". $row ."%'))"; 
		 }
		} 
    // プリペアドステートメントを作る
   		 $stm = $pdo->prepare($sql);
    // SQL文を実行する
   		 $stm->execute();
    // 結果の取得（連想配列で返す）
         $candidated_records = $stm->fetchAll(PDO::FETCH_ASSOC);
    // 全てのレコード行を$temp_recordsへ格納
	     $temp_records = $candidated_records;

// $temp_recordsに本来のデータを残しておく
		$work_records = $temp_records;  

    // 全ての$kwdが含まれるレコードを表示
		echo "<table>"; 
		foreach($temp_records as $key => $row){
			echo "<tr>";
			echo "<td  class=td1 align=center>", es($row['num']), "</td>";
			echo "<td  class=td3 align=left>",nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['quest'])), "</td>";
			if($row['hlink'] != ''){
				echo "<td  class=td4 align=left>";
				echo "<a href=",$row['hlink'],' target="_blank"',' rel="noopener noreferrer"',">";
				echo nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['ans']));
				echo '</a>','</td>';
			}else {
				$text1		=	$row['ans'];
				$pattern	= 	'/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
				$replace	= 	'<a href="$1"'.' target="_blank"'.' rel="noopener noreferrer"'.'>$1</a>';
				$text1    	= 	preg_replace(	$pattern,	$replace,	$text1	);
				echo "<td  class=td4 align=left>",nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $text1)),"</td>";
			}
			echo "<td  class=td6 align=center>", es($row['cat']), "</td>";
			echo "</tr>";
		}
//  ------------- OR検索 ------------------
		}else{
			$sql = "";
			foreach ($kwd as $row) {
				 if ( $sql == "") { 
				 	$sql = " SELECT * FROM $table_list WHERE((quest collate utf8_unicode_ci LIKE '%". $row ."%') 
				 										OR (ans collate utf8_unicode_ci LIKE '%". $row ."%'))"; 
				 }else { 
				 	$sql = $sql."OR ((quest collate utf8_unicode_ci LIKE '%". $row ."%') 
				 					OR (ans collate utf8_unicode_ci LIKE '%". $row ."%'))"; 
		 		}
		} 

	     // プリペアドステートメントを作る
	    	$stm_kwd = $pdo->prepare($sql);
	    // SQL文を実行する
	    	$stm_kwd->execute();
	    // 結果の取得（連想配列で返す）
	    	$candidated_records = $stm_kwd->fetchAll(PDO::FETCH_ASSOC);
	    // 全てのレコード行を$temp_recordsへ格納
	        $temp_records = $candidated_records;

			// $temp_recordsに本来のデータを残しておく
			$work_records = $temp_records;  

  			// 値を取り出して行に表示する
			echo "<table>"; 
		  	foreach ($temp_records as $key => $row){
		     // １行ずつテーブルに入れる
		    	echo "<tr>";
		    	echo "<td  class=td1 align=center>", es($row['num']), "</td>";
		    	echo "<td  class=td3 align=left>",nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['quest'])), "</td>";
				if($row['hlink'] != ''){
					echo "<td  class=td4 align=left>";
					echo "<a href=",$row['hlink'],' target="_blank"',' rel="noopener noreferrer"',">";
					echo nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['ans']));
					echo '</a>','</td>';
				}else {
					$text1		=	$row['ans'];
					$pattern	= 	'/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
					$replace	= 	'<a href="$1"'.' target="_blank"'.' rel="noopener noreferrer"'.'>$1</a>';
					$text1    	= 	preg_replace(	$pattern,	$replace,	$text1	);
					echo "<td  class=td4 align=left>",nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $text1)), "</td>";
				}

		    	echo "<td  class=td6 align=center>", es($row['cat']), "</td>";
		       	echo "</tr>";
		       	}
		  }
		  	echo "</table>";
		  }
		 }
 
  ?>

<?php
 if ($kwd[0] !== ""){
  echo "<p align=center>&copy;Copyright ADVANTEC Grp.SYSTEM Div. All right reserved.","</p>";
}
?>
 </div>
 </div>
</body>
</html>