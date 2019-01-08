<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
$parcalanan=parcala($_GET['sayfa']);

$kisi=$db->prepare('SELECT * FROM sakin WHERE  id=?');
$kisi->execute([$parcalanan[1]]);
$kisiisim=$kisi->fetch(PDO::FETCH_ASSOC);

$bol=explode(" ",$kisiisim['ad']);


?>


                    <section role="main" class="content-body">
                    <header class="page-header">
                        <h2><?=$kisiisim['ad']?> - Düzenle</h2>
                    </header>
                    <form class="form-horizontal form-bordered" method="post" action="#">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Ad</label>
                            <div class="col-md-6">
                                <input name="ad" type="text" value="<?=$bol[0]?>" class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Soyad</label>
                            <div class="col-md-6">
                                <input name="soyad" type="text" value="<?=$bol[1]?>"class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">İletişim Numarası</label>
                            <div class="col-md-6">
                                <input name="tel" type="text" maxlength="10" value="<?=$kisiisim['tel']?>" class="form-control" id="number">
                                 <div class="help-block">Lütfen başında "0" olmadan giriniz</div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">E-posta Adresi</label>
                            <div class="col-md-6">
                                <input name="eposta" type="text" value="<?=$kisiisim['eposta']?>" class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Şifre</label>
                            <div class="col-md-6">
                                <input name="sifre" type="password" placeholder="*****" class="form-control" id="inputDefault">
                            </div>
                        </div>

                        <br><br><br>
                        <button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Değişiklikleri Kaydet</button>
                    </form>
                        <form method="post" action="#">
                            <button type="submit" name="sil" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Kişiyi Sil</button>
                        </form>



<?php
if(isset($_POST['submit'])){
    print_r($_POST);
    array_map('filtrele',$_POST);
    if (!post('ad')){
        echo '<div><span style="color: red;  "><b>Ad kısmı boş olamaz</b></span></div>';
    }
    elseif (!post('soyad')){
        echo '<div><span style="color: red;  "><b>Soyad kısmı boş olamaz</b></span></div>';
    }
    elseif (!post('tel')){
        echo '<div><span style="color: red;  "><b>iletişim adresi boş olamaz</b></span></div>';
    }
    elseif (!post('eposta')){
        echo '<div><span style="color: red;  "><b>E-posta Adresi boş olamaz</b></span></div>';
    }
    elseif (!filter_var($_POST['eposta'],FILTER_VALIDATE_EMAIL)){

        echo '<div><span style="color: red;  "><b>Lütfen Geçerli bir email adresi giriniz</b></span></div>';
    }
    else{
    $ad=$_POST['ad']." ".$_POST['soyad'];
    $adguncelle=$db->prepare('UPDATE sakin SET ad=? WHERE id=?');
    $adguncelle->execute([$ad,$parcalanan[1]]);

    $telguncelle=$db->prepare('UPDATE sakin SET tel=? WHERE id=?');
    $telguncelle->execute([$_POST['tel'],$parcalanan[1]]);

    $epostaguncelle=$db->prepare('UPDATE sakin SET eposta=? WHERE id=?');
    $epostaguncelle->execute([$_POST['eposta'],$parcalanan[1]]);

    if (post('sifre')){
        $sifre=md5($_POST['sifre']);
        $sifreguncelle=$db->prepare('UPDATE sakin SET sifre=? WHERE id=?');
        $sifreguncelle->execute([$sifre,$parcalanan[1]]);
    }
    echo '<div><span style="color: green;  "><b>Başarıyla Güncellendi</b></span></div>';
     header('Refresh:1; url=anasayfa.php?sayfa=kisiduzenle-'.$parcalanan[1]);
    }
}
if(isset($_POST['sil'])){
    if(guncelborc($parcalanan[1])==0){
    $sil=$db->prepare('DELETE FROM sakin WHERE id=?');
    $sil->execute([$parcalanan[1]]);

    echo '<div><span style="color: green;  "><b>Başarıyla Silindi</b></span></div>';
    header('Refresh:1; url=anasayfa.php?sayfa=kisiduzenle-'.$parcalanan[1]);
    }
    else{
        echo '<div><span style="color: red;  "><b>Silmeye Çalıştığınız kişinin borcu bulunmaktadır</b></span></div>';
    }
}


?>
                    </section>
