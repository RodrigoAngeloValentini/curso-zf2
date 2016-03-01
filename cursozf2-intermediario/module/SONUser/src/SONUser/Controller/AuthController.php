<?php
namespace SONUser\Controller;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage;
use SONUser\Form\Login as LoginForm;
class AuthController extends AbstractActionController
{

    public function indexAction()
    {
        $form = new LoginForm();
        $request = $this->getRequest();
        $error = false;

        if($request->isPost())
        {
            $form->setData($request->getPost());
            if($form->isValid())
            {
                $data = $request->getPost()->toArray();
                //Criando Storage para gravar sessão da autenticação
                $sessionStorage = new SessionStorage('SONUser');

                $auth = new AuthenticationService();
                $auth->setStorage($sessionStorage); //Define o Storage utilizado no Auth

                $authAdapter = $this->getServiceLocator()->get('SONUser\Auth\Adapter');
                $authAdapter->setUsername($data['email']);
                $authAdapter->setPassword($data['password']);

                $result = $auth->authenticate($authAdapter);
                if($result->isValid())
                {
                    $user = $auth->getIdentity();
                    $sessionStorage->write($user['user'], null);

                    return $this->redirect()->toRoute('sonuser-admin/default', array('controller'=>'users'));
                }
                else
                    $error = true;

            }
        }
        return new ViewModel(array('form'=>$form, 'error'=>$error));
    }

    public function logoutAction()
    {
        $auth = new AuthenticationService();
        $auth->setStorage(new SessionStorage('SONUser'));
        $auth->clearIdentity();

        return $this->redirect()->toRoute('sonuser-auth');
    }

}