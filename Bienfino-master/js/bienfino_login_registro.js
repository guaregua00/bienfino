/**
Selector personalizado
**/
function customSelectCall(){

  var x, i, j, selElmnt, a, b, c;
  /*Eliminar selector anterior*/
  var ele1= document.getElementsByClassName("select-selected");
  for (var i = ele1.length - 1; i >= 0; i--) {
    ele1[i].remove();
  }
  /*buscando elementos con la clase "bienfino-select":*/
  x = document.getElementsByClassName("bienfino-select");
  for (i = 0; i < x.length; i++){
    selElmnt = x[i].getElementsByTagName("select")[0];
    /*Para cada elemento, crear un nuevo DIV que actuara como el elemento seleccionado:*/
  
    a = document.createElement("DIV");
    if(!selElmnt.options[selElmnt.selectedIndex].value == true)
         a.setAttribute("class", "select-selected");
    else
       a.setAttribute("class", "select-selected select-selected-by-user");
  
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  
    x[i].appendChild(a);
    /*Para cada elemento, crear un nuevo DIV que contendra la lista de opciones:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 0; j < selElmnt.length; j++) {
      /*Para cada opcion del select original,
      crear un nuevo DIV que actuara como una opcion:*/
  
      
      c = document.createElement("DIV");
      c.innerHTML = selElmnt.options[j].innerHTML;
      c.addEventListener("click", function(e) {
          /*cuando un item es clickeado, actualizar el select original,
          y el item del select:*/
          var y, i, k, s, h, sbu, sba;
          var evtcambio=false;
          s = this.parentNode.parentNode.getElementsByTagName("select")[0];
          h = this.parentNode.previousSibling;
  
          if(!(s.options[s.selectedIndex].innerHTML==this.innerHTML)){
            evtcambio=true;
          }
  
         
          for (i = 0; i < s.length; i++) {
            
            if (s.options[i].innerHTML == this.innerHTML) {
              s.selectedIndex = i;
              h.innerHTML = this.innerHTML;
              sbu = this.parentNode.parentNode.getElementsByClassName("select-selected");
              for (sba = 0; sba < sbu.length ; sba++) {
  
                var clases_cont= sbu[sba].className;
             
                
                if(!s.options[i].value == true)
                {
                  sbu[sba].classList.remove("select-selected-by-user")
                  //clases_cont.replace("select-selected-by-user","");
                 
                }
                else
                {
                  //if(!clases_cont.includes("select-selected-by-user"))
                   //clases_cont += " select-selected-by-user"; 
                    if(!sbu[sba].classList.toggle("select-selected-by-user"))
                   sbu[sba].classList.add("select-selected-by-user")
                   
                }
  
                //sbu[sba].className=clases_cont;
  
              }
             
              y = this.parentNode.getElementsByClassName("same-as-selected");
              
              for (k = 0; k < y.length; k++) {
                y[k].removeAttribute("class");
              }
              this.setAttribute("class", "same-as-selected");
              break;
            }
            
          }
          
          if(evtcambio){
             if ("createEvent" in document) {
                var evt = document.createEvent("HTMLEvents");
                evt.initEvent("change", false, true);
                s.dispatchEvent(evt);
            }
            else
                s.fireEvent("onchange");
          }
          h.click();
      });
      b.appendChild(c);
  
    }
    x[i].appendChild(b);
    
    a.addEventListener("click", function(e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
        createMapTextByFilter('selects-filter','mapa-filtro');
    });
    markAItemWhenIsSelected(selElmnt.parentNode,'same-as-selected');
  }
  
  }
  
  
  function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    for (i = 0; i < y.length; i++) {
      if (elmnt == y[i]) {
        arrNo.push(i)
      } else {
        y[i].classList.remove("select-arrow-active");
      }
    }
    for (i = 0; i < x.length; i++) {
      if (arrNo.indexOf(i)) {
        x[i].classList.add("select-hide");
      }
    }
  }
  /*if the user clicks anywhere outside the select box,
  then close all select boxes:*/
  document.addEventListener("click", closeAllSelect); 
  
  function customSelectMultipleCall(){

    var x, i, j, selElmnt, a, b, c, selectedIndex;
    /*Eliminar selector anterior*/
    var ele1= document.getElementsByClassName("select-selected-m");
    for (var i = ele1.length - 1; i >= 0; i--) {
      ele1[i].remove();
    }
    /*buscando elementos con la clase "form-select-multiple":*/
    x = document.getElementsByClassName("form-select-multiple");
    for (i = 0; i < x.length; i++){
      selElmnt = x[i].getElementsByTagName("select")[0];
      if(selElmnt.selectedIndex>=0 && selElmnt.selectedIndex!=""){
         selectedIndex=selElmnt.selectedIndex;
      }else{
         selectedIndex=0;
      }
      /*Para cada elemento, crear un nuevo DIV que actuara como el elemento seleccionado:*/
      
      a = document.createElement("DIV");
      if(!selElmnt.options[selectedIndex].value == true)
           a.setAttribute("class", "select-selected-m");
      else
         a.setAttribute("class", "select-selected-m select-selected-by-user-m");
    
      a.innerHTML = selElmnt.options[0].innerHTML;
    
      x[i].appendChild(a);
      /*Para cada elemento, crear un nuevo DIV que contendra la lista de opciones:*/
      b = document.createElement("DIV");
      b.setAttribute("class", "select-items-m select-hide-m");
      for (j = 1; j < selElmnt.length; j++){
        /*Para cada opcion del select original,
        crear un nuevo DIV que actuara como una opcion:*/
    
        
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;

        c.addEventListener("click", function(e) {
            /*cuando un item es clickeado, actualizar el select original,
            y el item del select:*/
            var y, i, k, s, h, sbu, sba,sselected, auxSelected;
            var evtcambio=false;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            h = this.parentNode.previousSibling;
            sselected=s.selectedOptions;
            /*
            if(!(s.options[s.selectedIndex].innerHTML==this.innerHTML)){
              evtcambio=true;
            }
            */
            

           
            for (i = 0; i < s.length; i++) {
            
            
             if (s.options[i].innerHTML == this.innerHTML){
               if(s.options[i].selected)
               s.options[i].selected = false;
               else
               s.options[i].selected = true;
             
               // s.selectedIndex = i;

               // h.innerHTML = this.innerHTML;
                sbu = this.parentNode.parentNode.getElementsByClassName("select-selected");
                for (sba = 0; sba < sbu.length ; sba++) {
                  
                  var clases_cont= sbu[sba].className;
               
                  
                  if(!s.options[i].value == true)
                  {
                    sbu[sba].classList.remove("select-selected-by-user-m")
                    //clases_cont.replace("select-selected-by-user","");
                   
                  }
                  else
                  {
                    //if(!clases_cont.includes("select-selected-by-user"))
                     //clases_cont += " select-selected-by-user"; 
                      if(!sbu[sba].classList.toggle("select-selected-by-user-m"))
                     sbu[sba].classList.add("select-selected-by-user-m")
                     
                  }
    
                  //sbu[sba].className=clases_cont;
    
                }
               
                y = this.parentNode.getElementsByClassName("same-as-selected-m");
                
                for (k = 0; k < y.length; k++) {
                  y[k].removeAttribute("class");
                }


                auxSelected= this.parentNode.childNodes;
                for(k=auxSelected.length-1;k>=0;k--){
                  if(s.options[k+1].selected){
                    auxSelected[k].setAttribute('class','same-as-selected-m');
                  }
                }


                break;
              }
              
              
              
            }
            
            if(evtcambio){
               if ("createEvent" in document) {
                  var evt = document.createEvent("HTMLEvents");
                  evt.initEvent("change", false, true);
                  s.dispatchEvent(evt);
              }
              else
                  s.fireEvent("onchange");
            }
            h.click();
           
        });

        b.appendChild(c);
    
      }
      x[i].appendChild(b);
      
      a.addEventListener("click", function(e) {
          /*when the select box is clicked, close any other select boxes,
          and open/close the current select box:*/
          e.stopPropagation();
          closeAllSelect(this);
          this.nextSibling.classList.toggle("select-hide-m");
          this.classList.toggle("select-arrow-active-m");
      });
      //markAItemWhenIsSelected(selElmnt.parentNode,'same-as-selected-m');
    }
    
    }

  function initModals(className){
    if(!className==false){
      var modals = document.getElementsByClassName(className);

      if(!modals==false){
        for(var i= modals.length -1 ; i>=0; i--){
          modals[i].setAttribute('class',className+' select-hide');
        }
      }
    }
  }
  
  function slider_general(contenedor, pos) {
      var i;
      var principal= document.getElementsByClassName(contenedor);
  
      if(!principal)
        console.log("Slider general no encontro el contenedor "+contenedor);
      else{
  
      var x = principal;
  
      
  
  
      var inputpos = document.createElement("input");
      inputpos.setAttribute("type", "hidden");
      inputpos.setAttribute("name", "pos_slider_"+contenedor);
      
      inputpos.setAttribute("class", "pos_slider_"+contenedor);
  
      var flecha_pre;
      var flecha_next;
     
      if (pos > x.length) {pos= 1}
      if (pos < 1) {pos = x.length} ;
      for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
           flecha_pre= x[i].getElementsByClassName("pre");
           flecha_next= x[i].getElementsByClassName("next");
  
          for(j=0; j< flecha_pre.length;j++){
            flecha_pre[j].setAttribute("onclick", "slider_general(\""+contenedor+"\","+(pos-1)+")");
          }
  
           for(j=0; j< flecha_next.length;j++){
            flecha_next[j].setAttribute("onclick", "slider_general(\""+contenedor+"\","+(pos+1)+")");
          }
         
      }
      inputpos.setAttribute("value", pos);
     
      x[pos-1].style.display = "flex";
      x[pos-1].appendChild(inputpos);
  
      }
  
      
  }
  
  function carousel_general(contenedor,item,pos) {
      var i;
      var principal= document.getElementById(contenedor);
  
      if(!principal)
        console.log("Carousel no encontro el contenedor "+contenedor);
      else{
  
      var x = principal.getElementsByClassName(item);
  
  
        //console.log(principal.getElementsByClassName("indicador-container"));
  
      if(!x){
        console.log("Sin contenido de items");
      }
  
      var input_del= principal.getElementsByClassName("pos_carousel_"+contenedor);
      var indicador_del=principal.getElementsByClassName("indicador-container");
  
      for(i=0; i< input_del.length;i++){
        input_del[i].parentNode.removeChild(input_del[i]);
      }
  
       for(i=0; i< indicador_del.length;i++){
        indicador_del[i].parentNode.removeChild(indicador_del[i]);
      }
  
  
      var inputpos = document.createElement("input");
      inputpos.setAttribute("type", "hidden");
      inputpos.setAttribute("name", "pos_carousel_"+contenedor);
      inputpos.setAttribute("value", pos);
      inputpos.setAttribute("class", "pos_carousel_"+contenedor);
  
      var selectores="";
      var indicador = document.createElement("DIV");
      indicador.setAttribute("class", "indicador-container");
  
      var indicador_activo="";
      if (pos > x.length) {pos= 1}
      if (pos < 1) {pos = x.length} ;
      for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
          if(pos-1 == i)
            indicador_activo="class=\"activo\"";
          else
            indicador_activo="";
          selectores+="<label "+indicador_activo+" onclick='carousel_general(\""+contenedor+"\",\""+item+"\","+(i+1)+")'></label>";
      }
  
      indicador.innerHTML= selectores;
  
      x[pos-1].style.display = "flex";
      x[pos-1].appendChild(inputpos);
      x[pos-1].appendChild(indicador);
  
      }
  
      
  }
  
  
  
  function getBrowserInfo() {
      var ua= navigator.userAgent, tem, 
      M= ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || [];
      if(/trident/i.test(M[1])){
          tem=  /\brv[ :]+(\d+)/g.exec(ua) || [];
          return {name:'IE',version:(tem[1] || '')};
      }
      if(M[1]==='Chrome'){
          tem= ua.match(/\b(OPR|Edge)\/(\d+)/);
          if(tem!= null) return tem.slice(1).join(' ').replace('OPR', 'Opera');
      }
      M= M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
      if((tem= ua.match(/version\/(\d+)/i))!= null) M.splice(1, 1, tem[1]);
      return {name:M[0],version:M[1] };
  };
  
  
 function loadPage(){

  //defaultImgOnError('.tarjeta-item>.tarjeta-imagen>img',base_url+'/Bienfino-master/imagenes/base/logo.gif');
  //defaultImgOnError('.tarjeta-item-pub>img',base_url+'/Bienfino-master/imagenes/base/logo.gif');
  //defaultImgOnError('.photo-viewer-panel>img',base_url+'/Bienfino-master/imagenes/base/logo.gif');
  //defaultImgOnError('th>a>img',base_url+'/Bienfino-master/imagenes/base/logo.gif');
}

