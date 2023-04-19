<?php
    include ("./head.php"); ?>
    <link href="./rnotes.css" rel="stylesheet">
   
			<main class="content">
				<div class="container-fluid p-0">
				<div class="row">
        <div class="col-md-12">
            <h1 _ngcontent-c7="" style="font-weight: normal"> Registro de cambios</h1>
            <mat-card-subtitle _ngcontent-c7="" class="mat-card-subtitle">Todos los cambios notables en este proyecto se documentará en esta página.</mat-card-subtitle>
           <mat-card _ngcontent-c7="" class="mat-card">
               <mat-card-title _ngcontent-c7="" class="mat-card-title">v 1.0.1 
               <mat-card-subtitle _ngcontent-c7="" class="mat-card-subtitle">
                   Lanzamiento 05-03-2022</mat-card-subtitle>
                   </mat-card-title>
                   <mat-card-content _ngcontent-c7="" class="mat-card-content">
                       <button class="btn btn-new">Nuevo</button>
                       <ul _ngcontent-c7="">
                           <li _ngcontent-c7="" class="new">Agregado botón PERFIL en menú.</li>
                            <li _ngcontent-c7="">Al acceder por primera vez debes rellenar la información de tu empresa.</li>
                            <li _ngcontent-c7="" class="new"> Agregado botón CERRAR SESIÓN en menú.</li>
                           </ul>
                           </mat-card-content>
                           <mat-card-content _ngcontent-c7="" class="mat-card-content">
                       <button class="btn btn-err">CORRECCIONES</button>
                       <ul _ngcontent-c7="">
                           <li _ngcontent-c7="" class="err">Corregido problemas al almacenar datos del cliente.</li>
                           
                           </ul>
                           </mat-card-content>
                           <mat-card-content _ngcontent-c7="" class="mat-card-content">
                       <button class="btn btn-new">MEJORAS</button>
                       <ul _ngcontent-c7="">
                           <li _ngcontent-c7="" class="new">Mejoras en la seguridad y tratamiento de datos de los clientes.</li>
                            <li _ngcontent-c7="" class="new">Mejoras en el codigo fuente y carga de los reproductores.</li>
                           </ul>
                           </mat-card-content></mat-card>
        </div> 
        
    </div>
  



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
	    $('#rnotesactiv').addClass("active");
    </script>
</body>

</html>