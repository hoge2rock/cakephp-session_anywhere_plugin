<?php
class SessionAnywhereComponent extends Object {
	
	function initialize(&$controller) {
		if(class_exists("Session")){
			if(empty(Session::$SessionComponent) && !empty($controller->Session)){
				d("SessionAnywhereComponent got started.");
				Session::$SessionComponent =& $controller->Session;
			}
		}
	}

	function __call($method, $params) {
		if(class_exists("Session")){
			return call_user_func_array(array('Session', $method), $params);
		}
		//debug("SessionAnywhereComponent is not working properly.");
		return null;
	}
}

if(!class_exists("Session")){
class Session {
	static $SessionComponent;
	
	function check($name){
		return self::$SessionComponent->check($name);
	}
	function read($name){
		return self::$SessionComponent->read($name);
	}
	function write($name, $value){
		return self::$SessionComponent->write($name);
	}
	function delete($name){
		return self::$SessionComponent->delete($name);
	}
}
}