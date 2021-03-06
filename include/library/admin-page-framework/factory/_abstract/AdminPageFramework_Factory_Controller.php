<?php
abstract class CustomScrollbar_AdminPageFramework_Factory_Controller extends CustomScrollbar_AdminPageFramework_Factory_View {
    public function start() {
    }
    public function setUp() {
    }
    public function enqueueStyles($aSRCs, $_vArg2 = null) {
    }
    public function enqueueStyle($sSRC, $_vArg2 = null) {
    }
    public function enqueueScripts($aSRCs, $_vArg2 = null) {
    }
    public function enqueueScript($sSRC, $_vArg2 = null) {
    }
    public function addHelpText($sHTMLContent, $sHTMLSidebarContent = "") {
        if (method_exists($this->oHelpPane, '_addHelpText')) {
            $this->oHelpPane->_addHelpText($sHTMLContent, $sHTMLSidebarContent);
        }
    }
    public function addSettingSections() {
        foreach (func_get_args() as $asSection) {
            $this->addSettingSection($asSection);
        }
        $this->_sTargetSectionTabSlug = null;
    }
    public function addSettingSection($aSection) {
        if (!is_array($aSection)) {
            return;
        }
        $this->_sTargetSectionTabSlug = $this->oUtil->getElement($aSection, 'section_tab_slug', $this->_sTargetSectionTabSlug);
        $aSection['section_tab_slug'] = $this->oUtil->getAOrB($this->_sTargetSectionTabSlug, $this->_sTargetSectionTabSlug, null);
        $this->oForm->addSection($aSection);
    }
    public function addSettingFields() {
        foreach (func_get_args() as $aField) {
            $this->addSettingField($aField);
        }
    }
    public function addSettingField($asField) {
        if (method_exists($this->oForm, 'addField')) {
            $this->oForm->addField($asField);
        }
    }
    public function setFieldErrors($aErrors) {
        $GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'] = $this->oUtil->getElement($GLOBALS, array('aCustomScrollbar_AdminPageFramework', 'aFieldErrors'), array());
        if (empty($GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'])) {
            add_action('shutdown', array($this, '_replyToSaveFieldErrors'));
        }
        $_sID = md5($this->oProp->sClassName);
        $GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'][$_sID] = isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'][$_sID]) ? $this->oUtil->uniteArrays($GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'][$_sID], $aErrors) : $aErrors;
    }
    public function hasFieldError() {
        return isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aFieldErrors'][md5($this->oProp->sClassName) ]);
    }
    public function setSettingNotice($sMessage, $sType = 'error', $asAttributes = array(), $bOverride = true) {
        $GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices'] = $this->oUtil->getElement($GLOBALS, array('aCustomScrollbar_AdminPageFramework', 'aNotices'), array());
        if (empty($GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices'])) {
            add_action('shutdown', array($this, '_replyToSaveNotices'));
        }
        $_sID = md5(trim($sMessage));
        if ($bOverride || !isset($GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices'][$_sID])) {
            $_aAttributes = $this->oUtil->getAsArray($asAttributes);
            if (is_string($asAttributes) && !empty($asAttributes)) {
                $_aAttributes['id'] = $asAttributes;
            }
            $GLOBALS['aCustomScrollbar_AdminPageFramework']['aNotices'][$_sID] = array('sMessage' => $sMessage, 'aAttributes' => $_aAttributes + array('class' => $sType, 'id' => $this->oProp->sClassName . '_' . $_sID,),);
        }
    }
    public function hasSettingNotice($sType = '') {
        $_aNotices = $this->oUtil->getElementAsArray($GLOBALS, array('aCustomScrollbar_AdminPageFramework', 'aNotices'), array());
        if (!$sType) {
            return ( bool )count($_aNotices);
        }
        foreach ($_aNotices as $aNotice) {
            if (!isset($aNotice['aAttributes']['class'])) {
                continue;
            }
            if ($aNotice['aAttributes']['class'] == $sType) {
                return true;
            }
        }
        return false;
    }
}