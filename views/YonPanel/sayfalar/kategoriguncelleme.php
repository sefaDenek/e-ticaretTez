<?php require 'views/YonPanel/header.php'; ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          

          <div class="row">
      <div class="col-xl-12 col-md-12 mb-12 text-center"> 



     <?php 
         if (isset($veri["bilgi"])) :
            echo $veri["bilgi"];


         endif;


	  if (isset($veri["data"])) :
	  
            
	  
	  if (!$_POST) :
	  
	  ?>
      
       <!-- BAŞLIK -->
      
       <div class="row text-left border-bottom-mvc mb-2">  
       
        	 <div class="col-xl-12 col-md-12 mb-12 border-left-mvc text-left p-2 mb-2"><h1 class="h3 mb-0 text-gray-800"> <i class="fas fa-th basliktext"></i> KATEGORİ GÜNCELLE </h1></div>
              
 
          </div>
          <!-- BAŞLIK --> 	
      
      <?php
	  
	  Form::Olustur("1",array(
					 "action" => URL."/panel/kategoriGuncelSon",
					 "method" => "POST"				
					 ));  
	  ?>
      
            <!--  FORMUN İSKELETİ-->
          
            <div class="col-xl-12 col-md-12  text-center"> 
      
    
      
       <div class="row text-center">  
       
        	 <div class="col-xl-4 col-md-6 mx-auto">
             
             
             			<div class="row bg-gradient-beyazimsi">
             
             		<div class="col-lg-12 col-md-12 col-sm-12 bg-gradient-mvc pt-2 basliktext2"><h3>Kategoriyi Güncelle</h3></div>
                   <div class="col-lg-12 col-md-12 col-sm-12 formeleman">Kategori adı</div>
                   <?php 	
                     switch($veri["kriter"]):
                        case "ana": 
                           echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';

                   
                           Form::Olustur("2",array("type"=>"text","name"=>"katad","value"=>$veri["data"][0]["ad"],"class"=>"form-control m-2"));		
                           echo '</div>';

                           Form::Olustur("2",array("type"=>"hidden","name"=>"kriter","value"=>$veri["kriter"]));

                           
                        break;

                        case "cocuk":

                           echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
                           Form::Olustur("2",array("type"=>"text","name"=>"katad","value"=>$veri["data"][0]["ad"],"class"=>"form-control m-2"));		

                           echo '</div>';

                           echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">Ana kategori';
                           Form::OlusturSelect("1",array("name"=>"anakatid","class"=>"form-control m-2"));
                           
                           foreach($veri["AnakategorilerTumu"] as $deger):
                              if($veri["data"][0]["ana_kat_id"]==$deger["id"]):

                                 Form::OlusturOption(array("value"=>$deger["id"]),"selected",$deger["ad"]);
                              else:
                                 Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);

                              endif;

                              
                           endforeach;

                              Form::OlusturSelect("2",null);
                              Form::Olustur("2",array("type"=>"hidden","name"=>"kriter","value"=>$veri["kriter"]));
                            
                              echo '</div>';

                        break;

                        case "alt":
                           echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">';
                           Form::Olustur("2",array("type"=>"text","name"=>"katad","value"=>$veri["data"][0]["ad"],"class"=>"form-control m-1"));		

                           echo '</div>';

                           echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">Ana kategori'; // ana kategoriler başla
                           Form::OlusturSelect("1",array("name"=>"anakatid","class"=>"form-control m-2"));
                           
                           foreach($veri["AnakategorilerTumu"] as $deger):
                              if($veri["data"][0]["ana_kat_id"]==$deger["id"]):

                                 Form::OlusturOption(array("value"=>$deger["id"]),"selected",$deger["ad"]);
                              else:
                                 Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);

                              endif;

                              
                           endforeach;

                              Form::OlusturSelect("2",null);
                              Form::Olustur("2",array("type"=>"hidden","name"=>"kriter","value"=>$veri["kriter"]));
                              echo '</div>';// ana kategoriler bitiş


                              echo '<div class="col-lg-12 col-md-12 col-sm-12 formeleman">Çocuk Kategori';//çocuk kategoriler başla
                           Form::OlusturSelect("1",array("name"=>"cocukkatid","class"=>"form-control m-1"));
                           
                           foreach($veri["CocukkategorilerTumu"] as $deger):
                              if($veri["data"][0]["cocuk_kat_id"]==$deger["id"]):

                                 Form::OlusturOption(array("value"=>$deger["id"]),"selected",$deger["ad"]);
                              else:
                                 Form::OlusturOption(array("value"=>$deger["id"]),false,$deger["ad"]);

                              endif;

                              
                           endforeach;

                              Form::OlusturSelect("2",null);
                              echo '</div>';//çocuk kategoriler bitiş

                        break;


                     endswitch;
                  ?>

             
             
              <div class="col-lg-12 col-md-12 col-sm-12 formeleman nocizgi"><?php 		
		
			 Form::Olustur("2",array("type"=>"submit","value"=>"GÜNCELLE","class"=>"btn btn-success"));		 
          Form::Olustur("2",array("type"=>"hidden","name"=>"kayitid","value"=>$veri["data"][0]["id"]));	 
			Form::Olustur("kapat");	 ?></div>  
             
             
             
             			</div>
                        
                        
  
                        
             
             
             </div>
              
 
      			 </div>
         </div>
         
           <!--  FORMUN İSKELETİ-->
      
      
      <?php 
	  
	  	 
				
		 
	  
	  
	  
	  endif;
	  	  
	  endif; 
	   
     ?>
           
          
  </div> 
  
      
        </div>  
<!-- /.row bitiyor -->

        </div>
        <!-- /.container-fluid -->

     

     
     
     <?php require 'views/YonPanel/footer.php'; ?>