<?php
/**
 * This file is part of the "Easy Shipping Rules" module for Magento eCommerce
 * developed by (c) Matheus Gontijo <matheus@matheusgontijo.com>
 */

/**
 * Adminhtml Easy Shipping Rules Existing Methods Edit Tab Actions block
 *
 * @category    MatheusGontijo
 * @package     MatheusGontijo_EasyShippingRules
 * @author      Matheus Gontijo <matheus@matheusgontijo.com>
 * @license     OSL v3.0
 */
class MatheusGontijo_EasyShippingRules_Block_Adminhtml_Easyshippingrules_Existingmethod_Edit_Tab_Actions
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare actions form
     *
     * @return MatheusGontijo_EasyShippingRules_Block_Adminhtml_Easyshippingrules_Existingmethod_Edit_Tab_Actions
     */
    protected function _prepareForm()
    {
        $model = Mage::registry('current_easyshippingrules_existing_method');

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('existing_method_');
        $form->setFieldNameSuffix('existing_method');

        $fieldset = $form->addFieldset('action_fieldset', array(
            'legend' => $this->__('Update prices using the following information'),
        ));

        $fieldset->addField('action', 'select', array(
            'label'   => $this->__('Action'),
            'name'    => 'action',
            'options' => Mage::getModel('easyshippingrules/system_action')->toArray(),
        ));

        $fieldset->addField('price_action', 'select', array(
            'label'   => $this->__('Price Action'),
            'name'    => 'price_action',
            'options' => Mage::getModel('easyshippingrules/system_priceaction')->toArray(false, true),
        ));

        $fieldset->addField('price_percentage', 'text', array(
            'name'  => 'price_percentage',
            'class' => 'validate-not-negative-number',
            'label' => $this->__('Price / Percentage'),
            'note'  => $this->__('Set this value for replacing rules\' price / percentage'),
        ));

        $fieldset = $form->addFieldset('action_methods_fieldset', array(
            'legend' => $this->__('Carriers and Shipping Methods'),
        ));

        $fieldset->addField('shipping_method_codes', 'multiselect', array(
            'name'     => 'shipping_method_codes[]',
            'label'    => $this->__('Shipping Methods'),
            'title'    => $this->__('Shipping Methods'),
            'required' => true,
            'values'   => Mage::getSingleton('easyshippingrules/system_shipping')->getShippingValuesForForm(),
        ));

        $form->setValues($model->getData());

        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare content for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return $this->__('Actions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return $this->__('Actions');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return boolean
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return boolean
     */
    public function isHidden()
    {
        return false;
    }
}
