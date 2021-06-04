$(document).ready(function(e) {
	
	
	
	//http://localhost/site       (taşınınca değişcek)  aramaselect

//--------------------------panel başla-----------------------------

	$('#detaygoster a').click(function(){
		
		var sipno=$(this).attr('data-value');
		var adresid=$(this).attr('data-value2');
		

		
		$.post("http://e-cini.xyz/GenelGorev/teslimatgetir",{"sipno":sipno,"adresid":adresid},function(cevap){
		
			$(".modal-body").html(cevap);
		});
		


		});






//--------------------------panel bitiş-----------------------------








	$("#aramakutusu").attr("placeholder","Sipariş numarası");
	$("#aramaselect").on('change', function(e){
		

		var secilenial=$(this);
		var valueninDegeri=secilenial.val();
		if (valueninDegeri=="sipno"){

			$("#aramakutusu").val("");
			$("#aramakutusu").attr("placeholder","Sipariş numarası");

		}
		if (valueninDegeri=="uyebilgi"){
			$("#aramakutusu").val("");
			$("#aramakutusu").attr("placeholder","Üye Bilgisi");

		}


	});
	
	
	
	$("#SepetDurum").load("http://e-cini.xyz/GenelGorev/SepetKontrol");
	
	
	$("#Sonuc").hide();

	$("#FormAnasi").hide();

    $("#yorumEkle").click(function(e) {

		 $("#FormAnasi").slideToggle();	

        

    });

	

	

	$("#yorumGonder").click(function() {

		$.ajax({

			type:"POST",

			url:'http://e-cini.xyz/GenelGorev/YorumFormKontrol',

			data:$('#yorumForm').serialize(),

			success: function(donen_veri){

				$('#yorumForm').trigger("reset");

				$('#FormSonuc').html(donen_veri);

				

				if ($('#ok').html()=="Yorumunuz kayıt edildi. Onaylandıktan sonra yayınlanacaktır") {

					$("#FormAnasi").fadeOut();

					

					

				}

				

			

				

			},

		});

			

		

        

    });

	

	

	$("[type='number']").keypress(function (evt) {

		evt.preventDefault();

		

		

	});

	

	

	

	

	

	$("#bultenBtn").click(function() {
	$.ajax({

			type:"POST",

			url:'http://e-cini.xyz/GenelGorev/BultenKayit',

			data:$('#bultenForm').serialize(),

			success: function(donen_veri){

				$('#bultenForm').trigger("reset");

				$('#Bulten').html(donen_veri);

				

				if ($('#bultenok').html()=="Bultene Başarılı bir şekilde kayıt oldunuz. Teşekkür ederiz") {

				}

			},

		});

        

    });

	

	

	

	

	

	$("#İletisimbtn").click(function() {	
	$.ajax({

			type:"POST",

			url:'http://e-cini.xyz/GenelGorev/iletisim',

			data:$('#iletisimForm').serialize(),

			success: function(donen_veri){

				$('#iletisimForm').trigger("reset");

			$('#FormSonuc').html(donen_veri);

				

					if ($('#formok').html()=="Mesajınız Alındı. En kısa sürede Dönüş yapılacaktır. Teşekkür ederiz") {

						

				$('#iletisimForm').fadeOut();

				$('#FormSonuc').html(donen_veri);


				}

				
				

			},

		});

			

		

        

    });

	

		$("#SepetBtn").click(function() {
	$.ajax({

			type:"POST",

			url:'http://e-cini.xyz/GenelGorev/SepeteEkle',

			data:$('#SepeteForm').serialize(),

			success: function(donen_veri){

				$('#SepeteForm').trigger("reset");
				
				$('#SepetDurum').load("http://e-cini.xyz/GenelGorev/SepetKontrol");
				$('#Mevcut').html('<div class="alert alert-success text-center">Sepete Eklendi</div>');
	
	


			},

		});

			

		

        

    });

	

	

	$('#GuncelForm input[type="button"]').click(function(){
		
		var id=$(this).attr('data-value');
		
		var adet=$('#GuncelForm input[name="adet'+id+'"]').val();
		
		
		$.post("http://e-cini.xyz/GenelGorev/UrunGuncelle",{"urunid":id,"adet":adet},function(){
		
		window.location.reload();
		});
		
		});

//-----------------------------------------------------------------------------------------------------------------------	

	$('#GuncelButonlarinanasi input[type="button"]').click(function(){
		
		var id=$(this).attr('data-value');
		
		var textArea=$("<textarea id='"+id+"' name='yorum' style='width:100% height:200px' />");
		
		
		textArea.val($(".sp"+id).html());
		$(".sp"+id).parent().append(textArea);
		$(".sp"+id).remove();
		input.focus();
		
		});

	
	$(document).on('blur' ,'textarea[name=yorum]',function() {
		
		$(this).parent().append($('<span/>').html($(this).val()));
		var id=$(this).attr("id");
		$(this).remove();
		
		$.post("http://e-cini.xyz/uye/YorumGuncelle",{"yorumid":id,"yorum":$(this).val()},function(donen) {
		
		window.location.reload();
		});
		
		
		
	});
	
//------------------------------------------------------------------------------------------------------	
	
	
	$('#AdresGuncelButonlarinanasi input[type="button"]').click(function() {
		
		var id=$(this).attr('data-value');
		
		
		var textArea=$("<textarea id='"+id+"' name='adres' style='width:100%; height:100%;' />");
		
		
		textArea.val($(".adresSp"+id).html());
		$(".adresSp"+id).parent().append(textArea);
		$(".adresSp"+id).remove();
		input.focus();
		
	
		
		
	});
	
	
	$(document).on('blur' ,'textarea[name=adres]',function() {
		
		$(this).parent().append($('<span/>').html($(this).val()));
		var id=$(this).attr("id");
		$(this).remove();
		
		
		
		
		$.post("http://e-cini.xyz/uye/AdresGuncelle",{"adresid":id,"adres":$(this).val()},function(donen) {
			
			//alert(donen);
			
		window.location.reload();
		
	});		
	
		

		
		
	});	
	
	
	
	var ad,soyad,mail,telefon;
	
	
	$('input[name=bilgiTercih]').on('change',function() {
		var gelenTercih=$(this).val(); // 0-1
		
		if (gelenTercih==1) 		
		{
			ad=$('input[id=sipAd]').val();
			soyad=$('input[id=sipSoyad]').val();
			mail=$('input[id=sipMail]').val();
			telefon=$('input[id=sipTlf]').val();
			 $('input[id=sipAd]').val("");
			 $('input[id=sipSoyad]').val("");
			 $('input[id=sipMail]').val("");
			 $('input[id=sipTlf]').val("");
		}
		
		else {
			
			 $('input[id=sipAd]').val(ad);
			 $('input[id=sipSoyad]').val(soyad);
			 $('input[id=sipMail]').val(mail);
			 $('input[id=sipTlf]').val(telefon);	
			
		}
		


		
	
	
		
	});
	
	
//-----------------------------------------------------------------------------------------------------------------	

});



