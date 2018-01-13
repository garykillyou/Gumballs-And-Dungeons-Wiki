<?php

function isNullinTable($content) {
	// echo $content . "<br>";
	preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $content, $temp );
	if ($temp[1] != null) {
		// echo $temp[1]. "<br>";
		return $temp[1];
	}
	else {
		preg_match ( '%<font color="#000000">(((?!</font>)[\s\S])*)</font>%', $content, $temp );
		// echo $temp[1]. "<br>";
		return $temp[1];
	}
}

function getFateTable($content, $fileName) {
	// echo $content . "<br>";
	preg_match_all ( "#<tr>(((?!</tr>)[\s\S])*)</tr>#", $content, $match );
	// echo count($match[1]) . "<br>";
	$tdList = array ();
	foreach ( $match[1] as $x ) {
		preg_match_all ( "#<td(((?!</td>)[\s\S])*)</td>#", $x, $match2 );
		$tdList[] = $match2[0];
	}
	// echo count($tdList) . "<br>";
	$fateList = array ();
	foreach ( $tdList as $x ) {
		if (count ( $x ) == 4) {
			$fate = new stdClass ();
			$fate->name = isNullinTable ( $x[0] );
			$fate->firstG = isNullinTable ( $x[1] );
			preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
			$fate->firstGcolor = $temp[1];
			$fate->secondG = isNullinTable ( $x[2] );
			preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
			$fate->secondGcolor = $temp[1];
			$fate->reward = preg_replace ( "#,#", "", isNullinTable ( $x[3] ) );
		}
		else if (count ( $x ) == 5) {
			$fate = new stdClass ();
			$fate->name = isNullinTable ( $x[0] );
			$fate->firstG = isNullinTable ( $x[1] );
			preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
			$fate->firstGcolor = $temp[1];
			if ($temp[1] != "#C0C0C0") {
				$fate->secondG = isNullinTable ( $x[2] );
				preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
				$fate->secondGcolor = $temp[1];
			}
			else {
				$fate->secondG = isNullinTable ( $x[3] );
				preg_match ( '#<td bgcolor="([^"]+)"#', $x[3], $temp );
				$fate->secondGcolor = $temp[1];
			}
			$fate->reward = preg_replace ( "#,#", "", isNullinTable ( $x[4] ) );
		}
		
		$fateList[] = $fate;
	}
	if (count ( $fateList ) > 0) {
		
		$temp = json_encode ( $fateList, JSON_UNESCAPED_UNICODE );
		$file = fopen ( $fileName, "w" );
		fwrite ( $file, $temp );
		fclose ( $file );
	}
	else
		echo "List = 0<br>ERROR!!!";
}

