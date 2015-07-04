<?php
/**
 Admin Page Framework v3.5.10b by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class CustomScrollbar_AdminPageFramework_FormOutput extends CustomScrollbar_AdminPageFramework_WPUtility {
    protected function _getFieldContainerAttributes($aField, $aAttributes = array(), $sContext = 'fieldrow') {
        $_aAttributes = $this->uniteArrays($this->getElementAsArray($aField, array('attributes', $sContext)), $aAttributes);
        $_aAttributes['class'] = $this->generateClassAttribute($this->getElement($_aAttributes, 'class', array()), $this->getElement($aField, array('class', $sContext), array()));
        if ('fieldrow' === $sContext && $aField['hidden']) {
            $_aAttributes['style'] = $this->generateStyleAttribute($this->getElement($_aAttributes, 'style', array()), 'display:none');
        }
        return $this->generateAttributes($_aAttributes);
    }
    protected function _getDescriptions($asDescriptions, $sClassAttribute = 'admin-page-framework-form-element-description') {
        $_aOutput = array();
        foreach ($this->getAsArray($asDescriptions) as $_sDescription) {
            $_aOutput[] = "<p class='{$sClassAttribute}'>" . "<span class='description'>" . $_sDescription . "</span>" . "</p>";
        }
        return implode(PHP_EOL, $_aOutput);
    }
}