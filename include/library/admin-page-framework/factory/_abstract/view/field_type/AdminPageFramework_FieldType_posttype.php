<?php
class CustomScrollbar_AdminPageFramework_FieldType_posttype extends CustomScrollbar_AdminPageFramework_FieldType_checkbox {
    public $aFieldTypeSlugs = array('posttype',);
    protected $aDefaultKeys = array('slugs_to_remove' => null, 'query' => array(), 'operator' => 'and', 'attributes' => array('size' => 30, 'maxlength' => 400,), 'select_all_button' => true, 'select_none_button' => true,);
    protected $aDefaultRemovingPostTypeSlugs = array('revision', 'attachment', 'nav_menu_item',);
    protected function getStyles() {
        $_sParentStyles = parent::getStyles();
        return $_sParentStyles . <<<CSSRULES
/* Posttype Field Type */
.custom-scrollbar-field input[type='checkbox'] {
    margin-right: 0.5em;
}     
.custom-scrollbar-field-posttype .custom-scrollbar-input-label-container {
    padding-right: 1em;
}    
CSSRULES;
        
    }
    protected function getField($aField) {
        $this->_sCheckboxClassSelector = '';
        $aField['label'] = $this->_getPostTypeArrayForChecklist(isset($aField['slugs_to_remove']) ? $this->getAsArray($aField['slugs_to_remove']) : $this->aDefaultRemovingPostTypeSlugs, $aField['query'], $aField['operator']);
        return parent::getField($aField);
    }
    private function _getPostTypeArrayForChecklist($aSlugsToRemove, $asQueryArgs = array(), $sOperator = 'and') {
        $_aPostTypes = array();
        foreach (get_post_types($asQueryArgs, 'objects') as $_oPostType) {
            if (isset($_oPostType->name, $_oPostType->label)) {
                $_aPostTypes[$_oPostType->name] = $_oPostType->label;
            }
        }
        return array_diff_key($_aPostTypes, array_flip($aSlugsToRemove));
    }
}