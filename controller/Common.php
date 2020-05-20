<?php
namespace Controller;

class Common extends \Controller{
	public function Index(){
		//$data['head'] = \Loader::loadController('Head');
		$data['routes'] = \Loader::loadController('Routes');
		
		\View::viewOutput('Common', $data);
	}
}