window.onload=loadPage(); 
  
document.addEventListener("DOMContentLoaded", function(event) {
 findByClassAndHide('alert-success');
  optionNavActive();
  makeResponsiveTable("mispublicaciones");
});

  $(document).ready(function() {
    var navegador = getBrowserInfo();
    //alert("Usted esta navegando desde "+navegador.name+" en su version "+navegador.version);
    //Navegadores compatibles
    /*
      IE 11
      Edge 16 17 18
      Firefox 59 60 61 62
      Chrome 49 65 66 67 68 69
      Safari 11.1 12
      iOS Safari 10.3 11.2 11.3
      Opera Mini all
      Chrome Android 66
      UC Browser android 11.8 
      Samsung Internet 4 6.2
    */
  
 
  
  
  /* Para el toggle del mapa del sitio */
  customSelectCall();
  customSelectMultipleCall();
  drawDimensions();
  initModals('modal-preview');
  initTabs();

  
    var estado=false;
  
          scrollingElement = (document.scrollingElement || document.body)
       function scrollSmoothToBottom (id) {
         $(scrollingElement).animate({
        scrollTop: document.body.scrollHeight
          }, 500);
        }
  
  
     $('#toggle-abrir').on('click',function(){
  
        $('.info_footer').slideToggle();
  
        if (estado) {
  
            $(this).children("label").text("AMPLIAR").append('<div class="icon graph-up-open-big"></div>');
  
  
            estado=false;
  
        }else{
  
           $(this).children("label").text("CERRAR").append('<div class="icon graph-down-arrow"></div>');;
            estado=true;
  
        }

         window.scrollTo(0,scrollSmoothToBottom());

  
    });
  
    $('.modal-trigger').on('click',function(e){
      var idTarget=$(this).attr('data-target');

      openModal(idTarget);
    });
    
    $('.modal-close').on('click',function(){
      var idTarget= this.parentNode.id;
      if(!idTarget==false){
        closeModal(idTarget);
      }
    });
    $('.btn.btn-bf.close-modal').on('click',function(){
      var idTarget= this.parentNode.id;
      if(!idTarget==false){
        closeModal(idTarget);
      }
    });

    $('.tab-info-item>span').on('click',function(){
      tabActivateOption(this.parentNode); 
    });
//romel
    $('.lnk-listen').on('click',function(e){
      var url= $(this).attr('data-href');
      var target=$(this).attr('data-target');
      if(!target){
        target='_self';
      }
      e.stopPropagation();
      
      triggerLinkEffect(url,target);
    });
    
    $('a').on('click',function(e){
      e.stopPropagation();
    })

    $('.photo-viewer-panel>img').on('click',function(){
      cargarImagenCentral(this.src,this.alt);
    });

    $('.photo-viewer-visor>.left-arrow').on('click',function(){
     var pos = $('.photo-viewer-visor>img').attr('data-position');
      pasarImagenCentral(--pos);
    });

    $('.photo-viewer-visor>.right-arrow').on('click',function(){
      var pos = $('.photo-viewer-visor>img').attr('data-position');
      pasarImagenCentral(++pos);
    });

    $('.tips').on('mouseover',function(e){
  
        e.preventDefault();

      showTitle(this);
    });

    $('.tips').on('mouseout',function(){
      dropShowTitle(this);
    });

    checkEveryImagePublicacionItem();

      $('.option-nav').on('click',function(e){
        optionSelectActive(e);
      });

      $('.plan').on('click',function(e){
        markPlanBox(e.target);
      });

    $('.find-switch').on('click',function(e){
      
      var elemForm = document.getElementsByClassName('find-small-form');
      if(!elemForm==false){

      if(hasClass(this,'switched')){
          addClass(elemForm[0],'hide');
          removeClass(this,'switched');
      }else{
          removeClass(elemForm[0],'hide');
          addClass(this,'switched');
      }

    }else{
      console.log('No es posible activar el formulario, este no existe');
    }

    });   

  });
  

    function cerrar() {
  
    document.getElementsByClassName('help')[0].style.display="none";
    document.getElementsByClassName('close_help')[0].style.display="none";
  
   }

   /* Para menu usuaurio */

   /* Cuando se da click en el boton,
se muestra el contenido del menu */
function menuUsuarioOpen() {
  document.getElementById("menu-usuario").classList.toggle("show");
  //Ocultar nombre usuario
  var labelUsuario = document.getElementsByClassName("user-name-show");
 
  if(!labelUsuario==false && labelUsuario.length>0){
    labelUsuario[0].classList.add("user-name-hide");
  }
}

