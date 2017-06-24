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


class Opengento_Featuretoggle_Model_System_Config_Source_Features {


    public function toOptionArray()
    {

        $options[] = array(
            'value' => '',
            'label' => '-- SELECT --'
        );
        $xmlFile  = Mage::getConfig()->loadModulesConfiguration('features.xml')->getNode();
        foreach ($xmlFile as $xml) {
            $options[] = array(
                'value' => $xml->id,
                'label' => $xml->name
            );
        }


        return $options;

    }


}