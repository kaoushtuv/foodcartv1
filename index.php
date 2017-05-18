<?php

	$array = [[1,2,3]];

	//echo count($array);

	$str = '';
	foreach ($array as $key => $value) {

		for ($i=0; $i < count($value); $i++) { 
			if ( $i == 0 ) {
				$str .= '(';	
			}

				$str .= $value[$i];
			if ( $i != count($value) - 1 ) {
				$str .= ',';	
			}

			if ( $i == count($value) - 1 ) {
				$str .= '), ';	
			}
		}
		
	}

	//echo rtrim( $str, ',');
	//substr("a,b,c,d,e,", 0, -1)
	$str = rtrim($str,'');
	$a = rtrim($str,', ');
	echo $a;
?>