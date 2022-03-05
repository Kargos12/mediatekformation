<?php
namespace App\Controller;

use App\Repository\FormationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdministrationController
 *
 * @author Kargos
 */
class AdministrationController extends AbstractController{
    
        /**
     *
     * @var FormationRepository
     */
    private $repository;
    
    /**
     * 
     * @param FormationRepository $repository
     */
    function __construct(FormationRepository $repository) {
        $this->repository = $repository;
    }
    
    /**
     * @Route("/administration", name="administration")
     * @return Response
     */
    public function index(): Response{
        $formations = $this->repository->findAll();
        return $this->render("pages/administration.html.twig", [
            'formations' => $formations
        ]);
    }
    
    /**
     * @Route("/administration", name="administration")
     * @return Response
     
    public function index(): Response{
        return $this->render("pages/administration.html.twig", [
        ]);  
    }*/
    
}
