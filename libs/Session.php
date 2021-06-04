<?php



class  Session {

	public static $db;

	public static function init() {

		self::$db= new Database();

		if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 		

	

		

	}

	

	

	public static function set ($key,$value) {

		$_SESSION[$key]=$value;
	}

	

	public static function get ($key) {
		
		if (isset($_SESSION[$key])) 
		return $_SESSION[$key];

		

	}

	

	public static function destroy() {
		session_destroy();
		

	}// oturum kapatma

	
	public static function OturumKontrol($tabloAdi,$deger1,$deger2) {
		
	 $sonuc=self::$db->listele($tabloAdi,"where ad='".$deger1."' and id=".$deger2);
	
	
	if (!isset($sonuc[0])) :
	
	
	self::destroy();
	
	endif;	

		
	}
	

	



	

}









?>