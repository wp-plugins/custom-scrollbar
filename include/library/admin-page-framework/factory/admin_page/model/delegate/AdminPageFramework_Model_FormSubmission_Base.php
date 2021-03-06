<?php
abstract class CustomScrollbar_AdminPageFramework_Model_FormSubmission_Base extends CustomScrollbar_AdminPageFramework_Format_Base {
    protected function _getPressedSubmitButtonData(array $aPostElements, $sTargetKey = 'field_id') {
        foreach ($aPostElements as $_sInputID => $_aSubElements) {
            if (!isset($_aSubElements['name'])) {
                continue;
            }
            $_aNameKeys = explode('|', $_aSubElements['name']);
            if (null === $this->getElement($_POST, $_aNameKeys, null)) {
                continue;
            }
            return $this->getElement($_aSubElements, $sTargetKey, null);
        }
        return null;
    }
    protected function _setSettingNoticeAfterValidation($bIsInputEmtpy) {
        if ($this->oFactory->hasSettingNotice()) {
            return;
        }
        $this->oFactory->setSettingNotice($this->getAOrB($bIsInputEmtpy, $this->oFactory->oMsg->get('option_cleared'), $this->oFactory->oMsg->get('option_updated')), $this->getAOrB($bIsInputEmtpy, 'error', 'updated'), $this->oFactory->oProp->sOptionKey, false);
    }
}