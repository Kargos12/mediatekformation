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
     * @param EntityManagerInterface
     */
    function __construct(NiveauxRepository $repository, EntityManagerInterface $om){
        $this->repository = $repository;
        $this->om = $om;
    }
    
    /**
     * @Route("/adminniveaux", name="adminniveaux")
     * @return Response
    */
    public function index(): Response{
        $niveau = $this->repository->findAll();
        return $this->render("pages/adminniveaux.html.twig", [
            'niveaux' => $niveau
        ]);
    }
        
    /**
     * Suppression d'un niveau
     * @Route("/adminniveaux/suppr/{id}", name="adminniveaux.suppr")
     * @param Niveaux $niveau
     * @return Response
    */
    public function suppr (Niveaux $niveau): Response {
        $this->om->remove($niveau);
        $this->om->flush();
        return $this->redirectToRoute('adminniveaux');
    }
    
    /**
     * @route("adminniveaux/ajout", name="adminniveaux.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request):Response{
        $nomNiveau=$request->get("nom");
        $niveau = new Niveaux();
        $niveau->setNom($nomNiveau);
        $this->om->persist($niveau);
        $this->om->flush();
        return $this->redirectToRoute('adminniveaux');
    }
}
