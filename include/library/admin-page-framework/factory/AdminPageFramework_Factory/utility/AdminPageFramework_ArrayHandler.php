<?php
/**
 Admin Page Framework v3.6.0b07 by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
class CustomScrollbar_AdminPageFramework_ArrayHandler extends CustomScrollbar_AdminPageFramework_WPUtility {
    public $aData = array();
    public function __construct() {
        $_aParameters = func_get_args() + array($this->aData,);
        $this->aData = $_aParameters[0];
    }
    public function get() {
        $_mDefault = null;
        $_aKeys = func_get_args() + array(null);
        if (!isset($_aKeys[0])) {
            return $this->aData;
        }
        if (is_array($_aKeys[0])) {
            $_aKeys = $_aKeys[0];
            $_mDefault = isset($_aKeys[1]) ? $_aKeys[1] : null;
        }
        return $this->getArrayValueByArrayKeys($this->aData, $_aKeys, $_mDefault);
    }
    public function set() {
        $_aParameters = func_get_args();
        if (!isset($_aParameters[0], $_aParameters[1])) {
            return;
        }
        $_asKeys = $_aParameters[0];
        $_mValue = $_aParameters[1];
        if (is_scalar($_asKeys)) {
            $this->aData[$_asKeys] = $_mValue;
            return;
        }
        $this->setMultiDimensionalArray($this->aData, $_asKeys, $_mValue);
    }
    public function delete() {
        $_aParameters = func_get_args();
        if (!isset($_aParameters[0], $_aParameters[1])) {
            return;
        }
        $_asKeys = $_aParameters[0];
        $_mValue = $_aParameters[1];
        if (is_scalar($_asKeys)) {
            $this->aData[$_asKeys] = $_mValue;
            return;
        }
        $this->unsetDimensionalArrayElement($this->aData, $aKeys);
    }
    public function __toString() {
        return $this->getObjectInfo($this);
    }
}