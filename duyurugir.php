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
                        <h2>Duyuru Ekle</h2>
                    </header>
                    <form class="form-horizontal form-bordered" method="post" action="#">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="inputDefault">Başlık</label>
                            <div class="col-md-6">
                                <input name="baslik" type="text" class="form-control" id="inputDefault">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="textareaAutosize">Duyuru İçeriği</label>
                            <div class="col-md-6">
                                <textarea name="icerik" class="form-control" rows="3" id="textareaAutosize" data-plugin-textarea-autosize></textarea>
                            </div>
                        </div>
                        <br>
                        <button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary btn-block">Yayınla</button>
                    </form>


<?php
       if(isset($_POST['submit'])){
           array_map('filtrele',$_POST);
            if (!post('baslik')){
                echo '<div><span style="color: red;  "><b>Lütfen başlığı girin</b></span></div>';
            }
            elseif (!post('baslik')){
                echo '<div><span style="color: red;  "><b>Lütfen icerigi girin</b></span></div>';
            }
            else{
                $duyuruekle=$db->prepare('INSERT INTO duyurular SET baslik=?, icerik=?');
                $ekle=$duyuruekle->execute([$_POST['baslik'],$_POST['icerik']]);

                if($ekle){
                    echo '<div><span style="color: green;  "><b>Duyuru  başarıyla Eklendi</b></span></div>';
                    header('Refresh:1; url="anasayfa.php?sayfa=duyurular');
                }
                else{
                    echo '<div><span style="color: red;  "><b>Bir sorun oluştu lütfen ilgili kişiye bildiriniz</b></span></div>';
                }
            }

       }

?>
                </section>
