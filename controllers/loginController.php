<?php
use models\Usuario;

final class loginController extends Controller
{
    public function __construct()
    {
        parent::__construct();    
    }

    public function login()
    {
        $this->getMessages();

        $this->_view->assign('title','Login');
        $this->_view->assign('asunto','Acceso Usuario');
        $this->_view->assign('process','login/store');
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        
        $this->_view->render('login');
    }

    public function store()
    {
        $this->validateForm('login/login',[
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'password' => Filter::getSql('password')
        ]);

        $usuario = Usuario::with('role')
            ->where('email', Filter::getPostParam('email'))
            ->where('password', Helper::encryptPassword(Filter::getPostParam('password')))
            ->where('activo', 1)
            ->first();

        if (!$usuario) {
            Session::set('msg_error','El email o la password no están registrados');
            $this->redirect('login/login');
        }

        Session::set('authenticate', true);
        Session::set('usuario_id', $usuario->id);
        Session::set('usuario_nombre', $usuario->nombre);
        Session::set('usuario_email', $usuario->email);
        Session::set('usuario_role', $usuario->role->nombre);
        Session::set('time', time());

        Session::set('msg_success','Bienvenid@ ' . Session::get('usuario_nombre'));
        $this->redirect();
    }

    public function logout()
    {
        Session::destroy();
        $this->redirect();
    }
}
