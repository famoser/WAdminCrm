<?php

/**
 * Created by PhpStorm.
 * User: Florian Moser
 * Date: 09.09.2015
 * Time: 23:43
 */
class ApiController extends ControllerBase
{
    private $request = null;
    private $params = null;

    /**
     * Konstruktor, erstellet den Controller.
     *
     * @param Array $request Array aus $_GET & $_POST.
     */
    public function __construct($request, $requestFiles, $params)
    {
        $this->request = $request;
        $this->params = $params;
    }

    /**
     * Methode zum anzeigen des Contents.
     *
     * @return String Content der Applikation.
     */
    public function Display()
    {
        $view = null;
        if (IsReservedApiAddress($this->params,$this->request))
            $view = GetReservedApiAdressView($this->params, $this->request);

        if ($view == null)
            $view = $this->NotFound();

        return $view->loadTemplate();
    }
}