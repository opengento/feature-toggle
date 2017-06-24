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


class Opengento_Featuretoggle_Block_Adminhtml_Form_Field_Features_List extends Mage_Core_Block_Html_Select {
    public function _toHtml()
    {
        $options = Mage::getSingleton('opengento_featuretoggle/system_config_source_features')
            ->toOptionArray();
        foreach ($options as $option) {
            $this->addOption($option['value'], $option['label']);
        }

        return parent::_toHtml();
    }

    public function setInputName($value)
    {
        return $this->setName($value);
    }
}