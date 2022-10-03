<head>
<meta charset="utf-8">
<!-- <link  rel="stylesheet" type="text/css" href="style_post.css"> -->
<!-- テーブル用のスタイルシート -->
<link rel="stylesheet" type="text/css" href="style2.css" > 
</head>

<body>
<div>
<?php
require_once("util.php");
require_once("login_database.php");
require_once("func.php");


$kwd = ['電源', 'PC'];

//SQLサーバに接続する
 // $pdo = connect2db(); 
  list($pdo,$table_list) = connect2db(); 
  // SQL文を作る（全レコード）

$sql = "";
foreach ($kwd as $row) {
 if ( $sql == "") { 
 	echo '$row =',$row; echo "<br/>";
 	$sql = " SELECT * FROM $table_list WHERE((quest collate utf8_unicode_ci LIKE '%". $row ."%') 
 										OR (ans collate utf8_unicode_ci LIKE '%". $row ."%'))"; 
 }else { 
 	$sql = $sql."OR ((quest collate utf8_unicode_ci LIKE '%". $row ."%') 
 					OR (ans collate utf8_unicode_ci LIKE '%". $row ."%'))"; 
 }
} 
 
  		  
  // プリペアドステートメントを作る
  $stm = $pdo->prepare($sql);
  // SQL文を実行する
  $stm->execute();
  // 結果の取得（連想配列で返す）
  $result = $stm->fetchAll(PDO::FETCH_ASSOC);

   // テーブルのタイトル行
	echo "<table>";
  	echo "<tr class=tr0>";
   	echo "<th class=td1 align=center>", "番号", "</th>";
//  	echo "<th class=td2 align=center>", "日付", "</th>";
  	echo "<th class=td3>", "問い合わせ内容", "</th>";
  	echo "<th class=td4>", "回答", "</th>";
  	echo "<th class=td6 align=center>", "カテゴリー", "</th>";
  	echo "</tr>";
	echo "</table>";
	
echo " </div>";
echo "<div>";

  // 値を取り出して行に表示する
	echo "<table>";
    	foreach ($result as $row){
    // １行ずつテーブルに入れる
  	echo "<tr>";
   		echo "<td  class=td1 align=center>", es($row['num']), "</td>";
     	echo "<td  class=td3 align=left>", nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['quest'])), "</td>";
    	
    	// ハイパーリンクを含む行の場合は「回答」欄に埋め込む
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
  	echo "</table>";


?>

</div>
</body>
</html>
