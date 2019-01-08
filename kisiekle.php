<?php if(!isset($_SESSION['oturum'])){
header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
?>
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Kişi Ekle</h2>
    </header>
    <form class="form-horizontal form-bordered" method="post" action="#">
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputDefault">Ad</label>
            <div class="col-md-6">
                <input name="ad" type="text" class="form-control" id="inputDefault">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputDefault">Soyad</label>
            <div class="col-md-6">
                <input name="soyad" type="text" class="form-control" id="inputDefault">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputDefault">İletişim Numarası</label>
            <div class="col-md-6">
                <input name="numara" maxlength="10" type="tel" class="form-control" id="number">
                <div class="help-block">Lütfen başında "0" olmadan giriniz</div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputDefault">E-posta Adresi</label>
            <div class="col-md-6">
                <input name="eposta" type="email" class="form-control" id="inputDefault">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputDefault">Şifre</label>
            <div class="col-md-6">
                <input name="sifre" type="password" class="form-control" id="inputDefault">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputSuccess">Blok</label>
            <div class="col-md-6">
                <select name="blok" class="form-control mb-md">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputSuccess">Apartman</label>
            <div class="col-md-6">
                <input name="apartman" type="text" class="form-control" id="inputDefault">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-3 control-label" for="inputSuccess">Daire</label>
            <div class="col-md-6">
                <select name="daire" class="form-control mb-md">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </select>
            </div>
        </div>
        <br><br>
        <button name="submit" type="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Kişi Ekle</button>
    </form>




<?php
if(isset($_POST['submit'])){
   array_map('filtrele',$_POST);
   $ad=ucfirst($_POST['ad']);
   $soyad=strtoupper($_POST['soyad']);
   $adsoyad=$ad." ".$soyad;
   $blok=strtoupper($_POST['blok']);
   $numara=ltrim($_POST['numara'],'0');
   $apartman=$_POST['apartman'];
   $daire=$_POST['daire'];
   $sifre=md5($_POST['sifre']);
   $eposta=$_POST['eposta'];
   $a=strlen($numara);
   $kontrol=$db->prepare('SELECT daire FROM sakin WHERE daire=? AND blok=?');
   $kontrolsonuc=$kontrol->execute([$daire,$blok]);
   $kontrolsay=$kontrol->fetchAll(PDO::FETCH_ASSOC);

   if (!post('ad')){
       echo '<div><span style="color: red;  "><b>Ad kısmı boş olamaz</b></span></div>';
   }
   elseif (!post('soyad')){
       echo '<div><span style="color: red;  "><b>Soyad Kısmı bos olamaz</b></span></div>';
   }
   elseif (!post('numara')){
       echo '<div><span style="color: red;  "><b>Numara boş olamaz</b></span></div>';
   }
   elseif (!post('sifre')){
       echo '<div><span style="color: red;  "><b>Sifre bos olamaz</b></span></div>';
   }

   elseif ($a!=10 || !is_numeric($numara)){
       echo '<div><span style="color: red;  "><b>Lütfen Geçerli bir numara giriniz</b></span></div>';
   }
   elseif (!filter_var($eposta,FILTER_VALIDATE_EMAIL)){

       echo '<div><span style="color: red;  "><b>Lütfen Geçerli bir email adresi giriniz</b></span></div>';
   }
   elseif (count($kontrolsay)!=0){
       echo '<div><span style="color: red;  "><b>Eklemek istededğiniz  blok ve daireye ait bir kayıt bulunmaktadır</b></span></div>';
   }
   elseif (!post('apartman')){
       echo '<div><span style="color: red;  "><b>Lütfen Apartmanı giriniz</b></span></div>';
   }
   else{
        $sorgu=$db->prepare('INSERT INTO sakin SET ad=?,tel=?,eposta=?,sifre=?,blok=?,apartman=?,daire=?');
        $ekle=$sorgu->execute([
                $adsoyad,$numara,$eposta,$sifre,$blok,$apartman,$daire
        ]);
        if($ekle){
            echo '<div><span style="color: green;  "><b>Başarıyla Eklendi</b></span>';
             header('Refresh:1; url=anasayfa.php?sayfa=kisiekle');
        }
        else{
            echo '<div><span style="color: red;  "><b>Bi Hata Oluştu lütfen ilgili kişilere bildirin..</b></span>';
        }
   }




}

?>

</section>
