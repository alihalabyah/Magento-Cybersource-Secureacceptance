<?php
/**
 * @category   Cybersource
 * @package    Cybersource_Secureacceptance
 * @author     ali@shopgo.me
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Cybersource_Secureacceptance_Block_Redirect extends Mage_Core_Block_Abstract
{
	protected function _toHtml()
	{
		$standard 	= $this->getOrder()->getPayment()->getMethodInstance();

        $form 		= new Varien_Data_Form();
        $form->setAction($standard->getSecureacceptanceUrl())
            ->setId('secureacceptance_payment_checkout')
            ->setName('secureacceptance_payment_checkout')
            ->setMethod('POST')
            ->setUseContainer(true);

		foreach ($standard->getFormFields() as $field => $value) {
            $form->addField($field, 'hidden', array('name'=>$field, 'value'=>$value));
        }

        $merchant_id = Mage::getStoreConfig('payment/secureacceptance/merchant_id');
        $formFields = $standard->getFormFields();
        // session id -> order id
        $session_id = $reference_number = $formFields['reference_number'];

        $org_id = '';
        if(!Mage::getStoreConfig('payment/secureacceptance/mode')) {
            // test mode
            $org_id = '1snn5n9w';
        } else {
            // live mode
            $org_id = 'k8vif92e';
        }   

        $html = '<html><body>';

        $html .= '<p style="background:url(https://h.online-metrix.net/fp/clear.png?org_id=' . $org_id . '&session_id=' . $merchant_id . $session_id . '&m=1)"></p>';
        $html .= '<img style="display:none;" src="https://h.online-metrix.net/fp/clear.png?org_id=' . $org_id . '&session_id=' . $merchant_id . $session_id . '&m=2" alt="">';
        $html .= '<object type="application/x-shockwave-flash" data="https://h.online-metrix.net/fp/fp.swf?org_id=' . $org_id . '&session_id=' . $merchant_id . $session_id . '" width="1" height="1" id="thm_fp"> <param name="movie" value="https://h.online-metrix.net/fp/fp.swf?org_id=' . $org_id . '&session_id=' . $merchant_id . $session_id . '" /> <div></div> </object>';
        $html .= '<script src="https://h.online-metrix.net/fp/check.js?org_id=' . $org_id . '&session_id=' . $merchant_id . $session_id . '" type="text/javascript"> </script>';

        $html.= $this->__('You will be redirected to CyberSource Secure Acceptance WM in a few seconds.');
		$html.= $form->toHtml();
		// die($html);
        $html.= '<script type="text/javascript">document.getElementById("secureacceptance_payment_checkout").submit();</script>';
        $html.= '</body></html>';

		return $html;
    }
}