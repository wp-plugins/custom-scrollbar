<?php
class CustomScrollbar_AdminPageFramework_PageLoadInfo_Page extends CustomScrollbar_AdminPageFramework_PageLoadInfo_Base {
    private static $_oInstance;
    private static $aClassNames = array();
    public static function instantiate($oProp, $oMsg) {
        if (in_array($oProp->sClassName, self::$aClassNames)) return self::$_oInstance;
        self::$aClassNames[] = $oProp->sClassName;
        self::$_oInstance = new CustomScrollbar_AdminPageFramework_PageLoadInfo_Page($oProp, $oMsg);
        return self::$_oInstance;
    }
    public function _replyToSetPageLoadInfoInFooter() {
        if ($this->oProp->isPageAdded()) {
            add_filter('update_footer', array($this, '_replyToGetPageLoadInfo'), 999);
        }
    }
}