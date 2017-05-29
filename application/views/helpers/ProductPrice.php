<?php
class Zend_View_Helper_ProductPrice extends Zend_View_Helper_Abstract
{
	public function productPrice($product)
	{
		$currency = new Zend_Currency();
		$formatted = '<p class="price">' . $currency->toCurrency($product->getPrice($product->discounted)) . '</p>';
		if ($product->discounted) {
			$formatted .= '<p class="discprice"> Valore <del>'
			             . $currency->toCurrency($product->getPrice(false))
			             . '</del><br>Sconto ' . $product->discountPerc . '%</p>';
		}
		return $formatted;
	}
}
