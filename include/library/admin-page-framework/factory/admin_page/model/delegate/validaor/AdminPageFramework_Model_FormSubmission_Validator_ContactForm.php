<?php
class CustomScrollbar_AdminPageFramework_Model_FormSubmission_Validator_ContactForm extends CustomScrollbar_AdminPageFramework_Model_FormSubmission_Validator_Base {
    public $sActionHookPrefix = 'try_validation_before_';
    public $iHookPriority = 10;
    public $iCallbackParameters = 5;
    public function _replyToCallback($aInputs, $aRawInputs, array $aSubmits, $aSubmitInformation, $oFactory) {
        $_bConfirmedToSendEmail = ( bool )$this->_getPressedSubmitButtonData($aSubmits, 'confirmed_sending_email');
        if (!$_bConfirmedToSendEmail) {
            return;
        }
        $this->_sendEmailInBackground($aInputs, $this->getElement($aSubmitInformation, 'input_name'), $this->getElement($aSubmitInformation, 'section_id'));
        $this->oFactory->oProp->_bDisableSavingOptions = true;
        $this->deleteTransient('apf_tfd' . md5('temporary_form_data_' . $this->oFactory->oProp->sClassName . get_current_user_id()));
        add_action("setting_update_url_{$this->oFactory->oProp->sClassName}", array($this, '_replyToRemoveConfirmationQueryKey'));
        $_oException = new Exception('aReturn');
        $_oException->aReturn = $aInputs;
        throw $_oException;
    }
    private function _sendEmailInBackground($aInputs, $sPressedInputNameFlat, $sSubmitSectionID) {
        $_sTranskentKey = 'apf_em_' . md5($sPressedInputNameFlat . get_current_user_id());
        $_aEmailOptions = $this->getTransient($_sTranskentKey);
        $this->deleteTransient($_sTranskentKey);
        $_aEmailOptions = $this->getAsArray($_aEmailOptions) + array('to' => '', 'subject' => '', 'message' => '', 'headers' => '', 'attachments' => '', 'is_html' => false, 'from' => '', 'name' => '',);
        $_sTransientKey = 'apf_emd_' . md5($sPressedInputNameFlat . get_current_user_id());
        $_aFormEmailData = array('email_options' => $_aEmailOptions, 'input' => $aInputs, 'section_id' => $sSubmitSectionID,);
        $_bIsSet = $this->setTransient($_sTransientKey, $_aFormEmailData, 100);
        wp_remote_get(add_query_arg(array('apf_action' => 'email', 'transient' => $_sTransientKey,), admin_url($GLOBALS['pagenow'])), array('timeout' => 0.01, 'sslverify' => false,));
        $_bSent = $_bIsSet;
        $this->oFactory->setSettingNotice($this->oFactory->oMsg->get($this->getAOrB($_bSent, 'email_scheduled', 'email_could_not_send')), $this->getAOrB($_bSent, 'updated', 'error'));
    }
    public function _replyToRemoveConfirmationQueryKey($sSettingUpdateURL) {
        return remove_query_arg(array('confirmation',), $sSettingUpdateURL);
    }
}