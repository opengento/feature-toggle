<?php
/**
 * Opengento_Featuretoggle Extension
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category   Opengento
 * @copyright  Copyright (c) 2017 Opengento
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Opengento_Featuretoggle_Model_Observer
{

    const TOGGLE_FEATURE_CODE = 'toggle_feature';
    /**
     * Set Toggle cookie with random value on user cookie
     *
     * @param Varien_Event_Observer $observer
     * @event controller_action_predispatch
     */
    public function addCustomerCookie(Varien_Event_Observer $observer)
    {
        if($observer->getEvent()->getControllerAction()->getResponse()->getHttpResponseCode() == '200') {
            if($value = Mage::getSingleton('core/cookie')->get(self::TOGGLE_FEATURE_CODE)) {
                Mage::getSingleton('core/cookie')->set(self::TOGGLE_FEATURE_CODE, $value, 60*60*24*365);

            } else {
                $value = json_encode(array('random' => rand(1,100)));
                Mage::getSingleton('core/cookie')->set(self::TOGGLE_FEATURE_CODE, $value, 60*60*24*365);
            }
        }
    }
}