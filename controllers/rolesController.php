<?php

class rolesController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->getMessages();

        $roles = array(
            array('id' => 1, 'nombre' => 'Administrador' ),
            array('id' => 2, 'nombre' => 'Periodista' ),
        );
        $this->_view->assign('title','Roles');
        $this->_view->assign('asunto','Lista de Roles');
        $this->_view->assign('notice','No hay roles disponibles');
        $this->_view->assign('roles', $roles);
        $this->_view->render('index');
    }
}