// Cerrar el menu si el usuario da click fuera del contenido del menu
window.onclick = function(event) {
if (!event.target.matches('.dropbtn')) {

  var dropdowns = document.getElementsByClassName("menu-usuario-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
    var openDropdown = dropdowns[i];
    if (openDropdown.classList.contains('show')) {
      openDropdown.classList.remove('show');
    }
  }
    //Mostrar nombre de usuario
  var labelUsuario = document.getElementsByClassName("user-name-hide");
  
  if(!labelUsuario==false){
    var i;
  for (i = 0; i < labelUsuario.length; i++) {
    var showLabelUser = labelUsuario[i];
    if (showLabelUser.classList.contains('user-name-hide')) {
      showLabelUser.classList.remove('user-name-hide');
    }
   }
  }

}
} 
  
  
  function init_home_carousel(){
  /* Creacion de los sliders y carousels de la pagina*/
   slider_general('seccion1', 1);
  carousel_general('seccion2','tarjeta-2-2',1);
  carousel_general('seccion3','tarjeta-2-2',1);
  carousel_general('noticias','tarjeta-3-1',1);
  
  setInterval( function() { 
    var posicion;
    posicion= document.getElementsByClassName('pos_slider_seccion1');
    if(posicion.length>0)
      slider_general('seccion1',++posicion[0].value); }, 5000 );
  
  
  setInterval( function() { 
    var posicion;
    posicion= document.getElementsByClassName('pos_carousel_seccion2');
    if(posicion.length>0)
    carousel_general('seccion2','tarjeta-2-2',++posicion[0].value); }, 10000 );
  
  
  setInterval( function() { 
    var posicion;
    posicion= document.getElementsByClassName('pos_carousel_seccion3');
    if(posicion.length>0)
    carousel_general('seccion3','tarjeta-2-2',++posicion[0].value); }, 15000 );
  
  
  setInterval( function() { 
    var posicion;
    posicion= document.getElementsByClassName('pos_carousel_noticias');
    if(posicion.length>0)
    carousel_general('noticias','tarjeta-3-1',++posicion[0].value); }, 25000 );

  }

    /*
      Acciones elemento image-publicacion-item
    */ 
   
    $(".image-publicacion-item>input").on('change',function(){
      //console.log(this);
      
      //abro el modal actual despues de subir la imagen temporl
      //var idTarget=$(this).attr('data-target');
      //openModal(idTarget);

      console.log('Cargo el cortador en el modal y luego de aceptar subo');
      
      uploadPublicacionTempImg(this);
      
    });

    $(".component-busqueda>form>.filter-nav>button").on('mouseover',function(){
      var clases = $('.selects-filter').attr('class');
      clases+= " show-selects-filter";
      $('.selects-filter').attr('class',clases);
    });

    $(".component-busqueda>form>.filter-nav>button").on('mouseout',function(){
      var clases = $('.selects-filter').attr('class');
      clases=clases.replace('show-selects-filter', ' ') ;
      $('.selects-filter').attr('class',clases);
    });

    $(".component-busqueda>form>.filter-nav>.selects-filter").on('mouseover',function(){
      var clases = $('.selects-filter').attr('class');
      clases+= " show-selects-filter";
      $('.selects-filter').attr('class',clases);
    });

    $(".component-busqueda>form>.filter-nav>.selects-filter").on('mouseout',function(){
      var clases = $('.selects-filter').attr('class');
      clases=clases.replace('show-selects-filter', ' ') ;
      $('.selects-filter').attr('class',clases);
    });

    $(".component-busqueda>form>.filter-nav>.selects-filter>.nav-form-select>select").on('focus',function(){
      var clases = $('.selects-filter').attr('class');
      clases+= " show-selects-filter";
      $('.selects-filter').attr('class',clases);
    });
    
    function checkEveryImagePublicacionItem(){
      var ele1= document.getElementsByClassName("image-publicacion-item");
      var imageInput= null;
      var aux=null;
      for (var i = ele1.length - 1; i >= 0; i--) {
        aux=ele1[i].getElementsByTagName("input");
        if(aux.length>0){
        imageInput = ele1[i].getElementsByTagName("input")[0];
        

        //editImage(imageInput);
        //renderPrivewLoadedImage(imageInput);
        
          if(imageInput.files.length>0){
            addDropElement(ele1[i]);
          }else{
            delDropElement(ele1[i]);
          }

        }else{
          console.log("Image in item component no detected.");
        }
      }
    }
