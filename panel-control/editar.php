<?php include ("./head.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">
					<?php require_once "../admin/editar.php"; ?>
				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a class="text-muted" <?php if(!empty($perfil['web'])){ echo "href='{$perfil['web']}'"; }else{ echo "href='#'"; } ?> target="_blank"><strong><?php if(!empty($perfil['text_footer'])){ echo $perfil['text_footer']; }else{ echo 'Ingresar el texto del Footer'; } ?></strong></a>
							</p>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank"></a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank"></a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank"></a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="" target="_blank"></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="js/app.js"></script>
    <script>
	    $('#panelactiv').addClass("active");
	</script>
</body>

</html>