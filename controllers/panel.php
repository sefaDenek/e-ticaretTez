<?php

class panel extends Controller  {
	
	
function __construct() {
		parent::__construct();
		
	$this->Modelyukle('adminpanel');
	Session::init();

	if (!Session::get("AdminAd") && !Session::get("Adminid")) : 
		$this->giris();
		exit();
	endif;
	
}	
	
//---------------------GİRİŞ KODLARI BAŞLA----------------------------------
	
	function giris() {

		if (Session::get("AdminAd") && Session::get("Adminid")) : 

			$this->bilgi->direktYonlen("/panel/siparisler");


		else:
			
			$this->view->goster("YonPanel/sayfalar/index");
		
		endif;
	
		
	} // giriş ekranı


	function Index() {
		
	
		$this->siparisler();
			
	} // giriş ekranı





//---------------------GİRİŞ KODLARI BİTİŞ----------------------------------
	
//---------------------SİPARİŞ KODLARI BAŞLA----------------------------------
	function siparisler() {

	$this->view->goster("YonPanel/sayfalar/siparis",array(
		"data"=> $this->model->Verial("siparisler","order BY id desc")

	));
		
	}   // siparişlerin indexi

	function kargoguncelle($sipno) {

		$this->view->goster("/YonPanel/sayfalar/siparis",array(
			"KargoGuncelle"=> $this->model->Verial("siparisler","where siparis_no=".$sipno)
	
		));
			
		}   // kargo durum değiştirme

	function kargoguncelleSon() {

			if ($_POST) :	
		
				$sipno=$this->form->get("sipno")->bosmu();
				$durum=$_POST["durum"];


				$sonuc=$this->model->Guncelle("siparisler",
				array("kargodurum"),
				array($durum),"siparis_no=".$sipno);
			
				if ($sonuc): 
			
					$this->view->goster("YonPanel/sayfalar/siparis",
					array(
					"bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/panel/siparisler")
					 ));
						
				else:
				
					$this->view->goster("YonPanel/sayfalar/siparis",
					array(
						"data"=> $this->model->Verial("siparisler",false),
					"bilgi" => $this->bilgi->uyari("danger","Güncelleme sırasında hata oluştu.")
					 ));	
				
				endif;

			else:

				$this->bilgi->direktYonlen("/panel/siparisler");


			endif;	
		
	}   // kargo durum güncelleme son işlem




	function siparisarama() {	
		
		if ($_POST) :
		$aramatercih=$this->form->get("aramatercih")->bosmu();
		
		$aramaverisi=$this->form->get("aramaverisi")->bosmu();
		
		
		
				if (!empty($this->form->error)) :
				
			$this->view->goster("YonPanel/sayfalar/siparis",
			array(		
			"bilgi" => $this->bilgi->hata("BİLGİ GİRİLMELİDİR.","/panel/siparisler",1)
			 ));
				
				
				else:
				
				
		if ($aramatercih=="sipno") :
				
				
			$this->view->goster("YonPanel/sayfalar/siparis",array(
	
			"data" => $this->model->arama("siparisler","siparis_no LIKE '%".$aramaverisi."%'")));	
			
			elseif($aramatercih=="uyebilgi"):
			
			
			$bilgicek=$this->model->arama("uye_panel",
			"id LIKE '%".$aramaverisi."%' or 
			ad LIKE '%".$aramaverisi."%'  or 
			soyad LIKE '%".$aramaverisi."%' or 
			telefon LIKE '%".$aramaverisi."%'");
			
				if ($bilgicek):
			
				$this->view->goster("YonPanel/sayfalar/siparis",array(				
				"data" => $this->model->Verial("siparisler", "where uyeid=".$bilgicek[0]["id"])				
				));		
				
				else:
				
				$this->view->goster("YonPanel/sayfalar/siparis",
				array(		
				"bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/siparisler",2)
				 ));			
				endif;
				
		endif;
				
		
		
				
				endif;
		
		
		
		else:
			$this->bilgi->direktYonlen("/panel/siparisler");		
		
		
		endif;
	
			

	
		
	}// siparis arama fonksiyonu



//---------------------SİPARİŞ KODLARI BİTİŞ----------------------------------		

