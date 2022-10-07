<main class="main detallepublicacion">
        <div class="container">
                
                <!--Activo1, PorRevisar6, Rechazado10, Verificado11, Vendido5--> 
     <?php if($publicacion->estatus==10){?>
            <div class='mensajeDetalle btn-rojo'>
                <p>Está publicación ha sido rechazada por incumplimiento de nuestras políticas.</p>
            </div>
     <?php }?>
     <?php if($publicacion->estatus==5){?>
            <div class='mensajeDetalle btn-exito'>
                <p>Este vehiculo ya ha sido vendido.</p>
            </div>
     <?php }?>
     <?php if($publicacion->estatus==6){?>
            <div class='mensajeDetalle btn-danger'>
                <p>Está publicación esta siendo verificada para su Activación.</p>
            </div>
     <?php }?>          
            <div class="grid-detalle-auto">
                <div class="cont-detalle-auto">
                    <div class="detalle-auto">
                        <div class="btn-regresar">
                            <a href="javascript: history.go(-1)">Regresar</a>
                        </div>
                        <div class="categoria">
                            <a href="#"><?= ucwords($publicacion->categoria)?> <span>></span></a>
                            <a href="#"><?= ucwords($publicacion->marca)?> <span>></span></a>
                            <a href="#"><?= ucwords($publicacion->modelo)?></a>
                        </div>
                    </div>
                </div>
                <div class="cont-galeria-auto">
                    <div class="galeria-auto">
                        <div class="cont-miniatura-img">
                            <div class="miniauturas-imagenes">
                                <div class="miniautura-img">
                                    <img loading="lazy" data-position="1" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_uno;?>" alt="foto1">
                                </div>
                                <div class="miniautura-img">
                                    <img loading="lazy" data-position="2" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_dos;?>" alt="foto2"> 
                                </div>                           
                                <div class="miniautura-img">
                                    <img loading="lazy" data-position="3" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_tres;?>" alt="foto3"> 
                                </div>                            
                                <div class="miniautura-img">
                                    <img loading="lazy" data-position="4" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_cuatro;?>" alt="foto4"> 
                                </div>

                                <?php $img = getcwd()."/publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_cinco;
                                    if(is_file($img)){ ?>
                                    <div class="miniautura-img">
                                        <img loading="lazy" data-position="5" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_cinco;?>" alt="foto5">
                                    </div>
                                <?php } ?>

                                <?php $img = getcwd()."/publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_seis;
                                    if(is_file($img)){ ?>
                                <div class="miniautura-img">
                                    <img loading="lazy" data-position="6" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_seis;?>" alt="foto6"> 
                                </div> 
                                <?php } ?>
                            </div>                           
                        </div>
                        <div class="cont-img-principal">
                            <div class="img-principal">
                                <img loading="lazy" data-position="1" src="<?php echo base_url()."publicaciones/".trim($publicacion->codigo)."/".$publicacion->url_uno;?> " alt="principal" id="img-principal-galeria">
                            </div>

                        </div>

                    </div> 
                </div>

                <div class="cont-info-auto-principal">
                    <div class="info-auto-principal">

                        <div class="title-area">                           
                            <p class="location">
                                <i class="fa fa-map-marker-alt"></i>
                                <span class="parroquia"><?=ucwords($publicacion->parroquia)?> - </span> 
                                <span class="estado"><?=ucwords($publicacion->estado)?></span>
                            </p>
                            <!--<h3><?= $publicacion->id_ano.' '.ucwords(strtolower($publicacion->modelo)).' '.mb_strtoupper($publicacion->marca) ?></h3>-->
                            <div class="marca-modelo">
                                <span class="marca"><?= mb_strtoupper($publicacion->marca)?></span>
                                <span class="modelo"><?= mb_strtoupper($publicacion->modelo)?></span>
                            </div>
                            <h2 class="precio">$<?=mb_strtoupper($publicacion->precio_dol)?></h2>
                        </div>
                        <div class="caracteristicas">
                            <p><i class="fas fa-tachometer-alt"></i><?php echo $publicacion->recorrido; ?> km</p>
                            <p><i class="fas fa-calendar-alt"></i><?php echo $publicacion->id_ano; ?></p>
                            <p><i class="fas fa-tachometer-alt"></i>Negociable: <?php echo ucwords(strtolower($publicacion->negociable));?></p>
                            <p><i class="fas fa-tachometer-alt"></i>Vendedor: <span><?= ucwords(strtolower($publicacion->nombres)).' '.ucwords(strtolower($publicacion->apellidos)) ?></span></p>
                            <p><i class="fas fa-phone"></i>Contacto: <span> <a href="tel:+58<?=mb_strtoupper($publicacion->moviluno)?>"><?=mb_strtoupper($publicacion->moviluno)?></a></span></p>
                            <?php if(isset($publicacion->movildos) and $publicacion->movildos!=""){?>
                            <p><i class="fas fa-phone"></i>Contacto 2: <span> <a href="tel:+58<?=mb_strtoupper($publicacion->movildos)?>"><?=mb_strtoupper($publicacion->movildos)?></a></span></p>
                            <?php } ?>
                            <p><i class="fas fa-phone"></i><span>Whatsapp:</span> <a href="https://api.whatsapp.com/send?phone=58<?=mb_strtoupper($publicacion->moviluno)?>"><i class="fab fa-whatsapp"></i></a></p>
                        </div>
                        <div class="items">      
                            <span id="compartir"><i class="fas fa-share-alt"></i>Compartir</span>
                            <span id="favorito"><i class="fas fa-heart active icofavorito" id="fa-heart-favorito"></i>Favorito</span>
                        </div> 

                    </div>
                </div>

                <div class="cont-info-auto-detalle">
                    <div class="info-auto-detalle">
                        <div class="tabla-detalle">
                            <h3>Información Adicional</h3>
                            <div class="detalle">
                                <ul class="ul-detalle">
                                    <!--<li class="li-detalle"><span>Precio (Bs S)</span> <?= $publicacion->precio_bs!="" ? ucwords(strtolower($publicacion->precio_bs)) : 'no específico' ?></li>-->
                                    <li class="li-detalle"><span>Color</span> <?= $publicacion->color!="" ? ucwords(strtolower($publicacion->color)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Combustible</span> <?= $publicacion->combustible!="" ? ucwords(strtolower($publicacion->combustible)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Unico Dueño</span> <?= $publicacion->unico_dueno!="" ? ucwords(strtolower($publicacion->unico_dueno)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Dirección</span> <?= $publicacion->direccion!="" ? ucwords(strtolower($publicacion->direccion)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Estéreo</span> <?= $publicacion->estereo!="" ? ucwords(strtolower($publicacion->estereo)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Tapizado</span> <?= $publicacion->tapizado!="" ? ucwords(strtolower($publicacion->tapizado)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Transmisión</span> <?= $publicacion->transmision!="" ? ucwords(strtolower($publicacion->transmision)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Vidrios</span> <?= $publicacion->vidrios!="" ? ucwords(strtolower($publicacion->vidrios)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Motor recien reparado</span> <?= $publicacion->reparado!="" ? ucwords(strtolower($publicacion->reparado)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Tracción</span> <?= $publicacion->traccion!="" ? ucwords(strtolower($publicacion->traccion)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Cant. de puertas</span> <?= $publicacion->puertas!="" ? ucwords(strtolower($publicacion->puertas)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Condición</span> <?= $publicacion->condicion!="" ? ucwords(strtolower($publicacion->condicion)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Motor</span> <?= $publicacion->motor!="" ? ucwords(strtolower($publicacion->motor)) : 'no específico' ?></li>
                                    <li class="li-detalle"><span>Nro Cilindros</span> <?= $publicacion->nro_cilindros!="" ? ucwords(strtolower($publicacion->nro_cilindros)) : 'no específico' ?></li>
                                </ul>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="comentario-vendedor">
                    <div class="comentario-header">Comentario Vendedor</div>
                    <div class="comentario-contenido">
                        <p><?= $publicacion->comentario!="" ? ucwords(strtolower($publicacion->comentario)) : 'no específico' ?></p>
                    </div>
            </div>
        </div>
    </main>

    <?php $this->view('layouts/footerR'); ?>

    <div class="modal" id="modal">
        <div class="img-position"><p>1/2</p></div>
        <div class="imagen">
            <button id="modal-left"><!--<i class="fas caret-left">-->&#60;</i></button>
            <img loading="lazy" data-position="" src="" alt="fotomodal" id="imgmodal" class="fotomodal">
            <button id="modal-right"><!--<i class="fas caret-right">-->></button>
        </div>
        <button class="btn-cerrar-modal" id="btn-cerrar-modal">X</button>
    </div>
    <div class="modal2" id="modal2">
        <div class="modal-container">
            <div class="modal-header">
                <div class="texto-compartir">
                    <p>Compartir</p>
                </div>
                <div class="contenedor-botton">
                    <button class="btn-cerrar-modal2" id="btn-cerrar-modal2">X</button>
                </div>
            </div>
            <div class="modal-iconos">
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://bienfino.com/detallepublicacion/<?=$publicacion->id_publicacion?>&title=bienfino" class="icon icon-facebook" target="_blank"><i class="fab fa-facebook"></i></a>
                <a href="https://twitter.com/intent/tweet?Auto en Venta Bienfin&url=https://bienfino.com/detallepublicacion/<?=$publicacion->id_publicacion?>&hashtag=bienfino" class="icon icon-twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://www.instagram.com/bienfino" class="icon icon-instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://api.whatsapp.com/send?text=Auto en Venta Bienfino%20https://bienfino.com/detallepublicacion/<?=$publicacion->id_publicacion?>" class="icon icon-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
            </div>

        </div>

        
    </div>    
<!--
    <div class="social-bar">
        <a href="https://www.facebook.com/sharer/sharer.php?u=https://bienfino.com/detalleauto&title=bienfino" class="icon icon-facebook" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com/intent/tweet?textobienfino&url=https://bienfino.com/detalleauto&hashtag=bienfino" class="icon icon-twitter" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="#" class="icon icon-instagram" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://api.whatsapp.com/send?text=Bienfino%20https://google.com" class="icon icon-whatsapp" target="_blank"><i class="fab fa-whatsapp"></i></a>
    </div>
-->
    <script src="<?php echo base_url(); ?>asset/js/sharer/sharer.min.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>
    <script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
    <script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>    

<script>

    var menu = document.getElementById('menu');
    var headroom = new Headroom(menu);
    headroom.init();

    const btnDepartamentos = document.getElementById('btn-departamentos'),
	  btnCerrarMenu = document.getElementById('btn-menu-cerrar'),
	  grid = document.getElementById('grid'),
	  contenedorEnlacesNav = document.querySelector('#menu .contenedor-enlaces-nav'),
	  contenedorSubCategorias = document.querySelector('#grid .contenedor-subcategorias'),
	  esDispositivoMovil = () => window.innerWidth <= 970;


btnDepartamentos.addEventListener('mouseover', () => {
	if(!esDispositivoMovil()){
		grid.classList.add('activo');
	}
});

grid.addEventListener('mouseleave', () => {
	if(!esDispositivoMovil()){
		grid.classList.remove('activo');
	}
});

btnDepartamentos.addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.add('activo');
	btnCerrarMenu.classList.add('activo');
});

    const divFiltros = document.getElementById('div-filtros'),
    menuLateral = document.getElementById('menu-lateral'),
    buttonFiltre = document.getElementById('button-filtre'),
    cards = document.getElementById('cards'),
    faHeartFavorito = document.getElementById('fa-heart-favorito'),
    modal = document.getElementById('modal'),
    imgModal = document.getElementById('imgmodal'),
    btnCerrarModal = document.getElementById('btn-cerrar-modal'),
    btnCerrarModal2 = document.getElementById('btn-cerrar-modal2'),
    modalRight = document.getElementById('modal-right'),
    modalLeft = document.getElementById('modal-left'),
    imgPrincipalGaleria = document.getElementById('img-principal-galeria'),
    imgPosition = document.querySelector('.img-position'),
    compartir = document.querySelector('#compartir'),
    favorito = document.querySelector('#favorito');

 
    compartir.addEventListener('click', (e) => {
        modal2.classList.add('active');
    });
    favorito.addEventListener('click', (e) => {
        document.querySelector('.icofavorito').classList.toggle('active');
    });

    faHeartFavorito.addEventListener('click', () => {
        faHeartFavorito.classList.toggle('red');
    });

    //cambio miniatura a imagen principal
    document.querySelectorAll('.miniauturas-imagenes .miniautura-img img').forEach((elemento) => {
        elemento.addEventListener('mouseover', (e) => {
           clearClassMiniauturaImg();
           imgPrincipalGaleria.src = elemento.src;
           imgPrincipalGaleria.alt = elemento.alt;
           imgPrincipalGaleria.setAttribute('data-position',elemento.dataset.position);
           imgPrincipalGaleria.dataset.position = elemento.dataset.position;
           elemento.classList.add('active');
        });
    });

    //limpia la clase active de todas las miniaturas
    const clearClassMiniauturaImg = () => {
        document.querySelectorAll('.miniauturas-imagenes .miniautura-img img').forEach((elemento) => {
            elemento.classList.remove('active');
        });
    };

    
    //abre el modal al clickear una miniatura
    /*
    document.querySelectorAll('.miniauturas-imagenes .miniautura-img img').forEach((elemento) => {
        elemento.addEventListener('click', (e) => {
            modal.classList.add('active');
            imgModal.src = elemento.src;
        });
    });
    */
    

    //abre el modal al darle click sobre la imagen principal
    imgPrincipalGaleria.addEventListener('click', (e) => {
        let miniImg = document.querySelectorAll('.miniauturas-imagenes .miniautura-img img');
        imgPosition.innerHTML=imgPrincipalGaleria.dataset.position+"/"+miniImg.length;
        modal.classList.add('active');
        imgModal.src = imgPrincipalGaleria.src;
        imgModal.alt = imgPrincipalGaleria.alt;
        imgModal.setAttribute('data-position',imgPrincipalGaleria.dataset.position);
    });
    
    btnCerrarModal.addEventListener('click',(e) => {
        modal.classList.remove('active');
    });
    btnCerrarModal2.addEventListener('click',(e) => {
        modal2.classList.remove('active');
    });

    document.querySelectorAll('miniautura-img img').forEach((elemento) => {
        elemento.addEventListener('click', (e) => {
            if(esDispositivoMovil()){
                contenedorSubCategorias.classList.add('activo');
                document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
                    categoria.classList.remove('activo');
                    if(categoria.dataset.categoria == e.target.dataset.categoria){
                        categoria.classList.add('activo');
                    }
                });
            }
        });
    });


    modalLeft.addEventListener('click',(e) => {

        var p = imgModal.dataset.position;
        let miniImg = document.querySelectorAll('.miniauturas-imagenes .miniautura-img img');

        for (let i = 1; i < miniImg.length; i++) {
            if(p==miniImg[i].dataset.position){
                imgModal.src = miniImg[i-1].src;
                imgModal.alt = miniImg[i-1].alt;
                imgModal.setAttribute('data-position',miniImg[i-1].dataset.position);
                imgPosition.innerHTML= (parseInt(p) - 1)+"/"+miniImg.length;
                continue;
            }         
        }
    }); 

    modalRight.addEventListener('click',(e) => {

        var p = imgModal.dataset.position;
        let miniImg = document.querySelectorAll('.miniauturas-imagenes .miniautura-img img');

        for (let i = 0; i < miniImg.length -1 ; i++) {
            if(p==miniImg[i].dataset.position){
                imgModal.src = miniImg[i+1].src;
                imgModal.alt = miniImg[i+1].alt;
                imgModal.setAttribute('data-position',miniImg[i+1].dataset.position);
                imgPosition.innerHTML= (parseInt(p) + 1)+"/"+miniImg.length;
                continue;
            }         
        }
    });
    if(!esDispositivoMovil()){
	document.querySelectorAll('.contenedor-enlaces-nav .enlaces').forEach((elem) => {
		elem.addEventListener('mouseover',() =>{
			grid.classList.remove('activo');
		});
	});
}

document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
	elemento.addEventListener('mouseenter', (e) => {
		if(!esDispositivoMovil()){
			document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
				categoria.classList.remove('activo');
				if(categoria.dataset.categoria == e.target.dataset.categoria){
					categoria.classList.add('activo');
				}
			});
		};
	});
});

// EventListeners para dispositivo movil.
document.querySelector('#btn-menu-barras').addEventListener('click', (e) => {
	e.preventDefault();
	if(contenedorEnlacesNav.classList.contains('activo')){
		contenedorEnlacesNav.classList.remove('activo');
		document.querySelector('body').style.overflow = 'visible';
	} else {
		contenedorEnlacesNav.classList.add('activo');
		document.querySelector('body').style.overflow = 'hidden';
	}
});

// Click en boton de todos los departamentos (Para version movil).
btnDepartamentos.addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.add('activo');
	btnCerrarMenu.classList.add('activo');
});

// Boton de regresar en el menu de categorias
document.querySelector('#grid .categorias .btn-regresar').addEventListener('click', (e) => {
	e.preventDefault();
	grid.classList.remove('activo');
	btnCerrarMenu.classList.remove('activo');
});

document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
	elemento.addEventListener('click', (e) => {
		if(esDispositivoMovil()){
			contenedorSubCategorias.classList.add('activo');
			document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
				categoria.classList.remove('activo');
				if(categoria.dataset.categoria == e.target.dataset.categoria){
					categoria.classList.add('activo');
				}
			});
		}
	});
});

// Boton de regresar en el menu de categorias
document.querySelectorAll('#grid .contenedor-subcategorias .btn-regresar').forEach((boton) => {
	boton.addEventListener('click', (e) => {
		e.preventDefault();
		contenedorSubCategorias.classList.remove('activo');
	});
});

btnCerrarMenu.addEventListener('click', (e)=> {
	e.preventDefault();
	document.querySelectorAll('#menu .activo').forEach((elemento) => {
		elemento.classList.remove('activo');
	});
	document.querySelector('body').style.overflow = 'visible';
});

//ocultar menu

if(!esDispositivoMovil()){
	document.querySelectorAll('.contenedor-enlaces-nav .enlaces').forEach((elem) => {
		elem.addEventListener('mouseover',() =>{
			grid.classList.remove('activo');
		});
	});
}


</script>

</body>
</html>    