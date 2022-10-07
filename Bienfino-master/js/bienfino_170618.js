/**
Selector personalizado
**/
var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("bienfino-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /*for each element, create a new DIV that will act as the selected item:*/

  a = document.createElement("DIV");
  if(!selElmnt.options[selElmnt.selectedIndex].value == true)
       a.setAttribute("class", "select-selected");
  else
     a.setAttribute("class", "select-selected select-selected-by-user");

  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;

  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 0; j < selElmnt.length; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/


    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sbu, sba;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
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
  });
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

          $(this).children("label").text("Ampliar Info").append('<div class="icon graph-up-open-big"></div>');


          estado=false;

      }else{

         $(this).children("label").text("Cerrar Info").append('<div class="icon graph-down-arrow"></div>');;
          estado=true;

      }

       window.scrollTo(0,scrollSmoothToBottom());



  });


});


  function cerrar() {

  document.getElementsByClassName('help')[0].style.display="none";
  document.getElementsByClassName('close_help')[0].style.display="none";

 }



/* Creacion de los sliders y carousels de la pagina*/
 slider_general('seccion1', 1);
carousel_general('seccion2','tarjeta-2-2',1);
carousel_general('seccion3','tarjeta-2-2',1);
carousel_general('noticias','tarjeta-3-1',1);


setInterval( function() { 
  var posicion;
  posicion= document.getElementsByClassName('pos_slider_seccion1');
  if(!posicion)
    return;
    slider_general('seccion1',++posicion[0].value); }, 5000 );


setInterval( function() { 
  var posicion;
  posicion= document.getElementsByClassName('pos_carousel_seccion2');
  if(!posicion)
    return;
  carousel_general('seccion2','tarjeta-2-2',++posicion[0].value); }, 10000 );


setInterval( function() { 
  var posicion;
  posicion= document.getElementsByClassName('pos_carousel_seccion3');
  if(!posicion)
    return;
  carousel_general('seccion3','tarjeta-2-2',++posicion[0].value); }, 15000 );


setInterval( function() { 
  var posicion;
  posicion= document.getElementsByClassName('pos_carousel_noticias');
  if(!posicion)
    return;
  carousel_general('noticias','tarjeta-3-1',++posicion[0].value); }, 25000 );



