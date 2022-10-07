const divFiltros = document.getElementById('div-filtros'),
    menuLateral = document.getElementById('menu-lateral'),
    buttonFiltre = document.getElementById('button-filtre'),
    cards = document.getElementById('cards'),
    faHeartFavorito = document.getElementById('fa-heart-favorito'),
    modal = document.getElementById('modal'),
    imgModal = document.getElementById('imgmodal'),
    btnCerrarModal = document.getElementById('btn-cerrar-modal'),
    modalRight = document.getElementById('modal-right'),
    modalLeft = document.getElementById('modal-left'),
    imgPrincipalGaleria = document.getElementById('img-principal-galeria');

    esDispositivoMovil = () => window.innerWidth <= 600;

    
    divFiltros.addEventListener('click', () => {
        //menuLateral.classList.toggle('active');
        alert("modal con menu filtro")
    });
    

    
    buttonFiltre.addEventListener('click', () => {
        if(window.innerWidth <= 600){
            cards.classList.remove('columns4');
            cards.classList.toggle('columns1');
        }else{
            cards.classList.remove('columns1');
            cards.classList.toggle('columns4');
        }
        
    });
    
    faHeartFavorito.addEventListener('click', () => {
        faHeartFavorito.classList.toggle('red');
    });

    //cambio miniatura a imagen principal
    document.querySelectorAll('.miniauturas-imagenes .miniautura-img img').forEach((elemento) => {
        elemento.addEventListener('mouseover', (e) => {
            console.log(elemento.dataset.position);
            console.log(imgPrincipalGaleria.dataset.position);
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
    document.querySelectorAll('.miniauturas-imagenes .miniautura-img img').forEach((elemento) => {
        elemento.addEventListener('click', (e) => {
            modal.classList.add('active');
            imgModal.src = elemento.src;
        });
    });
    

    //abre el modal al darle click sobre la imagen principal
    /*
    imgPrincipalGaleria.addEventListener('click', (e) => {
        console.log(imgModal.dataset.position);
        modal.classList.add('active');
        imgModal.src = imgPrincipalGaleria.src;
        imgModal.alt = imgPrincipalGaleria.alt;
        imgModal.setAttribute('data-position',imgPrincipalGaleria.dataset.position);
    });
    
    btnCerrarModal.addEventListener('click',(e) => {
        modal.classList.remove('active');
    });
*/
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

/*
    modalLeft.addEventListener('click',(e) => {

        let p = imgModal.dataset.position;
        let miniImg = document.querySelectorAll('.miniauturas-imagenes .miniautura-img img');

        for (let i = 1; i < miniImg.length; i++) {
            if(p==miniImg[i].dataset.position){
                imgModal.src = miniImg[i-1].src;
                imgModal.alt = miniImg[i-1].alt;
                imgModal.setAttribute('data-position',miniImg[i-1].dataset.position);
                continue;
            }         
        }
    }); 

    modalRight.addEventListener('click',(e) => {

        let p = imgModal.dataset.position;
        let miniImg = document.querySelectorAll('.miniauturas-imagenes .miniautura-img img');

        for (let i = 0; i < miniImg.length -1 ; i++) {
            if(p==miniImg[i].dataset.position){
                imgModal.src = miniImg[i+1].src;
                imgModal.alt = miniImg[i+1].alt;
                imgModal.setAttribute('data-position',miniImg[i+1].dataset.position);
                continue;
            }         
        }
    });
 */