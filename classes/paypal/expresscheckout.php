<?php defined('SYSPATH') or die('No direct script access.');
/**
 * PayPal ExpressCheckout integration.
 *
 * @see  https://cms.paypal.com/us/cgi-bin/?cmd=_render-content&content_ID=developer/e_howto_api_ECGettingStarted
 *
 * @package    Kohana
 * @author     Kohana Team
 * @copyright  (c) 2009 Kohana Team
 * @license    http://kohanaphp.com/license.html
 */
class PayPal_ExpressCheckout extends PayPal {

	// Default parameters
	protected $_default = array(
		'PAYMENTACTION' => 'Sale',
	);

	/**
	 * Make an SetExpressCheckout call.
	 *
	 * @param  array   NVP parameters
	 */
	public function set(array $params = NULL)
	{
		$params = $this->_params($params);

		if ( ! isset($params['AMT']))
		{
			throw new Kohana_Exception('You must provide a :param parameter for :method',
				array(':param' => 'AMT', ':method' => __METHOD__));
		}

		return $this->_post('SetExpressCheckout', $params);
	}

	/**
	 * Make an GetExpressCheckoutDetails call.
	 *
	 * @see      https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_GetExpressCheckoutDetails
	 * @throws  Kohana_Exception
	 * @param   array   NVP parameters
	 */
	public function details(array $params = NULL)
	{
		$params = $this->_params($params);

		if ( ! isset($params['TOKEN']))
		{
			throw new Kohana_Exception('You must provide a :param parameter for :method',
				array(':param' => 'TOKEN', ':method' => __METHOD__));
		}

		return $this->_post('GetExpressCheckoutDetails', $params);
	}

	/**
	 * Make an DoExpressCheckoutPayment call.
	 *
	 * @see      https://cms.paypal.com/us/cgi-bin/?&cmd=_render-content&content_ID=developer/e_howto_api_nvp_r_DoExpressCheckoutPayment
	 * @throws  Kohana_Exception
	 * @param   array   NVP parameters
	 */
	public function do_payment(array $params = NULL)
	{
		$params = $this->_params($params);

		if ( ! isset($params['TOKEN']))
		{
			throw new Kohana_Exception('You must provide a :param parameter for :method',
				array(':param' => 'TOKEN', ':method' => __METHOD__));
		}

		return $this->_post('DoExpressCheckoutPayment', $params);
	}

	/**
	 * Returns the Express Checkout URL for the current environment.
	 *
	 * @return  string
	 */
	public function express_checkout_url($token = NULL)
	{
		if ($token !== NULL)
		{
			$token = '&token='.$token;
		}

		return 'https://www.'.$this->_sub_domain().'paypal.com/webscr&cmd=_express-checkout'.$token;
	}

} // End PayPal_ExpressCheckout
