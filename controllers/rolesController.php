<?php
use models\Role;
class rolesController extends Controller
{
    public function __construct()
    {
        $this->validateInAdmin();
        parent::__construct();
    }

    public function index()
    {
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Lista de Roles');
        $this->_view->assign('notice','No hay roles disponibles');
        $this->_view->assign('roles', Role::select('id','nombre')->orderBy('id','desc')->get());
        $this->_view->render('index');
    }

    public function create()
    {
        $this->getMessages();

        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Nuevo Rol');
        $this->_view->assign('process','roles/store');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('create');
    }

    public function store()
    {
        $this->validateForm('roles/create',[
            'nombre' => Filter::getText('nombre'),
        ]);

        $rol = Role::select('id')->where('nombre', Filter::getText('nombre'))->first();

        if($rol){
            Session::set('msg_error','El rol ingresado ya existe... intente con otro');
            $this->redirect('roles/create');
        }

        $rol = new Role;
        $rol->nombre = Filter::getText('nombre');
        $rol->save();

        Session::set('msg_success','El rol se ha registrado correctamente');
        $this->redirect('roles');
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
