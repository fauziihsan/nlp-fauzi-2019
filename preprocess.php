<?php 

try{

	$database = 'mysql:host=localhost;port=3306;dbname=twitterr';
	$username = 'root';
	$password = '';
	$connection = new PDO($database, $username, $password);
	$connection->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// $connection = new
	// PDO("mysql:localhost; dbname=twitter","root","");
	// $connection->setAttribute(PDO::ATTR_ERRMODE,
	// PDO::ERRMODE_EXCEPTION);

	// echo "Koneksi berhasil";
	} catch(PDOException $ex){
	echo 'Connection Failed:'.$ex->getMessage();
	exit();
}

//ambil data

$sql = "SELECT `id`, `text` FROM tweets LIMIT 10";

try {

	$stmt = $connection->prepare($sql);
	$stmt->setFetchMode(PDO::FETCH_OBJ);
	$stmt->execute();

	$no = 1;
	while(($obj = $stmt->fetch()) == true){
		$text = $obj->text;
		

		echo "<b>Tweet: ".$no."</b><br><br>";
		echo $text."<br><br>";
		// $stmt->closeCursor();

		$text = strtolower($text);
		echo "<b>Case Folding:</b><br><br>";
		echo $text."<br><br>";

		$text = removeEntity($text);
		echo "<b>Remove Entity:</b><br><br>";
		echo $text."<br><br>";

		$text = characterFilter($text);
		echo "<b>Character Filter:</b><br><br>";
		echo $text."<br><br>";

		$tokens = wordTokenizer($text);
		echo "<b>Word Tokenizer:</b><br><br>";
		echo "<pre";
		print_r($tokens);
		// var_dump($tokens);
		echo "</pre";
		echo "<br><br>";
		echo "<hr>";
		$no++;
	}
	
} catch (PDOException $ex) {
	echo $ex->getMessage();
	exit();
}


function removeEntity($text){
	//Retweet
    $text = preg_replace('/RT +@[^ :]+:?/ui', '', $text);
    
    //Mention
    $text = preg_replace('/[@]+([A-Za-z0-9-_]+)/i', '', $text);

    //Hashtag
    $text = preg_replace('/[#]+([A-Za-z0-9-_]+)/i', '', $text);

    //URL
    $text = preg_replace('/(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/i', '', $text);
	return $text;
}

function characterFilter($text) {
    /*
	Table of ascii characters and symbols.html
	Sumber: https://www.ascii.cl/htmlcodes.htm
	Pada tabel, kode HTML yang ada dimulai dari kode ASCII 32.
	Pada tabel, kode ASCII 127 ke atas dinyatakan tidak terdefinisi pada standar HTML 4
	Pada penelitian ini hanya digunakan kode 32 s/d 126, sehingga selain itu diganti dengan spasi
	Selain itu, pada tabel, juga terdapat HTML character entity (name and number) yang diawali dengan & diikuti nol atau satu # dan diikuti satu atau lebih (batasi sampai 8, jika mengacu ke tabel paling panjang adalah 6) alfabet atau angka, kemudian diakhir dengan ;
	Seluruh teks yang dituliskan HTML character entity (name and number) diganti dengan spasi
    */
    $text = preg_replace('/[\x00-\x1F\x7F-\xFF]/', ' ', $text);	//Regex-nya harus menggunakan tanda kutip satu
	$text = preg_replace("/&#?[a-z0-9]{2,8};/i", " ", $text);
	$text = str_replace("~", " ", $text);
	
	//Karena preg_replace di atas menggantikan dengan spasi, maka hilangkan spasi berlebih menjadi satu spasi, kemudian trim untuk memastikan telah bersih dari spasi di awal dan akhir kalimat
	$text = preg_replace('/\s+/', ' ', $text);
    $text = trim($text);
    
    return $text;
}

function wordTokenizer($text) {
    $tokens = preg_split('/[ "#*(),\/\-:;\.!?{}\[\]|]/', $text);

    $tokens2 = array();
    foreach ($tokens as $v) {
        if ($v != '') {
            $tokens2[] = $v;
        }
    }
    
    return $tokens2;
}