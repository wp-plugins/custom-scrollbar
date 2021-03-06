<?php
class CustomScrollbar_AdminPageFramework_FieldType_checkbox extends CustomScrollbar_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('checkbox');
    protected $aDefaultKeys = array('select_all_button' => false, 'select_none_button' => false,);
    protected function getScripts() {
        new CustomScrollbar_AdminPageFramework_Script_CheckboxSelector;
        $_sClassSelectorSelectAll = $this->_getSelectButtonClassSelectors($this->aFieldTypeSlugs, 'select_all_button');
        $_sClassSelectorSelectNone = $this->_getSelectButtonClassSelectors($this->aFieldTypeSlugs, 'select_none_button');
        return <<<JAVASCRIPTS
jQuery( document ).ready( function(){
    // Add the buttons.
    jQuery( '{$_sClassSelectorSelectAll}' ).each( function(){
        jQuery( this ).before( '<div class=\"select_all_button_container\" onclick=\"jQuery( this ).selectAllCustomScrollbar_AdminPageFrameworkCheckboxes(); return false;\"><a class=\"select_all_button button button-small\">' + jQuery( this ).data( 'select_all_button' ) + '</a></div>' );
    });            
    jQuery( '{$_sClassSelectorSelectNone}' ).each( function(){
        jQuery( this ).before( '<div class=\"select_none_button_container\" onclick=\"jQuery( this ).deselectAllCustomScrollbar_AdminPageFrameworkCheckboxes(); return false;\"><a class=\"select_all_button button button-small\">' + jQuery( this ).data( 'select_none_button' ) + '</a></div>' );
    });
});
JAVASCRIPTS;
        
    }
    private function _getSelectButtonClassSelectors(array $aFieldTypeSlugs, $sDataAttribute = 'select_all_button') {
        $_aClassSelectors = array();
        foreach ($aFieldTypeSlugs as $_sSlug) {
            if (!is_scalar($_sSlug)) {
                continue;
            }
            $_aClassSelectors[] = '.custom-scrollbar-checkbox-container-' . $_sSlug . "[data-{$sDataAttribute}]";
        }
        return implode(',', $_aClassSelectors);
    }
    protected function getStyles() {
        return <<<CSSRULES
/* Checkbox field type */
.select_all_button_container, 
.select_none_button_container
{
    display: inline-block;
    margin-bottom: 0.4em;
}
.custom-scrollbar-checkbox-label {
    margin-top: 0.1em;
}
.custom-scrollbar-field input[type='checkbox'] {
    margin-right: 0.5em;
}     
.custom-scrollbar-field-checkbox .custom-scrollbar-input-label-container {
    padding-right: 1em;
}
.custom-scrollbar-field-checkbox .custom-scrollbar-input-label-string  {
    display: inline; /* Checkbox labels should not fold(wrap) after the check box */
}
CSSRULES;
        
    }
    protected $_sCheckboxClassSelector = 'apf_checkbox';
    protected function getField($aField) {
        $_aOutput = array();
        $_bIsMultiple = is_array($aField['label']);
        foreach ($this->getAsArray($aField['label'], true) as $_sKey => $_sLabel) {
            $_aOutput[] = $this->_getEachCheckboxOutput($aField, $_bIsMultiple ? $_sKey : '', $_sLabel);
        }
        return "<div " . $this->getAttributes($this->_getCheckboxContainerAttributes($aField)) . ">" . "<div class='repeatable-field-buttons'></div>" . implode(PHP_EOL, $_aOutput) . "</div>";
    }
    protected function _getCheckboxContainerAttributes(array $aField) {
        return array('class' => 'custom-scrollbar-checkbox-container-' . $aField['type'], 'data-select_all_button' => $aField['select_all_button'] ? (!is_string($aField['select_all_button']) ? $this->oMsg->get('select_all') : $aField['select_all_button']) : null, 'data-select_none_button' => $aField['select_none_button'] ? (!is_string($aField['select_none_button']) ? $this->oMsg->get('select_none') : $aField['select_none_button']) : null,);
    }
    private function _getEachCheckboxOutput(array $aField, $sKey, $sLabel) {
        $_oCheckbox = new CustomScrollbar_AdminPageFramework_Input_checkbox($aField['attributes']);
        $_oCheckbox->setAttributesByKey($sKey);
        $_oCheckbox->addClass($this->_sCheckboxClassSelector);
        return $this->getElement($aField, array('before_label', $sKey)) . "<div class='custom-scrollbar-input-label-container custom-scrollbar-checkbox-label' style='min-width: " . $this->sanitizeLength($aField['label_min_width']) . ";'>" . "<label " . $this->getAttributes(array('for' => $_oCheckbox->getAttribute('id'), 'class' => $_oCheckbox->getAttribute('disabled') ? 'disabled' : null,)) . ">" . $this->getElement($aField, array('before_input', $sKey)) . $_oCheckbox->get($sLabel) . $this->getElement($aField, array('after_input', $sKey)) . "</label>" . "</div>" . $this->getElement($aField, array('after_label', $sKey));
    }
}