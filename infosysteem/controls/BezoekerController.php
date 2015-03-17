<?php
    namespace infosysteem\controls;
    use infosysteem\models as MODELS;
    use infosysteem\view as VIEW;

class BezoekerController  
{
    private $action;
    private $control;
    private $view;
    private $model;
    
    public function __construct($control,$action)
    {
        $this->control = $control;
        $this->action = $action;

        $this->view=new VIEW\View();     
        $this->model = new MODELS\BezoekerModel();       
    }
    
    public function execute() 
    {
        $opdracht = $this->action.'Action';
        if(!method_exists($this,$opdracht))
        {
            $opdracht = 'defaultAction';
            $this->action = 'default';
        }
        $this->$opdracht();
        $this->view->setAction($this->action);
        $this->view->setControl($this->control);
        $this->view->toon();
    }
    
    public function forward($action, $control)
    {
        $klasseNaam = __NAMESPACE__.'\\'.ucFirst($control).'Controller';
        $controller = new $klasseNaam($control,$action);
        $controller->execute();
        exit();
    }
    
    private function inloggenAction()
    {
        if($this->model->isPostLeeg())
        {
           $this->view->set("opmerking","Vul uw gegevens in");
        }
        else
        {   
            $resultInlog=$this->model->controleerInloggen();
            
            switch($resultInlog)
            {
                case "GELUKT":
                    $this->model->setIp();
                    $this->forwardRecht();
                    break;
                case "MISLUKT":
                    $this->view->set("opmerking","Inloggen mislukt");
                    break;
                case "ONVOLLEDIG":
                    $this->view->set("opmerking","Niet alle gegevens ingevuld");
                    break;
            }
        }
    }
    
    private function forwardRecht()
    {
        $recht = $this->model->geefRecht();
        switch ($recht)
        {
            case "admin":
                $this->forward("default", "admin"); 
                break;
            case "stage":
                $this->forward("default", "stage");
                break;
            case "klant":
                $this->forward("default", "klant");
                break;
        } 
    }
    
    private function defaultAction()
    {
       if($this->model->isPostLeeg())
       {
           $this->view->set("opmerking","Voer gegevens in");
       }
       else
       {
           $this->inloggenAction();
       } 
       
    }
}
