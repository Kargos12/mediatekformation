<?php
namespace App\Controller;

use App\Entity\Formation;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
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
    function __construct(FormationRepository $repository,EntityManagerInterface $om) {
        $this->repository = $repository;
        $this->om = $om;
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
     * @Route("/administration/tri/{champ}/{ordre}", name="administration.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sort($champ, $ordre): Response{
        $formations = $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render("pages/administration.html.twig", [
            'formations' => $formations
            ]);
    }   
    
     /**
     * @Route("/administration/recherche/{champ}", name="administration.findallcontain")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllContain($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $formations = $this->repository->findByContainValue($champ, $valeur);
            return $this->render("pages/administration.html.twig", [
            'formations' => $formations
            ]);
        }
        return $this->redirectToRoute("formations");
    }  
    
    /**
     * 
     * @var EntityManagerInterface
     */
    private $om;
    
    /**
     * Suppression d'une formation
     * @Route("administration/suppr/{id}", name="administration.suppr")
     * @param Formation $formation
     * @return Response
     */
    public function suppr (Formation $formation) : Response {
        $this->om->remove($formation);
        $this->om->flush();
        return $this->redirectToRoute("administration");
    }
}