//subida imagen ajax tomas//

function uploadPublicacionTempImg(elem){
  event.preventDefault();
    var preload = document.querySelector('.preload');
 
    //preload.classList.add('activate-preload');
    var data = new FormData();
    data.append("codigo",$('#codigo').val());
    data.append("id_precio",$('#id_precio').val());
    var img = $(elem)[0].files[0];
    var pos = $(elem)[0].name;
    pos = pos.substring(pos.length - 1, pos.length);
    data.append("file",img);
    data.append("position",pos);
    
    jQuery.ajax( {
      url: base_url + 'UploadImg/',
      type: 'POST',
      processData: false,
      contentType: false,
      data: data,
      success: function( response ) {
        // response
        //preload.classList.remove('activate-preload');
        console.log(checkCountImgValidate());
        res = JSON.parse(response);
        console.log(res);
        $( "#progressbar"+pos ).css("display","none" );
        var idFoto = '#mfoto' + res.position;
        var img = document.querySelector(idFoto);
        img.classList.add('img-active');
        if(res.result){
          checkEveryImagePublicacionItem();
          //this.parentNode.getElementsByTagName('label')[0].getElementsByTagName('img')[0].src = urlImage;
          //$('#tempidimg'+pos).val(res.url);
        }else{

          img.src="";
          checkEveryImagePublicacionItem();
          $('#tempidimg'+pos).val("");
        }
        
      },
      xhr: function() {
        var xhr = new XMLHttpRequest();
        $( "#progressbar"+pos ).css("display","block" );
        xhr.upload.addEventListener("progress", function(e) {
          if (e.lengthComputable) {
            //var uploadPercent = e.loaded / e.total; typo uploadpercent (all lowercase)
            var uploadpercent = e.loaded / e.total; 
            uploadpercent = (uploadpercent * 100); //optional Math.round(uploadpercent * 100)
            $( "#progressbar"+pos ).progressbar({
              value: uploadpercent
            });
          /*	$('.progress-bar').text(uploadpercent + '%');
            $('.progress-bar').width(uploadpercent + '%');
            if (uploadpercent == 100) {
              $('.progress-bar').text('Completed');
            }*/
          }
        }, false);
        
        return xhr;
      },
      error: function(){
        $( "#progressbar"+pos ).css("display","none" );
      }
    });
    
  }

    
