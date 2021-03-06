<?php
abstract class CustomScrollbar_AdminPageFramework_CustomSubmitFields extends CustomScrollbar_AdminPageFramework_WPUtility {
    public $aPost = array();
    public $sInputID;
    public function __construct(array $aPostElement) {
        $this->aPost = $aPostElement;
        $this->sInputID = $this->getInputID($aPostElement['submit']);
    }
    protected function getSubmitValueByType($aElement, $sInputID, $sElementKey = 'format') {
        return $this->getElement($aElement, array($sInputID, $sElementKey), null);
    }
    public function getSiblingValue($sKey) {
        return $this->getSubmitValueByType($this->aPost, $this->sInputID, $sKey);
    }
    public function getInputID($aSubmitElement) {
        foreach ($aSubmitElement as $sInputID => $v) {
            $this->sInputID = $sInputID;
            return $this->sInputID;
        }
    }
}