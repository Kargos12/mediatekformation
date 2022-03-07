<?php

namespace App\Controller;

use App\Entity\Niveaux;
use App\Repository\NiveauxRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminNiveauxController
 *
 * @author Kargos
 */
class AdminNiveauxController extends AbstractController{
    
    private const PAGENIVEAUX = "pages/admin.niveaux.html.twig";
    
    /**
     * 
     * @var NiveauxRepository
     */
    private $repository;
        
    /**
     * 
     * @var EntityManagerInterface
     */
    private $om;
    
    /**
     * 
     * @param NiveauxRepository $repository
     * @param EntityManagerInterface $om
     */
    function _construct(NiveauxRepository $repository, EntityManagerInterface $om){
        $this->repository = $repository;
        $this->om = $om;
    }
    
    /**
     * @Route("/admin/niveaux", name="admin.niveaux")
     * @return Response
    */
    public function index() : Response{
        $niveaux = $this->repository->findAll();
        return $this->render(self::PAGENIVEAUX, [
            'niveaux' => $niveaux
        ]);
    }
        
    /**
     * @Route("/admin/niveaux/suppr/{id}", name="admin.niveaux.suppr")
     * @param Niveaux $Niveaux
     * @return Response
    */
    public function suppr (Niveaux $Niveaux): Response {
        $this->om->remove($niveaux);
        $this->om->flush();
        return $this->redirectToRoute('admin.niveaux');
    }
    
    /**
     * @route("admin/niveaux/ajout", name="admin.niveaux.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request):Response{
        $nomNiveau=$request->get("nom");
        $Niveaux = new Niveaux();
        $Niveaux->setNom($nomNiveau);
        $this->om->persist ($Niveaux);
        $this->om->flush();
        return $this->redirectToRoute('admin.niveaux');
    }
}
