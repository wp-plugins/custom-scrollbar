<?php
/**
 Admin Page Framework v3.5.10b by Michael Uno
 Generated by PHP Class Files Script Generator <https://github.com/michaeluno/PHP-Class-Files-Script-Generator>
 <http://en.michaeluno.jp/admin-page-framework>
 Copyright (c) 2013-2015, Michael Uno; Licensed under MIT <http://opensource.org/licenses/MIT>
 */
abstract class CustomScrollbar_AdminPageFramework_Form_Model_Export extends CustomScrollbar_AdminPageFramework_Form_Model_Import {
    protected function _exportOptions($mData, $sPageSlug, $sTabSlug) {
        $_oExport = new CustomScrollbar_AdminPageFramework_ExportOptions($_POST['__export'], $this->oProp->sClassName);
        $_aArguments = array('class_name' => $this->oProp->sClassName, 'page_slug' => $sPageSlug, 'tab_slug' => $sTabSlug, 'section_id' => $_oExport->getSiblingValue('section_id'), 'pressed_field_id' => $_oExport->getSiblingValue('field_id'), 'pressed_input_id' => $_oExport->getSiblingValue('input_id'),);
        $_mData = $this->_getFilteredExportingData($_aArguments, $_oExport->getTransientIfSet($mData));
        $_sFileName = $this->_getExportFileName($_aArguments, $_oExport->getFileName(), $_mData);
        $_oExport->doExport($_mData, $this->_getExportFormatType($_aArguments, $_oExport->getFormat()), $this->_getExportHeaderArray($_aArguments, $_sFileName, $mData));
        exit;
    }
    private function _getExportHeaderArray(array $aArguments, $sFileName, $mData) {
        $_aHeader = array('Content-Description' => 'File Transfer', 'Content-Disposition' => "attachment; filename=\"{$sFileName}\";",);
        return $this->oUtil->addAndApplyFilters($this, $this->_getPortFilterHookNames('export_header_', $aArguments), $_aHeader, $aArguments['pressed_field_id'], $aArguments['pressed_input_id'], $mData, $sFileName, $this);
    }
    private function _getFilteredExportingData(array $aArguments, $mData) {
        return $this->_getFilteredItemForPortByPrefix('export_', $mData, $aArguments);
    }
    private function _getExportFileName(array $aArguments, $sExportFileName, $mData) {
        return $this->oUtil->addAndApplyFilters($this, $this->_getPortFilterHookNames('export_name_', $aArguments), $sExportFileName, $aArguments['pressed_field_id'], $aArguments['pressed_input_id'], $mData, $this);
    }
    private function _getExportFormatType(array $aArguments, $sExportFileFormat) {
        return $this->_getFilteredItemForPortByPrefix('export_format_', $sExportFileFormat, $aArguments);
    }
}