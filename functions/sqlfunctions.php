<?php

$rootdir = '';

//////
//Required files
//////


require $rootdir."connection.php";

/**
* SQL FUNCTIONS CALL
*/
class sqlfunctions
{

	private $debug = true;

	function __construct()
	{

	}


	public function select( $conn, $table, $fields = array() , $where = array(), $order = '', $group = array(), $limit = '', $debug = true){

		$qry = '';

		$qry .= 'SELECT ';

		if ( count($fields) > 0 ) {
			$tmpfeilds = implode(",", $fields);
			$qry .= $tmpfeilds;
		}else{
			$qry .= '*';
		}

		$qry .= ' FROM `'.$table.'`';

		if ( count($where) > 0 ) {

			$tmpwhere = '';

			foreach ( $where as $key => $value ) {
			  	$tmpwhere .= "`$key` = '$value'";
			}

			$qry .= ' WHERE '.rtrim($tmpwhere, ',');
		}

		if ( count( $group ) > 0 ) {
			$tmpgroup = implode(',', $group );
			$qry .= ' GROUP BY '.$tmpgroup;
		}

		if ( $order != '' ) {
			
			$qry .= ' ORDER BY '.$order;
		}

		if ( $limit != '' ) {
			
			$qry .= ' LIMIT '.$limit;
		}

		if ( $debug ) {

			echo $qry;
			exit();
		}

		$result = mysqli_query( $conn, $qry ) or  die( mysqli_error($conn) ) ;

		return $result;

	}

	public function insert( $conn, $table, $fields = array(), $values = array(), $debug = false ){

		$qry = 'INSERT INTO ';

		if ( $table != '' ) {

			$qry .= $table;

		} else {

			echo "Error : Table field cannot be empty.";
			exit();
		}

		if ( count($fields) > 0 ){

			$tmpfields = implode(', ', $fields);

			$qry .= '('.$tmpfields.')'; 
		}

		if ( count($values) > 0 ) {

			$str = '';
			foreach ($values as $key => $value) {

				for ($i=0; $i < count($value); $i++) { 
					if ( $i == 0 ) {
						$str .= '(';	
					}

						$str .= "'".$value[$i]."'";
					if ( $i != count($value) - 1 ) {
						$str .= ',';	
					}

					if ( $i == count($value) - 1 ) {
						$str .= '), ';	
					}
				}
				
			}

			$str = rtrim($str,'');
			$tmpvalues = rtrim($str,', ');
			
			$qry .= ' VALUES '.$tmpvalues;
					
		} else {

			echo 'Error : no value to insert';
			exit();
		}

		if ($debug == true) {
			echo $qry;
			exit();	
		}

		mysqli_query( $conn, $qry ) or  die( mysqli_error($conn) );
		$newid = mysqli_insert_id($conn);
		return $newid;

	}

	public function update( $table, $fields = array(), $where = array() ){

		

		
	}

	public function delete( $table, $where = array() ){

	}
}

$obj = new sqlfunctions();

$arr = $obj->insert($conn, "role", array('ROLE', 'STATUS'), [['test',1], ['test1',1]] );
print_r($arr);
?>