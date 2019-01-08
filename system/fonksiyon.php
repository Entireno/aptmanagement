<?php
/**
 * Created by PhpStorm.
 * User: Entireno
 * Date: 15.04.2018
 * Time: 22:53
 */

date_default_timezone_set('Europe/Istanbul');
setlocale(LC_ALL,'tr_TR.Utf-8');

function  filtrele($post){
    return htmlspecialchars(trim($post));
}
function post($name)
{
    if (isset($_POST[$name])) {
        return $_POST[$name];
    }
}

function parcala($parcala){
         $b=$_GET['sayfa'];
         $a = explode("-",$b);
        if(isset($a)){
            return $a;
        }
        else{
            return $parcala;
        }
}
function tarihkontrol($ilktarih,$sontarih){
    $ilktarih=strtotime($ilktarih);
    $sontarih=strtotime($sontarih);

    if(!($sontarih>$ilktarih)){
        return false;
    }
    else{
        return true;
    }
}
function ay($tarih){

        if($tarih=='1970-01-01'){
            return false ;
        }
        else{
            $tarih=strtotime($tarih);
            $tarihay=date('Y-m',$tarih);
            return $tarihay;
        }
}


function guncelborc($id){
    $db= new PDO('mysql:host=localhost;dbname=apt','root','root');
    $elektirikborchesap=$db->prepare('SELECT miktar as toplam FROM elektirik WHERE s_id=? AND durum!=1 AND gecikme!=1 ');
    $dogalgazborchesap=$db->prepare('SELECT miktar as toplam FROM dogalgaz WHERE s_id=? AND durum!=1 AND gecikme!=1 ');
    $suborchesap=$db->prepare('SELECT miktar as toplam FROM su WHERE s_id=? AND durum!=1 AND gecikme!=1');
    $digerborchesap=$db->prepare('SELECT miktar as toplam FROM diger WHERE s_id=? AND durum!=1 AND gecikme!=1 ');

    $elektirikborchesap->execute([$id]);
    $suborchesap->execute([$id]);
    $dogalgazborchesap->execute([$id]);
    $digerborchesap->execute([$id]);

    $elektirikborc=$elektirikborchesap->fetch(PDO::FETCH_ASSOC);
    $suborc=$suborchesap->fetch(PDO::FETCH_ASSOC);
    $dogalgazborc=$dogalgazborchesap->fetch(PDO::FETCH_ASSOC);
    $digerborc=$digerborchesap->fetch(PDO::FETCH_ASSOC);

    $toplamborc=$elektirikborc['toplam']+$suborc['toplam']+$dogalgazborc['toplam']+$digerborc['toplam'];
     return $toplamborc;
}
function gecikmeli($id){
    $db= new PDO('mysql:host=localhost;dbname=apt','root','root');
    $gelektirikborchesap=$db->prepare('SELECT SUM(miktar)as toplam FROM sakin INNER JOIN elektirik ON elektirik.s_id=sakin.id WHERE sakin.id=? AND elektirik.durum!=1 AND elektirik.gecikme!=0 ');
    $gdogalgazborchesap=$db->prepare('SELECT SUM(miktar)as toplam FROM sakin INNER JOIN dogalgaz ON dogalgaz.s_id=sakin.id WHERE sakin.id=? AND dogalgaz.durum!=1 AND dogalgaz.gecikme!=0 ');
    $gsuborchesap=$db->prepare('SELECT SUM(miktar)as toplam FROM sakin INNER JOIN su ON su.s_id=sakin.id WHERE sakin.id=? AND su.durum!=1 AND su.gecikme!=0 ');
    $gdigerborchesap=$db->prepare('SELECT SUM(miktar)as toplam FROM sakin INNER JOIN diger ON diger.s_id=sakin.id WHERE sakin.id=? AND diger.durum!=1 AND diger.gecikme!=0 ');

    $gelektirikborchesap->execute([$id]);
    $gsuborchesap->execute([$id]);
    $gdogalgazborchesap->execute([$id]);
    $gdigerborchesap->execute([$id]);

    $gelektirikborc=$gelektirikborchesap->fetch(PDO::FETCH_ASSOC);
    $gsuborc=$gsuborchesap->fetch(PDO::FETCH_ASSOC);
    $gdogalgazborc=$gdogalgazborchesap->fetch(PDO::FETCH_ASSOC);
    $gdigerborc=$gdigerborchesap->fetch(PDO::FETCH_ASSOC);

    $gtoplamborc=$gelektirikborc['toplam']+$gsuborc['toplam']+$gdogalgazborc['toplam']+$gdigerborc['toplam'];
    return $gtoplamborc;

}
function kisi($id){
    $db= new PDO('mysql:host=localhost;dbname=apt','root','root');
    $kisi=$db->prepare('SELECT daire,blok,ad,eposta,tel FROM sakin WHERE id=?');
    $kisi->execute([$id]);
    $kisibilgiler=$kisi->fetch(PDO::FETCH_ASSOC);
    if ($kisi){
    return $kisibilgiler;
    }
    else{
        return false;
    }


}
function say($tarih,$tablo){

    $db= new PDO('mysql:host=localhost;dbname=apt','root','root');
    $heyyo=' SELECT * FROM  '. $tablo . ' WHERE ilk=? ';
    $sorgu= $db->prepare($heyyo);
    $sorgu->execute([$tarih]);
    $sonuc=$sorgu->fetchAll(PDO::FETCH_ASSOC);

     return count($sonuc);
}
function karaktersinirla($sayi)
{
    $uzunluk=strlen($sayi);
    $sinir=8;
    if($uzunluk>$sinir){
        $yenisayi=substr($sayi,0,$sinir);
        return $yenisayi;
    }
    else{
       return $sayi;
    }


}

?>