function getFateTableTEST($content) {
	// echo $content . "<br>";
// 	echo "+" . "<br>";
	preg_match_all ( "#<tr>(((?!</tr>)[\s\S])*)</tr>#", $content, $match );
	// echo count($match[1]) . "<br>";
	$tdList = array ();
	foreach ( $match[1] as $x ) {
		// echo $x . "<br>";
		preg_match_all ( "#<td(((?!</td>)[\s\S])*)</td>#", $x, $match2 );
		$tdList[] = $match2[0];
	}
	// echo count($tdList) . "<br>";
	$fateList = array ();
	foreach ( $tdList as $x ) {
		if (count ( $x ) == 4) {
			$fate = new stdClass ();
			$fate->name = isNullinTable ( $x[0] );
			$fate->firstG = isNullinTable ( $x[1] );
			preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
			$fate->firstGcolor = $temp[1];
			$fate->secondG = isNullinTable ( $x[2] );
			preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
			$fate->secondGcolor = $temp[1];
			// $fate->reward = preg_replace ( "#,#", "", isNullinTable ( $x[3] ) );
			$fate->reward = isNullinTable ( $x[3] );
		}
		else if (count ( $x ) == 5) {
			$fate = new stdClass ();
			$fate->name = isNullinTable ( $x[0] );
			$fate->firstG = isNullinTable ( $x[1] );
			preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
			$fate->firstGcolor = $temp[1];
			if ($temp[1] != "#C0C0C0") {
				$fate->secondG = isNullinTable ( $x[2] );
				preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
				$fate->secondGcolor = $temp[1];
			}
			else {
				$fate->secondG = isNullinTable ( $x[3] );
				preg_match ( '#<td bgcolor="([^"]+)"#', $x[3], $temp );
				$fate->secondGcolor = $temp[1];
			}
			$fate->reward = preg_replace ( "#,#", "", isNullinTable ( $x[4] ) );
		}
		
		$fateList[] = $fate;
	}
	/*
	 * foreach ( $tdList as $x ) {
	 * if (count ( $x ) == 4) {
	 * $fate = new stdClass ();
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[0], $temp );
	 * $fate->name = $temp[1];
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[1], $temp );
	 * $fate->firstG = $temp[1];
	 * preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
	 * $fate->firstGcolor = $temp[1];
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[2], $temp );
	 * $fate->secondG = $temp[1];
	 * preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
	 * $fate->secondGcolor = $temp[1];
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[3], $temp );
	 * $fate->reward = preg_replace ( "#,#", "", $temp[1] );
	 * }
	 * else if (count ( $x ) == 5) {
	 * $fate = new stdClass ();
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[0], $temp );
	 * $fate->name = $temp[1];
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[1], $temp );
	 * $fate->firstG = $temp[1];
	 * preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
	 * $fate->firstGcolor = $temp[1];
	 * if ($temp[1] != "#C0C0C0") {
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[2], $temp );
	 * $fate->secondG = $temp[1];
	 * preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
	 * $fate->secondGcolor = $temp[1];
	 * }
	 * else {
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[3], $temp );
	 * $fate->secondG = $temp[1];
	 * preg_match ( '#<td bgcolor="([^"]+)"#', $x[3], $temp );
	 * $fate->secondGcolor = $temp[1];
	 * }
	 * preg_match ( '#<font size="3">(((?!</font>)[\s\S])*)</font>#', $x[4], $temp );
	 * $fate->reward = preg_replace ( "#,#", "", $temp[1] );
	 * }
	 *
	 * $fateList[] = $fate;
	 * }
	 */
	if (count ( $fateList ) > 0) {
		print_r ( $fateList );
		$temp = json_encode ( $fateList, JSON_UNESCAPED_UNICODE );
		echo $temp;
	}
	else
		echo "List = 0";
}

function getFateTableInherit($content, $fileName) {
	// echo $content . "<br>";
	preg_match_all ( "#<tr>(((?!</tr>)[\s\S])*)</tr>#", $content, $match );
	// echo count($match[1]) . "<br>";
	$tdList = array ();
	foreach ( $match[1] as $x ) {
		preg_match_all ( "#<td(((?!</td>)[\s\S])*)</td>#", $x, $match2 );
		$tdList[] = $match2[0];
	}
	// echo count($tdList) . "<br>";
	$fateList = array ();
	foreach ( $tdList as $x ) {
		
		$fate = new stdClass ();
		$fate->name = isNullinTable ( $x[0] );
		$fate->firstG = isNullinTable ( $x[1] );
		preg_match ( '#<td bgcolor="([^"]+)"#', $x[1], $temp );
		$fate->firstGcolor = $temp[1];
		$fate->secondG = isNullinTable ( $x[2] );
		preg_match ( '#<td bgcolor="([^"]+)"#', $x[2], $temp );
		$fate->secondGcolor = $temp[1];
		$fate->reward = preg_replace ( "#,#", "", isNullinTable ( $x[3] ) );
		$fate->forG = isNullinTable ( $x[4] );
		preg_match ( '#<td bgcolor="([^"]+)"#', $x[4], $temp );
		$fate->forGcolor = $temp[1];
		
		$fateList[] = $fate;
	}
	if (count ( $fateList ) > 0) {
		
		$temp = json_encode ( $fateList, JSON_UNESCAPED_UNICODE );
		$file = fopen ( $fileName, "w" );
		fwrite ( $file, $temp );
		fclose ( $file );
	}
	else
		echo "List = 0. ERROR!!!";
}

if (isset ( $_POST["function"] )) {
	if ($_POST["function"] == "getFateTable") {
		if (isset ( $_POST["content"], $_POST["fileName"] ))
			getFateTable ( $_POST["content"], $_POST["fileName"] );
	}
	else if ($_POST["function"] == "getFateTableInherit") {
		if (isset ( $_POST["content"], $_POST["fileName"] ))
			getFateTableInherit ( $_POST["content"], $_POST["fileName"] );
	}
	else if ($_POST["function"] == "TEST") {
		if (isset ( $_POST["content"] ))
			echo $_POST["content"];
			getFateTableTEST ( $_POST["content"] );
	}
	else {
		
		echo "getFateTable.php POST[Function] not current. ERROR!!!";
	}
}
else {
	echo "getFateTable.php POST[Function]. ERROR!!!";
}

?>
