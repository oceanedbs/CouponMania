<?php
class Zend_View_Helper_ProductPrice extends Zend_View_Helper_Abstract
{
	public function productPrice($product)
	{
		$price=$product->price;
		$price=$product->discounted?round(($price-($price*$product->discountPerc)/100), 2):$price;
		$currency = new Zend_Currency();
		$formatted = '<p class="price">' . $currency->toCurrency($price) . '</p>';
		if ($product->discounted) {
			$formatted .= '<p class="discprice"> Valore <del>'
			             . $currency->toCurrency($product->price)
			             . '</del><br>Sconto ' . $product->discountPerc . '%</p>';
		}
		return $formatted;
	}
}
