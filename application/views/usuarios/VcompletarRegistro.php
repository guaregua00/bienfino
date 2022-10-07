<div class="contenedor2">

    <?php if(isset($mensaje)){ ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger"> <?php echo $mensaje; ?></div>
        </div>
    </div>
    <?php }?>
    <?php if($this->session->flashdata('mensaje')){ ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger"> <?php echo $this->session->flashdata('mensaje'); ?></div>
        </div>
    </div>
    <br>
    <?php }?>
    <?php if($this->session->flashdata('mensaje2')){ ?>
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success"> <?php echo $this->session->flashdata('mensaje2'); ?></div>
        </div>
    </div>
    <?php }?>

    <form id="completar" action="<?php echo base_url();?>Cusuarios/completarRegistro" method="POST">


        <div class="flex-col">
            <div class="titulo-descripcion">
                <label>Completa los Datos</label>
                <span>para poder disfrutar de todos nuestros servicios </span>
            </div>
            <div class="flex-col">
                <div class="titulo-descripcion">
                    <label>Datos Personales</label>
                </div>
            </div>
        </div>
        <!--flex-col-->

        <div class="flex-row">
            <div class="group-text-field">
                <label for="nac">Nacionalidad<span style="color: red"> *</span></label>
                <select name="nac" id="nac" class="input-form">
                    <option value="V">Venezolan@</option>
                    <option value="E">Extranjer@</option>
                </select>
            </div>
            <div class="group-text-field">
                <label for="cedula">Documento Identidad<span style="color: red"> *</span></label>
                <input type="text" id="cedula" name="cedula" maxlength="8" placeholder="" class="input-form"
                    value="<?php echo set_value('cedula');?>">
                <?php echo form_error('cedula');?>
            </div>
        </div>
        <div class="flex-row">
            <div class="group-text-field">
                <label for="nombres">Nombres<span style="color: red"> *</span></label>
                <input type="text" placeholder="" name="nombres" class="input-form" maxlength="100"
                    value="<?php echo set_value('nombres');?>">
                <?php echo form_error('nombres');?>
            </div>
            <div class="group-text-field">
                <label for="apellidos">Apellidos<span style="color: red"> *</span></label>
                <input type="text" placeholder="" name="apellidos" class="input-form" maxlength="100"
                    value="<?php echo set_value('apellidos');?>">
                <?php echo form_error('apellidos');?>
            </div>
        </div>
        <div class="flex-row">
            <div class="group-text-field">
                <label for="moviluno">Movil Uno <span class="red">*</span></label>
                <input type="tel" class="input-form" id="moviluno" name="moviluno" maxlength="11"
                    placeholder="Telf Movil" value="<?php echo form_error('moviluno');?>">
                <span class="help-block">Ejemplo: 04141234567</span>
            </div>


            <div class="group-text-field">
                <label for="movildos">Movil Dos</label>
                <input type="tel" class="input-form" id="movildos" name="movildos" maxlength="11"
                    placeholder="Telf Movil" value="<?php echo form_error('movildos');?>">
                <?php echo form_error('movildos');?>
            </div>
        </div>

        <div class="flex-col">
            <div class="titulo-descripcion">
                <label>Datos de Ubicación</label>
                <span></span>
            </div>
        </div>

        <div class="flex-row">

            <div class="group-text-field">
                <label>Estado <span class="red">*</span></label>
                <div class="form-select bienfino-select">
                    <select class="input-form" name="codigoestado" id="codigoestado">
                        <option selected="selected" value="">Seleccione un estado</option>
                        <?php
                  foreach ($estados as $value) {
                    ?>
                        <option value="<?php echo $value->codigoestado; ?>"><?php echo ucwords($value->nombre); ?>
                        </option>
                        <?php 
                   }
                  ?>
                    </select>
                </div>
                <?php echo form_error('codigoestado');?>

            </div>


            <div class="group-text-field">
                <label>Municipio <span class="red">*</span></label>
                <div class="form-select bienfino-select">
                    <select class="input-form" name="codigomunicipio" id="codigomunicipio">
                        <option value="">Seleccione un municipio</option>
                    </select>
                </div>
                <?php echo form_error('codigomunicipio');?>
            </div>

            <div class="group-text-field">
                <label>Parroquia <span class="red">*</span></label>
                <div class="form-select bienfino-select">
                    <select class="input-form" name="codigoparroquia" id="codigoparroquia">
                        <option value="">Seleccione una parroquia</option>
                    </select>
                </div>
                <?php echo form_error('codigoparroquia');?>
            </div>

            <div class="group-text-field">
                <label>Direccion Especifica <span class="red">*</span></label>
                <textarea class="input-form" rows="3" maxlength="255" id="direccion_esp"
                    name="direccion_esp"></textarea>
                <?php echo form_error('direccion_esp');?>
            </div>
        </div>

        <div class="flex-col">
            <div class="titulo-descripcion">
                <label>Datos de tu Vehículo</label>
                <span>Agrega tu vehículo</span>
            </div>
        </div>

        <div class="flex-row">
            <div class="group-text-field">
                <label for="nombres">Marca</label>
                <input type="text" placeholder="" name="marca" class="input-form" maxlength="100"
                    value="<?php echo set_value('marca');?>">
                <?php echo form_error('marca');?>
            </div>
            <div class="group-text-field">
                <label for="apellidos">Modelo</label>
                <input type="text" placeholder="" name="modelo" class="input-form" maxlength="100"
                    value="<?php echo set_value('modelo');?>">
                <?php echo form_error('modelo');?>
            </div>

            <div class="group-text-field">
                      <label>Año:</label>
                      <div class="form-select bienfino-select">
                      <select  class="input-form" name="id_ano" id="id_ano">
                        <option value="">Debe seleccionar un Año</option>
                        <?php 
                        for ($anio = date('Y'); $anio >= 1900 ; $anio--) {
                            echo '<option value="'.$anio.'">'.$anio.'</option>';
                        }
                        ?>
                      </select>
                      </div>
              </div>

        </div>



        <div class="flex-row">
            <div class="group-text-field">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>" />
                <button type="submit" id="boton_completar" class="btn btn-info btn-mini">Completar Registro</button>
            </div>
        </div>

