<?php


class Opengento_Featuretoggle_Helper_Data extends Mage_Core_Helper_Abstract
{

    /**
     *
     * @param mixed $value
     * @return string
     */
    protected function _serializeValue($value)
    {
        if (is_numeric($value)) {
            $data = (float)$value;
            return (string)$data;
        } else if (is_array($value)) {
            $data = array();
            foreach ($value as $country => $price) {
                if (!array_key_exists($country, $data)) {
                    $data[$country] = $price;
                }
            }
            return serialize($data);
        } else {
            return '';
        }
    }

    /**
     *
     * @param mixed $value
     * @return array
     */
    protected function _unserializeValue($value)
    {
        if (is_string($value) && !empty($value)) {
            return unserialize($value);
        } else {
            return array();
        }
    }

    /**
     * Check whether value is in form retrieved by _encodeArrayFieldValue()
     *
     * @param mixed
     * @return bool
     */
    protected function _isEncodedArrayFieldValue($value)
    {
        if (!is_array($value)) {
            return false;
        }
        unset($value['__empty']);
        foreach ($value as $_id => $row) {
            if (!is_array($row) || !array_key_exists('country', $row) || !array_key_exists('price', $row)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Encode value to be used in Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
     *
     * @param array
     * @return array
     */
    protected function _encodeArrayFieldValue(array $value)
    {
        $result = array();
        foreach ($value as $country => $price) {
            $_id = Mage::helper('core')->uniqHash('_');
            $result[$_id] = array(
                'country' => $country,
                'price' => $price,
            );
        }
        return $result;
    }

    /**
     * Decode value from used in Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
     *
     * @param array
     * @return array
     */
    protected function _decodeArrayFieldValue(array $value)
    {
        $result = array();
        unset($value['__empty']);
        foreach ($value as $_id => $row) {
            if (!is_array($row) || !array_key_exists('country', $row) || !array_key_exists('price', $row)) {
                continue;
            }
            $country = $row['country'];
            $price =$row['price'];
            $result[$country] = $price;
        }
        return $result;
    }

    /**
     * Make value readable by Mage_Adminhtml_Block_System_Config_Form_Field_Array_Abstract
     *
     * @param mixed $value
     * @return array
     */
    public function makeArrayFieldValue($value)
    {
        $value = $this->_unserializeValue($value);
        if (!$this->_isEncodedArrayFieldValue($value)) {
            $value = $this->_encodeArrayFieldValue($value);
        }
        return $value;
    }

    /**
     * Make value ready for store
     *
     * @param mixed $value
     * @return string
     */
    public function makeStorableArrayFieldValue($value)
    {
        if ($this->_isEncodedArrayFieldValue($value)) {
            $value = $this->_decodeArrayFieldValue($value);
        }
        $value = $this->_serializeValue($value);
        return $value;
    }

    public function isToggle($percent = null)
    {
        if(!$percent) {
            $cookie     = json_decode(Mage::getSingleton('core/cookie')->get(Opengento_Featuretoggle_Model_Observer::TOGGLE_FEATURE_CODE));
            $percent = $cookie->random;
        }
        $featuresEnabled    = array();
        $features           = unserialize(Mage::getStoreConfig('featuretoggle_config/features/values'));

        if(!empty($features) && is_array($features)) {
            foreach ($features as $feature) {
                if($percent < $feature['value']) {
                    $featuresEnabled[] = $feature['feature_id'];
                }
            }
        }

        Mage::log($featuresEnabled);
        return $featuresEnabled;
    }
}