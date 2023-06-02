<?php
use models\Usuario;
use models\Role;

class usuariosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Lista de Usuarios');
        $this->_view->assign('notice','No hay usuarios disponibles');
        $this->_view->assign('usuarios', Usuario::with('role')->orderBy('id','desc')->get());
        $this->_view->render('index');
    }

    public function create()
    {
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Nuevo Usuario');
        $this->_view->assign('process','usuarios/store');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('create');
    }

    public function store()
    {
        $this->validateForm('usuarios/create',[
            'run' => Filter::getText('rut'),
            'nombre' => Filter::getText('nombre'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'password' => Filter::getSql('password'),
            'rol' => Filter::getText('rol')
        ]);

        $usuario = Usuario::select('id')
            ->where('run', Filter::getText('run'))
            ->where('email', Filter::getPostParam('email'))
            ->first();

        if($usuario){
            Session::set('msg_error','El usuario ingresado ya existe... intente con otro');
            $this->redirect('usuarios/create');
        }

        $usuario = new Usuario;
        $usuario->run = Filter::getText('run');
        $usuario->nombre = Filter::getText('nombre');
        $usuario->email = Filter::getPostParam('email');
        $usuario->password = Helper::encryptPassword(Filter::getSql('password'));
        $usuario->activo = 1;//activo
        $usuario->role_id = Filter::getInt('rol');
        $usuario->save();

        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect('usuarios');
    }

    public function show($id = null)
    {
        Validate::validateModel(Role::class, $id, 'error/error');

        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Detalle Rol');
        $this->_view->assign('role', Role::find(Filter::filterInt($id)));
        $this->_view->render('show');
    }

    public function edit($id = null)
    {
        Validate::validateModel(Role::class, $id, 'error/error');

        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Editar Rol');
        $this->_view->assign('role', Role::find(Filter::filterInt($id)));
        $this->_view->assign('process',"roles/update/{$id}");
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validatePUT();
        $this->validateForm("roles/edit/{$id}",[
            'nombre' => Filter::getText('nombre'),
        ]);

        $rol = Role::find(Filter::filterInt($id));
        $rol->nombre = Filter::getText('nombre');
        $rol->save();

        Session::set('msg_success','El rol se ha modificado correctamente');
        $this->redirect('roles/show/' . $id);
    }
}
