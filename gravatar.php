<?php namespace Gravatar;

use \HTML, \Config;

/**
 * Gravatar - A bundle for Laravel based on Damian Bushong's GravatarLib
 *
 * Original library by
 * @author  Damian Bushong
 * @see  https://github.com/damianb/gravatarlib
 *
 * Original Laravel package by
 * @author  Michael John Owens
 * 
 * Updated to Laravel 3 Bundle by:
 * @author  Phill Sparks <me@phills.me.uk>
 */
class Gravatar
{
	/**#@+
	 * URL constants for the Gravatar images
	 * 
	 * @var string
	 */
	const HTTP_URL = 'http://www.gravatar.com/avatar/';
	const HTTPS_URL = 'https://secure.gravatar.com/avatar/';
	/**#@-*/
	
	/**
	 * Get the currently set avatar size.
	 * 
	 * @return integer
	 */
	public static function size()
	{
		return Config::get('gravatar::default.size', 80);
	}

	/**
	 * Get the current default image setting.
	 * 
	 * @return string|boolean  False if no default image set, string if one is set.
	 */
	public static function default_image()
	{
		return Config::get('gravatar::default.default_image');
	}

	/**
	 * Get the current maximum allowed rating for avatars.
	 * 
	 * @return string
	 */
	public static function rating()
	{
		return Config::get('gravatar::default.rating', 'g');
	}

	/**
	 * Check if we are using the secure protocol for the image URLs.
	 * 
	 * @return boolean
	 */
	public static function secure()
	{
		return Config::get('gravatar::default.secure');
	}

	/**
	 * Get the email hash to use (after cleaning the string).
	 * 
	 * @param  string $email
	 * @return string
	 */
	public static function hash($email)
	{
		// Using md5 as per Gravatar docs.
		return hash('md5', strtolower(trim($email)));
	}

	/**
	 * Build the Gravatar URL based on the provided email address.
	 * 
	 * @param  string $email
	 * @param  integer $size
	 * @param  boolean $https
	 * @return string
	 */
	public static function url($email, $size = null, $https = false)
	{
		// Start building the URL, and deciding if we're doing this via HTTPS or HTTP.
		$url = (self::secure() or $https) ? static::HTTPS_URL : static::HTTP_URL;

		// Tack the email hash onto the end.
		$url .= self::hash($email);

		// Build the parameters
		$params = array();
		$params['s'] = $size ?: self::size();
		$params['r'] = self::rating();
		$params['d'] = self::default_image();
		$url .= '?'.http_build_query(array_filter($params));

		// And we're done.
		return $url;
	}
	
	/**
	 * Get the Gravatar URL with forced secure connection.
	 * 
	 * @param  string $email
	 * @param  integer $size
	 * @return string
	 */
	public static function url_secure($email, $size = null)
	{
		return self::url($email, $size, true);
	}
	
	/**
	 * Get the Gravatar and return as image HTML.
	 * 
	 * @param  string $email
	 * @param  integer $size
	 * @param  string $alt
	 * @param  array $attributes
	 * @return string
	 * @uses   Laravel\HTML::image
	 */
	public static function image($email, $size = null, $alt = '', array $attributes = array())
	{
		if ( ! isset($attributes['width']) and ! isset($attributes['height']))
		{
			$attributes['width'] = $size ?: self::size();
			$attributes['height'] = $size ?: self::size();
		}

		return HTML::image(self::url($email, $size), $alt, $attributes);
	}
	
	/**
	 * Get the gravatar with forced secure connection and return as image
	 * 
	 * @param  string $email
	 * @param  integer $size
	 * @param  string $alt
	 * @param  array  $attributes
	 * @return string
	 * @uses   Laravel\HTML::image
	 */
	public static function image_secure($email, $size = null, $alt = '', array $attributes = array())
	{
		if ( ! isset($attributes['width']) and ! isset($attributes['height']))
		{
			$attributes['width'] = $size ?: self::size();
			$attributes['height'] = $size ?: self::size();
		}

		return HTML::image(self::url($email, $size, true), $alt, $attributes);
	}
	
}