/**    function disableSortable(){
      
      var elem = document.getElementsByClassName('sortable');
      for(var i= elem.length-1; i>0;i--){
        $(elem[i]).sortable( {
          disabled: true
        } );
      }
    }

    function enableSortable(){

    }
 */
    function addDropElement(element){
      if(!element == true){
        
      }else{
        delDropElement(element);
        var a = document.createElement("span");
        a.setAttribute('class','drop-element');
        a.onclick= function(){
          this.parentElement.getElementsByTagName('input')[0].value=null;
          this.parentElement.getElementsByTagName('label')[0].getElementsByTagName('img')[0].src = null;
          this.parentElement.getElementsByTagName('input')[1].value=null;
          
          this.remove();
        };
        element.appendChild(a);
      }
    }

    function delDropElement(element){
      if(!element == true){
        
      }else{
        var ele= element.getElementsByClassName("drop-element");
        for (var i = ele.length - 1; i >= 0; i--) {
          ele[i].remove();
        }
      }
    }

    function editImage(elemento) {
      if (elemento.files && elemento.files[0]) {
        var reader = new FileReader();

        var idTarget=$(elemento).attr('data-target');
        openModal(idTarget);  

        var editable = document.getElementById(idTarget)
        console.log('are modal?',elemento.files[0]);

        reader.onload = function(e) {
          editable.getElementsByTagName('img')[0].src = e.target.result;
        }
        reader.readAsDataURL(elemento.files[0]);
      }
      return;
    }

    function renderPrivewLoadedImage(elemento) {

      if (elemento.files && elemento.files[0]) {
        var reader = new FileReader();     

        reader.onload = function(e) {
          elemento.parentNode.getElementsByTagName('label')[0].getElementsByTagName('img')[0].src = e.target.result;
        }
        reader.readAsDataURL(elemento.files[0]);

      }
      return;
    }

    function markAItemWhenIsSelected(element,clase){
      if(!element == false){
        var select = element.getElementsByTagName("select")[0];
        var selected = null;
        var itemscontainer =null;
        var items =null;
        if(!select == false){
            selected = select[select.selectedIndex].text;
            itemscontainer = element.getElementsByClassName("select-items")[0];
            if(!itemscontainer == false && !selected==false && select[select.selectedIndex].value!=null){
              items = itemscontainer.getElementsByTagName("div");
              for(var i= items.length - 1; i >= 0; i--){
                if(items[i].innerHTML == selected){
                  items[i].setAttribute("class", clase);
                }else{
                  items[i].removeAttribute('class');
                }
              }
            }
            
        }
      }
    }
    
    //selects-filter
    function createMapTextByFilter(classFilter,classMap){
      if(!classFilter==false && !classMap==false){
        var container=null;
        var elementos = null;
        var mapa = "";
        var mapElement=null;

        container= document.getElementsByClassName(classFilter)[0];
        if(!container==false){
          elementos = container.getElementsByTagName("select");
          if(!elementos==false){
            for(var i = elementos.length-1 ; i>=0; i--){
              if(!elementos[i][elementos[i].selectedIndex].value==false){
                if(mapa==""){
                  mapa= elementos[i][elementos[i].selectedIndex].text;
                }else{
                  mapa=  elementos[i][elementos[i].selectedIndex].text + " > " + mapa;
                }
              }
            }
          }
        }

        mapElement= document.getElementsByClassName(classMap)[0];
        if(!mapElement==false){
          mapElement.innerHTML=mapa;
        }

      }
    }

