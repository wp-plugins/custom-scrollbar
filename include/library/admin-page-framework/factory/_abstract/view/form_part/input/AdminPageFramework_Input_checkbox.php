<?php
class CustomScrollbar_AdminPageFramework_Input_checkbox extends CustomScrollbar_AdminPageFramework_Input_Base {
    public function get() {
        $_aParams = func_get_args() + array(0 => '', 1 => array());
        $_sLabel = $_aParams[0];
        $_aAttributes = $this->uniteArrays($this->getElementAsArray($_aParams, 1, array()), $this->aAttributes);
        return "<{$this->aOptions['input_container_tag']} " . $this->getAttributes($this->aOptions['input_container_attributes']) . ">" . "<input " . $this->getAttributes(array('type' => 'hidden', 'class' => $_aAttributes['class'], 'name' => $_aAttributes['name'], 'value' => '0',)) . " />" . "<input " . $this->getAttributes($_aAttributes) . " />" . "</{$this->aOptions['input_container_tag']}>" . "<{$this->aOptions['label_container_tag']} " . $this->getAttributes($this->aOptions['label_container_attributes']) . ">" . $_sLabel . "</{$this->aOptions['label_container_tag']}>";
    }
    public function getAttributesByKey() {
        $_aParams = func_get_args() + array(0 => '',);
        $_sKey = $_aParams[0];
        $_bIsMultiple = '' !== $_sKey;
        return $this->getElement($this->aAttributes, $_sKey, array()) + array('type' => 'checkbox', 'id' => $this->aAttributes['id'] . '_' . $_sKey, 'checked' => $this->getElement($this->aAttributes, array('value', $_sKey), null) ? 'checked' : null, 'value' => 1, 'name' => $_bIsMultiple ? "{$this->aAttributes['name']}[{$_sKey}]" : $this->aAttributes['name'], 'data-id' => $this->aAttributes['id'],) + $this->aAttributes;
    }
}