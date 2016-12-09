<?php
/*
* Copyright (c) 2015 www.magebuzz.com 
*/
class Magebuzz_Splashpage_Helper_Data extends Mage_Core_Helper_Abstract {
	public function enableSplashpage() {
		$storeId = Mage::app()->getStore()->getId(); 
		return (bool) Mage::getStoreConfig('web/splashpage/is_active', $storeId);
	}
	
	public function canShowSplashPage() {
		if (!$this->enableSplashpage()) {
			return false;
		}
		$cookie = Mage::getModel('core/cookie')->get('splashpage_confirm');

		if ($cookie && $cookie == 'splashpage') {
			return false;
		}
		return true;
	}
	
	public function getSplashpageRouter() {
		$storeId = Mage::app()->getStore()->getId(); 
		return (string) Mage::getStoreConfig('web/splashpage/splash_page', $storeId);
	}
	
	public function getCookieExpiry() {
		$storeId = Mage::app()->getStore()->getId(); 
		return Mage::getStoreConfig('web/splashpage/cookie_time', $storeId);
	}
}