<?php
abstract class CustomScrollbar_AdminPageFramework_Attribute_Base extends CustomScrollbar_AdminPageFramework_WPUtility {
    public $sContext = '';
    public $aArguments = array();
    public $aAttributes = array();
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aArguments, $this->aAttributes,);
        $this->aArguments = $_aParameters[0];
        $this->aAttributes = $_aParameters[1];
    }
    public function get() {
        return $this->getAttributes($this->_getFormattedAttributes());
    }
    protected function _getFormattedAttributes() {
        return $this->aAttributes + $this->_getAttributes();
    }
    protected function _getAttributes() {
        return array();
    }
}