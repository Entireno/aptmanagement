
<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
$id=$_SESSION['id'];
$kisi=kisi($id);

$kisiad=explode(" ",$kisi['ad']);
?>


<div class="form-group">
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>PROFİLİM</h2>
        </header>
        <form class="form-horizontal form-bordered" method="post" action="#">
            <?php if($_SESSION['yetki']==1){?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="inputDefault">Ad</label>
                <div class="col-md-6">
                    <input  name="ad" value="<?=$kisiad[0]?>" type="text" class="form-control" id="inputDefault">
                </div>
            </div>
                <div class="form-group">
                    <label class="col-md-3 control-label" for="inputDefault">Soyad</label>
                    <div class="col-md-6">
                        <input  name="soyad" value="<?=$kisiad[1]?>" type="text" class="form-control" id="inputDefault">
                    </div>
                </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for="inputDefault">Sifre</label>
                        <div class="col-md-6">
                            <input  name="sifre" placeholder="***" type="password" class="form-control" id="inputDefault">
                        </div>
                    </div>
            <?php }?>
            <div class="form-group">
                <label class="col-md-3 control-label" for="inputDefault">İletişim Numarası</label>
                <div class="col-md-6">
                    <input name="tel" value="<?=$kisi['tel']?>" maxlength="10" type="text" class="form-control" id="number">
                    <div class="help-block">Lütfen başında "0" olmadan giriniz</div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-3 control-label" for="inputDefault">E-posta Adresi</label>
                <div class="col-md-6">
                    <input name="eposta" value="<?=$kisi['eposta']?>" type="text" class="form-control" id="inputDefault">
                </div>
            </div><br><br><br>
                <button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg btn-block">Bilgilerimi Düzenle</button>
        </form>

<?php
if(isset($_POST['submit'])){
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
        $adguncelle->execute([$ad,$id]);

        $telguncelle=$db->prepare('UPDATE sakin SET tel=? WHERE id=?');
        $telguncelle->execute([$_POST['tel'],$id]);

        $epostaguncelle=$db->prepare('UPDATE sakin SET eposta=? WHERE id=?');
        $epostaguncelle->execute([$_POST['eposta'],$id]);

        if (post('sifre')){
            $sifre=md5($_POST['sifre']);
            $sifreguncelle=$db->prepare('UPDATE sakin SET sifre=? WHERE id=?');
            $sifreguncelle->execute([$sifre,$id]);
        }
        echo '<div><span style="color: green;  "><b>Başarıyla Güncellendi</b></span></div>';
        header('Refresh:1; url=anasayfa.php?sayfa=profil');
    }
}


?>
    </section>
