<?php

function getSQLorder($web_site) {
	if (isset ( $web_site )) {
		// print $site . "<br>";
		$content = file_get_contents ( $web_site );
		
		preg_match_all ( '#<p>[^>]+>#i', $content, $match );
		$tempArray = array ();
		foreach ( $match as $x ) {
			foreach ( $x as $y ) {
				$tempArray[] = preg_replace ( '#<[^>]*>#', '', $y );
			}
		}
		$description = preg_replace("#\s#", "", $tempArray[0]);
		$talent = preg_replace("#\s#", "", $tempArray[1]);
		$exclusive_skill = preg_replace("#\s#", "", $tempArray[2]);
		
		preg_match_all ( '#<div class="pi-data-value pi-font">[^>]+>#', $content, $match );
		$tempArray = array ();
		foreach ( $match as $x ) {
			foreach ( $x as $y ) {
				$tempArray[] = preg_replace ( '#<[^>]*>#', '', $y );
			}
		}
		$star_num = $tempArray[0];
		$temp = preg_replace ( '#[^1-9]*#', '', $star_num );
		$star_num = $temp;
		$faction = $tempArray[1];
		$type = $tempArray[2];
		
		preg_match_all ( '#<h1 class="page-header__title">[^>]+>#', $content, $match );
		$tempArray = array ();
		foreach ( $match as $x ) {
			foreach ( $x as $y ) {
				$tempArray[] = preg_replace ( '#<[^>]*>#', '', $y );
			}
		}
		
		$name = $tempArray[0];
		
		$total = $name . "','" . $description . "','" . $star_num . "','" . $faction . "','" . $type . "','" .
				 $talent . "','" . $exclusive_skill . "');";
		return $total;
	}
	else {
		echo "No site !!!!";
	}
}

function getSortList($file, $gumballsListState) {
	$list = file_get_contents ( $file );
	$json = json_decode ( $list );
	
	$sortList = array ();
	foreach ( $json as $x ) {
		$sortList[] = $x->name;
	}
	
	$ret = array ();
	foreach ( $sortList as $x ) {
		// print $x . "<br>";
		$pp = "#" . $x . "#";
		for($i = 0; $i < count ( $gumballsListState ); $i ++) {
			if (preg_match ( $pp, $gumballsListState[$i] ) == 1) {
				$ret[] = $gumballsListState[$i];
				array_splice ( $gumballsListState, $i, 1 );
				break;
			}
		}
	}
	
	return $ret;
}

function getGumballsListSite($webSite) {
	$content = file_get_contents ( $webSite );
	preg_match_all ( '#<b><a[^>]+>#', $content, $match );
	
	$tempArray = array ();
	foreach ( $match as $x ) {
		foreach ( $x as $y ) {
			preg_match ( '#/[^"]+"#', $y, $tempMatch );
			foreach ( $tempMatch as $z )
				$tempArray[] = $z;
		}
	}
	$list = array ();
	foreach ( $tempArray as $x ) {
		$list[] = str_replace ( '"', '?variant=zh-hant', $x );
	}
	
	// print count ( $tempArray ) . "<br>";
	$tempArray = $list;
	$list = array ();
	foreach ( $tempArray as $x ) {
		$list[] = "http://zh.gdmaze.wikia.com" . $x;
	}
	
	return $list;
}

if (isset ( $_POST["website"], $_POST["faction"] )) {
	
	$gumballsListSite = getGumballsListSite ( $_POST["website"] );
	// $imgList = getImgList ( $_POST["listname"] );
	
	$gumballsListState = array ();
	foreach ( $gumballsListSite as $x ) {
		$gumballsListState[] = getSQLorder ( $x );
	}
	
	// $gumballsListState = getSortList ( $_POST["sortname"], $gumballsListState );
	/*
	 * for($i = 0; $i < count ( $gumballsListState ); $i ++) {
	 * $gumballsListState[$i] = $gumballsListState[$i] . '")';
	 * }
	 */
	$faction = $_POST["faction"];
	foreach ( $gumballsListState as $x ) {
		echo 
		"INSERT INTO `" . $faction .
		 "` (`Name`, `Description`, `Star_Num`, `Faction`, `Type`, `Talent`, `Exclusive_skill`) VALUES ('" . $x .
		 "<br><br>";
	}
}
else {
	print "ERROR!!!";
}

?>
