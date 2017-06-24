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

class Opengento_Featuretoggle_Block_Adminhtml_Form_Field_Features extends Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract {


    protected $_featuresRenderer;

    protected function _getFeatureRenderer()
    {
        if (!$this->_featuresRenderer) {
            $this->_featuresRenderer = $this->getLayout()->createBlock(
                'opengento_featuretoggle/adminhtml_form_field_features_list', '',
                array('is_render_to_js_template' => true)
            );
        }
        return $this->_featuresRenderer;
    }
    /**
     * Prepare to render
     */
    protected function _prepareToRender()
    {
        $this->addColumn('feature_id', array(
            'label' => Mage::helper('opengento_featuretoggle')->__('Feature'),
            'renderer' => $this->_getFeatureRenderer(),
            'style' => 'width:150px',
        ));
        $this->addColumn('value', array(
            'label' => Mage::helper('opengento_featuretoggle')->__('Value'),
            'style' => 'width:100px',
        ));
        $this->_addAfter = false;
        $this->_addButtonLabel = Mage::helper('opengento_featuretoggle')->__('Add Feature');
    }

    protected function _prepareArrayRow(Varien_Object $row)
    {
        $row->setData(
            'option_extra_attr_' . $this->_getFeatureRenderer()
                ->calcOptionHash($row->getData('feature_id')),
            'selected="selected"'
        );
    }

}