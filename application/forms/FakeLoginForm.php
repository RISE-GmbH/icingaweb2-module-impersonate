<?php
/* Icinga Web 2 | (c) 2013 Icinga Development Team | GPLv2+ */
/* icingaweb2-module-impersonate | (c) 2022 | GPLv2+ */
namespace Icinga\Module\Impersonate\Forms;

use Icinga\Application\Hook\AuthenticationHook;
use Icinga\Authentication\Auth;
use Icinga\User;
use Icinga\Web\Url;
use Icinga\Forms\Authentication\LoginForm;
use Icinga\Application\Hook\AuditHook;

/**
 * Form for user authentication
 */
class FakeLoginForm extends LoginForm
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->setSubmitLabel($this->translate('Impersonate'));
        $this->setProgressLabel($this->translate('Faking logging in'));
    }
    /**
     * {@inheritdoc}
     */
    public function createElements(array $formData)
    {
        $this->addElement(
            'text',
            'username',
            array(
                'autocapitalize'    => 'off',
                'autocomplete'      => 'username',
                'class'             => false === isset($formData['username']) ? 'autofocus' : '',
                'placeholder'       => $this->translate('Username'),
                'required'          => true,
                'style' => "margin-bottom:10px"
            )
        );
    }

    public function getRedirectUrl()
    {
        return Url::fromPath("/");
    }

    public function onSuccess()
    {
        $auth = Auth::getInstance();
        $oldUsername = $auth->getUser()->getUserName();
        AuditHook::logActivity('login-impersonate',sprintf("User logged in as %s", $this->getElement('username')->getValue()), null, $oldUsername);
        $authChain = $auth->getAuthChain();
        $authChain->setSkipExternalBackends(true);
        $user = new User($this->getElement('username')->getValue());
        $auth->setAuthenticated($user);
        AuthenticationHook::triggerLogin($user);
        $this->getResponse()->setRerenderLayout(true);
        return true;

    }

}