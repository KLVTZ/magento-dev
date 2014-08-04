<?php

class Foggyline_Stripe_Model_Source_Cctype extends
Mage_Payment_Model_Source_Cctype
{
	protected $_allowedTypes = ['AE', 'VI', 'MC', 'DI', 'JCB', 'OT'];
}
