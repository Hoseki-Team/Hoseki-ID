<?php
	/****
		GTS.php
			* By Hansiec
			
		- For use with Hansiec's trading system for Pokemon Essentials
		- Please edit the variables starting from $user ending at $table
		- After Editing, you can continue with main instructions
	****/
	$user = "root";
	$password = "";
	$host = "localhost";
	$port = 3306;
	$database = "cremisi_portals";
	$settings_table = "settings";
	$table = "gts";
	
	$version = "3.0";
	$default_message = "GTS, Version: $version";

	$mysqli = mysqli_connect($host, $user, $password, $database, $port);
	
	if ($mysqli->connect_errno) {
    echo "failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if (!isset($_POST["action"]))
	{
		die($default_message);
	}
	else
	{
		$action = $_POST["action"];
	}
	

	if ($action == "getOnlineID") #### Tested (mysqli), Works
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$query = $mysqli->query("SELECT * FROM users WHERE username = '$username'");
		$str = "";
		$row = null;
		if ($query != false)
		{
			$row = $query->fetch_assoc();
			if (!isset($row["password"]))
			{
				die("user doesn't exist");
			}
			elseif ($row["password"] == $password) {
				die($row["user_id"]);
			}
			else {
				die("invalid password");
			}
		}
		else {
			die("SQL Error");
		}
	}
	elseif ($action == "newAccount") ### Tested (mysqli), Works
	{
		$username = $_POST["username"];
		$password = $_POST["password"];
		$email = $_POST["email"];

		if (!$query = $mysqli->query("SELECT * FROM users WHERE username = '$username' OR email = '$email'"))
		{
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		$row = $query->fetch_assoc();
		if (!isset($row["user_id"])) {
			if (!$query = $mysqli->query("INSERT INTO users (username, password, email) VALUES ('$username', '$password', '$email')")) {
				die("row creation failed: (" . $mysqli->errno . ") " . $mysqli->error);
			}
			else {
				die("success");
			}
		}
		else {
			die("username or email already exist");
		}
	}
	elseif ($action == "hasPokemonUploaded") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		
		if (!$query = $mysqli->query("SELECT * FROM gts WHERE id = $id")) {
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			$row = $query->fetch_assoc();
			if(!isset($row["id"])) {
				die("no");
			}
			else {
				die("yes");
			}
		}
	}
	elseif ($action == "setTaken") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		
		if (!$query = $mysqli->query("UPDATE gts SET taken = 1 WHERE id = $id")) {
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			die("success");
		}
	}
	elseif ($action == "isTaken") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		
		if (!$query = $mysqli->query("SELECT taken FROM gts WHERE id = $id")) {
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			$row = $query->fetch_assoc();
			if (isset($row["taken"]))
			{
				if ($row["taken"] == 1)
				{
					die("yes");
				}
				else {
					die("no");
				}
			}
			else {
				die("pokemon doesn't exist");
			}
		}
	}
	elseif ($action == "uploadPokemon") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		$pokemon = $_POST["pokemon"];
		$species = $_POST["species"];
		$level = $_POST["level"];
		$gender = $_POST["gender"];
		$wspecies = $_POST["Wspecies"];
		$wlevelmin = $_POST["WlevelMin"];
		$wlevelmax = $_POST["WlevelMax"];
		$wgender = $_POST["Wgender"];
		
		if(!$query = $mysqli->query("INSERT INTO gts (`id`, `pokemon`, `species`, `level`, `gender`, `wanted_species`, `wanted_min_level`,
		`wanted_max_level`, `wanted_gender`) VALUES ($id, '$pokemon', $species, $level, $gender, $wspecies, $wlevelmin, $wlevelmax, $wgender)")) {
			die("insert failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			die("success");
		}
	}
	elseif ($action == "uploadNewPokemon") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		$pokemon = $_POST["pokemon"];
		
		if (!$query = $mysqli->query("UPDATE gts SET pokemon = '$pokemon' WHERE id = $id")) {
			die("insert failed: (" . $mysqli->errno . ") " . $mysqli->error);	
		}
		else {
			die("success");
		}
	}
	elseif ($action == "downloadPokemon") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		
		if (!$query = $mysqli->query("SELECT pokemon FROM gts WHERE id = $id")) {
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			$row = $query->fetch_assoc();
			if (isset($row["pokemon"]))
			{
				die($row["pokemon"]);
			}
			else {
				die("");
			}
		}
	}
	elseif ($action == "downloadWantedData") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		
		if (!$query = $mysqli->query("SELECT * FROM gts WHERE id = $id")) {
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			$row = $query->fetch_assoc();
			$str = "";
			if (!isset($row["wanted_species"]) || !isset($row["wanted_min_level"]) || !isset($row["wanted_max_level"]) || !isset($row["wanted_gender"]))
			{
				die("error column");
			}

			$str = "".$row["wanted_species"].",".$row["wanted_min_level"].",".$row["wanted_max_level"].",".$row["wanted_gender"];
			die($str);
		}
	}
	elseif ($action == "deletePokemon") #### Tested (mysqli), Works
	{
		$id = $_POST["onlineID"];
		$withdraw = $_POST["withdraw"];
		if ($withdraw == "y")
		{
			if (!$query = $mysqli->query("SELECT taken FROM gts WHERE id = $id"))
			{
				die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
			}
			else
			{
				$row = $query->fetch_assoc();
				if (isset($row["taken"]))
				{
					if ($row["taken"] == 1)
					{
						die("failed, pokemon already taken!");
					}
				}
			}
		}
		
		if (!$query = $mysqli->query("DELETE FROM gts WHERE id = $id")) {
			die("delete failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		else {
			die("success");
		}
	}
	elseif ($action == "getPokemonList") #### Tested (mysqli), Works
	{
		$species = $_POST["species"];
		$levelMin = $_POST["levelMin"];
		$levelMax = $_POST["levelMax"];
		$gender = $_POST["gender"];
		$id = $_POST["onlineID"];
		
		if ($gender != -1)
		{
			if (!$query = $mysqli->query("SELECT * FROM gts WHERE `id` != $id && `species` = $species && `level` >= $levelMin && `level` <= $levelMax &&
			`gender` = $gender && taken = 0")) {
				die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
			}
		}
		else
		{
			if (!$query = $mysqli->query("SELECT * FROM gts WHERE `id` != $id && `species` = $species && `level` >= $levelMin && `level` <= $levelMax && taken = 0")) {
				die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
			}
		}
		$str = "";
		$row = null;
		if ($query != false)
		{
			$row = $query->fetch_assoc();
			$str = $str.$row["id"];
			while($row = $query->fetch_assoc())
			{
				$str = $str.",".$row["id"];
			}
		}
		if ($str == "")
		{
			$str = "nothing";
		}
		die($str);
	}
	elseif ($action == "getPokemonListFromWanted") #### Tested (mysqli), Works
	{
		$species = $_POST["species"];
		$level = $_POST["level"];
		$gender = $_POST["gender"];
		$id = $_POST["onlineID"];
		
		if (!$query = $mysqli->query("SELECT * FROM gts WHERE `id` != $id && `wanted_species` = $species && `wanted_max_level` >= $level && `wanted_min_level` <= $level &&
		(`wanted_gender` = $gender || `wanted_gender` = -1) && `taken` = 0")) {
			die("query failed: (" . $mysqli->errno . ") " . $mysqli->error);
		}
		$str = "";
		$row = null;
		if ($query != false)
		{
			$row = $query->fetch_assoc();
			$str = $str.$row["id"];
			while($row = $query->fetch_assoc())
			{
				$str = $str.",".$row["id"];
			}
		}
		if ($str == "")
		{
			$str = "nothing";
		}
		die($str);
	}
	
	die($default_message);
?>