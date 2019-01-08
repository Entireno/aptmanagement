<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
$parcalanan=parcala($_GET['sayfa']);
if($_SESSION['yetki']!=1){
    if($_SESSION['id']!=$parcalanan[1]){
        header('Location: anasayfa.php?sayfa=detay-'.$_SESSION['id']);
    }
}
 $elektirik=$db->prepare('SELECT miktar as tmiktar FROM elektirik WHERE s_id=? AND durum!=1 AND gecikme!=1');
 $dogalgaz=$db->prepare('SELECT  miktar  as tmiktar FROM dogalgaz WHERE s_id=? AND durum!=1 AND gecikme!=1');
 $su=$db->prepare('SELECT  miktar  as tmiktar FROM su WHERE s_id=? AND durum!=1 AND gecikme!=1');
 $diger=$db->prepare('SELECT miktar  as tmiktar FROM diger WHERE s_id=? AND durum!=1 AND gecikme!=1');

 $diger->execute([$parcalanan[1]]);
 $elektirik->execute([$parcalanan[1]]);
 $dogalgaz->execute([$parcalanan[1]]);
 $su->execute([$parcalanan[1]]);
 $elektirikborc=$elektirik->fetch(PDO::FETCH_ASSOC);
 $suborc=$su->fetch(PDO::FETCH_ASSOC);
 $dogalgazborc=$dogalgaz->fetch(PDO::FETCH_ASSOC);
 $digerborc=$diger->fetch(PDO::FETCH_ASSOC);
 $toplamborc=$elektirikborc['tmiktar']+$suborc['tmiktar']+$dogalgazborc['tmiktar']+$digerborc['tmiktar'];
 $kisi=$db->prepare('SELECT ad FROM sakin WHERE  id=?');
 $kisi->execute([$parcalanan[1]]);
 $kisiisim=$kisi->fetch(PDO::FETCH_ASSOC);
 include 'system/mailfonk.php';

