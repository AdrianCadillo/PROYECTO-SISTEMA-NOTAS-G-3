<?php 
use lib\BaseController;
class DashboardController extends BaseController
{
  /// inicializar el contructor
 public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $this->View("dashboard");
  }
}
