<?php
/**
 * File: SimpleImage.php
 * Author: Simon Jarvis
 * Modified by: Miguel Fermín
 * Based in: http://www.white-hat-web-design.co.uk/articles/php-image-resizing.php
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details:
 * http://www.gnu.org/licenses/gpl.html
 */

class SimpleImage {

	public $image;
	public $image_type;

	public function __construct($filename = null){
		if( !empty($filename) )
			$this->load( $filename );
	}

	public function load( $filename ){

		$filename = realpath( $filename );

		$mime = substr( $filename, strripos( $filename, '.' ) + 1 );

		switch( $mime ){

			case 'png':
			case 'gif':
			case 'jpg':
			case 'jpeg':
			case IMAGETYPE_PNG:
			case IMAGETYPE_JPEG:

				/*PNG Load*/
					$this->image = imagecreatefrompng( $filename );

				/*JPEG Load*/
				if( !$this->image )
					$this->image = imagecreatefromjpeg( $filename );

				/*GIF Load*/
				if( !$this->image )
					$this->image = imagecreatefromgif( $filename );

				if( !$this->image )
					end_alert('Archivo no soportado');

			break;

			case null:
				end_alert('Archivo no encontrado');
			break;

			default:
				end_alert('Archivo no soportado');
			break;
		}
	}

	public function save( $filename, $image_type = IMAGETYPE_JPEG, $compression = 75, $permissions = null ){

		switch ( $image_type ){

			case IMAGETYPE_PNG:
			case IMAGETYPE_JPEG:
				imagepng( $this->image, $filename );
			break;

			case IMAGETYPE_GIF:
				imagegif( $this->image, $filename );
			break;
		}

		if( $permissions != null )
			chmod( $filename, $permissions );
	}

	public function output( $no_cache = false, $image_type = IMAGETYPE_JPEG ){

		if( $no_cache !== true ){
			header('Cache-Control: max-age='.sysconfig('Cache-Control') );
			header('Pragma: cache');
		}

		else{
			header('Cache-Control: max-age=0, no-store, no-cache, must-revalidate');
			header('Pragma: no-cache');
		}

		switch( $image_type ){

			case IMAGETYPE_PNG:
			case IMAGETYPE_JPEG:
				header('Content-type: image/png');
				imagepng( $this->image );
			break;

			case IMAGETYPE_GIF:
				header('Content-type: image/gif');
				imagegif( $this->image );
			break;
		}
	}

	public function getWidth(){
		return imagesx( $this->image );
	}

	public function getHeight(){
		return imagesy( $this->image );
	}

	public function resizeToHeight( $height ){

		$ratio	= $height / $this->getHeight();
		$width	= round( $this->getWidth() * $ratio );
		$this->resize( $width, $height );
	}

	public function resizeToWidth( $width ){

		$ratio	= $width / $this->getWidth();
		$height	= round( $this->getHeight() * $ratio );
		$this->resize( $width, $height );
	}

	public function square( $size ){

		$new_image = imagecreatetruecolor( $size, $size );

		if(
			$this->getWidth() > $this->getHeight()
		){

			$this->resizeToHeight( $size );

			imagecolortransparent( $new_image, imagecolorallocate( $new_image, 0, 0, 0 ) );

			imagealphablending( $new_image, false );

			imagesavealpha( $new_image, true );

			imagecopy( $new_image, $this->image, 0, 0, ( $this->getWidth() - $size ) / 2, 0, $size, $size );
		}

		else {

			$this->resizeToWidth($size);

			imagecolortransparent( $new_image, imagecolorallocate( $new_image, 0, 0, 0 ) );

			imagealphablending( $new_image, false );

			imagesavealpha( $new_image, true );

			imagecopy( $new_image, $this->image, 0, 0, 0, ( $this->getHeight() - $size ) / 2, $size, $size );
		}

		$this->image = $new_image;
	}

	public function scale( $scale ){

		$width	= $this->getWidth()		* $scale / 100;
		$height	= $this->getHeight()	* $scale / 100;
		$this->resize( $width, $height );
	}

	public function resize( $width, $height ){

		$new_image = imagecreatetruecolor( $width, $height );

		imagecolortransparent( $new_image, imagecolorallocate( $new_image, 0, 0, 0 ) );

		imagealphablending( $new_image, false );

		imagesavealpha( $new_image, true );

		imagecopyresampled( $new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->getWidth(), $this->getHeight() );

		$this->image = $new_image;
	}

	public function cut( $x, $y, $width, $height ){

		$new_image = imagecreatetruecolor( $width, $height );

		imagecolortransparent( $new_image, imagecolorallocate( $new_image, 0, 0, 0) );

		imagealphablending( $new_image, false );

		imagesavealpha( $new_image, true );

		imagecopy( $new_image, $this->image, 0, 0, $x, $y, $width, $height );

		$this->image = $new_image;
	}

	public function maxarea( $width, $height = null ){

		$height = $height ? $height : $width;

		if( $this->getWidth() > $width )
			$this->resizeToWidth( $width );

		if( $this->getHeight() > $height )
			$this->resizeToheight( $height );
	}

	public function minarea( $width, $height = null ){

		$height = $height ? $height : $width;

		if( $this->getWidth() < $width )
			$this->resizeToWidth( $width );

		if( $this->getHeight() < $height )
			$this->resizeToheight( $height );
	}

	public function cutFromCenter( $width, $height ){

		if( $width > $height )
		if( $width < $this->getWidth() )
			$this->resizeToWidth( $width );

		if( $width < $height )
		if( $height < $this->getHeight() )
			$this->resizeToHeight( $height );

		$x = ( $this->getWidth()	/ 2 ) - ( $width	/ 2 );
		$y = ( $this->getHeight()	/ 2 ) - ( $height	/ 2 );

		return $this->cut( $x, $y, $width, $height );
	}

	public function maxareafill( $width, $height, $red = 0, $green = 0, $blue = 0 ){

		$this->maxarea($width, $height);

		$new_image	= imagecreatetruecolor( $width, $height );
		$color_fill	= imagecolorallocate( $new_image, $red, $green, $blue );
		imagefill( $new_image, 0, 0, $color_fill );

		imagecopyresampled(
			$new_image,
			$this->image,
			floor( ( $width		- $this->getWidth()	 ) / 2 ),
			floor( ( $height	- $this->getHeight() ) / 2 ),
			0,
			0,
			$this->getWidth(),
			$this->getHeight(),
			$this->getWidth(),
			$this->getHeight()
		);

		$this->image = $new_image;
	}
}