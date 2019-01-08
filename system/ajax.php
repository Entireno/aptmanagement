<?php

 require_once 'baglan.php';
 if(isset($_POST['blok'])){
 $blok=$_POST['blok'];
 $kisiler=$db->prepare('SELECT ad,id FROM sakin WHERE blok=?');
 $kisiler->execute([$blok]);
 $kisilerad=$kisiler->fetchAll(PDO::FETCH_ASSOC);
  $html='<option value="">-Kişi Seçin-</option>';
  foreach ($kisilerad as $kisi){

      $html .='
                <option value="'.$kisi['id'].'">'.$kisi['ad'].'</option>
      ';
  }
   echo $html;

 }
 ?>