<?php
class CustomScrollbar_AdminPageFramework_Format_Sectionset extends CustomScrollbar_AdminPageFramework_Format_Base {
    static public $aStructure = array('section_id' => '_default', 'page_slug' => null, 'tab_slug' => null, 'section_tab_slug' => null, 'title' => null, 'description' => null, 'capability' => null, 'if' => true, 'order' => null, 'help' => null, 'help_aside' => null, 'repeatable' => false, 'sortable' => false, 'attributes' => array('class' => null, 'style' => null, 'tab' => array(),), 'class' => array('tab' => array(),), 'hidden' => false, 'collapsible' => false, 'save' => true, 'content' => null, '_fields_type' => null, '_is_first_index' => false, '_is_last_index' => false, '_caller_object' => null,);
    public $aSection = array();
    public $sFieldsType = '';
    public $sCapability = 'manage_options';
    public $iCountOfElements = 0;
    public $oCaller = null;
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aSection, $this->sFieldsType, $this->sCapability, $this->iCountOfElements, $this->oCaller,);
        $this->aSection = $_aParameters[0];
        $this->sFieldsType = $_aParameters[1];
        $this->sCapability = $_aParameters[2];
        $this->iCountOfElements = $_aParameters[3];
        $this->oCaller = $_aParameters[4];
    }
    public function get() {
        $_aSection = $this->uniteArrays(array('_fields_type' => $this->sFieldsType,) + $this->aSection + array('capability' => $this->sCapability,), self::$aStructure);
        $_aSection['order'] = $this->getAOrB(is_numeric($_aSection['order']), $_aSection['order'], $this->iCountOfElements + 10);
        $_oCollapsibleArgumentFormatter = new CustomScrollbar_AdminPageFramework_Format_CollapsibleSection($_aSection['collapsible'], $_aSection['title']);
        $_aSection['collapsible'] = $_oCollapsibleArgumentFormatter->get();
        $_aSection['class'] = $this->getAsArray($_aSection['class']);
        $_aSection['_caller_object'] = $this->oCaller;
        return $_aSection;
    }
}