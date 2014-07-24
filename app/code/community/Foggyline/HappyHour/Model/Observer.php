<?php

class Foggyline_HappyHour_Model_Observer
{
	public function intercept($observer = null)
	{
		$helper = Mage::helper("foggyline_happyhour");
		$event = $observer->getEvent();
		$controllerAction = $event->getControllerAction();
		$params = $controllerAction->getRequest()->getParams();

		Mage::log($params);
	}
}
