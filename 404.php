<?php
if(!isset($_SESSION['oturum'])){
    header('Location:index.php');
}
?>

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>404</h2>


					</header>

					<!-- start: page -->
						<section class="body-error error-inside">
							<div class="center-error">

								<div class="row">
									<div class="col-md-12">
										<div class="main-error mb-xlg">
											<h2 class="error-code text-dark text-center text-weight-semibold m-none">404 <i class="fa fa-file"></i></h2>
											<p class="error-explanation text-center">Üzgünüz,ama aradığınız sayfa bulunamadı.</p>
										</div>
									</div>

								</div>
							</div>
						</section>
