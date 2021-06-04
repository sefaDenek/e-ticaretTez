<?php



class GenelGorev extends Controller  {

	function __construct() {
	parent::__construct();
	$this->Modelyukle('GenelGorev');
	}	

	

	function YorumFormKontrol() {
	if ($_POST) :
		$ad=$this->form->get("ad")->bosmu();
		$yorum=$this->form->get("yorum")->bosmu();
		$urunid=$this->form->get("urunid")->bosmu();
		$uyeid=$this->form->get("uyeid")->bosmu();
		$tarih=date("d-m-Y");	
		if (!empty($this->form->error)) :
			
			echo $this->bilgi->uyari("danger","LÜTFEN BOŞ ALAN BIRAKMAYINIZ");
		
		else:
			
			$sonuc=$this->model->YorumEkleme("yorumlar",
				array("uyeid","urunid","ad","icerik","tarih"),
				array($uyeid,$urunid,$ad,$yorum,$tarih));
			
			if ($sonuc==1):
				
			echo $this->bilgi->uyari("success","Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır",'id="ok"');
				
			else:
				
			echo $this->bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
				
			endif;
			
		endif;
			
	else:	
			
		$this->bilgi->direktYonlen("/");
			
	endif;

	} // YORUM  KONTROL

	

	

	

	function BultenKayit() {

	if ($_POST) :	
		$mailadres=$this->form->get("mailadres")->bosmu();	
		$this->form->GercektenMailmi($mailadres);	
		$tarih=date("Y-m-d");
				
		if (!empty($this->form->error)) :
			
		echo $this->bilgi->uyari("danger","GİRİLEN MAİL ADRESİ GEÇERSİZ");
		
		else:
			
		$sonuc=$this->model->BultenEkleme("bulten",
			array("mailadres","tarih"),
			array($mailadres,$tarih));

			
			if ($sonuc==1):
			
			echo $this->bilgi->uyari("success","Bultene Başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz",'id="bultenok"');
				
			else:
			
			echo $this->bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
				
			endif;
			


		endif;
			
	else:	
			
		$this->bilgi->direktYonlen("/");
			
	endif;

	} // BULTEN KAYIT  KONTROL

	

	function iletisim() {

	if ($_POST) :		
	$ad=$this->form->get("ad")->bosmu();
	$mail=$this->form->get("mail")->bosmu();
	$konu=$this->form->get("konu")->bosmu();
	$mesaj=$this->form->get("mesaj")->bosmu();
	
	
	@$this->form->GercektenMailmi($mail);	
	$tarih=date("d-m-Y");
		
	if (!empty($this->form->error)) :
	
	echo $this->bilgi->uyari("danger","LÜTFEN TÜM BİLGİLERİ UYGUN GİRİNİZ");

	else:
	

	
		$sonuc=$this->model->iletisimForm("iletisim",
		array("ad","mail","konu","mesaj","tarih"),
		array($ad,$mail,$konu,$mesaj,$tarih));
	
		if ($sonuc==1):
	

		
		echo $this->bilgi->uyari("success","Mesajınız Alındı. En kısa sürede Dönüş yapılacaktır. Teşekkür ederiz",'id="formok"');
		
		else:
		
		
	
		echo $this->bilgi->uyari("danger","HATA OLUŞTU. LÜTFEN DAHA SONRA TEKRAR DENEYİNİZ");
		
		endif;
	
	endif;
	
	
	else:	
	
		$this->bilgi->direktYonlen("/");
	
	endif;


	}   //iletişim formu

	




	function SepeteEkle() {
		
		Cookie::SepeteEkle($this->form->get("id")->bosmu(),$this->form->get("adet")->bosmu());
		
	}
		


		
	function UrunSil() {
		if ($_POST) :		
		Cookie::UrunUcur($_POST["urunid"]);
		endif;	
	}
	



	function UrunGuncelle () {
		if ($_POST) :		
		Cookie::Guncelle($_POST["urunid"],$_POST["adet"]);
		endif;	
	}
	




	function SepetiBosalt () {
		
		$this->bilgi->direktYonlen("/sayfalar/sepet");
		
		Cookie::SepetiBosalt();
		
	}
	



	function SepetKontrol () {
		
		echo '
		<a href="'.URL.'/sayfalar/sepet">
		<h3> <img src="'.URL.'/views/design/images/bag.png" alt=""></h3>
		
		<p>'; 
		
		if (isset($_COOKIE["urun"])) :
			echo count($_COOKIE["urun"]);
			
			else:
			echo 'Sepet Boş';
		endif;
		
		echo '</p></a>';
		
	}
	
	




	function teslimatgetir () {
		if ($_POST) :
		$sipno=$this->form->get("sipno")->bosmu();
		$adresid=$this->form->get("adresid")->bosmu();
		
		$teslimatbilgileri=$this->model->Verial("teslimatbilgileri","where siparis_no=".$sipno);
		$AdresGetir=$this->model->Verial("adresler","where id=".$adresid);
		

		echo '
		<div class="row">
			
			<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-dark">
				<div class="row">
				
					<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 text-left">
						<div class="row">
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2">
						<h5>KİŞİSEL BİLGİLER</h5>
						</div>
				
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<span class="font-weight-bold">Ad : </span>'.$teslimatbilgileri[0]["ad"].'
						</div>
						
						
							<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<span class="font-weight-bold">Soyad : </span>'.$teslimatbilgileri[0]["soyad"].'
						</div>
						
						
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<span class="font-weight-bold">Mail :  </span>'.$teslimatbilgileri[0]["mail"].'
						</div>
						
						
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<span class="font-weight-bold">Telefon : </span>'.$teslimatbilgileri[0]["telefon"].'
						</div>
					
						</div>
						
						</div>
						
						
						
						
						<div class="col-lg-6 col-xl-6 col-md-12 col-sm-12 text-left">
							<div class="row">
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 border-bottom border-secondary mb-2">
						<h5>ADRES BİLGİSİ</h5>
						</div>
				
						<div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
						<span class="font-weight-bold">Adres : </span>'.$AdresGetir[0]["adres"].'
						</div>
						
						</div>
						
						</div>
				
				</div>
			
			</div>

		</div>';




		else:	
				
			$this->bilgi->direktYonlen("/");
				
		endif;
	

	}
	



	function VarsayilanAdresYap () {

		if ($_POST) :
			$uyeid=$this->form->get("uyeid")->bosmu();
			$adresid=$this->form->get("adresid")->bosmu();
			
			$this->model->Guncelle("adresler",
				array("varsayilan"),
				array(0),"uyeid=".$uyeid
			);

		else:	
					
			$this->bilgi->direktYonlen("/");
					
		endif;



	} // varsayılan adresi 0 yapan kod


	function VarsayilanAdresYap2 () {

		if ($_POST) :
			$uyeid=$this->form->get("uyeid")->bosmu();
			$adresid=$this->form->get("adresid")->bosmu();


			$this->model->Guncelle("adresler",
				array("varsayilan"),
				array(1),"id=".$adresid." and uyeid=".$uyeid
			);

	
		else:	
					
			$this->bilgi->direktYonlen("/");
					
		endif;



	} // varsayılan adresi 1 yapan kod




}

?>