//---------------------KATEGORİ KODLARI BAŞLA----------------------------------

	function kategoriler() {

			$this->view->goster("YonPanel/sayfalar/kategoriler",array(
				"anakategori"=> $this->model->Verial("ana_kategori",false),
				"cocukkategori"=> $this->model->Verial("cocuk_kategori",false),
				"altkategori"=> $this->model->Verial("alt_kategori",false)
		
			));
				
	}   // kategorileri getirme

			

	function kategoriGuncelle($kriter,$id) {

		$this->view->goster("YonPanel/sayfalar/kategoriguncelleme",array(
			"data"=> $this->model->Verial($kriter."_kategori","where id=".$id),
			"kriter"=> $kriter,
			"AnakategorilerTumu"=> $this->model->Verial("ana_kategori",false),
			"CocukkategorilerTumu"=> $this->model->Verial("cocuk_kategori",false)
					
			
		));
					
	} //kategorileri çekme güncelleme yardımcı

				
	function kategoriGuncelSon() {
		if ($_POST) :	

			$kriter=$this->form->get("kriter")->bosmu();
			$kayitid=$this->form->get("kayitid")->bosmu();
			$katad=$this->form->get("katad")->bosmu();

			@$anakatid=$_POST["anakatid"];
			@$cocukkatid=$_POST["cocukkatid"];


				if(!empty($this->form->error)):
					$this->view->goster("YonPanel/sayfalar/kategoriguncelleme",
					array(
					"bilgi" => $this->bilgi->hata("kategori adı giriniz","/panel/kategoriler",1)
					));

				else:



					if($kriter=="ana"):

						$sonuc=$this->model->Guncelle("ana_kategori",
							array("ad"),
							array($katad),"id=".$kayitid);

			
					elseif($kriter=="cocuk"):

						$sonuc=$this->model->Guncelle("cocuk_kategori",
							array("ana_kat_id","ad"),
							array($anakatid,$katad),"id=".$kayitid);


			
			
					elseif($kriter=="alt"):
						$sonuc=$this->model->Guncelle("alt_kategori",
							array("cocuk_kat_id","ana_kat_id","ad"),
							array($cocukkatid,$anakatid,$katad),"id=".$kayitid);

			
					endif;
		
		
						
					
					if ($sonuc): 
							
					$this->view->goster("YonPanel/sayfalar/kategoriguncelleme",
						array("bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/panel/kategoriler",2)
					));
										
					else:
								
						$this->view->goster("YonPanel/sayfalar/kategoriguncelleme",
							array("bilgi" => $this->bilgi->hata("GÜNCELLEME İŞLEMİNDE HATA OLDU","/panel/kategoriler",2)
						));	
								
					endif;


		
				endif;


		
			else:
		
				$this->bilgi->direktYonlen("/panel/kategoriler");
		
		
		endif;	

	} //kategori güncelleme son



	function kategoriSil($kriter,$id) {

		$sonuc=$this->model->Sil($kriter."_kategori"," id=".$id);

		if ($sonuc): 
							
			$this->view->goster("YonPanel/sayfalar/kategoriler",
				array("bilgi" => $this->bilgi->basarili("SİLME İŞLEMİ BAŞARILI","/panel/kategoriler",2)
			));
								
			else:
						
				$this->view->goster("YonPanel/sayfalar/kategoriler",
					array("bilgi" => $this->bilgi->hata("SİLME İŞLEMİNDE HATA OLDU","/panel/kategoriler",2)
				));	
						
			endif;

		
					
	} //kategori silme işlemleri


	function kategoriEkle($kriter) {


		$this->view->goster("YonPanel/sayfalar/kategoriEkle",
			array("kriter"=> $kriter,
			"AnakategorilerTumu"=> $this->model->Verial("ana_kategori",false),
			"CocukkategorilerTumu"=> $this->model->Verial("cocuk_kategori",false)
	
	
	
		));

		

		
					
	} //kategori ekleme



	function kategoriEkleSon() {


	
		if ($_POST) :	

			$kriter=$this->form->get("kriter")->bosmu();
			$katad=$this->form->get("katad")->bosmu();

			@$anakatid=$_POST["anakatid"];
			@$cocukkatid=$_POST["cocukkatid"];


				if(!empty($this->form->error)):
					$this->view->goster("YonPanel/sayfalar/kategoriEkle",
					array(
					"bilgi" => $this->bilgi->hata("kategori adı giriniz","/panel/kategoriler",2)
					));

				else:



					if($kriter=="ana"):

						$sonuc=$this->model->Ekleme("ana_kategori",
							array("ad"),
							array($katad));

			
					elseif($kriter=="cocuk"):

						$sonuc=$this->model->Ekleme("cocuk_kategori",
							array("ana_kat_id","ad"),
							array($anakatid,$katad));


			
			
					elseif($kriter=="alt"):
						$sonuc=$this->model->Ekleme("alt_kategori",
							array("cocuk_kat_id","ana_kat_id","ad"),
							array($cocukkatid,$anakatid,$katad));

			
					endif;
		
		
						
					
					if ($sonuc): 
							
					$this->view->goster("YonPanel/sayfalar/kategoriEkle",
						array("bilgi" => $this->bilgi->basarili("KATEGORİ EKLEME BAŞARILI","/panel/kategoriler",2)
					));
										
					else:
								
						$this->view->goster("YonPanel/sayfalar/kategoriEkle",
							array("bilgi" => $this->bilgi->hata("KATEGORİ EKLEME İŞLEMİNDE HATA OLDU","/panel/kategoriler",2)
						));	
								
					endif;

				endif;


		
			else:
		
				$this->bilgi->direktYonlen("/panel/kategoriler");
		
		
		endif;	
		

		
					
	} //kategori ekleme son