</div>

</form>

</div>
<!--contenedor-->
<?php
  $this->view('layouts/footerR');
?>

<script type="text/javascript">
var base_url = "<?php echo base_url();?>";
</script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/jquery.min.js"> </script>
<script type="text/javascript" src="<?php echo base_url();?>Bienfino-master/js/bienfino.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?php echo base_url();?>plugins/jquery-validation/localization/messages_es.js"></script>
<script src="<?php echo base_url();?>js/validaciones/completar.js"></script>
<script src="<?php echo base_url();?>js/menu_filtros.js"></script>
<script src="<?php echo base_url();?>js/geo.js"></script>

<script>
//formulario
$(".categoria").click(function() {
    buscarMarca();
});

$("#id_marca").change(function() {
    buscarModelo();
});
$("#id_modelo").change(function() {
    buscarAno();
});

$("#codigoestado").change(function() {
    buscarMunicipios2();
});
$("#codigomunicipio").change(function() {
    buscarParroquia();
});
</script>
<script>
//menu
$("#categoria_menu").change(function() {
    buscarMarcaMenu();
});

$("#marca_menu").change(function() {
    buscarModeloMenu();
});
</script>
<script>
const btnDepartamentos = document.getElementById('btn-departamentos'),
    btnCerrarMenu = document.getElementById('btn-menu-cerrar'),
    grid = document.getElementById('grid'),
    contenedorEnlacesNav = document.querySelector('#menu .contenedor-enlaces-nav'),
    contenedorSubCategorias = document.querySelector('#grid .contenedor-subcategorias'),

    buttonFiltre = document.getElementById('button-filtre'),
    esDispositivoMovil = () => window.innerWidth <= 970;

btnDepartamentos.addEventListener('mouseover', () => {
    if (!esDispositivoMovil()) {
        grid.classList.add('activo');
    }
});

grid.addEventListener('mouseleave', () => {
    if (!esDispositivoMovil()) {
        grid.classList.remove('activo');
    }
});

document.querySelectorAll('#menu .categorias a').forEach((elemento) => {
    elemento.addEventListener('mouseenter', (e) => {
        if (!esDispositivoMovil()) {
            document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
                categoria.classList.remove('activo');
                if (categoria.dataset.categoria == e.target.dataset.categoria) {
                    categoria.classList.add('activo');
                }
            });
        };
    });
});

// EventListeners para dispositivo movil.
document.querySelector('#btn-menu-barras').addEventListener('click', (e) => {
    e.preventDefault();
    if (contenedorEnlacesNav.classList.contains('activo')) {
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
        if (esDispositivoMovil()) {
            contenedorSubCategorias.classList.add('activo');
            document.querySelectorAll('#menu .subcategoria').forEach((categoria) => {
                categoria.classList.remove('activo');
                if (categoria.dataset.categoria == e.target.dataset.categoria) {
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

btnCerrarMenu.addEventListener('click', (e) => {
    e.preventDefault();
    document.querySelectorAll('#menu .activo').forEach((elemento) => {
        elemento.classList.remove('activo');
    });
    document.querySelector('body').style.overflow = 'visible';
});

//ocultar menu

if (!esDispositivoMovil()) {
    document.querySelectorAll('.contenedor-enlaces-nav .enlaces').forEach((elem) => {
        elem.addEventListener('mouseover', () => {
            grid.classList.remove('activo');
        });
    });
}

function limpiarFiltro(control) {
    window.location.href = base_url + 'limpiarfiltro/' + control;
}
</script>


<?php $this->view('layouts/alertify'); ?>
</body>

</html>