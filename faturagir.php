<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
?>
				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Fatura Gir</h2>
                    </header>
                    <form class="form-horizontal form-bordered" action="#" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fatura Dönemi</label>
                            <div class="col-md-6">
                                <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</span>
                                    <input id="date" name="ilk" data-plugin-masked-input data-input-mask="99-99-9999" placeholder="gün/ay/yıl" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bloklar</label>
                            <div class="col-md-6">
                                <select name="blok" data-plugin-selectTwo class="form-control populate">
                                    <optgroup  label="">
                                        <option value="A">A Blok</option>
                                        <option value="B">B Blok</option>
                                        <option value="C">C Blok</option>
                                        <option value="D">D Blok</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Fatura Tercihi</label>
                            <div class="col-md-6">
                                <select  name="tur" data-plugin-selectTwo class="form-control populate">
                                    <optgroup >
                                        <option value="dogalgaz">Doğalgaz</option>
                                        <option value="elektirik">Elektrik</option>
                                        <option value="su">Su</option>
                                        <option value="diger">Diğer</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Tutar</label>
                            <div class="col-md-6">
                                <input name="miktar" type="text" class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Son Ödeme Tarihi</label>
                            <div class="col-md-6">
                                <div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</span>
                                    <input name="son" id="date" data-plugin-masked-input data-input-mask="99-99-9999" placeholder="gün/ay/yıl" class="form-control">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button name="submit" type="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Kaydet</button>
                    </form>

                <?php

                require_once 'system/mailfonk.php';

                if(isset($_POST['submit'])){
                    array_map('filtrele',$_POST);
                    $tur=$_POST['tur'];
                    $ilk=strtotime($_POST['ilk']);
                    $ilkzaman=date('Y-m-d',$ilk);
                    $son=strtotime($_POST['son']);
                    $sonzaman=date('Y-m-d',$son);
                    $simdiki=time()-((60*60*24)*14);
                    $miktar=$_POST['miktar'];
                    $ayilk=ay($ilkzaman);
                    $ayson=ay($sonzaman);
                    $blok=strtoupper($_POST['blok']);
                    $deneme=$db->prepare('SELECT ilk FROM '.$tur.' WHERE blok=? ORDER BY id DESC LIMIT 1');
                    $kisi=$db->prepare(' SELECT id FROM sakin WHERE blok=? ');
                    $kisimail=$db->prepare('SELECT ad,eposta FROM sakin WHERE blok=?' );
                    $kisimail->execute([$blok]);
                    $kisimailler=$kisimail->fetchAll(PDO::FETCH_ASSOC);
                    $kisi->execute([$blok]);
                    $kisiid=$kisi->fetchAll(PDO::FETCH_ASSOC);
                    $deneme->execute([$blok]);
                    $sonuc=$deneme->fetch(PDO::FETCH_ASSOC);
                    $kisiidsay=count($kisiid);
                    $denememesaj=$sonzaman.' Son ödeme tarihli '.($miktar/$kisiidsay).' TL '.strtoupper($tur).'  faturanız oluşturulmuştur';

                    if(!post('ilk')){
                        echo '<div><span style="color: red;  "><b>Fatura Dönemini Girmelisiniz</b></span></div>';
                    }
                    elseif(!(isset($ayilk) || isset($ayson))){
                        echo '<div><span style="color: red;  "><b>Lütfen Girdiğiniz Tarih Değerlerini Kontrol Edin</b></span></div>';
                    }
                    elseif (!post('miktar') || !is_numeric(post('miktar'))){
                        echo '<div><span style="color: red;  "><b>Miktarı Girmelisiniz</b></span></div>';
                    }
                    elseif(!post('son')){
                        echo '<div><span style="color: red;  "><b>Son Ödeme Tarihini Girmelisiniz</b></span></div>';
                    }
                    elseif (!tarihkontrol($_POST['ilk'], $_POST['son'])){
                        echo '<div><span style="color: red;  "><b>Son Ödeme Tarihi başlangıç tarihinden önce olamaz..</b></span></div>';
                    }
                    elseif ($kisiidsay==0){
                        echo '<div><span style="color: red;  "><b>Girdiğiniz blokta kimse bulunmamaktadır</b></span></div>';
                    }
                    elseif($ilk<$simdiki){
                        echo '<div><span style="color: red;  "><b>En fazla 2 hafta öncesine kadar fatura oluşturabilirsiniz</b></span></div>';
                    }
                    elseif($son<$ilk){
                        echo '<div><span style="color: red;  "><b>Son ödeme tarihi , fatura döneminden önce olamaz</b></span></div>';
                    }
                    elseif(($son-$ilk>((60*60*24)*14))){

                        echo '<div><span style="color: red;  "><b>Fatura dönemi ve son ödeme tarihi arasında enfazla 2 hafta olabilir</b></span></div>';

                    }
                    elseif(ay($sonuc['ilk'])==ay($_POST['ilk'])){
                        echo '<div><span style="color: red;  "><b>Girdiğiniz ay a ait güncel bir fatura bulunmaktadır</b></span></div>';
                    }
                    else{
                    foreach ($kisiid as $kisiler) {
                        $sorgu = $db->prepare('INSERT INTO ' . $tur . ' SET ilk=?,son=? ,miktar= ?,s_id=?,blok=?');
                        $ekle = $sorgu->execute([
                            $ilkzaman, $sonzaman, ($miktar / $kisiidsay), $kisiler['id'], $blok
                        ]);
                    }


                    if($ekle){
                        $mail->Subject="APT Fatura Bildirimi";
                        $mail->MsgHTML($denememesaj);
                         foreach ($kisimailler as $mailat){
                             $mail->addAddress($mailat['eposta'],"Sayin ".$mailat['ad']);
                         }
                            if($mail->send()){
                                echo '<div><span style="color: green;  "><b>Epostalar Başarıyla Gönderildi</b></span></div>';
                                echo '<div><span style="color: green;  "><b>Faturanız Başarıyla Oluşturuldu</b></span></div>';

                                header('Refresh:1; url=anasayfa.php?sayfa=faturagir');
                            }
                            else{
                                echo '<div><span style="color: red;  "><b>Epostalar Gönderilirken bi sorun oluştu,Lütfen ilgili birime haber veriniz</b></span></div>';
                                 echo $mail->ErrorInfo;
                            }
                    }
                    else{
                        echo '<div><span style="color: red;  "><b>Bir Sorun Oluştu Lütfen ilgili Kişilere Bildirin</b></span></div>';
                    }
                  }
                }
                ?>
                </section>
