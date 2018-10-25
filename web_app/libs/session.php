<?php
	session_start();
	// Gán session (SET)
	function session_set($key, $val){
	    $_SESSION[$key] = $val;
	}

	// Gán session lv2
	function session_set_lv2($token, $key, $val){
	    $_SESSION[$token][$key] = $val;
	}

	// Lấy session (GET)
	function session_get($key){
	    return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
	}

	// Lấy session lv2 (GET)
	function session_get_lv2($token, $key){
	    return (isset($_SESSION[$token][$key])) ? $_SESSION[$token][$key] : false;
	}

	// Xóa session (DELETE)
	function session_delete($key){
	    if (isset($_SESSION[$key])){
	        unset($_SESSION[$key]);
	    }
	}
	echo session_get('id_member');

?>
