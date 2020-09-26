<?php
	require_once 'twitteroauth-master/autoload.php';
	use Abraham\TwitterOAuth\TwitterOAuth;

	include 'connection_db.php';
	//Isi variabel berikut ini berdasarkan nilai API Key, API Secret dan Access Token-nya
	$twitterConsumerKey = 'KfJHgZeDBsegCvp6SKQhqfEc9';
	$twitterConsumerSecret = 'SHDQcRLd4XuQe9Gz227BwLw7VVn9qMC5mZygRRBcYhfZtnYwn3';
	$twitterAccessToken = '447808106-b3MXVuf5SzNMzoEkoeXS2uV028DecayQcbo1y9pc';
	$twitterAccessTokenSecret = '6kGMVABP4rF1IzbMnuiqdzFi8CcGqKjxTzU0GEFVV1vpk';
	if (isset($_REQUEST['q'])) {
	$q = trim($_REQUEST['q']);
	} else {
	$q = "";
	}



	// $daa = object_to_array($result[0]);
				// echo $daa["id"];








	// try{
	// 	$sql = "SELECT * FROM accounts";
	// 	$stmt = $connection->prepare($sql);
	// 	$stmt->setFetchMode(PDO::FETCH_OBJ); ;
	// 	$stmt->execute();
	// 	$result = $stmt->fetchAll();
	// 	$stmt->closeCursor();
	// 	// var_dump($result);
	// 	// echo $result[0][0];
	// 	} catch (PDOException $ex) {
	// 	echo $ex->getMessage();
	// 	};



	// $statement = $connection->prepare('INSERT INTO accounts(id,name,screen_name,location,url,description,time_zone, lang, tweet_count, following_count, followed_count,favourites_count) VALUES(:id,:name,:screen_name,:location,:url,:description,:time_zone, :lang,:tweet_count,:following_count,:followed_count, :favourites_count)');
	// 				try{
	// 					$statement->execute([
	// 					':id'=>"2232",
	// 					':name'=> "F",
	// 					':screen_name'=>"F",
	// 					':location'=>"F",
	// 					':url'=>"F",
	// 					':description'=>"F",
	// 					':time_zone'=> "F",
	// 					':lang'=>"F",
	// 					':tweet_count'=>1,
	// 					':following_count'=>1,
	// 					':followed_count'=>1,
	// 					':favourites_count'=>1
	// 				]);
	// 					// header('location:index.php?module=admin&page=proses_daftar');
						
	// 					echo 'Berhasil disimpan!';
	// 				}catch(Exeption $exc){
	// 					die($exc->getMessage());
	// 				}




?>

