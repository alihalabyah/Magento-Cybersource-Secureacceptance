<?php
/**
 * @category   Cybersource
 * @package    Cybersource_Secureacceptance
 * @author     ali@shopgo.me
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Cybersource_Secureacceptance_Model_System_Config_Source_Modes
{
    public function toOptionArray()
    {
        return array(
            0    => Mage::helper('secureacceptance')->__('Test'),
            1    => Mage::helper('secureacceptance')->__('Live'),
        );
    }
}