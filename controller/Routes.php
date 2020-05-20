<?php
namespace Controller;

class Routes extends \Controller {
	
	public function Index(){
		
		$args = array();
		$args['offset'] = ( !empty( $_GET['page'] ) ? ( intval($_GET['page']) - 1 ) * PER_PAGE : 0 );
		$args['sorting_field'] = ( !empty( $_GET['sorting_field'] ) ? $_GET['sorting_field'] : '1' );
		$args['sorting_rule'] = ( !empty( $_GET['sorting_rule'] ) ? $_GET['sorting_rule'] : '' );
		
		$args['filter_field'] = ( !empty( $_GET['filter_field'] ) ? $_GET['filter_field'] : '' );
		$args['filter_rule'] = ( !empty( $_GET['filter_rule'] ) ? $_GET['filter_rule'] : '' );
		$args['filter_value'] = ( !empty( $_GET['filter_value'] ) ? $_GET['filter_value'] : '' );
		
		if( empty( $_GET['filter_field'] ) && empty( $_GET['filter_rule'] ) && empty( $_GET['filter_value'] ) ){
			
			$args['where_query'] = '1';
			$args['filter_field'] = '';
			$args['filter_rule'] = '';
			$args['filter_value'] = '';
			
		}elseif(  $_GET['filter_rule'] == 'more' ){
			$args['where_query'] = $_GET['filter_field'] . " > " . $this->check($_GET['filter_field'], $_GET['filter_value']);
		}elseif(  $_GET['filter_rule'] == 'less' ){
			$args['where_query'] = $_GET['filter_field'] . " < " . $this->check($_GET['filter_field'], $_GET['filter_value']);
		}elseif(  $_GET['filter_rule'] == 'like' ){
			$args['where_query'] = $_GET['filter_field'] . " LIKE '%" . $_GET['filter_value'] . "%'";
		}elseif(  $_GET['filter_rule'] == 'equal' ){
			$args['where_query'] = $_GET['filter_field'] . " = " . $this->check($_GET['filter_field'], $_GET['filter_value']);
		}
		
		$data['current_page'] = ( !empty( $_GET['page'] ) ? ( intval($_GET['page'])) : 1 );
		$data['page_link'] = get_controller_method_uri('Routes', 'Index');
		
		$data['sorting_rule'] = ( !empty( $_GET['sorting_rule'] ) ? $_GET['sorting_rule'] : '' );
		$data['sorting_field'] = ( !empty( $_GET['sorting_field'] ) ? $_GET['sorting_field'] : '' );
		
		$data['filter_action'] = get_controller_method_uri('Routes', 'Index', false);
		$data['routes'] = \Loader::loadModel('Routes', 'get_routes', $args);
		
		$data['pages'] = ceil($data['routes']['count'] / PER_PAGE);

		if(!empty($_GET['request'])){
			\View::viewOutput('ajaxRoutes', $data);	
		}
		return \View::viewGet('Routes', $data);
	}
	
	public function check($field, $value){
		global $db;
		$value = $db->prepare($value);
		if($field == 'Date') return "STR_TO_DATE('" . $value . "', '%Y-%m-%d')";
		return $value;
	}
	
	
	
	
}