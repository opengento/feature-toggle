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
    /**
     * @param Varien_Event_Observer $observer
     * @event controller_action_predispatch
     */
    public function addCustomerCookie(Varien_Event_Observer $observer)
    {
        $value = json_encode(array('key_1', 'value_1'));

        if(
            $observer->getEvent()->getControllerAction()->getResponse()->getHttpResponseCode() == '200'
            &&
            Mage::getSingleton('core/cookie')->get('toggle_feature')
        ) {
            Mage::getSingleton('core/cookie')->set('toggle_feature', $value, 60*60*24*365);
        }



    }
}