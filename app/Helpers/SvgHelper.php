<?php

// app/Helpers/SvgHelper.php

namespace App\Helpers;

class SvgHelper
{
	public static function render( $args = [] ) {
		$defaults = [
			'name'    => '',
			'type'    => 'icon',
			'class'   => '',
			'id'      => '',
			'action'  => 'echo',
			'show'    => 'html',
			'width'   => '',
			'height'  => '',
			'alt'     => '',
		];

		$args = array_merge( $defaults, $args );

		$icon = 'icons/' . $args['name'];
		if ( $args['type'] != 'icon' ) $icon = $args['name'];
		if ( $args['class'] ) $args['class'] = ' icon--' . $args['class'];

		$id = '';
		if ( $args['id'] ) $id = ' id="' . $args['id'] . '"';

		$svg_uri = asset( 'assets/images/' . $icon . '.svg' );
		$svg_path = public_path( 'assets/images/' . $icon . '.svg' );
		$svg_html = file_get_contents( $svg_path );

		$svg = '<i class="icon icon--' . $args['name'] . $args['class'] . '"' . $id . '>' . $svg_html . '</i>';

		if ( $args['show'] == 'img' ) {
			$width_total  = '';
			$width        = '';
			$height_total = '';
			$height       = '';
			$alt          = ' alt=""';

			if ( $args['width'] ) {
				$width_total = $args['width'];
				$width       = ' width="' . $width_total . '"';
			} else {
				preg_match( '/width=["|\']*(\d+)["|\']*/', $svg_html, $width_total );
				$width_total = $width_total[1];
				$width       = ' width="' . $width_total . '"';
			}

			if ( $args['height'] ) {
				$height_total = $args['height'];
				$height       = ' height="' . $height_total . '"';
			} else {
				preg_match( '/height=["|\']*(\d+)["|\']*/', $svg_html, $height_total );
				$height_total = $height_total[1];
				$height       = ' height="' . $height_total . '"';
			}

			if ( $args['alt'] ) {
				$alt = ' alt="' . $args['alt'] . '"';
			} else {
				preg_match( "/<title>(.+)<\/title>/i", $svg_html, $alt );
				$alt = ' alt="' . $alt[1] . '"';
			}

			$svg = '<img class="icon icon--' . $args['name'] . '" src="' . $svg_uri . '"' . $width . $height . $alt . $id . '>';
		}

		if ( $args['action'] == 'echo' ) {
			echo $svg;
		} else {
			return $svg;
		}
	}
}