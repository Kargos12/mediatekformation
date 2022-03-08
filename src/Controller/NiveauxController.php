<?php
namespace App\Controller;

use App\Repository\NiveauxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of NiveauxController
 *
 * @author Kargos
 */
class NiveauxController extends AbstractController {
    
    private const PAGENIVEAUX = "pages/adminniveaux.html.twig";

    /**
     *
     * @var NiveauxRepository
     */
    private $repository;

    /**
     * 
     * @param NiveauxRepository $repository
     */
    function __construct(NiveauxRepository $repository) {
        $this->repository = $repository;
    }

    /**
     * @Route("/adminniveaux", name="adminniveaux")
     * @return Response
     */
    public function index(): Response{
        $niveaux = $this->repository->findAll();
        return $this->render("pages/adminniveaux.html.twig", [
            'niveaux' => $niveaux
        ]);
    }
    
    /**
     * @Route("/adminniveaux/tri/{champ}/{ordre}", name="adminniveaux.sort")
     * @param type $champ
     * @param type $ordre
     * @return Response
     */
    public function sort($champ, $ordre): Response{
        $niveaux= $this->repository->findAllOrderBy($champ, $ordre);
        return $this->render(self::PAGENIVEAUX, [
           'niveaux' => $niveaux
        ]);
    }   
        
    /**
     * @Route("/adminniveaux/recherche/{champ}", name="adminniveaux.findallcontain")
     * @param type $champ
     * @param Request $request
     * @return Response
     */
    public function findAllContain($champ, Request $request): Response{
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
            $niveaux = $this->repository->findByContainValue($champ, $valeur);
            return $this->render(self::PAGENIVEAUX, [
                'niveaux' => $niveaux
            ]);
        }
        return $this->redirectToRoute("adminniveaux");
    }  
    
    /**
     * @Route("/adminniveaux/niveau/{id}", name="adminniveaux.showone")
     * @param type $id
     * @return Response
    */
    
    public function showOne($id): Response{
        $niveau = $this->repository->find($id);
        return $this->render("pages/adminniveaux.html.twig", [
            'niveaux' => $niveaux
        ]);        
    }
}
