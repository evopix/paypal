# NO LONGER UNDER ACTIVE DEVELOPMENT

See https://github.com/Hete/kohana-paypal for a more up-to-date library.

# About

PayPal module for [Kohana v3.0.x](http://github.com/kohana/kohana)

# Express Checkout Example

	// Make a SetExpressCheckout call
	$params = array
	(
		'RETURNURL' => url::site(Route::get('checkout')->uri(array('action' => 'shipping_method')), TRUE),
		'CANCELURL' => url::site(Route::get('cart')->uri(), TRUE),
		'AMT' => Cart::instance()->get_total(),
	);
	
	$response  = PayPal::instance('ExpressCheckout')->set($params);
