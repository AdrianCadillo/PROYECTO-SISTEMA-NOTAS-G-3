<?php 
namespace Http\pageextras;

use lib\View;

class PageExtra
{
    /// redireccionar a una página de no autorizado

    public static function PageNoAutorizado()
    {
     View::View("pageExtra.no-autorizado");
    }

    /// error 403

    public static function Page403()
    {
        View::View("pageExtra.page403");
    }

}