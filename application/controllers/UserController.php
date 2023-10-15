<?php
/* icingaweb2-module-impersonate | (c) 2022 | GPLv2+ */
namespace Icinga\Module\Impersonate\Controllers;

use Icinga\Web\Url;
use Icinga\Module\Impersonate\Forms\FakeLoginForm;
use Icinga\Web\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        $this->assertPermission("impersonate/user");
        $this->getTabs()->add('Impersonate', array(
            'title' => 'Impersonate',
            'label' => 'Impersonate',
            'url'   => Url::fromPath('impersonate/user')
        ))->activate('Impersonate');

        $form = new FakeLoginForm();
        $form->handleRequest();

        $this->view->form = $form;
        $this->view->title = $this->translate('changeuser');
    }

}