<html>
<head><title>NLPA2017</title></head>
<body>
<form action="index.php" method="get">
Akun <input name="q" value="<?php echo $q; ?>">
<input type="submit" value="Cari">
</form>
	<?php

	// require_once 'twitteroauth-master/autoload.php';
	// use Abraham\TwitterOAuth\TwitterOAuth;

	// include 'connection.php';
	// include 'connection.php';
		if ($q != "") {
			try {
				$connection = new TwitterOAuth($twitterConsumerKey, $twitterConsumerSecret,
				$twitterAccessToken, $twitterAccessTokenSecret);
				$connection->setTimeouts(10, 15);
				$result = $connection->get("statuses/user_timeline",
				array("screen_name" => $q, "include_entities" => true, "count" => 200));

				// $result = $connection->get("statuses/user_timeline",
				// array("screen_name" => $q, "include_entities" => true, "count" => 200, "max_id" => "690686543824945152"));

				// $menu  = $result, true;

				// function objectKeArray($result) {
			 //        $array = array();
			 //        if (is_object($result)) {
			 //            $array = get_object_vars($result);
			 //        }
			 //        return $array;
			 //    }


				function object_to_array($object) {
				    if(is_object($object)) {
				        $object = get_object_vars($object);
				    }
				    if(is_array($object)) {
				        return array_map(__FUNCTION__, $object);
				    } else {
				        return $object;
				    }
				}

				
				$daa = object_to_array($result[0]);
				var_dump($daa);
				$id = $daa["id"];

				echo $id;

				echo $daa["daa"]["urls"];




				// $statement = $connection_db->prepare('INSERT INTO accounts(id,name,screen_name,location,url,description,time_zone, lang, tweet_count, following_count, followed_count,favourites_count) VALUES(:id,:name,:screen_name,:location,:url,:description,:time_zone, :lang,:tweet_count,:following_count,:followed_count, :favourites_count)');
				// 	try{
				// 		$statement->execute([
				// 		':id'=>$idd,
				// 		':name'=> "F",
				// 		':screen_name'=>"F",
				// 		':location'=>"F",
				// 		':url'=>"F",
				// 		':description'=>"F",
				// 		':time_zone'=> "F",
				// 		':lang'=>"F",
				// 		':tweet_count'=>1,
				// 		':following_count'=>1,
				// 		':followed_count'=>1,
				// 		':favourites_count'=>1
				// 	]);
				// 		// header('location:index.php?module=admin&page=proses_daftar');
						
				// 		echo 'Berhasil disimpan!';
				// 	}catch(Exeption $exc){
				// 		die($exc->getMessage());
				// 	}




				// $statement = $connection->prepare('INSERT INTO accounts(id,name,screen_name,location,url,description,time_zone, lang, tweet_count, following_count, followed_count,favourites_count) VALUES(:id,:name,:screen_name,:location,:url,:description,:time_zone, :lang,:tweet_count,:following_count,:followed_count, :favourites_count)');
				// 	try{
				// 		$statement->execute([
				// 		':id'=>"2232",
				// 		':name'=> "F",
				// 		':screen_name'=>"F",
				// 		':location'=>"F",
				// 		':url'=>"F",
				// 		':description'=>"F",
				// 		':time_zone'=> "F",
				// 		':lang'=>"F",
				// 		':tweet_count'=>1,
				// 		':following_count'=>1,
				// 		':followed_count'=>1,
				// 		':favourites_count'=>1
				// 	]);
				// 		// header('location:index.php?module=admin&page=proses_daftar');
						
				// 		echo 'Berhasil disimpan!';
				// 	}catch(Exeption $exc){
				// 		die($exc->getMessage());
				// 	}


				// try{
				// 	$sql = 'INSERT INTO accounts(id,name,screen_name,location,url,description,time_zone, lang, tweet_count, following_count, followed_count,favourites_count) VALUES(:id,:name,:screen_name,:location,:url,:description,:time_zone, :lang,:tweet_count,:following_count,:followed_count, :favourites_count)';
				// 	$stmt = $connection->prepare($sql);
				// 	$stmt->execute([
				// 		':id'=>"2232",
				// 		':name'=> "F",
				// 		':screen_name'=>"F",
				// 		':location'=>"F",
				// 		':url'=>"F",
				// 		':description'=>"F",
				// 		':time_zone'=> "F",
				// 		':lang'=>"F",
				// 		':tweet_count'=>1,
				// 		':following_count'=>1,
				// 		':followed_count'=>1,
				// 		':favourites_count'=>1
				// 	]);
				// 	$stmt->closeCursor();
				// 	} catch (PDOException $ex) {
				// 	echo $ex->getMessage();
				// 	};

				// for ($i=0; $i < 99; $i++) { 
				// 	$daa = object_to_array($result[$i]);
				// 	echo $daa["id"]."<br>";
				// }


				
				




				echo '</pre>';
				echo "<hr>";


				echo '<pre>';
				// print_r($result);
				// echo "string";

				var_dump($result);

				// $data = json_encode($result);
				// echo $data;
				echo '</pre>';
				} catch (Abraham\TwitterOAuth\TwitterOAuthException $ex) {
				echo $ex->getMessage();
			}




		}




		



	?>


	

</body>
</html>