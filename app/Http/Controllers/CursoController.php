<?php 
use lib\BaseController;

class CursoController extends BaseController
{
  public function __construct()
  {
    parent::__construct();
  }

  /// método index para mostrar la vista de cursos

  public function index()
  {
    $this->View("cursos.index");
  }
}