<?php
/*
* Copyright (c) 2015 www.magebuzz.com 
*/
class Magebuzz_Splashpage_Model_Observer {
	public function showSplashPage($observer) {
		$helper = Mage::helper('splashpage');		
		if (!$helper->canShowSplashPage()) {
			return $this;
		}		
		$request = $observer->getEvent()->getControllerAction()->getRequest();
		$requestString = ltrim($request->getRequestString(), '/');		
		$splashPageRequest = $helper->getSplashpageRouter();
		if ($splashPageRequest != $requestString) {
			$splashBeforeUrl = Mage::getBaseUrl() . $requestString;
			Mage::getSingleton('core/session')->setSplashBeforeUrl($splashBeforeUrl);
		
			$redirectUrl = Mage::getUrl() . $splashPageRequest;
			Mage::app()->getResponse()->setRedirect($redirectUrl);
			Mage::app()->getResponse()->sendResponse();
			exit;
		}		
	}
}