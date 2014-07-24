<?php

class SmashingMagazine_MyCarrier_Model_Carrier extends
Mage_Shipping_Model_Carrier_Abstract implements
Mage_Shipping_Model_Carrier_Interface
{
	protected $_code = 'smashingmagazine_mycarrier';

	public function collectRates(Mage_Shipping_Model_Rate_Request $request)
	{
		$result = Mage::getModel('shipping/rate_result');
		$result->append($this->_getStandardShippingRate());

		$expressWeightThreshold =
			$this->getConfigData('express_weight_threshold');

		$eligibleForExpressDelivery = true;
		foreach ($request->getAllItems() as $_item) {
			if ($_item->getWeight() > $expressWeightThreshold) {
				$eligibleForExpressDelivery = false;				
			}
		}

		if ($eligibleForExpressDelivery) {
			$result->append($this->_getExpressShippingRate());
		}

		if ($request->getFreeShipping()) {
			$freeShippingRate = $this->_getFreeShippingRate();
			$result->append($freeShippingRate);
		}
		return $result;
	}

	protected function _getStandardShippingRate()
	{
		$rate = Mage::getModel('shipping/rate_result_method');

		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($this->getConfigData('title'));

		$rate->setMethod('standard');
		$rate->setMethodTitle('Standard');

		$rate->setPrice(4.99);
		$rate->setCost(0);

		return $rate;

	}

	protected function _getExpressShippingRate()
	{
		$rate = Mage::getModel('shipping/rate_result_method');

		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($this->getConfigData('title'));
		$rate->setMethod('express');
		$rate->setMethodTitle('Exress (Next Day)');
		$rate->setPrice(12.99);
		$rate->setCost(0);
		return $rate;
	}

	protected function _getFreeShippingRate()
	{
		$rate =  Mage::getModel('shipping/rate_result_method');
		$rate->setCarrier($this->_code);
		$rate->setCarrierTitle($this->getConfigData('title'));
		$rate->setMethod('free_shipping');
		$rate->setMethodTitle('Free Shipping (3- 5 days)');
		$rate->setPrice(0);
		$rate->setCost(0);
		return $rate;
	}

	public function getAllowedMethods()
	{
		return ['standard'      => 'Standard',
				'express'       => 'Express',
				'free_shipping' => 'Free Shipping',
			];
	}

	public function isTrackingAvailable()
	{
		return true;	
	}
}
