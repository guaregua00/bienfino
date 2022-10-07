	function loadPage() {

		defaultImgOnError('.grid-details>.card>img', base_url + '/Bienfino-master/imagenes/base/logo.gif');
		defaultImgOnError('.modal-info>.img>img', base_url + '/Bienfino-master/imagenes/base/logo.gif');
	}

	window.onload = loadPage();

	function defaultImgOnError(selector, urlImage) {

		var tagImg = document.querySelectorAll(selector);
		if (!tagImg == false) {

			//console.log(tagImg);
			for (var i = 0; i < tagImg.length; i++) {
				//tagImg[i]
				if (tagImg[i].naturalHeight == 0 && tagImg[i].naturalWidth == 0)
					tagImg[i].src = urlImage;
			}

		}

	}