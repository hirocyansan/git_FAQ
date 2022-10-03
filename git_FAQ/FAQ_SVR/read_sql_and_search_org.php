<?php
require_once("util.php");
require_once("func.php");
require_once("login_database.php");
// require_once("keyword.php");
setLocale(LC_ALL, 'English_United States.1252');

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<!-- <link  rel="stylesheet" type="text/css" href="style_post.css"> -->
<title>問い合わせDBトップページ</title>
<!-- テーブル用のスタイルシート -->
<link rel="stylesheet" type="text/css" href="style2.css" > 

</head>
<body>
<div>

 <div class="Header1">
 <form method="POST" action="keyword.php">
<!--  <label><div><font face="Arial">Welcome to</font></div></label> -->
  <div><nobr><font face="Arial">Welcome to</font>
 <h1 align="center">問い合わせ一覧データベース</h1></nobr></div> 
 <!-- 検索タイプのデフォルト値設定 -->
 <?php  $search_type = "and_search"; ?>
  <ul style="margin-left:50px">
    	<li><span><strong>検索タイプ</strong>を選択ください：</span>
    	 <!--  設定されたsearch_typeにチェックを入れる  -->
        <label><input type="radio" name="search_type" value="and_search" <?php checked("and_search", $search_type); ?> >AND サーチ</label>
        <label><input type="radio" name="search_type" value="or_search" <?php checked("or_search", $search_type); ?> >OR サーチ</label></li>
         <li><label><strong>検索キーワード</strong>(1つ以上)を入力ください。：<input type="text" name="kwd" placeholder="PC,Windows,etc " size="40" ><span> &nbsp;</span><input type="submit" value="検索開始" >
</label></li>
		<li><label>「問い合わせ内容」と「回答」欄が検索対象です。</label></li>
		<br/>
		<label>※ その他、詳しい使い方は<a href="https://advantec-group.ent.box.com/file/862439460754" "target=_blank">こちら</a>を参照ください。</label><br/>
		<label>※ 探したい項目が見つからない場合は、<a href="https://advantec-group.ent.box.com/file/763114430873" "target=_blank">システム部担当</a>宛てお問い合わせください。</label>
		
</ul>
</form>

<?php
//SQLサーバに接続する
 // $pdo = connect2db(); 
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
echo '<div class="Contents1">';

  // 値を取り出して行に表示する
	echo "<table>";
    	foreach ($result as $row){
    // １行ずつテーブルに入れる
  	echo "<tr>";
   		echo "<td  class=td1 align=center>", es($row['num']), "</td>";
//    	echo "<td  class=td2 align=center>", es($row['dt']), "</td>";
//    	echo "<td  class=td3 align=left>", es($row['quest']), "</td>";
     	echo "<td  class=td3 align=left>", nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['quest'])), "</td>";
    	
    	// ハイパーリンクを含む行の場合は「回答」欄に埋め込む
		if($row['hlink'] != ''){
			echo "<td  class=td4 align=left>";
			echo "<a href=",$row['hlink'],' target="_blank"',' rel="noopener noreferrer"',">";
//			echo es($row['ans']);
			echo nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['ans']));
			echo '</a>','</td>';
		}else {
//			echo "<td  class=td4 align=left>", es($row['ans']), "</td>";
			$text1		=	$row['ans'];
			$pattern	= 	'/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/';
//        	echo  "ファイル名:".__FILE__."行番号:".__LINE__."<br />";
			
			$replace	= 	'<a href="$1"'.' target="_blank"'.' rel="noopener noreferrer"'.'>$1</a>';
//			$replace	= 	'<a href="$1">$1</a>';
			$text1    	= 	preg_replace(	$pattern,	$replace,	$text1	);
			echo "<td  class=td4 align=left>",nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $text1)), "</td>";
//			echo "<td  class=td4 align=left>",nl2br(str_replace(['\r\n','\r','\n'], ["\r\n","\r","\n"], $row['ans'])), "</td>";
		}
    	echo "<td  class=td6 align=center>", es($row['cat']), "</td>";
   	echo "</tr>";
  	}
  	echo "</table>";
    	} catch (Exception $e) {
    		echo '<span class="error">エラーがありました。</span><br>';
    		echo $e->getMessage();
    		exit();
  	}
  ?>

<p align="center">&copy;Copyright ADVANTEC Grp.SYSTEM Div. All right reserved.</p>
</div>
</body>
</html>