?>

                    <section role="main" class="content-body">
                    <header class="page-header">
                        <h2> <?=$kisiisim['ad'] ?>/ Borç Sorgusu</h2>
                    </header>
                        <form method="post" action="#">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover mb-none">
                                <thead>
                                    <th> Detay</th>
                                    <th>Tutar</th>
                                    <th>Ödendi</th>
                                </thead>
                                <tbody>
                                <tr>

                                    <td>Doğalgaz Borcu</td>
                                    <td><?=$dogalgazborc['tmiktar']==0 ? '0':$dogalgazborc['tmiktar']?> TL</td>
                                    <td><input name="list[]" value="dogalgaz" id="for-project" <?=$dogalgazborc['tmiktar']==0 ? 'disabled':''?> type="checkbox"  />
                                        <label for="for-project"></label></td>
                                </tr>
                                <tr>
                                    <td>Elektrik Borcu</td>
                                    <td><?=$elektirikborc['tmiktar']==0 ? '0':$elektirikborc['tmiktar']?> TL</td>
                                    <td><input  name="list[]"  id="for-project" value="elektirik" <?=$elektirikborc['tmiktar']==0 ? 'disabled':''?> type="checkbox"   />
                                        <label for="for-project"></label></td>
                                </tr>
                                <tr>
                                    <td>Su Borcu</td>
                                    <td><?=$suborc['tmiktar']==0 ? '0':$suborc['tmiktar']?> TL</td>
                                    <td><input name="list[]"  id="for-project" value="su" <?=$suborc['tmiktar']==0 ? 'disabled':''?>  type="checkbox"   />
                                        <label for="for-project"></label></td>
                                </tr>
                                <tr>
                                    <td>Diğer Giderler</td>
                                    <td><?=$digerborc['tmiktar']==0? '0':$digerborc['tmiktar']?>TL</td>
                                    <td><input name="list[]" id="for-project" value="diger" <?=$digerborc['tmiktar']==0? 'disabled':''?> type="checkbox"  />
                                        <label for="for-project"></label></td>
                                </tr>
                                <tr>
                                    <td><strong>TOPLAM BORÇ</strong></td>
                                    <td><strong><?= $toplamborc==0 ? '0': $toplamborc ;?> TL</strong></td>
                                    <td>
                                        <label for="for-project"></label></td>
                                </tr>

                                </tbody>
                            </table>
                            <?php if($_SESSION['yetki']==1){ ?>
                            <div class="panel-body">
                                <button name="submit" type="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg btn-block">Kaldır</button>
                                </div>
                                <div class="panel-body">
                                    <button name="mailgonder" type="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg btn-block">Fatura Gönder</button>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                        </form>



<?php
$simdiki=time();
$zaman=date('Y-m-d',$simdiki);

if(isset($_POST['submit'])){

    $say=count($_POST['list']);

    for($i=0; $i<$say; $i++){

        if(isset($_POST['list'][$i])){
            $tablo= $_POST['list'][$i];

            $guncelle=$db->prepare("UPDATE ".$tablo ." SET  durum=?,tarih=? WHERE s_id=? AND  (gecikme!=1 AND durum!=1)");
            $merhaba=$guncelle->execute([1,$zaman,$parcalanan[1]]);
            if ($merhaba){
               echo' <br>  <div><span style="color: green;  "><b>'.strtoupper($tablo).' Faturası  Başarıyla kaldırıldı</b></span></div>';
            }
        }
    }
    if($merhaba){
        header('Refresh:1; url=anasayfa.php?sayfa=detay-'.$parcalanan[1].'');
    }else{
      echo'  <div><span style="color: red;  "><b>Bir Sorun Oluştu Lütfen ilgili Kişilere Bildirin</b></span></div>';
    }

}
if(isset($_POST['mailgonder'])) {
    $kisimail = $db->prepare('SELECT eposta FROM sakin WHERE id=?');
    $kisimail->execute([$parcalanan[1]]);
    $mailgonderilecek = $kisimail->fetch(PDO::FETCH_ASSOC);
    $mail->addAddress($mailgonderilecek['eposta']);
    $mail->Subject = 'Fatura Dekontu';
    $icerik='
    
    <html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv=\'Content-Type\' content=\'text/html; charset=UTF-8\'/>
    <title>Site Yönetim - Makbuz</title>
    <style type="text/css">
        * { margin: 0; padding: 0; }
        body { font: 14px/1.4 Georgia, serif; }
        #page-wrap { width: 800px; margin: 0 auto; }
        textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
        table { border-collapse: collapse; }
        table td, table th { border: 1px solid black; padding: 5px; }
        #header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }
        #address { width: 250px; height: 150px; float: left; }
        #customer { overflow: hidden; }
        #logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
        #logoctr { display: none; }
        #logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
        #logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
        #logohelp input { margin-bottom: 5px; }
        .edit #logohelp { display: block; }
        .edit #save-logo, .edit #cancel-logo { display: inline; }
        .edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
        #customer-title { font-size: 20px; font-weight: bold; float: left; }
        #meta { margin-top: 1px; width: 300px; float: right; }
        #meta td { text-align: right;  }
        #meta td.meta-head { text-align: left; background: #eee; }
        #meta td textarea { width: 100%; height: 20px; text-align: right; }
        #items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
        #items th { background: #eee; }
        #items textarea { width: 80px; height: 50px; }
        #items tr.item-row td { border: 0; vertical-align: top; }
        #items td.description { width: 300px; }
        #items td.item-name { width: 175px; }
        #items td.description textarea, #items td.item-name textarea { width: 100%; }
        #items td.total-line { border-right: 0; text-align: right; }
        #items td.total-value { border-left: 0; padding: 10px; }
        #items td.total-value textarea { height: 20px; background: none; }
        #items td.balance { background: #eee; }
        #items td.blank { border: 0; }
        #terms { text-align: center; margin: 20px 0 0 0; }
        #terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
        #terms textarea { width: 100%; text-align: center;}
        textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }
        .delete-wpr { position: relative; }
        .delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
		.price{float:right;}
	</style>
</head>
<body>
<div id="page-wrap">
    <div id="header">MAKBUZ</div>
    <div id="identity">
            <div id="address">
                Adres Mah.<br>
                Adres Cad. Adres Sk.<br>
                Semt/ŞEHİR
            </div>
        <div id="logo" style="display: none">
            <img id="image" src="images/logo.png" alt="logo"/>
        </div>
    </div>
    <div style="clear:both"></div>
    <div id="customer">
        <div id="customer-title">3 RED GROUP<br>Site Yönetim Sistemi</div>
        <table id="meta">
            <tr>
                <td class="meta-head">Fatura Dönemi</td>
                <td><div id="date">'.$zaman. '</div></td>
            </tr>
            <tr>
                <td class="meta-head">Toplam Tutar</td>
                <td>
                    <div class="due">'.$toplamborc.' TL</div>
                </td>
            </tr>
        </table>
    </div>
    <table id="items">
        <tr>
            <th>İsim</th>
            <th>Açıklama</th>
            <th>Tutar</th>
        </tr>
        <tr class="item-row">
            <td class="item-name">
                <div class="">
                    <div>Doğalgaz</div>
                </div>
            </td>
            <td class="description">
                <div>Apartmanın bu aya ait toplam doğalgaz faturası.</div>
            </td>
            <td><span class="price">'.$dogalgazborc['tmiktar'].'TL</span></td>
        </tr>
        <tr class="item-row">
            <td class="item-name">
                <div class="">
                    <div>Elektrik</div>
                   
                </div>
            </td>
            <td class="description">
                <div>Apartmanın bu aya ait toplam elektrik faturası.</div>
            </td>
            <td><span class="price">'.$elektirikborc['tmiktar'].'TL</span></td>
        </tr>
        <tr class="item-row">
            <td class="item-name">
                <div class="">
                    <div>Su</div>
                   
                </div>
            </td>
            <td class="description">
                <div>Apartmanın bu aya ait toplam su faturası.</div>
            </td>
            <td><span class="price">'.$suborc['tmiktar'].' TL</span></td>
        </tr>
        <tr class="item-row">
            <td class="item-name">
                <div class="">
                    <div>Diger</div>
                   
                </div>
            </td>
            <td class="description">
                <div>Apartmanın bu aya ait toplam kapıcı ,asansör bakım vb giderleri.</div>
            </td>
            <td><span class="price">'.$digerborc['tmiktar'].' TL</span></td>
        </tr>
    </table>
    <div id="terms">
        <h5>KURALLAR</h5>
        <div>
            * Belirtilen Son Ödeme Tarihini Geçiren Site Sakinleri Hakkında Hukuki Yaptırımlar Olacaktır.<br>
            * Belirtilen Tutarlar İle İlgili İtirazı Olanların Öncelikli Olarak Site Yöneticisi İle İletişime Geçmesi Gerekmektrdir.
        </div>
    </div>
</div>
</body>
</html>
    ';

    $mail->MsgHtml($icerik);
    if ($mail->send()) {
        echo '<div><span style="color: green;  "><b>Fatura Başarıyla Gönderildi</b></span></div>';
        header('Refresh:1; url=anasayfa.php?sayfa=detay-'.$parcalanan[1].'');
    }
    else{
        echo '<div><span style="color: red;  "><b>Fatura Gönderilirken Bir sorun oluştu</b></span></div>';
    }
}
?></section>

