<?php
/**
 * @copyright Ilch 2.0
 */

namespace Modules\Twitterauth\Controllers\Admin;

class Index extends Base
{
    public function indexAction()
    {
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('twitterauth.menu.signinwithtwitter'), ['action' => 'index'])
                ->add($this->getTranslator()->trans('twitterauth.menu.apikeys'), ['action' => 'index']);

        $output = [
            'consumerKey' => $this->getConfig()->get('twitterauth_consumer_key'),
            'consumerSecret' => $this->getConfig()->get('twitterauth_consumer_secret'),
            'accessToken' => $this->getConfig()->get('twitterauth_access_token'),
            'accessTokenSecret' => $this->getConfig()->get('twitterauth_access_token_secret'),
        ];

        $this->getView()->set('twitterauth', $output);
    }

    public function saveAction()
    {
        if ($this->getRequest()->isPost()) {
            $this->getConfig()->set('twitterauth_consumer_key', $this->getRequest()->getPost('consumerKey'));
            $this->getConfig()->set('twitterauth_consumer_secret', $this->getRequest()->getPost('consumerSecret'));
            $this->getConfig()->set('twitterauth_access_token', $this->getRequest()->getPost('accessToken'));
            $this->getConfig()->set('twitterauth_access_token_secret', $this->getRequest()->getPost('accessTokenSecret'));
            $this->addMessage('saveSuccess');
        }

        $this->redirect(['action' => 'index']);
    }
}
