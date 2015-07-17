<?php
	/****
		GTS.php
			* By Hansiec
			
		- For use with Hansiec's trading system for Pokemon Essentials
		- Please edit the variables starting from $user ending at $table
		- After Editing, you can continue with main instructions
	****/
	$user = "openthegame";
	$password = "";
	$host = "localhost";
	$port = 3306;
	$database = "my_openthegame";
	$settings_table = "settings";
	$table = "gts";
	
	$version = "2.0.1";
	$default_message = "GTS, Version: $version";

	mysql_connect($host, $user, $password, $port) or die(mysql_error());
	
	if (!isset($_POST["action"]))
	{
		die($default_message);
	}
	else
	{
		$action = $_POST["action"];
	}
	
	if ($action == "getOnlineID") #### Tested, Works
	{
		$query = mysql_query("SELECT `total_ids` FROM `$database`.`$settings_table` WHERE `id` = 0");
		$str = "";
		$row = null;
		if ($query != false)
		{
			$row = mysql_fetch_array($query);
			$str = $row["total_ids"] + 1;
		}
		die("$str");
	}
	elseif ($action == "setOnlineID") #### Tested, Works
	{
		$id = $_POST["id"];
		$query = mysql_query("UPDATE `$database`.`$settings_table` SET `total_ids` = $id WHERE `id` = 0");
		if ($query != false)
		{
			die("success");
		}else
		{
			die("");
		}
	}
	elseif ($action == "hasPokemonUploaded") #### Tested, Works
	{
		$id = $_POST["id"];
		$query = mysql_query("SELECT `id` FROM `$database`.`$table` WHERE `id` = $id");
		if ($query != false)
		{
			$v = mysql_fetch_array($query);
			if (isset($v["id"]))
			{
				die("yes");
			}
		}
		die("no");
	}
	elseif ($action == "setTaken") #### Tested, Works
	{
		$id = $_POST["id"];
		
		$query = mysql_query("UPDATE `$database`.`$table` SET `taken` = 1 WHERE `id` = $id");
		if ($query != false)
		{
			die("success");
		}
	}
	elseif ($action == "isTaken") #### Tested, Works
	{
		$id = $_POST["id"];
		
		$query = mysql_query("SELECT `taken` FROM `$database`.`$table` WHERE `id` = $id");
		if ($query != false)
		{
			$row = mysql_fetch_array($query);
			if (isset($row["taken"]))
			{
				if ($row["taken"] == 1)
				{
					die("yes");
				}
			}
		}
		die("no");
	}
	elseif ($action == "uploadPokemon") #### Tested, Works
	{
		$id = $_POST["id"];
		$pokemon = $_POST["pokemon"];
		$species = $_POST["species"];
		$level = $_POST["level"];
		$gender = $_POST["gender"];
		$wspecies = $_POST["Wspecies"];
		$wlevelmin = $_POST["WlevelMin"];
		$wlevelmax = $_POST["WlevelMax"];
		$wgender = $_POST["Wgender"];
		
		$query = mysql_query("INSERT INTO `$database`.`$table` (`id`, `pokemon`, `species`, `level`, `gender`, `wanted_species`, `wanted_min_level`,
		`wanted_max_level`, `wanted_gender`) VALUES ($id, '$pokemon', $species, $level, $gender, $wspecies, $wlevelmin, $wlevelmax, $wgender)") or die(mysql_error());
		
		if ($query != false)
		{
			die("success");
		}
		else
		{
			die("");
		}
		
	}
	elseif ($action == "uploadNewPokemon") #### Tested, Works
	{
		$id = $_POST["id"];
		$pokemon = $_POST["pokemon"];
		
		$query = mysql_query("UPDATE `$database`.`$table` SET `pokemon` = '$pokemon' WHERE `id` = $id");
		if ($query != false)
		{
			die("success");
		}
		else
		{
			die("");
		}
	}
	elseif ($action == "downloadPokemon") #### Tested, Works
	{
		$id = $_POST["id"];
		
		$query = mysql_query("SELECT `pokemon` FROM `$database`.`$table` WHERE `id` = $id");
		if ($query != false)
		{
			$row = mysql_fetch_array($query);
			if (isset($row["pokemon"]))
			{
				die($row["pokemon"]);
			}
		}
		die("");
	}
	elseif ($action == "downloadWantedData") #### Not Tested, Should Work
	{
		$id = $_POST["id"];
		
		$query = mysql_query("SELECT * FROM `$database`.`$table` WHERE `id` = $id");
		if ($query != false)
		{
			$row = mysql_fetch_array($query);
			$str = "";
			if (!isset($row["wanted_species"]) || !isset($row["wanted_min_level"]) || !isset($row["wanted_max_level"]) || !isset($row["wanted_gender"]))
			{
				die("");
			}

			$str = "".$row["wanted_species"].",".$row["wanted_min_level"].",".$row["wanted_max_level"].",".$row["wanted_gender"];
			die($str);
		}
		die("");
	}
	elseif ($action == "deletePokemon") #### Tested, Works
	{
		$id = $_POST["id"];
		$withdraw = $_POST["withdraw"];
		if ($withdraw == "y")
		{
			$query = mysql_query("SELECT `taken` FROM `$database`.`$table` WHERE `id` = $id");
			if ($query != false)
			{
				$row = mysql_fetch_array($query);
				if (isset($row["taken"]))
				{
					if ($row["taken"] == 1)
					{
						die("failed, pokemon already taken!");
					}
				}
			}
		}
		
		$query = mysql_query("DELETE FROM `$database`.`$table` WHERE `id` = $id");
		if ($query != false)
		{
			die("success");
		}

		die("failed, could not execute query!");
	}
	elseif ($action == "getPokemonList") #### Tested, Works
	{
		$species = $_POST["species"];
		$levelMin = $_POST["levelMin"];
		$levelMax = $_POST["levelMax"];
		$gender = $_POST["gender"];
		$id = $_POST["id"];
		
		if ($gender != -1)
		{
			$query = mysql_query("SELECT * FROM `$database`.`$table` WHERE `id` != $id && `species` = $species && `level` >= $levelMin && `level` <= $levelMax &&
			`gender` = $gender && taken = 0") or die(mysql_error());
		}
		else
		{
			$query = mysql_query("SELECT * FROM `$database`.`$table` WHERE `id` != $id && `species` = $species && `level` >= $levelMin && `level` <= $levelMax && taken = 0")
			or die(mysql_error());
		}
		$str = "";
		$row = null;
		if ($query != false)
		{
			$row = mysql_fetch_array($query);
			$str = $str.$row["id"];
			while($row = mysql_fetch_array($query))
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
	elseif ($action == "getPokemonListFromWanted") #### Not Tested, should work
	{
		$species = $_POST["species"];
		$level = $_POST["level"];
		$gender = $_POST["gender"];
		$id = $_POST["id"];
		
		$query = mysql_query("SELECT * FROM `$database`.`$table` WHERE `id` != $id && `wanted_species` = $species && `wanted_max_level` >= $level && `wanted_min_level` <= $level &&
		(`wanted_gender` = $gender || `wanted_gender` = -1) && `taken` = 0") or die(mysql_error());
		$str = "";
		$row = null;
		if ($query != false)
		{
			$row = mysql_fetch_array($query);
			$str = $str.$row["id"];
			while($row = mysql_fetch_array($query))
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
	elseif ($action == "createTables") #### Tested, Works
	{
		mysql_query("CREATE DATABASE IF NOT EXISTS `$database` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci") or die(mysql_error());
		mysql_query("USE `$database`") or die(mysql_error());
		mysql_query("DROP TABLE IF EXISTS `$table`") or die(mysql_error());
		mysql_query("DROP TABLE IF EXISTS `$settings_table`") or die(mysql_error());
		mysql_query("CREATE TABLE `$table` (
		  `id` int(11) NOT NULL,
		  `pokemon` varchar(3000) NOT NULL,
		  `species` int(11) NOT NULL,
		  `level` int(11) NOT NULL,
		  `gender` int(11) NOT NULL,
		  `wanted_species` int(11) NOT NULL,
		  `wanted_min_level` int(11) NOT NULL,
		  `wanted_max_level` int(11) NOT NULL,
		  `wanted_gender` int(11) NOT NULL,
		  `taken` int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysql_error());
		mysql_query("CREATE TABLE `$settings_table` (
		  `id` int(11) NOT NULL,
		  `total_ids` int(11) NOT NULL,
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `total_ids` (`total_ids`)
		) ENGINE=InnoDB DEFAULT CHARSET=latin1;") or die(mysql_error());
		mysql_query("INSERT INTO `$settings_table` (`id`, `total_ids`) VALUES (0, 0)") or die(mysql_error());
	}
	
	die($default_message);
?>