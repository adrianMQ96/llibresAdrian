<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\DBProvaLlibres;
class LlibreController extends AbstractController{

    private $llibres;
    public function __construct(DBProvaLlibres $dades)
    {
        $this->llibres = $dades->get();
    }

    /**
    * @Route("/llibre/{isbn}", name="fitxa_llibre")
    */
    public function fitxa($isbn){
        $resultat = array_filter($this->llibres,function($llibre) use ($isbn){
            return $llibre["isbn"] == $isbn;
        });
        if (count($resultat) > 0){
            return $this->render('fitxa_llibre.html.twig',
            array('llibre' =>
            array_shift($resultat)));
        }
        return $this->render('fitxa_llibre.html.twig',
                         array('llibre' => NULL));
    }
}
?>