//---------------------KATEGORİ KODLARI SON----------------------------------



//---------------------UYE KODLARI BASLA----------------------------------


	function uyeler() {
		
	
		$this->view->goster("YonPanel/sayfalar/uyeler",array(
			"data"=> $this->model->Verial("uye_panel",false),
			"data2"=> $this->model
		));
			
		} //üyeleri listeleme


	
		function uyearama() {	
		
			if ($_POST) :
					
			$aramaverisi=$this->form->get("aramaverisi")->bosmu();
			
			
			
					if (!empty($this->form->error)) :
					
					$this->view->goster("YonPanel/sayfalar/uyeler",
					array(		
					"bilgi" => $this->bilgi->hata("KRİTER GİRİLMELİDİR.","/panel/uyeler",2)
					 ));
					
					
					else:
					
				
				
				$bilgicek=$this->model->arama("uye_panel",
				"id LIKE '%".$aramaverisi."%' or 
				ad LIKE '%".$aramaverisi."%'  or 
				soyad LIKE '%".$aramaverisi."%' or 
				telefon LIKE '%".$aramaverisi."%'");
				
					if ($bilgicek):
				
					$this->view->goster("YonPanel/sayfalar/uyeler",array(
					
					"data" => $bilgicek				
					));		
					
					else:
					
					$this->view->goster("YonPanel/sayfalar/uyeler",
					array(		
					"bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/uyeler",2)
					 ));			
					endif;
		
					
					endif;
			
			
			
			else:
				$this->bilgi->direktYonlen("/panel/uyeler");		
			
			
			endif;
		
				
	
		
			
		}// üyeleri arama fonksiyonu

	function uyeSil($id) {

		$sonuc=$this->model->Sil("uye_panel","id=".$id);
		
		if ($sonuc): 
									
			$this->view->goster("YonPanel/sayfalar/uyeler",
				array("bilgi" => $this->bilgi->basarili("SİLME İŞLEMİ BAŞARILI","/panel/uyeler",2)
			));
										
		else:
								
			$this->view->goster("YonPanel/sayfalar/uyeler",
				array("bilgi" => $this->bilgi->hata("SİLME İŞLEMİNDE HATA OLDU","/panel/uyeler",2)
			));	
								
		endif;
		
				
							
	} //üye silme işlemleri


	function uyeGuncelle($id) {

				$this->view->goster("YonPanel/sayfalar/uyeler",array(
					"Uyeguncelle"=> $this->model->Verial("uye_panel","where id=".$id)
					
				));
							
	} // üye bilgi güncelleme


	function uyeguncelleSon() {
		if ($_POST) :	


			$uyeid=$this->form->get("uyeid")->bosmu();
			$ad=$this->form->get("ad")->bosmu();
			$soyad=$this->form->get("soyad")->bosmu();
			$mail=$this->form->get("mail")->bosmu();
			$telefon=$this->form->get("telefon")->bosmu();
			$durum=$_POST["durum"];
			



			if(!empty($this->form->error)):
				$this->view->goster("YonPanel/sayfalar/uyeler",
				array(
					"bilgi" => $this->bilgi->hata("Boş alan bırakılamaz","/panel/uyeler",1)
				));

			else:
				$sonuc=$this->model->Guncelle("uye_panel",
					array("ad","soyad","mail","telefon","durum"),
					array($ad,$soyad,$mail,$telefon,$durum),"id=".$uyeid);

		
		
		
						
					
				if ($sonuc): 
							
					$this->view->goster("YonPanel/sayfalar/uyeler",
						array("bilgi" => $this->bilgi->basarili("GÜNCELLEME BAŞARILI","/panel/uyeler",2)
					));
										
				else:
								
						$this->view->goster("YonPanel/sayfalar/uyeler",
							array("bilgi" => $this->bilgi->hata("GÜNCELLEME İŞLEMİNDE HATA OLDU","/panel/uyeler",2)
						));	
								
				endif;


		
			endif;


		
		else:
		
				$this->bilgi->direktYonlen("/panel/uyeler");
		
		
		endif;	

	} //üye güncelleme son

	function uyeadresbak($id) {

		$this->view->goster("YonPanel/sayfalar/uyeler",array(
			"UyeadresBak"=> $this->model->Verial("adresler","where uyeid=".$id)
			
		));
					
} // üye adres getir



