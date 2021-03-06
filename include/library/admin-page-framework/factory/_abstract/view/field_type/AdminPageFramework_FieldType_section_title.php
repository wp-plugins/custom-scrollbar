<?php
class CustomScrollbar_AdminPageFramework_FieldType_section_title extends CustomScrollbar_AdminPageFramework_FieldType_text {
    public $aFieldTypeSlugs = array('section_title',);
    protected $aDefaultKeys = array('label_min_width' => 30, 'attributes' => array('size' => 20, 'maxlength' => 100,),);
    protected function getStyles() {
        return <<<CSSRULES
/* Section Tab Field Type */
.custom-scrollbar-section-tab .custom-scrollbar-field-section_title {
    padding: 0.5em;
}
 .custom-scrollbar-section-tab .custom-scrollbar-field-section_title .custom-scrollbar-input-label-string {     
    vertical-align: middle; 
} 
 .custom-scrollbar-section-tab .custom-scrollbar-fields {
    display: inline-block;
} 
.custom-scrollbar-field.custom-scrollbar-field-section_title {
    float: none;
} 
.custom-scrollbar-field.custom-scrollbar-field-section_title input {
    background-color: #fff;
    color: #333;
    border-color: #ddd;
    box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
    border-width: 1px;
    border-style: solid;
    outline: 0;
    box-sizing: border-box;
    vertical-align: middle;
}
CSSRULES;
        
    }
    protected function getField($aField) {
        $aField['attributes'] = array('type' => 'text') + $aField['attributes'];
        return parent::getField($aField);
    }
}