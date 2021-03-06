<?php
class CustomScrollbar_AdminPageFramework_FormPart_TableRow extends CustomScrollbar_AdminPageFramework_FormPart_Base {
    public $aFieldset = array();
    public $hfCallback = null;
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aFieldset, $this->hfCallback);
        $this->aFieldset = $_aParameters[0];
        $this->hfCallback = $_aParameters[1];
    }
    public function get() {
        return $this->_getRow($this->aFieldset, $this->hfCallback);
    }
    protected function _getRow(array $aFieldset, $hfCallback) {
        if ('section_title' === $aFieldset['type']) {
            return '';
        }
        $_oFieldrowAttribute = new CustomScrollbar_AdminPageFramework_Attribute_Fieldrow($aFieldset, array('id' => 'fieldrow-' . $aFieldset['tag_id'], 'valign' => 'top', 'class' => 'custom-scrollbar-fieldrow',));
        return $this->_getFieldByContainer($aFieldset, $hfCallback, array('open_container' => "<tr " . $_oFieldrowAttribute->get() . ">", 'close_container' => "</tr>", 'open_title' => "<th>", 'close_title' => "</th>", 'open_main' => "<td " . $this->getAttributes(array('colspan' => $aFieldset['show_title_column'] ? 1 : 2, 'class' => $aFieldset['show_title_column'] ? null : 'custom-scrollbar-field-td-no-title',)) . ">", 'close_main' => "</td>",));
    }
    protected function _getFieldByContainer(array $aFieldset, $hfCallback, array $aOpenCloseTags) {
        $aOpenCloseTags = $aOpenCloseTags + array('open_container' => '', 'close_container' => '', 'open_title' => '', 'close_title' => '', 'open_main' => '', 'close_main' => '',);
        $_aOutput = array();
        if ($aFieldset['show_title_column']) {
            $_aOutput[] = $aOpenCloseTags['open_title'] . $this->_getFieldTitle($aFieldset) . $aOpenCloseTags['close_title'];
        }
        $_aOutput[] = $aOpenCloseTags['open_main'] . call_user_func_array($hfCallback, array($aFieldset)) . $aOpenCloseTags['close_main'];
        return $aOpenCloseTags['open_container'] . implode(PHP_EOL, $_aOutput) . $aOpenCloseTags['close_container'];
    }
    private function _getFieldTitle(array $aField) {
        $_oInputTagIDGenerator = new CustomScrollbar_AdminPageFramework_Generate_FieldInputID($aField, 0);
        return "<label for='" . $_oInputTagIDGenerator->get() . "'>" . "<a id='{$aField['field_id']}'></a>" . "<span title='" . esc_attr(strip_tags(isset($aField['tip']) ? $aField['tip'] : (is_array($aField['description'] ? implode('&#10;', $aField['description']) : $aField['description'])))) . "'>" . $aField['title'] . (in_array($aField['_fields_type'], array('widget', 'post_meta_box', 'page_meta_box')) && isset($aField['title']) && '' !== $aField['title'] ? "<span class='title-colon'>:</span>" : '') . "</span>" . "</label>";
    }
}