//---------------------UYE KODLARI BİTİŞ----------------------------------



//---------------------ÜRÜN KODLARI BAŞLA----------------------------------

	function urunler() {
		
	
		$this->view->goster("YonPanel/sayfalar/urunler",array(
			"data"=> $this->model->Verial("urunler",false),
			"data2"=> $this->model->Verial("alt_kategori",false)
		));
			
		} //ÜRÜNLERİ AL


	function urunGuncelle($id) {
		
	
				
		$this->view->goster("YonPanel/sayfalar/urunler",array(	
			"Urunguncelle" => $this->model->Verial("urunler","where id=".$id),
			"data2" => $this->model->Verial("alt_kategori",false)		
		));	
				
			
				
	} // ÜRÜN GÜNCELLE	
			
	function urunguncelleSon() {	
				
				
		if ($_POST) :	

		$urunad=$this->form->get("urunad")->bosmu();
		$katid=$this->form->get("katid")->bosmu();
		$malzeme=$this->form->get("malzeme")->bosmu();
		$uretimyeri=$this->form->get("uretimyeri")->bosmu();
		$renk=$this->form->get("renk")->bosmu();
		$fiyat=$this->form->get("fiyat")->bosmu();
		$stok=$this->form->get("stok")->bosmu();
		$durum=$_POST["durum"];
		$urunaciklama=$this->form->get("urunaciklama")->bosmu();
		$urunozellik=$this->form->get("urunozellik")->bosmu();
		$urunekstra=$this->form->get("urunekstra")->bosmu();
		$kayitid=$this->form->get("kayitid")->bosmu();
						
						
				
						
		if ($this->Upload->uploadPostAl("res1")) : $this->Upload->UploadDosyaKontrol("res1");	endif;	
		
		if ($this->Upload->uploadPostAl("res2")) : $this->Upload->UploadDosyaKontrol("res2");	endif;	
						
		if ($this->Upload->uploadPostAl("res3")) : $this->Upload->UploadDosyaKontrol("res3");	endif;				
				
				
						
					
						
			if (!empty($this->form->error)) :
						
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(		
				"bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.","/panel/urunler",2)
			 ));
					 
			elseif (!empty($this->Upload->error)) :
						
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
					"bilgi" => $this->Upload->error,
					"yonlen" =>$this->bilgi->sureliYonlen(3,"/panel/urunler") 
				 ));	
				
			
						
			else:	
						
				
					
					
			$sutunlar=array("katid","urunad","durum","aciklama","malzeme","urtYeri","renk","fiyat","stok","ozellik","ekstraBilgi");
					
			$veriler=array($katid,$urunad,$durum,$urunaciklama,$malzeme,$uretimyeri,$renk,$fiyat,$stok,$urunozellik,$urunekstra);
					
					
		 if ($this->Upload->uploadPostAl("res1")) :
			 $sutunlar[]="res1"; 
			$veriler[]=$this->Upload->Yukle("res1",true); 
		 endif;	
		
		 if ($this->Upload->uploadPostAl("res2")) :
			 $sutunlar[]="res2"; 
			$veriler[]=$this->Upload->Yukle("res2",true); 
		 endif;	
		  if ($this->Upload->uploadPostAl("res3")) :
			 $sutunlar[]="res3"; 
			$veriler[]=$this->Upload->Yukle("res3",true); 
		 endif;	
					
				
			
		$sonuc=$this->model->Guncelle("urunler",
		$sutunlar,
		$veriler,"id=".$kayitid);
						
			
				
			
				if ($sonuc): 
			
					$this->view->goster("YonPanel/sayfalar/urunler",
					array(
					"bilgi" => $this->bilgi->basarili("ÜRÜN BAŞARIYLA GÜNCELLENDİ","/panel/urunler",2)
					 ));
						
				else:
				
					$this->view->goster("YonPanel/sayfalar/urunler",
					array(
					"bilgi" => $this->bilgi->hata("GÜNCELLEME SIRASINDA HATA OLUŞTU.","/panel/urunler",2)
					 ));	
				
				endif;
				
			
				
			endif;
				
						
			else:
			$this->bilgi->direktYonlen("/panel/urunler");
						
			
		endif;		
				
				
				
			
			
				
		} // ÜRÜNLER GÜNCEL SON

	function Urunekleme() {	
				
			$this->view->goster("YonPanel/sayfalar/urunler",array(	
			"Urunekleme" => true,
			"data2" => $this->model->Verial("alt_kategori",false)		
			));	
				
			
				
	}	 // ÜRÜN EKLEME


	function urunekle() {	
		
		
		if ($_POST) :	
		
		$urunad=$this->form->get("urunad")->bosmu();
		$katid=$this->form->get("katid")->bosmu();
		$malzeme=$this->form->get("malzeme")->bosmu();
		$uretimyeri=$this->form->get("uretimyeri")->bosmu();
		$renk=$this->form->get("renk")->bosmu();
		$fiyat=$this->form->get("fiyat")->bosmu();
		$stok=$this->form->get("stok")->bosmu();
		$durum=$_POST["durum"];
		$urunaciklama=$this->form->get("urunaciklama")->bosmu();
		$urunozellik=$this->form->get("urunozellik")->bosmu();
		$urunekstra=$this->form->get("urunekstra")->bosmu();
		
		$this->Upload->UploadResimYeniEkleme("res",3);
			
		
			
			if (!empty($this->form->error)) :
			
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
				"bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.","/panel/urunler",2)
				));	
		 
			elseif (!empty($this->Upload->error)) :
			
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
				"bilgi" => $this->Upload->error
				));	
			
			else:	
			
	
			$dosyayukleme=$this->Upload->Yukle();

			$sonuc=$this->model->Ekleme("urunler",
				array("katid","urunad","res1","res2","res3","durum","aciklama","malzeme","urtYeri","renk","fiyat","stok","ozellik","ekstraBilgi"),
				array($katid,$urunad,$dosyayukleme[0],$dosyayukleme[1],$dosyayukleme[2],$durum,$urunaciklama,$malzeme,$uretimyeri,$renk,$fiyat,$stok,$urunozellik,$urunekstra));
			

	

			if ($sonuc): 

				$this->view->goster("YonPanel/sayfalar/urunler",
				array(
				"bilgi" => $this->bilgi->basarili("ÜRÜN BAŞARIYLA EKLENDİ","/panel/urunler",2)
				));
					
			else:
			
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(
				"bilgi" => $this->bilgi->hata("EKLEME SIRASINDA HATA OLUŞTU.","/panel/urunler",2)
				));	
			
			endif;
			

			
			endif;
		else:
		$this->bilgi->direktYonlen("/panel/urunler");
			

		endif;		
	
	}// ÜRÜN EKLEME SON	






	function urunSil($id) {
	
		
		$sonuc=$this->model->Sil("urunler","id=".$id);
			
			
		if ($sonuc): 
			
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
				"bilgi" => $this->bilgi->basarili("SİLME BAŞARILI","/panel/urunler",2)
			 ));
						
		else:
				
			$this->view->goster("YonPanel/sayfalar/urunler",
			array(
				"bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.","/panel/urunler",2)
				 ));	
				
		endif;
			
		
			
				
			}  // ÜRÜN SİL

	function katgoregetir() {	
		
		if ($_POST) :
						
		$katid=$this->form->get("katid")->bosmu();
				
				
		$bilgicek=$this->model->Verial("urunler","where katid=".$katid);
				
				
		if ($bilgicek):
					
			$this->view->goster("YonPanel/sayfalar/urunler",array(
						
				"data" => $bilgicek	,
				"data2" => $this->model->Verial("alt_kategori",false)			
			));		
						
		else:
						
			$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
				"bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/urunler",1)
			));			
		endif;
			
						
				
		else:

		$this->bilgi->direktYonlen("/panel/urunler");		
				
		endif;
			
				
		} // KATEGORİYE GÖRE ÜRÜN GETİR
	
	function urunarama() {	
		
		if ($_POST) :
					
		$aramaverisi=$this->form->get("arama")->bosmu();
			
			
			
			if (!empty($this->form->error)) :
					
				$this->view->goster("YonPanel/sayfalar/urunler",
				array(		
					"bilgi" => $this->bilgi->hata("KRİTER GİRİLMELİDİR.","/panel/urunler",1)
				));
					
					
			else:
					
				
				
			$bilgicek=$this->model->arama("urunler",
				"urunad LIKE '%".$aramaverisi."%' or 
				malzeme LIKE '%".$aramaverisi."%'  or 
				urtYeri LIKE '%".$aramaverisi."%' or 
				stok LIKE '%".$aramaverisi."%'");
				
					if ($bilgicek):
				
					$this->view->goster("YonPanel/sayfalar/urunler",array(
					
					"data" => $bilgicek,
					"data2" => $this->model->Verial("alt_kategori",false)			
					));		
					
					else:
					
					$this->view->goster("YonPanel/sayfalar/urunler",
					array(		
					"bilgi" => $this->bilgi->hata("HİÇBİR KRİTER UYUŞMADI.","/panel/urunler",1)
					 ));			
					endif;
		
					
					endif;
			
			
			
			else:
				$this->bilgi->direktYonlen("/panel/urunler");		
			
			
			endif;
		
				
	
		
			
		} // ÜRÜN ARAMA


//---------------------ÜRÜN KODLARI BİTİŞ----------------------------------






//---------------------BÜLTEN KODLARI BAŞLA----------------------------------
	function bulten() {
		
	
		$this->view->goster("YonPanel/sayfalar/bulten",array(
			"data"=> $this->model->Verial("bulten",false)
		));
			
		} //bülten getir






	function mailSil($id) {
		$sonuc=$this->model->Sil("bulten","id=".$id);
				
				
		if ($sonuc): 
				
			$this->view->goster("YonPanel/sayfalar/bulten",
				array(
					"bilgi" => $this->bilgi->basarili("SİLME BAŞARILI","/panel/bulten",2)
				 ));
							
		else:
					
			$this->view->goster("YonPanel/sayfalar/bulten",
				array(
				"bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.","/panel/bulten",2)
				 ));	
					
		endif;
				
			
				
					
		}  // Mail sil






	function mailarama() {	
		
		if ($_POST) :
					
		$aramaverisi=$this->form->get("arama")->bosmu();
			
			
			
			if (!empty($this->form->error)) :
					
				$this->view->goster("YonPanel/sayfalar/bulten",
					array(		
					"bilgi" => $this->bilgi->hata("Mail adresi giriniz","/panel/bulten",2)
				 ));
			
					
			else:
					
				
				
				$bilgicek=$this->model->arama("bulten",
				"mailadres LIKE '%".$aramaverisi."%'");
				
				if ($bilgicek):
				
					$this->view->goster("YonPanel/sayfalar/bulten",array(
					
					"data" => $bilgicek				
					));		
					
				else:
					
					$this->view->goster("YonPanel/sayfalar/bulten",
					array(		
					"bilgi" => $this->bilgi->hata("Girilen Mail Adresi Bulunamadı.","/panel/bulten",2)
					 ));			
				endif;
		
					
			endif;
			
			
			
		else:
			$this->bilgi->direktYonlen("/panel/bulten");		
			
		endif;
		
				
	
		
			
	}//mail arama


	function tarihegoregetir() {	
		
		if ($_POST) :
					
		$tar1=$this->form->get("tar1")->bosmu();
		$tar2=$this->form->get("tar2")->bosmu();
			
			
			if (!empty($this->form->error)) :
					
				$this->view->goster("YonPanel/sayfalar/bulten",
					array(		
					"bilgi" => $this->bilgi->hata("Tarih seçiniz","/panel/bulten",2)
				 ));
			
					
			else:
					
				
				
				$bilgicek=$this->model->Verial("bulten",
				"where DATE(tarih) BETWEEN '".$tar1."' and '".$tar2."'");
				
				if ($bilgicek):
				
					$this->view->goster("YonPanel/sayfalar/bulten",array(
					
					"data" => $bilgicek				
					));		
					
				else:
					
					$this->view->goster("YonPanel/sayfalar/bulten",
					array(		
					"bilgi" => $this->bilgi->hata("Girilen Mail Adresi Bulunamadı.","/panel/bulten",2)
					 ));			
				endif;
		
					
			endif;
			
			
			
		else:
			$this->bilgi->direktYonlen("/panel/bulten");		
			
		endif;
		
				
	
		
			
	}//tarihe göre arama




