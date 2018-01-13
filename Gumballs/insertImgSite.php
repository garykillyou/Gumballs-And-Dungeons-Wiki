<?php

function getGumballsImgUpdateOrderWithFaction($img_site_list, $gumball_name_list, $faction) {
	$fileContent = fopen ( $img_site_list, "r" );
	if ($fileContent) {
		$list1 = array ();
		while ( ($list1[] = fgets ( $fileContent )) !== false ) {
		}
		fclose ( $fileContent );
	}
	
	$list2 = file_get_contents ( $gumball_name_list );
	$json = json_decode ( $list2 );
	
	$sortList = array ();
	foreach ( $json as $x ) {
		$sortList[] = $x->name;
	}
	
	$temp = array ();
	for($i = 0; $i < count ( $sortList ); $i ++) {
		$temp[] = "UPDATE `" . $faction . "` SET `Img_website` = \"" . $list1[$i] . "\" WHERE `Name` = \"" .
					 $sortList[$i] . "\";";
	}
	for($i = 0; $i < count ( $temp ); $i ++) {
		$temp[$i] = preg_replace ( '#png[^"]*"#', 'png"', $temp[$i] );
	}
	
	foreach ( $temp as $x ) {
		print $x . "<br>";
	}
}

if (isset ( $_POST["img_site_list"] ) && isset ( $_POST["gumball_name_list"] ) && isset ( $_POST["faction"] )) {
	getGumballsImgUpdateOrderWithFaction ( $_POST["img_site_list"], $_POST["gumball_name_list"],
										$_POST["faction"] );
}
else {
	print "ERROR!!!";
}

?>
