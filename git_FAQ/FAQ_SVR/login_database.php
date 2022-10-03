 <?php 
function connect2db(){
//　実行環境　MAMP/Windowsサーバの切り替え設定
  $MAMP = false;
  if ($MAMP === true){ 
	$table_list = 'FAQ_table';   	              		
	$user = 'ichi';
	$password = 'ichizero';
// 利用するデータベース
	$dbName = 'toiawase_db';
// MySQLサーバ
	$host = 'localhost:3306';
// MySQLのDSN文字列
	$dsn = "mysql:host={$host};dbname={$dbName};charset=utf8";
  }else{
	$table_list = 'FAQ_table';   	              		
	$user = 'sa';
	$password = 'Manager4763@';
// 利用するデータベース
	$dbName = 'toiawase_db';
// SQLサーバ
	$host = 'RSFL01\SQLEXPRESS';
// SQLのDSN文字列
//	echo '$dbName = ', $dbName; echo '  $host = ', $host; echo "<br/>\n";
	$dsn = "sqlsrv:server={$host};database={$dbName}";
  }
   //MySQLデータベースに接続する
    $pdo = new PDO($dsn, $user, $password);
 
    // プリペアドステートメントのエミュレーションを無効にする
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // 例外がスローされる設定にする
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "データベース{$dbName}に接続しました。", "<br>";
//  return $pdo;
    return[$pdo,$table_list];
}
?>