//---------------------BÜLTEN KODLARI BİTİŞ----------------------------------








//---------------------SİSTEM AYAR KODLARI BAŞLA----------------------------------
	function sistemayar() {
		
	
		$this->view->goster("YonPanel/sayfalar/sistemayar",array(
			"sistemayar"=> $this->model->Verial("ayarlar",false)
		));
			
		} //bilgileri getir






	function ayarguncelle() {	
		
	
		if ($_POST) :	
			
		$sloganust1=$this->form->get("sloganust1")->bosmu();
		$sloganalt1=$this->form->get("sloganalt1")->bosmu();

		$sloganust2=$this->form->get("sloganust2")->bosmu();
		$sloganalt2=$this->form->get("sloganalt2")->bosmu();

		$sloganust3=$this->form->get("sloganust3")->bosmu();
		$sloganalt3=$this->form->get("sloganalt3")->bosmu();

		$sayfatitle=$this->form->get("sayfatitle")->bosmu();
		$sayfaaciklama=$this->form->get("sayfaaciklama")->bosmu();
		$anahtarkelime=$this->form->get("anahtarkelime")->bosmu();

		$kayitid=$this->form->get("kayitid")->bosmu();	
		
				
			if (!empty($this->form->error)) :
				
				$this->view->goster("YonPanel/sayfalar/sistemayar",
					array(		
					"bilgi" => $this->bilgi->hata("Tüm alanlar doldurulmalıdır.","/panel/sistemayar",2)
				));	
			 
		
				
			else:	
			
	
				$sonuc=$this->model->Guncelle("ayarlar",
					array("sloganUst1","sloganAlt1","sloganUst2","sloganAlt2","sloganUst3","sloganAlt3","title","sayfaAciklama","anahtarKelime"),
					array($sloganust1,$sloganalt1,$sloganust2,$sloganalt2,$sloganust3,$sloganalt3,$sayfatitle,$sayfaaciklama,$anahtarkelime),"id=".$kayitid
				
				);
				
	
		
	
			if ($sonuc): 
	
				$this->view->goster("YonPanel/sayfalar/sistemayar",
					array(
					"bilgi" => $this->bilgi->basarili("Güncelleme Başarılı","/panel/sistemayar",1)
				));
						
			else:
				
				$this->view->goster("YonPanel/sayfalar/sistemayar",
					array(
					"bilgi" => $this->bilgi->hata("Güncelleme Başarısız","/panel/sistemayar",1)
				));	
				
			endif;
				
	
				
			endif;
			else:
			$this->bilgi->direktYonlen("/panel/sistemayar");
				
	
			endif;		
		
		}// Sistem ayarları değiştirme


