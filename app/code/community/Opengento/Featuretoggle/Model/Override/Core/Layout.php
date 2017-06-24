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


class Opengento_Featuretoggle_Model_Override_Core_Layout extends Mage_Core_Model_Layout
{
    /**
     * REWRITE: Add toggle feature logic
     *
     * @param Varien_Simplexml_Element $node
     * @param Varien_Simplexml_Element $parent
     * @return $this|Mage_Core_Model_Layout
     */
    protected function _generateBlock($node, $parent)
    {
        if($this->_ifToggleElement($node)) {
            return $this;
        }
        return parent::_generateBlock($node, $parent);
    }

    /**
     * REWRITE: Add toggle feature logic
     *
     * @param Varien_Simplexml_Element $node
     * @param Varien_Simplexml_Element $parent
     * @return $this|Mage_Core_Model_Layout
     */
    protected function _generateAction($node, $parent)
    {
       if($this->_ifToggleElement($node)) {
           return $this;
       }

       return parent::_generateAction($node, $parent);
    }


    /**
     * Determine if node have toggle_feature param
     * and if the toggle_feature need to be hide
     * for the current user
     *
     * @param $node
     * @return bool
     */
    protected function _ifToggleElement($node)
    {
        if(isset($node['toggle']) && ($feature = (string)$node['toggle'])) {
            if(Mage::helper('opengento_featuretoggle')->showFeature($feature)) {
                return true;
            }
        }
        return false;
    }

}