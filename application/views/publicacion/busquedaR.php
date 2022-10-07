<main class="main">
        <div class="container">
            <div class="grid-resultado">
                <div class="cont-info">            
                    <div class="info">
                        <?php 
                        if(isset($busqueda)){?>
                        <p>Se han encontrado<span><?=$cantidad_resultado?> Resultado(s)</span></p>
                        <?php }else{?>
                            <p><span></span></p>
                        <?php } ?>
                    </div>
                    <div class="result-info-btn">
                        <div class="result-busqueda">
                            <?php
                            if ($this->session->userdata("buscar_palabra")) {
                                echo   "<p>Búsquedas relacionadas: <span>".$this->session->userdata("buscar_palabra")."</span></p>";
                            }
                            ?>
                            <?php
                            if(isset($categorias) and $categorias!=""){
                                foreach ($categorias as $key => $categoria) {
                                    if($categoria->id_categoria == $this->session->userdata('categoria')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($categoria->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(1)"></i></span>';
                                    }
                                }
                            }                        
                            if(isset($estados) and $estados!=""){
                                foreach ($estados as $key => $estado) {
                                    if($estado->codigoestado == $this->session->userdata('estado')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($estado->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(2)"></i></span>';
                                    }
                                }
                            }
                            if(isset($municipios) and $municipios!=""){
                                foreach ($municipios as $key => $municipio) {
                                    if($municipio->codigomunicipio == $this->session->userdata('municipio')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($municipio->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(3)"></i></span>';
                                    }
                                }
                            }
                            if(isset($parroquias) and $parroquias!=""){
                                foreach ($parroquias as $key => $parroquia) {
                                    if($parroquia->codigoparroquia == $this->session->userdata('parroquia')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($parroquia->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(4)"></i></span>';
                                    }
                                }
                            }
                            if(isset($modelos) and $modelos!=""){
                                foreach ($modelos as $key => $modelo) {
                                    if($modelo->id_modelo == $this->session->userdata('modelo')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($modelo->modelo)).'<i class="fas fa-times" onclick="limpiarFiltro(7)"></i></span>';
                                    }
                                }
                            }
                            if(isset($marcas) and $marcas!=""){
                                foreach ($marcas as $key => $marca) {
                                    if($marca->id_marca == $this->session->userdata('marca')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($marca->marca)).'<i class="fas fa-times" onclick="limpiarFiltro(6)"></i></span>';
                                    }
                                }
                            }
                            if($this->session->userdata('anio')){
                                echo '<span class="label-filtro">'.$this->session->userdata("anio").'<i class="fas fa-times" onclick="limpiarFiltro(8)"></i></span>';
                            }
                            if($this->session->userdata('precio')){
                                echo '<span class="label-filtro">'.$this->session->userdata("precio").' $<i class="fas fa-times" onclick="limpiarFiltro(9)"></i></span>';
                            }
                            if($this->session->userdata('km')){
                                echo '<span class="label-filtro">'.$this->session->userdata("km").' km<i class="fas fa-times" onclick="limpiarFiltro(10)"></i></span>';
                            }
                            
                        ?>                            
                        </div>                
                        <div class="info-btn">
                            <button class="button-filtre" id="button-filtre"><i class="fa fa-grip-horizontal"></i></button>
                            <!---caret-right  caret-down  cog heart sistrix whatsapp fontawesome-->
                            <button class="button-filtre button-filtre2" id="button-filtre2"><i class="fas fa-filter"></i></button>
                        </div>

                    </div>
                    <div class="pagination-container">
                            <?php 
                                
                            if(!empty($this->pagination->create_links())){
                                $limitePagina= $this->pagination->per_page;
                            $totalPaginas = round($cantidad_resultado/$limitePagina);
                            $actualPagina = $this->pagination->cur_page;
                            if($actualPagina==1){
                                    echo "<div class='short_count_close_open'>&nbsp;</div>";
                                }
                                echo $this->pagination->create_links();
                                echo "<div class='short_count normal-hide'>". $actualPagina." de ".$totalPaginas."</div>";
                                if($totalPaginas==$actualPagina){
                                    echo "<div class='short_count_close'>&nbsp;</div>";
                                }
                            }
                            ?>
                        </div><!--pagination-container-->
                </div><!--cont-info-->
                


                <div class="cont-menu-lateral">
                    <div class="div-filtros" id="div-filtros">
                        <button class="btn btn-yellow">Filtros</button>
                    </div>
                    <div class="menu-lateral" id="menu-lateral">
                    <div class="cont-filtros-busqueda">


                        </div>

                        <?php if(!$this->session->userdata("estado")){?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Estado<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($estados) and $estados!=""){
                                    foreach ($estados as $key => $estado) {
                                        echo '<li><a href="'.base_url().'buscar?estado='.$estado->codigoestado.'">'.ucwords(strtolower($estado->nombre)).'</a></li>';
                                    }
                                }else{
                                        echo '<li><a href="#">Sin opciones</a></li>';
                                    } 
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata("estado") && !$this->session->userdata("municipio")){?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Municipio<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($municipios) and $municipios!=""){
                                    foreach ($municipios as $key => $municipio) {
                                        echo '<li><a href="'.base_url().'buscar?municipio='.$municipio->codigomunicipio.'">'.ucwords(strtolower($municipio->nombre)).'</a></li>';
                                    }
                                }else{
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata("estado") && $this->session->userdata("municipio") && !$this->session->userdata("parroquia")){?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Parroquia<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($parroquias) and $parroquias!=""){
                                    foreach ($parroquias as $key => $parroquia) {
                                        echo '<li><a href="'.base_url().'buscar?parroquia='.$parroquia->codigoparroquia.'">'.ucwords(strtolower($parroquia->nombre)).'</a></li>';
                                    }
                                }else{
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if(!$this->session->userdata("categoria")){?>
                        <div class="select-categoria">
                            <h3>Tipo de vehículo<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($categorias) and $categorias!=""){
                                    foreach ($categorias as $key => $categoria) {
                                        echo '<li><a href="'.base_url().'buscar?categoria='.$categoria->id_categoria.'">'.ucwords(strtolower($categoria->nombre)).'</a></li>';
                                    }
                                }else{
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }    
                                ?>
                            </ul>
                        </div>
                        <?php } ?> 

                        <?php if(!$this->session->userdata("marca")){?>    
                        <div class="select-marca">
                            <h3>Marca<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                    if(isset($marcas) and $marcas!=""){
                                        foreach ($marcas as $key => $marca) {
                                            echo '<li><a href="'.base_url().'buscar?marca='.$marca->id_marca.'">'.ucwords(strtolower($marca->marca)).'</a></li>';
                                        }
                                    }else{
                                        echo '<li><a href="#">Sin opciones</a></li>';
                                    }
                                ?>
                            </ul>                    
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata("marca")){?> 
                            <?php if(!$this->session->userdata("modelo")){?> 
                            <div class="select-modelo">
                                <h3>Modelo<i class="fa fa-caret-down"></i></h3>
                                <ul>
                                <?php
                                    if(isset($modelos) and $modelos!=""){
                                        foreach ($modelos as $key => $modelo) {
                                            echo '<li><a href="'.base_url().'buscar?modelo='.$modelo->id_modelo.'">'.ucwords(strtolower($modelo->modelo)).'</a></li>';
                                        }
                                    }else{
                                        echo '<li><a href="#">Sin opciones</a></li>';
                                    } 
                                    ?>
                                </ul>                    
                            </div>
                            <?php }} ?>
                        <?php if(!$this->session->userdata("anio")){?> 
                        <div class="select-anio">
                            <h3>Año<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($anio) and $anio!=""){
                                    foreach ($anio as $key => $ano) { 
                                        echo "<li><a href='".base_url()."buscar?anio=".$ano->id_ano."'>".$ano->id_ano."</a></li>";
                                    }
                                }
                                ?>
                                
                            </ul>                    
                        </div>
                        <?php } ?>
                        <div class="select-precio">
                            <h3>Precio<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <!-- <li><a href="<?php echo base_url().'buscar?precio='.'_500'?>">Hasta $500</a></li> -->
                                <li><a href="<?php echo base_url().'buscar?precio='.'_2000'?>">Hasta $2000</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'_5000'?>">Hasta $5000</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'5000_15000'?>">$5000 a $15.000</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'15000_'?>">Más de $15.000</a></li>
                            </ul>                     
                        </div>
                        <!--
                        <div class="select-vendedor">
                            <h3>Vendedor<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <li><a href="">Autolavados</a></li>
                                <li><a href="">Consecionarios</a></li>
                                <li><a href="">Certificados BF</a></li>
                                <li><a href="">Particulares</a></li>
                            </ul>                      
                        </div>
                        -->
                        <div class="select-kilometros">
                            <h3>kilometraje<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <!-- <li><a href="<?php echo base_url().'buscar?km='.'_0_'?>">Cero Km</a></li> -->
                                <li><a href="<?php echo base_url().'buscar?km='.'_100000'?>">Hasta 100 mil km</a></li>
                                <li><a href="<?php echo base_url().'buscar?km='.'100000_200000'?>">Entre 100 mil y 200 mil km</a></li>
                                <li><a href="<?php echo base_url().'buscar?km='.'200000_'?>">Más de 200 mil km</a></li>
                            </ul>                     
                        </div>
                        <!--
                        <div class="select-blindado">
                            <h3>Blindaje<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <li><a href="">Ninguno</a></li>
                                <li><a href="">Nivel 1</a></li>
                                <li><a href="">Nivel 2</a></li>
                                <li><a href="">Nivel 3</a></li>
                                <li><a href="">Nivel 4</a></li>
                                <li><a href="">Nivel 5</a></li>
                            </ul> 
                        </div>
                        -->
                    </div>
                </div>
                
                <div class="cont-cards">
        
                    <div class="cards" id="cards">
                        <?php
                        if(isset($busqueda)){
                        foreach ($busqueda as $key => $busque) {
                        ?>
                            <div class="grid">

                                <div class="title-area">
                                    <!--<div class="category-title">
                                        <span class="padding_cats"><a href=""><?= mb_strtoupper($busque->marca)?></a></span>
                                        <span class="padding_cats"><a href=""><?= mb_strtoupper($busque->modelo)?></a></span>
                                    </div>-->
                                    <h3><a href=""><?= $busque->id_ano.' '.ucwords(strtolower($busque->modelo)).' '.mb_strtoupper($busque->marca) ?></a></h3>
                                    <p class="location"><i class="fa fa-map-marker-alt"></i><a href=""><?=mb_strtoupper($busque->parroquia)?></a>, <a href=""><?=mb_strtoupper($busque->estado)?></a></p>
                                </div>


                                <div class="image" onclick="cargarVista('<?php echo base_url(); ?>detallepublicacion/<?php echo $busque->id_publicacion; ?>')">
                                    <a href="<?php echo base_url();?>detallepublicacion/<?php echo $busque->id_publicacion; ?>">
                                        <img loading="lazy" src="<?php echo base_url()."publicaciones/".trim($busque->codigo)."/".$busque->url_uno;?>" alt="<?php echo $busque->modelo;?>" class="img-responsive">
                                    </a>
                                    <div class="price-tag">
                                        <div class="price"><span class="precio">$<?=mb_strtoupper($busque->precio_dol)?></span><span class="nego"></span></div>
                                    </div>
                                </div>

                                <div class="short-description">
                                    <ul class="list-unstyled">
                                        <li><i class="fas fa-tachometer-alt"></i><?php echo $busque->recorrido; ?> km</li>
                                        <li><i class="fas fa-calendar-alt"></i><?php echo $busque->id_ano; ?></li>
                                        <?php if($busque->transmision!=""){?><li><i class="fas fa-cogs"></i><?php echo $busque->transmision; ?></li><?php } ?>    
                                        <li><i class="far fa-handshake"></i>Negociable: <?php echo ucwords(strtolower($busque->negociable));?></li>
                                    </ul>
                                </div>

                            </div><!--grid-->
                            
                     <?php } 
                            }else{ 
                                echo "<p>".$mensaje."</p>";
                            }?>
                    </div><!--cards-->

                        <div class="pagination-container">
                            <?php 
                                
                            if(!empty($this->pagination->create_links())){
                                $limitePagina= $this->pagination->per_page;
                            $totalPaginas = round($cantidad_resultado/$limitePagina);
                            $actualPagina = $this->pagination->cur_page;
                            if($actualPagina==1){
                                    echo "<div class='short_count_close_open'>&nbsp;</div>";
                                }
                                echo $this->pagination->create_links();
                                echo "<div class='short_count normal-hide'>". $actualPagina." de ".$totalPaginas."</div>";
                                if($totalPaginas==$actualPagina){
                                    echo "<div class='short_count_close'>&nbsp;</div>";
                                }
                            }
                            ?>
                        </div><!--pagination-container-->



                </div><!--cont-cards-->
            </div><!--grid-resultado-->

        </div><!--container-->
    </main>
    <div class="modal3" id="modal3">
    <div class="modal-container">
        <div class="modal-header">
            <div class="texto-compartir">
                <p>Tu cuenta aún no ah sido confirmada</p>
            </div>
            <div class="contenedor-botton">
                <button class="btn-cerrar-modal2" id="btn-cerrar-modal2">X</button>
            </div>
        </div>
        <div class="modal-iconos">
              <p>Filtro</p>
              <div class="menu-lateral active" id="menu-lateral">
                        <div class="cont-filtros-busqueda">
                        <?php
                            if(isset($categorias) and $categorias!=""){
                                foreach ($categorias as $key => $categoria) {
                                    if($categoria->id_categoria == $this->session->userdata('categoria')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($categoria->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(1)"></i></span>';
                                    }
                                }
                            }                        
                            if(isset($estados) and $estados!=""){
                                foreach ($estados as $key => $estado) {
                                    if($estado->codigoestado == $this->session->userdata('estado')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($estado->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(2)"></i></span>';
                                    }
                                }
                            }
                            if(isset($municipios) and $municipios!=""){
                                foreach ($municipios as $key => $municipio) {
                                    if($municipio->codigomunicipio == $this->session->userdata('municipio')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($municipio->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(3)"></i></span>';
                                    }
                                }
                            }
                            if(isset($parroquias) and $parroquias!=""){
                                foreach ($parroquias as $key => $parroquia) {
                                    if($parroquia->codigoparroquia == $this->session->userdata('parroquia')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($parroquia->nombre)).'<i class="fas fa-times" onclick="limpiarFiltro(4)"></i></span>';
                                    }
                                }
                            }
                            if(isset($modelos) and $modelos!=""){
                                foreach ($modelos as $key => $modelo) {
                                    if($modelo->id_modelo == $this->session->userdata('modelo')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($modelo->modelo)).'<i class="fas fa-times" onclick="limpiarFiltro(7)"></i></span>';
                                    }
                                }
                            }
                            if(isset($marcas) and $marcas!=""){
                                foreach ($marcas as $key => $marca) {
                                    if($marca->id_marca == $this->session->userdata('marca')){
                                        echo '<span class="label-filtro">'.ucwords(strtolower($marca->marca)).'<i class="fas fa-times" onclick="limpiarFiltro(6)"></i></span>';
                                    }
                                }
                            }
                            if($this->session->userdata('anio')){
                                echo '<span class="label-filtro">'.$this->session->userdata("anio").'<i class="fas fa-times" onclick="limpiarFiltro(8)"></i></span>';
                            }
                            if($this->session->userdata('precio')){
                                echo '<span class="label-filtro">'.$this->session->userdata("precio").' $<i class="fas fa-times" onclick="limpiarFiltro(9)"></i></span>';
                            }
                            if($this->session->userdata('km')){
                                echo '<span class="label-filtro">'.$this->session->userdata("km").' km<i class="fas fa-times" onclick="limpiarFiltro(10)"></i></span>';
                            }
                            
                        ?>

                        </div>

                        <?php if(!$this->session->userdata("estado")){?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Estado<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($estados) and $estados!=""){
                                    foreach ($estados as $key => $estado) {
                                        echo '<li><a href="'.base_url().'buscar?estado='.$estado->codigoestado.'">'.ucwords(strtolower($estado->nombre)).'</a></li>';
                                    }
                                }else{
                                        echo '<li><a href="#">Sin opciones</a></li>';
                                    } 
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata("estado") && !$this->session->userdata("municipio")){?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Municipio<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($municipios) and $municipios!=""){
                                    foreach ($municipios as $key => $municipio) {
                                        echo '<li><a href="'.base_url().'buscar?municipio='.$municipio->codigomunicipio.'">'.ucwords(strtolower($municipio->nombre)).'</a></li>';
                                    }
                                }else{
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata("estado") && $this->session->userdata("municipio") && !$this->session->userdata("parroquia")){?>
                        <div class="select-ubicacion">
                            <h3>Ubicación Parroquia<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($parroquias) and $parroquias!=""){
                                    foreach ($parroquias as $key => $parroquia) {
                                        echo '<li><a href="'.base_url().'buscar?parroquia='.$parroquia->codigoparroquia.'">'.ucwords(strtolower($parroquia->nombre)).'</a></li>';
                                    }
                                }else{
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }
                                ?>
                            </ul>
                        </div>
                        <?php } ?>

                        <?php if(!$this->session->userdata("categoria")){?>
                        <div class="select-categoria">
                            <h3>Vehiculo<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($categorias) and $categorias!=""){
                                    foreach ($categorias as $key => $categoria) {
                                        echo '<li><a href="'.base_url().'buscar?categoria='.$categoria->id_categoria.'">'.ucwords(strtolower($categoria->nombre)).'</a></li>';
                                    }
                                }else{
                                    echo '<li><a href="#">Sin opciones</a></li>';
                                }    
                                ?>
                            </ul>
                        </div>
                        <?php } ?> 

                        <?php if(!$this->session->userdata("marca")){?>    
                        <div class="select-marca">
                            <h3>Marca<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                    if(isset($marcas) and $marcas!=""){
                                        foreach ($marcas as $key => $marca) {
                                            echo '<li><a href="'.base_url().'buscar?marca='.$marca->id_marca.'">'.ucwords(strtolower($marca->marca)).'</a></li>';
                                        }
                                    }else{
                                        echo '<li><a href="#">Sin opciones</a></li>';
                                    }
                                ?>
                            </ul>                    
                        </div>
                        <?php } ?>

                        <?php if($this->session->userdata("marca")){?> 
                            <?php if(!$this->session->userdata("modelo")){?> 
                            <div class="select-modelo">
                                <h3>Modelo<i class="fa fa-caret-down"></i></h3>
                                <ul>
                                <?php
                                    if(isset($modelos) and $modelos!=""){
                                        foreach ($modelos as $key => $modelo) {
                                            echo '<li><a href="'.base_url().'buscar?modelo='.$modelo->id_modelo.'">'.ucwords(strtolower($modelo->modelo)).'</a></li>';
                                        }
                                    }else{
                                        echo '<li><a href="#">Sin opciones</a></li>';
                                    } 
                                    ?>
                                </ul>                    
                            </div>
                            <?php }} ?>
                        <?php if(!$this->session->userdata("anio")){?> 
                        <div class="select-anio">
                            <h3>Año<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <?php
                                if(isset($anio) and $anio!=""){
                                    foreach ($anio as $key => $ano) { 
                                        echo "<li><a href='".base_url()."buscar?anio=".$ano->id_ano."'>".$ano->id_ano."</a></li>";
                                    }
                                }
                                ?>
                                
                            </ul>                    
                        </div>
                        <?php } ?>
                        <div class="select-precio">
                            <h3>Precio<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <li><a href="<?php echo base_url().'buscar?precio='.'_500'?>">Hasta $500</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'_1000'?>">Hasta $1000</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'_3000'?>">Hasta $3000</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'5000_15000'?>">$5000 a $15.000</a></li>
                                <li><a href="<?php echo base_url().'buscar?precio='.'15000_'?>">Más de $15.000</a></li>
                            </ul>                     
                        </div>
                        <!--
                        <div class="select-vendedor">
                            <h3>Vendedor<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <li><a href="">Autolavados</a></li>
                                <li><a href="">Consecionarios</a></li>
                                <li><a href="">Certificados BF</a></li>
                                <li><a href="">Particulares</a></li>
                            </ul>                      
                        </div>
                        -->
                        <div class="select-kilometros">
                            <h3>Kilómetros<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <li><a href="<?php echo base_url().'buscar?km='.'_0_'?>">Cero Km</a></li>
                                <li><a href="<?php echo base_url().'buscar?km='.'_50000'?>">Hasta 50.000km</a></li>
                                <li><a href="<?php echo base_url().'buscar?km='.'_100000'?>">Hasta 100.000km</a></li>
                                <li><a href="<?php echo base_url().'buscar?km='.'_200000'?>">Hasta 200.000km</a></li>
                            </ul>                     
                        </div>
                        <!--
                        <div class="select-blindado">
                            <h3>Blindaje<i class="fa fa-caret-down"></i></h3>
                            <ul>
                                <li><a href="">Ninguno</a></li>
                                <li><a href="">Nivel 1</a></li>
                                <li><a href="">Nivel 2</a></li>
                                <li><a href="">Nivel 3</a></li>
                                <li><a href="">Nivel 4</a></li>
                                <li><a href="">Nivel 5</a></li>
                            </ul> 
                        </div>
                        -->
                    </div>             
              
        </div>
    </div>
