<?php
class CustomScrollbar_AdminPageFramework_Format_FieldsetOutput extends CustomScrollbar_AdminPageFramework_Format_Fieldset {
    static public $aStructure = array('_section_index' => null, 'tag_id' => null, '_tag_id_model' => '', '_field_name' => '', '_field_name_model' => '', '_field_name_flat' => '', '_field_name_flat_model' => '', '_field_address' => '', '_field_address_model' => '', '_parent_field_object' => null,);
    public $aFieldset = array();
    public $iSectionIndex = null;
    public $aFieldTypeDefinitions = array();
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aFieldset, $this->iSectionIndex, $this->aFieldTypeDefinitions,);
        $this->aFieldset = $_aParameters[0];
        $this->iSectionIndex = $_aParameters[1];
        $this->aFieldTypeDefinitions = $_aParameters[2];
    }
    public function get() {
        $_aFieldset = $this->aFieldset + self::$aStructure;
        $_aFieldset['_section_index'] = $this->iSectionIndex;
        $_oFieldTagIDGenerator = new CustomScrollbar_AdminPageFramework_Generate_FieldTagID($_aFieldset, $_aFieldset['_caller_object']->oProp->aFieldCallbacks['hfTagID']);
        $_aFieldset['tag_id'] = $_oFieldTagIDGenerator->get();
        $_aFieldset['_tag_id_model'] = $_oFieldTagIDGenerator->getModel();
        $_oFieldNameGenerator = new CustomScrollbar_AdminPageFramework_Generate_FieldName($_aFieldset, $_aFieldset['_caller_object']->oProp->aFieldCallbacks['hfName']);
        $_aFieldset['_field_name'] = $_oFieldNameGenerator->get();
        $_aFieldset['_field_name_model'] = $_oFieldNameGenerator->getModel();
        $_oFieldFlatNameGenerator = new CustomScrollbar_AdminPageFramework_Generate_FlatFieldName($_aFieldset, $_aFieldset['_caller_object']->oProp->aFieldCallbacks['hfNameFlat']);
        $_aFieldset['_field_name_flat'] = $_oFieldFlatNameGenerator->get();
        $_aFieldset['_field_name_flat_model'] = $_oFieldFlatNameGenerator->getModel();
        $_oFieldAddressGenerator = new CustomScrollbar_AdminPageFramework_Generate_FieldAddress($_aFieldset);
        $_aFieldset['_field_address'] = $_oFieldAddressGenerator->get();
        $_aFieldset['_field_address_model'] = $_oFieldAddressGenerator->getModel();
        return $this->_getMergedFieldTypeDefault($_aFieldset, $this->aFieldTypeDefinitions);
    }
    private function _getMergedFieldTypeDefault(array $aFieldset, array $aFieldTypeDefinitions) {
        return $this->uniteArrays($aFieldset, $this->getElementAsArray($aFieldTypeDefinitions, array($aFieldset['type'], 'aDefaultKeys'), array()));
    }
}