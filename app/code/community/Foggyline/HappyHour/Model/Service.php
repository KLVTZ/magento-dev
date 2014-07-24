<?php

class Foggyline_HappyHour_Model_Service
{
	public function ping()
	{
		Mage::log(date('l jS \of F Y h:i:s A'));
	}
}