//---------------------SİSTEM AYAR KODLARI BİTİŞ----------------------------------


	




//---------------------SİSTEM BAKIM KODLARI BAŞLA----------------------------------


	function sistembakim() {
		
	
		$this->view->goster("YonPanel/sayfalar/bakim",array(
			"sistembakim"=> true
		));
			
	} //BAKIM



	function bakimyap() {


		if ($_POST["sistembtn"]):
			$bakim = $this->model->bakim("cduetcin_mvcproje");

			if ($bakim):
				$this->view->goster("YonPanel/sayfalar/bakim", array(
					"bilgi" => $this->bilgi->basarili("BAKIM BAŞARIYLA YAPILDI", "/panel/sistembakim", 2)
				));
		 
			else:
				$this->view->goster("YonPanel/sayfalar/bakim", array(
					"bilgi" => $this->bilgi->hata("BAKIM YAPILAMADI", "/panel/sistembakim", 2)
				));
			endif;
		 
		else:
			$this->bilgi->direktYonlen("/panel/sistembakim");
		endif;
		 
	} // BAKIM SONUCU



//---------------------SİSTEM BAKIM KODLARI BİTİŞ----------------------------------



//---------------------OTURUM KODLARI BAŞLA----------------------------------

/*
	function kayitkontrol() {
		
		$ad=$this->form->get("ad")->bosmu();
		$soyad=$this->form->get("soyad")->bosmu();
		$mail=$this->form->get("mail")->bosmu();
		$sifre=$this->form->get("sifre")->bosmu();
		$sifretekrar=$this->form->get("sifretekrar")->bosmu();
		$telefon=$this->form->get("telefon")->bosmu();	
		$this->form->GercektenMailmi($mail);	
		$sifre=$this->form->SifreTekrar($sifre,$sifretekrar);
		

		
		if (!empty($this->form->error)) :
		

		$this->view->goster("sayfalar/uyeol",
		array("hata" => $this->form->error));
		
		
		else:
		

		
		$sonuc=$this->model->Ekleİslemi("uye_panel",
		array("ad","soyad","mail","sifre","telefon"),
		array($ad,$soyad,$mail,$sifre,$telefon));
		
			if ($sonuc==1):
		
		
			$this->view->goster("sayfalar/uyeol",
			array("bilgi" =>$this->bilgi->uyari("success","KAYIT BAŞARILI")));
			
			
			
			else:
			
			$this->view->goster("sayfalar/uyeol",
			array("bilgi" => 
			$this->bilgi->uyari("danger","Kayıt esnasında hata oluştu")));
			
			
			
			
			endif;
		
		endif;
	
	
	
		
	} // kayıt kontrol et	

*/



	function cikis() {
				
		Session::destroy();			
		$this->bilgi->direktYonlen("/panel/giris");

	} // çıkış
