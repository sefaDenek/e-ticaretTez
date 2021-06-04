<?php

class Upload   {
	
		public $inputname,$uploadlimit;
		public $error=array(),$izinverilenuzanti=array(),$yuklenenler=array();
		
		
		function __construct() {
		 include 'config/Upload.php';
		 $this->uploadlimit=$UploadConfig["UploadLimit"];				
		 $this->izinverilenuzanti=$UploadConfig["izinverilenUzanti"];	
		}
		
		
		



	function UploadResimYeniEkleme($name,$sayi) {
			
		$this->inputname=$name; 
			
		for ($i=0; $i<$sayi; $i++):
			if (empty($_FILES[$name]["name"][$i])) :
				$this->error[]=$i+1 ."RESİM YOK";						
			endif;
		endfor;


		if (empty($this->error)) :
			$this->Boyutbak($name,$sayi);
			$this->Uzantibak($name,$sayi);


			if (empty($this->error)) :
				return $this->inputname;
			else:			
				return $this->error;			
			endif;	
			
		else:
		return $this->error;
			
		endif;
			
		}
		





		
		function uploadPostAl ($key) {
			
			if (!empty($_FILES[$key]["name"])):
			return true;
			
			else:
			return false;
			
			endif;
		}
		
		







		
	function UploadDosyaKontrol($name) {
		$this->inputname=$name;
			
		if (empty($_FILES[$name]["name"])) :
			$this->error[]="RESİM YÜKLENMEDİ";	
		else:
					
			$this->Boyutbak($name,false,true);
			$this->Uzantibak($name,false,true);
								
			if (empty($this->error)) :
				return true;
			else:				
			return false;
			endif;
										
		endif;
			
			
	}
		
		




		
		
	function Boyutbak ($dizidegeri=false,$sayi=false,$guncel=false)  {	
		
	if ($guncel) :
		
		if ($_FILES[$dizidegeri]["size"] > $this->uploadlimit) :
			$this->error[]="RESİM BOYUTU LİMİTİ AŞIYOR";						
		endif;
	else:
			
		for ($i=0; $i<$sayi; $i++):
			
			if ($_FILES[$dizidegeri]["size"][$i] > $this->uploadlimit) :
				$this->error[]=$i+1 .". RESİM İSTENİLEN BOYUTTAN FAZLA.";						
			endif;
			
		endfor;
		
	return $this->error;
		
	endif;
		
		}
		











	function Uzantibak ($dizidegeri=false,$sayi=false,$guncel=false)  {	
		if ($guncel) :
		
			if (!in_array($_FILES[$dizidegeri]["type"],$this->izinverilenuzanti)) :
				$this->error[]="RESİM UZANTISI HATALI.";						
			endif;
		
		else:			
			for ($i=0; $i<$sayi; $i++):			
				if (!in_array($_FILES[$dizidegeri]["type"][$i],$this->izinverilenuzanti)) :
				$this->error[]=$i+1 .". uzantı hatalı.";						
				endif;
			
			endfor;
		
		return $this->error;
		
		
		endif;
		}
		
		
		
		 
	
		
		
		
	function Yukle ($name=false,$guncel=false)  {			
			
		if (empty($this->error)) :
				
			if ($guncel) :
		
			$uzanti=explode(".",$_FILES[$name]["name"]);			
			$randdeger=md5(mt_rand(0,99999999999));
			$isim=$randdeger.".".end($uzanti);
					
						
			move_uploaded_file($_FILES[$name]["tmp_name"],RESİMYOL.$isim);				
				
			return $isim;
		
		
			else:	
			
			
			foreach ($_FILES[$this->inputname]["tmp_name"] as $key => $deger) :
			$uzanti=explode(".",$_FILES[$this->inputname]["name"][$key]);
			$randdeger=md5(mt_rand(0,99999999999));
			$isim=$randdeger.".".end($uzanti);
			move_uploaded_file($deger,RESİMYOL.$isim);				
			$this->yuklenenler[]=$isim;
			endforeach;



			return $this->yuklenenler;	
				
			endif;
		else:
		return $this->error;
		endif;
			
		
		
			
		}

		


}




?>