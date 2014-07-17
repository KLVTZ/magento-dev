<?php

class Foggyline_HappyHour_HelloController extends
Mage_Core_Controller_Front_Action
{
	public function helloWorldAction()
	{
		$this->loadLayout();
		$block = $this->getLayout()->createBlock('foggyline_happyhour/hello');
		$this->getLayout()->getBlock('content')->insert($block);
		$this->renderLayout();
	}

	public function testUserSaveAction()
	{
		$user = Mage::getModel('foggyline_happyhour/user');

		$user->setFirstname('Justin');
		$user->setLastname('Page');

		try {
			$user->save();
			echo 'Success!';
		} catch (Exception $e) {
			Mage::logException($e);
		}
	}

	public function testUserCollectionAction()
	{
		$users = Mage::getModel('foggyline_happyhour/user')
			->getCollection();

		foreach ($users as $user) {
			$firstname = $user->getFirstname();
			$lastname = $user->getLastname();

			echo "First name: {$firstname}<br/>Last Name: {$lastname}";
		}
	}

	public function helperTestAction()
	{
		echo Mage::helper('foggyline_happyhour')->getCustomMessage();
	}
}