function getElementDefinedSize(elemento){
  if(!elemento==false)
      return {w:elemento.offsetWidth,h:elemento.offsetHeight};
  else
      return null;
  }

function ajustImageInnerContent(elemento,arrMargin,arrPadding,unidad){
  if(!elemento==false){
    var arrElementos = document.getElementsByClassName(elemento);
    var item = null;
    var arrHijos= null;
    var hijo = null;
    var sumHeight = 0;
    var sumWidth = 0;
    var arrayDimensions = null;
    var countImg = 0;
    var resultHeight = 0;
    var resultWidth = 0;
    var arrImg = null;
    var contentDimensions= null;

    if(!arrMargin){
      arrMargin = {top: 0, right: 0, bottom: 0, left: 0};
    }

    if(!arrPadding){
      arrPadding = {top: 0, right: 0, bottom: 0, left: 0};
    }

    if(!unidad){
      unidad='px';
    }

    if(unidad!='px'){
    arrMargin=convertUnidadToPx(arrMargin,unidad);
    arrPadding=convertUnidadToPx(arrPadding,unidad);
  }


    if(!arrElementos==false){
      for(var i= arrElementos.length -1 ; i>=0;i--){
          item=arrElementos[i];
          arrHijos = item.children;
          contentDimensions = getElementDefinedSize(item);
          
          sumHeight=0;
          sumWidth=0;
          resultHeight=0;
          resultWidth=0;
          countImg =0;

          if(!arrHijos==false){
            for(var j= arrHijos.length-1 ;j>=0;j--){
            hijo = arrHijos[j];
            arrayDimensions = getElementDefinedSize(arrHijos[j]);
            
            if(hijo.tagName!='IMG'){
            sumWidth += arrayDimensions['w'];
            sumHeight += arrayDimensions['h'];
            }else{
              countImg++;
            }
            
            resultHeight = contentDimensions['h']-arrMargin['top']-arrMargin['bottom']-arrPadding['top']-arrPadding['bottom']-sumHeight;
            resultWidth = contentDimensions['w']-arrMargin['left']-arrMargin['right']-arrPadding['left']-arrPadding['right']-sumWidth;
            if(countImg>1){
              resultHeight /= countImg;
            }

            }

           arrImg = item.getElementsByTagName('img');
           if(!arrImg==false){
             for(var k= arrImg.length -1 ; k>=0;k--){
               arrImg[k].setAttribute('height',resultHeight);
             }
           }
          }
      }
    }
  }
}
    

function convertUnidadToPx(elemento,unidad){
  var factor=0;
  var equival = {rem: 16,em: 16} 
if(!elemento==false && !unidad==false){
  factor=equival[unidad];
  if(isNaN(elemento)){
    if(elemento instanceof Array){
      for(var i=elemento.length -1;i>=0;i--){
        elemento[i]=elemento[i]*factor;
      }
    }
  }else{
    elemento = elemento*factor;
  }
}
return elemento;
}

function openModal(id,position){
  if(!id==false){
    var elem = document.getElementById(id);
    if(!elem==false){

      c = document.createElement("DIV");
      c.dataset.id = position;
      c.setAttribute('class','overlay');
      elem.setAttribute('class','modal-preview');
      document.getElementsByTagName('body')[0].appendChild(c);
      
    }
  }
}

function closeModal(id){
  if(!id==false){
    var elem = document.getElementById(id);
    if(!elem==false){
      elem.setAttribute('class','modal-preview select-hide');
      var overlay = document.getElementsByClassName('overlay');
      var position = overlay[0].dataset.id;
      subirImg(position);
      //capturo position para subir img      
      if(!overlay==false){
        for(var i= overlay.length -1 ; i>=0; i--){
          overlay[i].remove();
        }
      }
    }
  }
}

 //capturo position de img para subir
 function subirImg(position){
  var idFoto = '#foto' + position;
  const foto = document.querySelector(idFoto);
  console.log(foto);
  uploadPublicacionTempImg(foto);
}