function VarsayilanYap(deger,deger2){
	
		
		$.post("http://e-cini.xyz/GenelGorev/VarsayilanAdresYap",{"uyeid":deger,"adresid":deger2},function(){
		
		$.post("http://e-cini.xyz/GenelGorev/VarsayilanAdresYap2",{"uyeid":deger,"adresid":deger2},function(){
		
			window.location.reload();
		});
		});
	

}


function UrunSil(deger,kriter){
	switch (kriter){
		case "sepetsil":
		$.post("http://e-cini.xyz/GenelGorev/UrunSil",{"urunid":deger},function(){
		
		window.location.reload();
		});
		break;
		
		
		
		case "yorumsil":
		$.post("http://e-cini.xyz/uye/Yorumsil",{"yorumid":deger},function(donen){
		
		if(donen){
			
			$("#Sonuc").html("Yorum silme başarılı");
			
			
		}
		else
		{
			$("#Sonuc").html("Yorum silinemedi");
		}
		
			$("#Sonuc").fadeIn(1500,function() {
				
				$("#Sonuc").fadeOut(1500,function() {
					$("#Sonuc").html("");
					window.location.reload();
				});
			});
		});
		
		break;
		
		
		
		
		case "adresSil":
		$.post("http://e-cini.xyz/uye/adresSil",{"adresid":deger},function(donen){
		if(donen){
			
			$("#Sonuc").html("Adres silme başarılı");
			
			
		}
		else
		{
			$("#Sonuc").html("adres silinemedi");
		}
		
			$("#Sonuc").fadeIn(1500,function() {
				
				$("#Sonuc").fadeOut(1500,function() {
					$("#Sonuc").html("");
					window.location.reload();
				});
			
			
			});
		
		
		});
		break;
		
		}
	
	
	
	
	}