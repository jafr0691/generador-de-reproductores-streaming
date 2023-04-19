<?php include ("./head.php"); ?>

			<main class="content">
				<div class="container-fluid p-0">
				    <div class="row">
                        <div class="col-md-12">
                            <h2>Perfil</h2>
                            <p> Administrar usuario:</p>
                        </div>   
                    </div>
                    <?php if($_SESSION['user_roles']=='admin' or $_SESSION['user_roles']=='vendedor'){?>
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <label for="banner">Logo del Menu:</label>
                            <form id="logoform" enctype="multipart/form-data">
                                <div class="input-group">
                                    <label class="input-group-btn">
                            			<span class="btn btn-file">
                                            <img id="logoprev" width="150" height="120" <?php if(!empty($perfil['logo'])){ echo "src='.{$perfil['logo']}'"; }else{ echo "src='./img/ingre_img.jpg'";} ?>> <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="logo" type="file" id="logo"  onchange="previewImage('logo','logoprev');"><i class="align-middle" data-feather="folder"></i>
                                        </span>
                                    </label>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <label for="banner">Icono del Favicon:</label>
                            <form id="faviconform" enctype="multipart/form-data">
                                <div class="input-group">
                                    <label class="input-group-btn">
                            			<span class="btn btn-file">
                                            <img id="faviconprev" width="150" height="120" <?php if(!empty($perfil['favicon'])){ echo "src='.{$perfil['favicon']}'"; }else{ echo "src='./img/ingre_img.jpg'";} ?> style="margin-right:25px;"> <input accept=".jpg,.png,.jpeg,.gif" class="hidden" name="favicon" type="file" id="favicon"  onchange="previewImage('favicon','faviconprev');"><i class="align-middle" data-feather="folder"></i>
                                        </span>
                                    </label>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="desc">
                            <span><i class="fas fa-info-circle"></i> Url de servidores. Coloque la url (Ej: stream.mediapanel.app) de su servicio de Streaming.</span>
                            <br><br>
                            </div>
                        <div class="col-md-7 col-sm-6">
                            <div class="form-group">
                                <label for="servidor">Servidores:</label>
                                <select multiple data-role="tagsinput" id="servidor">
                                    <?php
                                        echo 'Ingrese Usuario Facebook 22';
                                        $servidores = json_decode($perfil['servidores']);
                                        
                                        if(!empty($servidores)){
                                           foreach($servidores as $serv){ 
                                                echo "<option value='{$serv}'>$serv</option>";
                                            } 
                                        }
                                     ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-6">
                            <div class="form-group">
                                <button class="btn btn-primary" id="btnservi" style="display:none">Guardar</button>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formfbtext">
                              <div class="form-group">
                                <label for="fb">Facebook:</label>
                                <span id="fbtext"><?php if(!empty($perfil['facebook'])){ echo $perfil['facebook']; }else{ echo 'Ingrese Usuario Facebook'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="fbedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formfb" style="display:none">
                              <div class="form-group">
                                <label for="fb">Facebook:</label>
                                <input type="text" class="form-control" id="fb">
                              </div>
                              <button class="btn btn-danger" id="fbcancelar">Cancelar</button> 
                              <button class="btn btn-success" id="fbguardar">Guardar</button>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formmgtext">
                              <div class="form-group">
                                <label for="mg">Messenger</label>
                                <span id="mgtext"><?php if(!empty($perfil['messenger'])){ echo $perfil['messenger']; }else{ echo 'Ingrese Usuario Messenger'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="mgedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formmg" style="display:none">
                              <div class="form-group">
                                <label for="mg">Messenger:</label>
                                <input type="text" class="form-control" id="mg">
                              </div>
                              <button class="btn btn-danger" id="mgcancelar">Cancelar</button> 
                              <button class="btn btn-success" id="mgguardar">Guardar</button>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formtwtext">
                              <div class="form-group">
                                <label for="tw">Twitter:</label>
                                <span id="twtext"><?php if(!empty($perfil['twitter'])){ echo $perfil['twitter']; }else{ echo 'Ingrese Usuario Twitter'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="twedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formtw" style="display:none">
                              <div class="form-group">
                                <label for="tw">Twitter:</label>
                                <input type="text" class="form-control" id="tw">
                              </div>
                              <button class="btn btn-danger" id="twcancelar">Cancelar</button> 
                              <button class="btn btn-success" id="twguardar">Guardar</button>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formigtext">
                              <div class="form-group">
                                <label for="ig">Instagram:</label>
                                <span id="igtext"><?php if(!empty($perfil['instagram'])){ echo $perfil['instagram']; }else{ echo 'Ingrese Usuario Instagram'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="igedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formig" style="display:none">
                              <div class="form-group">
                                <label for="ig">Instagram:</label>
                                <input type="text" class="form-control" id="ig">
                              </div>
                              <button class="btn btn-danger" id="igcancelar">Cancelar</button> 
                              <button class="btn btn-success" id="igguardar">Guardar</button>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formybtext">
                              <div class="form-group">
                                <label for="yb">Youtube:</label>
                                <span id="ybtext"><?php if(!empty($perfil['youtube'])){ echo $perfil['youtube']; }else{ echo 'Ingrese Usuario Youtube'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="ybedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formyb" style="display:none">
                              <div class="form-group">
                                <label for="yb">Youtube:</label>
                                <input type="text" class="form-control" id="yb">
                              </div>
                              <button class="btn btn-danger" id="ybcancelar">Cancelar</button> 
                              <button class="btn btn-success" id="ybguardar">Guardar</button>
                        </div>
                    </div>
                    
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formwptext">
                              <div class="form-group">
                                <label for="wp">Whatsapp:</label>
                                <span id="wptext"><?php if(!empty($perfil['whatsapp'])){ echo $perfil['whatsapp']; }else{ echo 'Ingrese Usuario Whatsapp'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="wpedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formwp" style="display:none">
                              <div class="form-group">
                                <label for="wp">Whatsapp:</label>
                                <input type="text" class="form-control" id="wp">
                              </div>
                              <button class="btn btn-danger" id="wpcancelar">Cancelar</button> 
                              <button class="btn btn-success" id="wpguardar">Guardar</button>
                        </div>
                    </div>

                    
                    
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formfootertext">
                              <div class="form-group">
                                <label for="txfooter">Texto Footer:</label>
                                <span><?php if(!empty($perfil['text_footer'])){ echo $perfil['text_footer']; }else{ echo 'Ingresar el texto del Footer'; } ?></span>
                              </div>
                              <div class="form-group">
                                <label for="web">Link web:</label>
                                <span><?php if(!empty($perfil['web'])){ echo $perfil['web']; }else{ echo 'Ingresar el texto del Footer'; } ?></span>
                              </div>
                              <button class="btn btn-primary" id="footeredi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formfooter" style="display:none">
                              <div class="form-group">
                                <label for="txfooter">Texto Footer:</label>
                                <input type="text" class="form-control" id="txfooter">
                              </div>
                              <div class="form-group">
                                <label for="web"> Link web:</label>
                                <input type="text" class="form-control" id="web">
                              </div>
                              <button class="btn btn-danger" id="footercancelar">Cancelar</button> 
                              <button class="btn btn-success" id="footerguardar">Guardar</button>
                        </div>
                        
                    </div>
                    
                    <div class="row mt-5">
                        <div class="form-inline" role="form" id="formfirmahtml">
                              <div class="form-group">
                                <label for="firma">Firma:</label>
                                <?php if(!empty($perfil['firma'])){ echo $perfil['firma']; }else{ echo 'Ingresar su firma de correo'; } ?>
                              </div>
                              <button class="btn btn-primary" id="firmaedi">Editar</button>
                        </div>
                        
                        <div class="form-inline" id="formfirma" style="display:none">
                            <div class="form-group">
                                <label for="firma">Firma:</label>
                                <textarea class="firma" name="firma" id="firma"><?php if(!empty($perfil['firma'])){ echo $perfil['firma']; }else{ echo 'Ingresar su firma de correo'; } ?></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-danger" id="firmacancelar">Cancelar</button> 
                                <button class="btn btn-success" id="firmaguardar">Guardar</button>
                            </div>
                        </div>
                        
                    </div>
                    
                    <div class="row mt-5">
						<div class="col-md-1">
                            <label for="hast" style="margin-top: 7px;">LICENCIA:</label>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <input type="text" class="form-control" name="hast"  id="hast" value="<?php if(!empty($_SESSION['hast'])){ echo $_SESSION['hast']; }else{ echo 'Tiene que generar el HASH en editar'; } ?>" readonly  />
                        </div>
                        
                            <?php 
                                if($_SESSION['acthash']==1){
                                    echo "<div class='col-md-1'><button class='btn btn-success'>ACTIVA</button></div>
                        <div class='col-md-1'>
                            <button class='btn btn-primary' id='copy-hast' onclick='copyToClipboard()'>Copiar</button>
                        </div>
                        <div class='col-md-1'>
                            <button class='btn btn-primary' id='copy-hast' onclick='copyToClipboard()'><i class='fa fa-cloud-download' aria-hidden='true'></i> Modulo WHMCS</button>
                        </div>";
                                }else if($_SESSION['acthash']==0){
                                    echo "<div class='col-md-1'><button class='btn btn-warning'>SUSPENDIDA</button></div>";
                                }else{
                                    echo "<div class='col-md-1'><button class='btn btn-danger'>INHABILITADA</button></div>";
                                }
                            ?>
                        
                       
                    </div>
                    <?php } ?>
                    <div class="row mt-5">
                        <div class="form-group">
						    <div class="row">
						        <div class="col-md-12 text-center pb-4">
						            <button type="button" id="btn-passedi" class="btn btn-primary"><i class="glyphicon glyphicon-lock"></i> Cambiar Contraseña</button>
						        </div>
						    </div>
						</div>
                        <div class="row" id="formpassedi" style="display:none">
                            <div class="col-md-12">
    							<div class="form-group">
    								<label for="passwordedi" class="col-md-3 control-label">Contraseña</label>
    								<div class="col-md-9">
    									<input type="password" class="form-control" id="passredi" name="passwordedi" placeholder="Contraseña" required value="" autocomplete="new-password" />
    								</div>
    							</div>
    							<div class="form-group pt-5 mt-5">
    								<label for="con_passwordedi" class="col-md-3 control-label">Confirmar Contraseña</label>
    								<div class="col-md-9">
    									<input type="password" class="form-control" id="con_passredi" name="con_passwordedi" placeholder="Confirmar Contraseña" required autocomplete="new-password" />
    								</div>
    							</div>
							</div>
							<div class="col-md-12 pt-5 text-center">
							    <button type="button" id="btn-passedisave" class="btn btn-primary"><i class="glyphicon glyphicon-lock"></i> Guardar Cambios</button>
							</div>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="./js/bootstrap-tagsinput.js"></script>
	<script>
	$(document).ready(function() {
            $('.firma').richText();
        });
	$("select").tagsinput('items');
	    function previewImage(entrada, salida) {
            var reader = new FileReader();
            reader.readAsDataURL(document.getElementById(entrada).files[0]);
            reader.onload = function(e) {
                document.getElementById(salida).src = e.target.result;
            };
            
            $.ajax({
                url: '../user/perfil.php',
                type: 'post',
                data: new FormData($('#'+entrada+'form')[0]),
                contentType: false,
                cache: false,
                processData: false,
                success: function(dato) {
                    let data = JSON.parse(dato);
                    console.log(dato);
                    
                    swal({
                      title: "Subida de imagen!",
                      text: data.msj,
                      icon: data.icon,
                      button: "Aceptar",
                    });
                }
            });
            
        }
        function copyToClipboard() {
            var textBox = document.getElementById("hast");
            textBox.select();
            document.execCommand("copy");
        }
        function redsocial(input, red){
            let redwp = $('#'+input).val();

            $.ajax({
                url: '../user/perfil.php',
                type: 'post',
                data: {red:redwp,db:red},
                success: function(dato) {
                    let data = JSON.parse(dato);
                    $('#'+input+'text').text(redwp);
                    $('#'+input+'cancelar').click();
                    swal({
                      title: "Red social "+red+"!",
                      text: data.msj,
                      icon: data.icon,
                      button: "Aceptar",
                    });
                }
            });
        }
        $("#footeredi").click(()=>{
            $("#formfootertext").css("display","none")
            $("#formfooter").css("display","block")
        })
        $("#firmaedi").click(()=>{
            $("#formfirmahtml").css("display","none")
            $("#formfirma").css("display","block")
        })
        $("#fbedi").click(()=>{
            $("#formfbtext").css("display","none")
            $("#formfb").css("display","block")
        })
        $("#fbcancelar").click(()=>{
            $("#formfbtext").css("display","block")
            $("#formfb").css("display","none")
        })
        $("#fbguardar").click(()=>{
            redsocial('fb', 'Facebook');
        });
        $("#mgedi").click(()=>{
            $("#formmgtext").css("display","none")
            $("#formmg").css("display","block")
        })
        $("#mgcancelar").click(()=>{
            $("#formmgtext").css("display","block")
            $("#formmg").css("display","none")
        })
        $("#mgguardar").click(()=>{
            redsocial('mg', 'Messenger');
        });
        $("#twedi").click(()=>{
            $("#formtwtext").css("display","none")
            $("#formtw").css("display","block")
        })
        $("#twcancelar").click(()=>{
            $("#formtwtext").css("display","block")
            $("#formtw").css("display","none")
        })
        $("#twguardar").click(()=>{
            redsocial('tw', 'Twitter');
        });
        $("#igedi").click(()=>{
            $("#formigtext").css("display","none")
            $("#formig").css("display","block")
        })
        $("#igcancelar").click(()=>{
            $("#formigtext").css("display","block")
            $("#formig").css("display","none")
        })
        $("#igguardar").click(()=>{
            redsocial('ig', 'Instagram');
        });
        $("#ybedi").click(()=>{
            $("#formybtext").css("display","none")
            $("#formyb").css("display","block")
        })
        $("#ybcancelar").click(()=>{
            $("#formybtext").css("display","block")
            $("#formyb").css("display","none")
        })
        $("#ybguardar").click(()=>{
            redsocial('yb', 'Youtube');
        });
        $("#wpedi").click(()=>{
            $("#formwptext").css("display","none")
            $("#formwp").css("display","block")
        })
        $("#wpcancelar").click(()=>{
            $("#formwptext").css("display","block")
            $("#formwp").css("display","none")
        })
        $("#wpguardar").click(()=>{
            redsocial('wp', 'Whatsapp');
        });
        $("#servidor").on('change',()=>{
            $("#btnservi").css("display","block")
            
        })
        $("#btnservi").click(()=>{
            let servi = $("#servidor").val();
            $.ajax({
                url: '../user/perfil.php',
                type: 'post',
                data: {servi},
                success: function(dato) {
                    let data = JSON.parse(dato);
                    console.log(dato);
                    
                    swal({
                      title: "Servidores!",
                      text: data.msj,
                      icon: data.icon,
                      button: "Aceptar",
                    });
                }
            });
        })
        $("#footercancelar").click(()=>{
            $("#formfootertext").css("display","block")
            $("#formfooter").css("display","none")
        })
        $("#footerguardar").click(()=>{
            let textf = $('#txfooter').val(), web = $('#web').val();
            $.ajax({
                url: '../user/perfil.php',
                type: 'post',
                data: {text_footer:textf,web:web},
                success: function(dato) {
                    let data = JSON.parse(dato);
                    console.log(dato);
                    
                    swal({
                      title: "Texto del Footer y url web!",
                      text: data.msj,
                      icon: data.icon,
                      button: "Aceptar",
                    });
                }
            });
        });
        $("#firmacancelar").click(()=>{
            $("#formfirmahtml").css("display","block")
            $("#formfirma").css("display","none")
        })
        $("#firmaguardar").click(()=>{
            let firma = $('#firma').val();
            $.ajax({
                url: '../user/perfil.php',
                type: 'post',
                data: {firma},
                success: function(dato) {
                    let data = JSON.parse(dato);
                    console.log(dato);
                    
                    swal({
                      title: "Firma del correo!",
                      text: data.msj,
                      icon: data.icon,
                      button: "Aceptar",
                    });
                }
            });
        });
        $('#btn-passedi').click(()=>{
            if($('#btn-passedi').html()=='<i class="glyphicon glyphicon-eye-close"></i> Ocultar Formulario'){
                $('#ifpassedi').val(false);
                $('#formpassedi').css('display','none');
                $('#btn-passedi').html('<i class="glyphicon glyphicon-lock"></i> Cambiar Password');
            }else{
                $('#ifpassedi').val(true);
                $('#formpassedi').css('display','block');
                $('#btn-passedi').html('<i class="glyphicon glyphicon-eye-close"></i> Ocultar Formulario');
            }
        });
        
        $("#btn-passedisave").click(()=>{
            let pass = $('#passredi').val(), con_pass = $('#con_passredi').val();
            $.ajax({
                url: '../user/perfil.php',
                type: 'post',
                data: {pass,con_pass},
                success: function(dato) {
                    let data = JSON.parse(dato);
                    console.log(dato);
                    
                    swal({
                      title: "Password!",
                      text: data.msj,
                      icon: data.icon,
                      button: "Aceptar",
                    });
                }
            });
        });
	</script>
 <script>
	    $('#perfilactiv').addClass("active");
    </script>
</body>

</html>