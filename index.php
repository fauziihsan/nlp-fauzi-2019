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

?>

<html>
<head><title>NLPA2017</title></head>
<body>
<form action="index.php" method="get">
Akun <input name="q" value="<?php echo $q; ?>">
<input type="submit" value="Cari">
</form>
	<?php

		if ($q != "") {
			try {
				$connection = new TwitterOAuth($twitterConsumerKey, $twitterConsumerSecret,
				$twitterAccessToken, $twitterAccessTokenSecret);
				$connection->setTimeouts(10, 15);

				$result = $connection->get("statuses/user_timeline",
				array("screen_name" => $q, "include_entities" => true, "count" => 200));

				// $result = $connection->get("statuses/user_timeline",
				// array("screen_name" => $q, "include_entities" => true, "count" => 200, "max_id" => "690686543824945152"));


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


				for ($i=0; $i <= 199 ; $i++) {

				$no = $i+1; 

				$data = object_to_array($result[$i]);



				// $id= $data["user"]["id"];
				// $name= $data["user"]["name"];
				// $screen_name= $data["user"]["screen_name"];
				// $location = $data["user"]["location"];
				// $url= $data["user"]["url"];
				// $description = $data["user"]["description"];
				// $time_zone= $data["user"]["time_zone"];
				// $lang=  $data["user"]["lang"];
				// $tweet_count = $data["user"]["statuses_count"];
				// $following_count= $data["user"]["friends_count"];
				// $followed_count = $data["user"]["followers_count"];
				// $favourites_count =  $data["user"]["favourites_count"];
				// $tweet= $data["text"];



				// $statement = $connection_db->prepare('INSERT INTO accounts(id,name,screen_name,location,url,description,time_zone, lang, tweet_count, following_count, followed_count,favourites_count, tweet) VALUES(:id,:name,:screen_name,:location,:url,:description,:time_zone, :lang,:tweet_count,:following_count,:followed_count, :favourites_count, :tweet)');
				// 	try{
				// 		$statement->execute([
				// 		':id'=>$id,
				// 		':name'=> $name,
				// 		':screen_name'=>$screen_name,
				// 		':location'=>$location,
				// 		':url'=>$url,
				// 		':description'=>$description,
				// 		':time_zone'=> $time_zone." ",
				// 		':lang'=>$lang,
				// 		':tweet_count'=>$tweet_count,
				// 		':following_count'=>$following_count,
				// 		':followed_count'=>$followed_count,
				// 		':favourites_count'=>$favourites_count,
				// 		':tweet'=>$tweet

				// 	]);
				// 		echo 'Data ['.$no.'] Berhasil disimpan!'.'<br>';
				// 		$no++;
				// 	}catch(Exeption $exc){
				// 		die($exc->getMessage());
				// 	}

				echo "<hr>";
				echo "TWEET KE ".$no;
				echo '<pre>';
				print_r($data);
				echo '</pre>';
				}

				
				


				// echo '<pre>';
				// print_r($result);
				// echo '</pre>';

				} catch (Abraham\TwitterOAuth\TwitterOAuthException $ex) {
				echo $ex->getMessage();
			}




		}




		



	?>


	

</body>
</html>