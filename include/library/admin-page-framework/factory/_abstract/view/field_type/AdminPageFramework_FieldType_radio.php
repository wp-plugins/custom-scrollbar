<?php
class CustomScrollbar_AdminPageFramework_FieldType_radio extends CustomScrollbar_AdminPageFramework_FieldType {
    public $aFieldTypeSlugs = array('radio');
    protected $aDefaultKeys = array('label' => array(), 'attributes' => array(),);
    protected function getStyles() {
        return <<<CSSRULES
/* Radio Field Type */
.custom-scrollbar-field input[type='radio'] {
    margin-right: 0.5em;
}     
.custom-scrollbar-field-radio .custom-scrollbar-input-label-container {
    padding-right: 1em;
}     
.custom-scrollbar-field-radio .custom-scrollbar-input-container {
    display: inline;
}     
.custom-scrollbar-field-radio .custom-scrollbar-input-label-string  {
    display: inline; /* radio labels should not fold(wrap) after the check box */
}
CSSRULES;
        
    }
    protected function getScripts() {
        return '';
    }
    protected function getField($aField) {
        $_aOutput = array();
        foreach ($this->getAsArray($aField['label']) as $_sKey => $_sLabel) {
            $_aOutput[] = $this->_getEachRadioButtonOutput($aField, $_sKey, $_sLabel);
        }
        $_aOutput[] = $this->_getUpdateCheckedScript($aField['input_id']);
        return implode(PHP_EOL, $_aOutput);
    }
    private function _getEachRadioButtonOutput(array $aField, $sKey, $sLabel) {
        $_oRadio = new CustomScrollbar_AdminPageFramework_Input_radio($aField['attributes']);
        $_oRadio->setAttributesByKey($sKey);
        $_oRadio->setAttribute('data-default', $aField['default']);
        return $this->getElement($aField, array('before_label', $sKey)) . "<div class='custom-scrollbar-input-label-container custom-scrollbar-radio-label' style='min-width: " . $this->sanitizeLength($aField['label_min_width']) . ";'>" . "<label " . $this->getAttributes(array('for' => $_oRadio->getAttribute('id'), 'class' => $_oRadio->getAttribute('disabled') ? 'disabled' : null,)) . ">" . $this->getElement($aField, array('before_input', $sKey)) . $_oRadio->get($sLabel) . $this->getElement($aField, array('after_input', $sKey)) . "</label>" . "</div>" . $this->getElement($aField, array('after_label', $sKey));
    }
    private function _getUpdateCheckedScript($sInputID) {
        $_sScript = <<<JAVASCRIPTS
jQuery( document ).ready( function(){
    jQuery( 'input[type=radio][data-id=\"{$sInputID}\"]' ).change( function() {
        // Uncheck the other radio buttons
        jQuery( this ).closest( '.custom-scrollbar-field' ).find( 'input[type=radio][data-id=\"{$sInputID}\"]' ).attr( 'checked', false );

        // Make sure the clicked item is checked
        jQuery( this ).attr( 'checked', 'checked' );
    });
});                 
JAVASCRIPTS;
        return "<script type='text/javascript' class='radio-button-checked-attribute-updater'>" . $_sScript . "</script>";
    }
}