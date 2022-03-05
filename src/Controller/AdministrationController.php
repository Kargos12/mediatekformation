<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdministrationController
 *
 * @author Kargos
 */
class AdministrationController extends AbstractController{
    
    
    /**
     * @Route("/administration", name="administration")
     * @return Response
     */
    public function index(): Response{
        return $this->render("pages/administration.html.twig", [
        ]);  
    }
    
}
