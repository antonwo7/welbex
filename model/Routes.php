<?php
namespace Model;

class Routes{
	public function get_routes($args){
		global $db;
		
		$result = array();
		
		$query_string = "SELECT SQL_CALC_FOUND_ROWS * FROM routes WHERE " . $args['where_query'] . " ORDER BY " . $db->prepare( $args['sorting_field'] ) . " " . $db->prepare( $args['sorting_rule'] ) . " LIMIT " . PER_PAGE . " OFFSET " . $db->prepare( $args['offset'] );
		
		$query = $db->query($query_string);

		while ($row = $query->fetch_assoc()){
			$result['list'][] = $row;
		}
		
		$query_string = 'SELECT FOUND_ROWS() as count;';
		$query = $db->query($query_string);
		$result['count'] = array_shift($query->fetch_assoc());

		$query->close();
		
		return $result;
	}
	
}

?>