</div>
    <?php $this->view('layouts/footerR'); ?>
    <script type="text/javascript"> var base_url = "<?php echo base_url();?>";</script>
    <script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
    <script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
    <script src="<?php echo base_url(); ?>asset/js/headroom.js"></script>    
<script>
        let buttonFiltre2 = document.querySelector('#button-filtre2'),
        btnCerrarModal2 = document.getElementById('btn-cerrar-modal2'),
        menuLateral = document.querySelector('.menu-lateral');

        buttonFiltre = document.getElementById('button-filtre'),
	  esDispositivoMovil = () => window.innerWidth <= 970;
 
        buttonFiltre2.addEventListener('click', (e) => {
            console.log(menuLateral);
            menuLateral.classList.toggle('active');
          }); 
/*           btnCerrarModal2.addEventListener('click',(e) => {
              modal3.classList.remove('active');
          });  */ 
          

          


buttonFiltre.addEventListener('click', () => {
        if(window.innerWidth <= 600){
            cards.classList.remove('columns4');
            cards.classList.toggle('columns2');
        }else{
            cards.classList.remove('columns2');
            cards.classList.toggle('columns4');
        }
        
    });


function limpiarFiltro(control){
    window.location.href = base_url+'limpiarfiltro/'+control;
}
</script>
<script src="<?php echo base_url(); ?>asset/js/menu.js"></script>
</body>
</html>