//---------------------OTURUM KODLARI BİTİŞ----------------------------------

//---------------------YÖNETİCİ BAŞLA----------------------------------

	function sifredegistir() {	
	
	
		$this->view->goster("YonPanel/sayfalar/sifreislemleri",array(
		"sifredegistir" => Session::get("Adminid")));	
		
			
	} // şifre değiştir

	

	function sifreguncelleson() {		

		if ($_POST) :		
			
		 $mevcutsifre=$this->form->get("mevcutsifre")->bosmu();
		 $yen1=$this->form->get("yen1")->bosmu();
		 $yen2=$this->form->get("yen2")->bosmu();
		 $yonid=$this->form->get("yonid")->bosmu();
		 $sifre=$this->form->SifreTekrar($yen1,$yen2);
		
		
		$mevcutsifre=$this->form->sifrele($mevcutsifre);
		
		if (!empty($this->form->error)) :
		$this->view->goster("YonPanel/sayfalar/sifreislemleri",
		array(
		"sifredegistir" => Session::get("Adminid"),
		"bilgi" => $this->bilgi->uyari("danger","Girilen şifreler uyuşmuyor.")
		 ));
		
		else:	
		
		
			
		$sonuc2=$this->model->GirisKontrol("yonetim","ad='".Session::get("AdminAd")."' and sifre='$mevcutsifre'");
		
			if ($sonuc2): 
			
					$sonuc=$this->model->Guncelle("yonetim",
					array("sifre"),
					array($sifre),"id=".$yonid);
				
					if ($sonuc): 
					
				
					$this->view->goster("YonPanel/sayfalar/sifreislemleri",
					array(
					"bilgi" => $this->bilgi->basarili("ŞİFRE DEĞİŞTİRME BAŞARILI","/panel/siparisler")
					 ));
						
							
					else:
					
					$this->view->goster("YonPanel/sayfalar/sifreislemleri",
					array(
					"sifredegistir" => Session::get("Adminid"),
					"bilgi" => $this->bilgi->uyari("danger","Şifre değiştirme sırasında hata oluştu.")
					));	
					
					endif;
				
			else:
			
			
			
			
			
				$this->view->goster("YonPanel/sayfalar/sifreislemleri",
		array(
		"sifredegistir" => Session::get("Adminid"),
		"bilgi" => $this->bilgi->uyari("danger","Mevcut şifre hatalıdır.")
		 ));
			
				
			
			endif;
		
		endif;
		
		
		else:	
		
		$this->bilgi->direktYonlen("/panel");
		endif;
		
		
			
		} //şifre güncelleme






	function yonetici() {
			
		
		$this->view->goster("YonPanel/sayfalar/yonetici",array(
			"data"=> $this->model->Verial("yonetim",false)
		));
			
	} //BAKIM

	

	function yonSil($id) {
		$sonuc=$this->model->Sil("yonetim","id=".$id);
				
				
		if ($sonuc): 
				
			$this->view->goster("YonPanel/sayfalar/yonetici",
				array(
					"bilgi" => $this->bilgi->basarili("SİLME BAŞARILI","/panel/yonetici",2)
				 ));
							
		else:
					
			$this->view->goster("YonPanel/sayfalar/yonetici",
				array(
				"bilgi" => $this->bilgi->hata("SİLME SIRASINDA HATA OLUŞTU.","/panel/yonetici",2)
				 ));	
					
		endif;
				
			
				
					
	}  // yönetici sil


	function yonekle() {	
				
		$this->view->goster("YonPanel/sayfalar/yonetici",array(	
		"yoneticiekle" => true	
		));	
			
	}


	function yonekleson() {		

		if ($_POST) :		
			
		 $yonadi=$this->form->get("yonadi")->bosmu();
		 $sif1=$this->form->get("sif1")->bosmu();
		 $sif2=$this->form->get("sif2")->bosmu();

		 $sifre=$this->form->SifreTekrar($sif1,$sif2);
		
		
		
		if (!empty($this->form->error)) :
		$this->view->goster("YonPanel/sayfalar/yonetici",
		array(
		"bilgi" => $this->bilgi->hata("Girilen şifreler uyuşmuyor.","/panel/yonetici")
		 ));
		
		else:	
		
			$sonuc=$this->model->Ekleme("yonetim",
				array("ad","sifre"),
				array($yonadi,$sifre));
				
			if ($sonuc): 
					
				
				$this->view->goster("YonPanel/sayfalar/yonetici",
					array(
					"bilgi" => $this->bilgi->basarili("Yeni Yönetici Eklendi","/panel/yonetici")
				));
						
							
			else:
					
				$this->view->goster("YonPanel/sayfalar/yonetici",
					array(
						"bilgi" => $this->bilgi->hata("Kullanıcı adı kullanılmaktadır","/panel/yonetici")
				));	
					
			endif;
		

		
			endif;
		
		
		else:	
		
		$this->bilgi->direktYonlen("/panel/giris");
		endif;
		
		
			
		} //yonetici ekle son

//---------------------YÖNETİCİ BİTİŞ----------------------------------








}

?>