<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\DBProvaLlibres;
use App\Entity\Llibre;
use Doctrine\Persistence\ManagerRegistry;
class IniciController extends AbstractController{
    // private $llibres;
    // public function __construct($bdProva)
    // {
    //     $this->llibres = $bdProva->get();
    // }
    /**
    * @Route("/", name="inici")
    */
    public function inici(ManagerRegistry $doctrine){
        $repositori = $doctrine->getRepository(Llibre::class);
        $llibres = $repositori->findAll();

        return $this->render('inici.html.twig', array(
            'llibres' => $llibres));
    }
}
?>