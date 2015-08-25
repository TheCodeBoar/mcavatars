<?php
class Render
{
	public function renderAvatar($skin, $size, $hat=false)
	{
		$skin = base64_decode($skin);
		$imgSkin = imagecreatefromstring($skin);
		$transparency = imagecolorat($imgSkin, 0, 0);

		$imgHead = imagecreatetruecolor($size, $size);
		imagecopyresized($imgHead, $imgSkin, 0, 0, 8, 8, $size, $size, 8, 8);
		if ($hat)
		{
			$imgHat = imagecreate($size, $size);
			imagecopyresized($imgHat, $imgSkin, 0, 0, 40, 8, $size, $size, 8, 8);
			imagecopy($imgHead, $imgHat, 0, 0, 0, 0, $size, $size);
			imagedestroy($imgHat);
		}

		header('Content-type: image/png');

		imagepng($imgHead);

		imagedestroy($imgHead);
		imagedestroy($imgSkin);
	}

	public function renderSkin($skin)
	{
		$skin = base64_decode($skin);
		$im = imagecreatefromstring($skin);

		header('Content-type: image/png');

		imagepng($im);

		imagedestroy($im);
	}

	public function renderBody($skin, $size, $hat=false)
	{
		$bodyWidth = (int) floor($size / 2);
		$bodyHeight = (int) floor($bodyWidth * 1.5);
		$armWidth = (int) floor($size / 4);
		$width = (int) $bodyWidth * 2;
		$height = (int) $width * 2;

		$skin = base64_decode($skin);
		$imgBody = imagecreatetruecolor($width, $height);
		$imgSkin = imagecreatefromstring($skin);
		$transparency = imagecolorat($imgSkin, 0, 0);
		$alphaRed = ($transparency >> 16) & 0xFF;
		$alphaGreen = ($transparency >> 8) & 0xFF;
		$alphaBlue = ($transparency) & 0xFF;

		// Make body transparent
		imagesavealpha($imgBody, true);
		$transparent = imagecolorallocatealpha($imgBody, 0, 0, 0, 127);
		imagefill($imgBody, 0, 0, $transparent);

		// Head (and hat, of course)
		imagecopyresized($imgBody, $imgSkin, $armWidth, 0, 8, 8, $bodyWidth, $bodyWidth, 8, 8);
		if ($hat)
		{
			$imgHat = imagecreatetruecolor($bodyWidth, $bodyWidth);
			imagecolortransparent($imgHat, $transparency);
			imagecopy($imgBody, $imgHat, 0, 0, $armWidth, 0, $bodyWidth, $bodyWidth);
			imagecopyresized($imgHat, $imgSkin, $armWidth, 0, 40, 8, $bodyWidth, $bodyWidth, 8, 8);
			/*$rgb = imagecolorallocatealpha( $imgHat, 0, 0, 0, 127 );
			imagefill( $imgHat, 0, 0, $rgb );*/
		}

		// Body
		imagecopyresized($imgBody, $imgSkin, $armWidth, $bodyWidth, 20, 20, $bodyWidth, $bodyHeight, 8, 12);
		// Arms
		imagecopyresized($imgBody, $imgSkin, $armWidth + $bodyWidth, $bodyWidth, 44, 20, $armWidth, $bodyHeight, 4, 12);
		imagecopyresized($imgBody, $imgSkin, 0, $bodyWidth, 44, 20, $armWidth, $bodyHeight, 4, 12);
		// Legs
		/**
		 * X: 4
		 * Y: 20
		 */
		imagecopyresized($imgBody, $imgSkin, $armWidth, $bodyWidth + $bodyHeight, 4, 20, $armWidth, $bodyHeight, 4, 12);
		$imgLeftLeg = imagecreatetruecolor($armWidth, $bodyHeight);
		imagecopyresized($imgLeftLeg, $imgSkin, 0, 0, 4, 20, $armWidth, $bodyHeight, 4, 12);
		imageflip($imgLeftLeg, IMG_FLIP_HORIZONTAL);
		imagecopy($imgBody, $imgLeftLeg, $bodyWidth, $bodyWidth + $bodyHeight, 0, 0, $armWidth, $bodyHeight);
		imagedestroy($imgLeftLeg);

		header('Content-type: image/png');

		imagepng($imgBody);

		imagedestroy($imgSkin);
		imagedestroy($imgBody);
	}
}