function drawDimensions(){
  ajustImageInnerContent('tarjeta-item-pub', {top: 40, right: 0.8, bottom: 4, left: 0.8}, {top: 1, right: 0.9, bottom: 1, left: 0.9},'rem');
  ajustImageInnerContent('publicidad-item', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
  ajustImageInnerContent('publicidad-banner', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
  ajustImageInnerContent('modal-publicidad', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
  ajustImageInnerContent('tarjeta-item-detail-image', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
  ajustImageInnerContent('photo-viewer-visor', {top: 50, right: 0, bottom: 50, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
  ajustImageInnerContent('photo-viewer-panel', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');
  ajustImageInnerContent('tarjeta-item-repuestos', {top: 0, right: 0, bottom: 0, left: 0}, {top: 0, right: 0, bottom: 0, left: 0},'rem');  
  
}

function initTabs(){
  var tabContainer = document.getElementsByClassName('tab-info');
  var tabSubElements = null;
  var itemActive = [];
  var auxDiv=null;
  var tagId=null;
  var activeId=null;
  var i,j,k;
  if(!tabContainer==false){

    for(i = tabContainer.length-1;i>=0;i--){
      tabSubElements = tabContainer[i].getElementsByClassName('tab-info-item');
      tagId=i;
      activeId=-1;
      if(!tabSubElements==false){
        for( j = tabSubElements.length-1;j>=0;j--){
          if(tabSubElements[j].classList.contains('item-active')){
            tagId=i;
            activeId=j;
            continue;
          }

          auxDiv = tabSubElements[j].getElementsByTagName('div');
          if(!auxDiv==false){
            for(k = auxDiv.length-1; k>=0; k--){
              if(auxDiv[k].classList.contains('item-tab-content-hide')){
                continue;
              }
              auxDiv[k].classList.add('item-tab-content-hide');
            }
          }

        }
      }
      itemActive.push({tab_id:tagId,active:activeId});
    }

  }

}

function tabActivateOption(tabElement){
  if(!tabElement==false){
    var tag = tabElement.parentNode;
    var tagElements = null;
    var divElements=null;
    var i,j;

    tagElements = tag.getElementsByClassName('item-active');
    if(!tagElements==false){
      for(i=tagElements.length-1;i>=0;i--){
        
       
        divElements= tagElements[i].getElementsByTagName('div');
        tagElements[i].classList.remove('item-active');
        if(!divElements==false){
          for(j=divElements.length-1;j>=0;j--){
            divElements[j].setAttribute('class','item-tab-content-hide');
          }
        }
      }
    }

    divElements=tabElement.getElementsByTagName('div');
    if(!divElements==false){
      for(i=divElements.length-1;i>=0;i--){
        divElements[i].setAttribute('class','');
      }
    }
    tabElement.setAttribute('class','tab-info-item item-active');

  }
}

function triggerLinkEffect(url,target){
  if(!target == true){
    target='_self';
  }
  if(!url==false){
    var ua    = navigator.userAgent.toLowerCase(),
    isIE      = ua.indexOf('msie') !== -1,
    version   = parseInt(ua.substr(4, 2), 10);

      // Internet Explorer 8 and lower
      if (isIE && version < 9) {
          var link = document.createElement('a');
          link.href = url;
          link.target = target;
          document.body.appendChild(link);
          link.click();
      }

      // All other browsers can use the standard window.location.href (they don't lose HTTP_REFERER like Internet Explorer 8 & lower does)
      else { 
          if(target=='_self')
          window.location.href = url;
          else
          window.open(url,target); 
      }
  }
}

function cargarImagenCentral(src,alt){
  if(!src==false){
    var contenedor = document.getElementsByClassName('photo-viewer-visor');
    var etiqueta=null;

    if(!contenedor==false){
      etiqueta=contenedor[0].getElementsByTagName('img');
      if(!etiqueta==false){
        etiqueta[0].src=src;
        etiqueta[0].alt=alt;
      }
    }
  }
}

function pasarImagenCentral(pos){
if(!pos==false || pos==0){
  var contenedor = document.getElementsByClassName('photo-viewer-panel');
  var totalImages = null;
  var contenedorVisor = document.getElementsByClassName('photo-viewer-visor');
  var tagImg = null;

  if(!contenedorVisor==false){
    tagImg = contenedorVisor[0].getElementsByTagName('img');
    if(!tagImg==false){
      tagImg=tagImg[0];

      if(!contenedor==false){
        totalImages = contenedor[0].getElementsByTagName('img');
        if(!totalImages==false){
          if(pos<=0)
          pos=totalImages.length;
          else if(pos>totalImages.length){
            pos= 1;
          }

          for(var i= totalImages.length-1;i>=0;i--){
            if(totalImages[i].getAttribute('data-index')==pos){
              tagImg.src=totalImages[i].getAttribute('src');
              tagImg.alt=totalImages[i].getAttribute('alt');
              tagImg.setAttribute('data-position',pos);
              break;
            }
          }
        }
      }
    }

  }

  

}
}

function showTitle(tag){
  if(!tag==false){
    var titulo = tag.getAttribute('title');
    var elemento = document.createElement("span");
    elemento.classList.add('tips_element');
    if(!titulo==false){
      elemento.innerHTML=titulo;
      tag.setAttribute('title','');
      tag.appendChild(elemento);
    }
  }
}

function dropShowTitle(tag){
  
  if(!tag==false){
    var elementos = tag.parentNode.getElementsByClassName('tips_element');

    if(!elementos==false){
      for(var i=elementos.length-1;i>=0;i--){
        tag.setAttribute('title',elementos[i].innerHTML);
        elementos[i].remove();
      }
    }
  }
}


function findByClassAndHide(targetClass){
  if(!targetClass==false){
      var elements = document.getElementsByClassName(targetClass);

      if(!elements==false){
        for(var i = elements.length-1; i>=0;i-- ){
          setTimeout(function(el){
            el.style.display = "none"; 
           }, 10000,elements[i]);
        
        }
      }
  }
}

function optionNavActive(){
  var className="option-nav";
  var sessionOptionNav = sessionStorage.getItem('optionsNavActive');
  var elements = document.getElementsByClassName(className);
  if(!elements==false){
    if(!sessionOptionNav==false){
     
        for (var i = elements.length -1 ; i >= 0; i--){
          if(sessionOptionNav==elements[i].href){
            elements[i].classList.add('active');
          }
        }    

        sessionStorage.removeItem('optionsNavActive');
      }
  }
}

function optionSelectActive(el){
  var target = el.target.href;
  sessionStorage.setItem('optionsNavActive',target);
}


function markPlanBox(el){
  if(!el==false){
    var elParent = el.parentNode.parentNode;
    var tagNameParent = elParent.tagName;
    var classToAdd = "mark-plan-active";

    removeClassInDocument(classToAdd);

    if(!tagNameParent==false){
      elParent.classList.add(classToAdd);
    }
  }
}

function removeClassInDocument(name){
  if(!name==false){
    var elems = document.getElementsByClassName(name);
    if(!elems==false){
      for(var i= elems.length -1 ; i>=0; i--){
        elems[i].classList.remove(name);
      }
    }    
  }
}

function makeResponsiveTable(idToFind){
  if(!idToFind==false){
//console.log(idToFind);
  
  var elem = document.getElementById(idToFind);
  if(!elem==false){
  
      var childrens = elem.childNodes;
      var grandson = null;
      var title;
      var titleValues;
      var titleElements;
      var body;
      var bodyValues;
      var bodyElements;
      var dropInto;

      dropInto=document.getElementById(idToFind+'-dropInto');
      if(!dropInto==true){
        dropInto = document.body;
      }

      if(!childrens==false){
        for(var i=0; i< childrens.length ; i++ )
        {
          //console.log(childrens[i].tagName);
          if(childrens[i].tagName=="THEAD")
            title = childrens[i];

          if(childrens[i].tagName=="TBODY")
            body = childrens[i];
          
        }
      //  console.log(body,title);
        if(!body==false){
            bodyValues = body.childNodes;
            titleValues = title.childNodes;
            for(var i=0;i<bodyValues.length;i++){
              
              if(bodyValues[i].tagName=="TR"){
                bodyElements = bodyValues[i].childNodes;
                titleElements= titleValues[1].childNodes;
                var auxTitleElems = [];
                for(var z=0; z<titleElements.length;z++){
                  
                  if(titleElements[z].tagName=="TH"){
                    auxTitleElems.push(titleElements[z]);
                  }
                }

                titleElements=auxTitleElems;

                var auxCreateElm = document.createElement("div");
                auxCreateElm.classList.add("flex-col");
                auxCreateElm.classList.add("center");
                auxCreateElm.classList.add("small-pub-created");
                auxCreateElm.classList.add("normal-hide");
                for(var j = 0; j< bodyElements.length; j++){
                 
                  var auxCreateElContain = document.createElement("div");
                  var auxCreateTitleContain = document.createElement("span");
                  auxCreateTitleContain.innerHTML=titleElements[j].innerHTML;
                  auxCreateElContain.appendChild(auxCreateTitleContain);
                  auxCreateElContain.innerHTML+=bodyElements[j].innerHTML;
                  auxCreateElm.appendChild(auxCreateElContain);
                }
                dropInto.appendChild(auxCreateElm);
              }
            }
        }else{
          console.log("No existen registros");
        }
      }
   
  }

  }
}


// Where el is the DOM element you'd like to test for visibility
function isHidden(el) {
  return (el.offsetParent === null)
}

  
  function hasClass(elem,className){
    if(!elem==false && !className==false){
      return (' ' + elem.className + ' ').indexOf(' ' + className+ ' ') > -1;
    }
  }

  function addClass(elem,className){
    if(!elem==false && !className==false){
      if(!hasClass(elem,className)){
        elem.classList.add(className);
      }
    }
  }

  function removeClass(elem,className){
    if(!elem==false && !className==false){
      if(hasClass(elem,className)){
        elem.classList.remove(className);
      }
    }
  }

function defaultImgOnError(selector,urlImage){

    var tagImg = document.querySelectorAll(selector);
   if(!tagImg==false){

  //console.log(tagImg);
  for (var i = 0; i < tagImg.length; i++) {
    //tagImg[i]
    if(tagImg[i].naturalHeight==0 && tagImg[i].naturalWidth==0)
   tagImg[i].src=urlImage;
  }
  
 }

}