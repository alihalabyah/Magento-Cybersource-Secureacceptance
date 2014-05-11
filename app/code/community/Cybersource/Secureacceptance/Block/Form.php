<?php
/**
 * @category   Cybersource
 * @package    Cybersource_Secureacceptance
 * @author     magepsycho@gmail.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Cybersource_Secureacceptance_Block_Form extends Mage_Payment_Block_Form
{
	protected function _construct()
    {
        $this->setTemplate('secureacceptance/form.phtml');
        parent::_construct();
    }
}
