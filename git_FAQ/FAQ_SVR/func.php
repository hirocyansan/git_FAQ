<?php
// require_once("util.php");
// require_once("read_sql_and_search.php");
// require_once("keyword.php");
?>


<?php
//  同じレコードを除外して$temp_recordsに入れ直す

function reject_same_records($temp_records){
$i = 0; $j = 0;
  do{
	do{
		// echo '$i =',$i, '  $j = ',$j; echo "<br/>\n";
		// 同じレコード番号どうしの比較はスキップ
		if ($i === $j) {
//			echo 'skip the same records comparing ';echo "<br/>\n";
			$j ++;
			continue;
		}
		// 同じ行番号(num)が見つかったら片方を削除して配列を詰める--> $temp_records
		if ($temp_records[$i]['num'] === $temp_records[$j]['num']){
			$skipped_records[] =array_splice($temp_records, $j, 1);
 		//行番号を削減したのでポインタ($j)参照位置も戻す
			if ($j > 0) $j --;   
		}
		$j ++;
	}while(count($temp_records) - 1 >= $j);
  $i ++; 
  $j = 0;
  }while(count($temp_records) - 1 >= $i);
  return($temp_records);
}
?>

<?php
function big2small($kwd){
  $kwd = mb_strtolower($kwd);  // アルファベット大文字→小文字変換
  $kwd = mb_convert_kana($kwd, 'rnk');  // 全角英字、数字、カナ　→　半角
  return $kwd;
}
?>

<?php
  // 初期値でチェックするかどうか
function checked($value, $question){
    if (is_array($question)){
      // 配列のとき、値が含まれていればtrue
      $isChecked = in_array($value, $question);
    } else {
      // 配列ではないとき、値が一致すればtrue
      $isChecked = ($value===$question);
    }
    if ($isChecked) {
      // チェックする
      echo "checked";
    } else {
      echo "";
    }
  }
 ?>

