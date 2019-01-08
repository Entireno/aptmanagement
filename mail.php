<?php
 if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
    }
if($_SESSION['yetki']!=1) {
    include '404.php';
    exit();
}
$parcalanan=parcala($_GET['sayfa']);

   include 'system/mailfonk.php';
   $bloklar=$db->prepare('SELECT DISTINCT blok From sakin WHERE blok IS NOT NULL AND blok!=" " ');
   $bloklar->execute();
   $bloklarad=$bloklar->fetchAll(PDO::FETCH_ASSOC);

   $kisi=kisi($parcalanan[1]);

    if(is_numeric($parcalanan[1]) && $kisi){
        $a=1;
        $duyuru=$db->prepare('SELECT baslik FROM sikayetler WHERE s_id=?');
        $duyuru->execute([$parcalanan[1]]);
        $duyurubaslik=$duyuru->fetch(PDO::FETCH_ASSOC);
        print_r($duyurubaslik);
    }
    else{
        $a=0;
    }

   ?>


				<section role="main" class="content-body">
                    <header class="page-header">
                        <h2>Mail</h2>
                    </header>
                    <form class="form-horizontal form-bordered" action="#" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label">Bloklar</label>
                            <div class="col-md-6">
                                <select name="blok" id="blok" data-plugin-selectTwo class="form-control populate">
                                    <optgroup>

                                        <?php if($a==0){ ?>
                                            <option value="">Blok Seçin</option>
                                        <?php foreach ($bloklarad as $bloklistele): ?>
                                        <option value="<?=$bloklistele['blok']?>"><?=$bloklistele['blok']?></option>
                                        <?php endforeach; ?>
                                        <?php }else{?>
                                        <option value="<?=$kisi['blok']?>"><?=$kisi['blok']?></option>
                                        <?php } ?>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Kişiler</label>
                            <div class="col-md-6">
                                <select name="kisi"  id="kisi" <?= $a==0 ? 'disabled':''?> data-plugin-selectTwo class="form-control populate">
                                    <optgroup>
                                        <?php if($a==1){ ?>
                                            <option value="<?=$parcalanan[1]?>"><?=$kisi['ad']?></option>
                                        <?php }else{ ?>
                                            <option  value="">-Kişi Seçin-</option>
                                               <?php }?>


                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Başlık</label>
                            <div class="col-md-6">
                                <input type="text" value="<?= $a==1 ? '(Cevap.)'.$duyurubaslik['baslik']:''?>"  name="baslik" class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="textareaAutosize">İçerik</label>
                            <div class="col-md-6">
                                <textarea name="icerik" class="form-control" rows="3" id="textareaAutosize" data-plugin-textarea-autosize></textarea>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Gönder</button>
                    </form>

      <?php
        if (isset($_POST['submit'])){
            array_map('filtrele',$_POST);
            if($_POST['blok']==""){
                echo '<div><span style="color: red;  "><b>Lütfen Bloğu seçiniz</b></span></div>';
            }
            elseif ($_POST['kisi']==""){
                echo '<div><span style="color: red;  "><b>Lütfen kisiyi seçiniz</b></span></div>';

            }
            elseif(!post('baslik')){
                echo '<div><span style="color: red;  "><b>Lütfen Başlığı giriniz</b></span></div>';
            }
            elseif (!post('icerik')){
                echo '<div><span style="color: red;  "><b>Lütfen İçeriği giriniz</b></span></div>';
            }
            else{
                $kisimail=$db->prepare('SELECT eposta FROM sakin WHERE id=?');
                $kisimail->execute([$_POST['kisi']]);
                $mailgonderilecek=$kisimail->fetch(PDO::FETCH_ASSOC);
                $mail->addAddress($mailgonderilecek['eposta']);
                $mail->Subject=$_POST['baslik'];
                $mail->MsgHtml($_POST['icerik']);
                if($mail->send()){
                    echo '<div><span style="color: green;  "><b>Mail Başarıyla Gönderildi</b></span></div>';
                     header('Refresh:1; url=anasayfa.php?sayfa=mail');
                }
                else{
                    echo '<div><span style="color: red;  "><b>Mail Gönderilirken bir hata oluştu lütfen ilgili kişilere haber veriniz.</b></span></div>';
                    echo $mail->ErrorInfo;
                }
            }

        }

        ?>
                </section>