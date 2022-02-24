<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\DBProvaLlibres;
use App\Entity\Llibre;
use App\Entity\Editorial;
use Doctrine\Persistence\ManagerRegistry;
class LlibreController extends AbstractController{

    /**
    * @Route("/llibre/pagines/{pagines}", name="filtrar_pagines")
    */
    public function filtrar($pagines, ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $query = $entityManager->createQuery(
            'SELECT l FROM App\Entity\Llibre l WHERE l.pagines > :pagines'
            )->setParameter('pagines', $pagines);
            
        if($query->execute() != null){
            return $this->render('inici.html.twig', array(
                'llibres' => $query->execute()));
        }else{
            return $this->render('inici.html.twig', array(
                'llibres' => NULL));
        }
        


    }

    /**
    * @Route("/llibre/inserirAmbEditorial", name="inserir_llibre_amb_editorial")
    */
    public function inserirAmbEditorial(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        $repositori = $doctrine->getRepository(Editorial::class);
        $editorialNom = "Minotauro";
        $isbn ="";
        $query = $entityManager->createQuery(
            'SELECT e FROM App\Entity\Editorial e WHERE e.nom LIKE :text'
            )->setParameter('text', '%' . $editorialNom . '%');

        try{
            if($query->execute() == null){
                $isbn ="8888TTTT";
                $editorial = new Editorial();
                    $editorial->setNom($editorialNom);
                $llibre = new Llibre();
                    $llibre->setIsbn($isbn);
                    $llibre->setTitol("El teu gust");
                    $llibre->setAutor("Isabel Clara Simó");
                    $llibre->setPagines(208);
                    $llibre->setImatge("default.jpg");
    
                $entityManager->persist($editorial);
                $entityManager->persist($llibre);
                $entityManager->flush();
            }else{
                $isbn ="9999TTTT";
                $editorial = $repositori->find(1);
                $llibre = new Llibre();
                    $llibre->setIsbn("9999TTTT");
                    $llibre->setTitol("El teu gust");
                    $llibre->setAutor("Isabel Clara Simó");
                    $llibre->setPagines(208);
                    $llibre->setImatge("default.jpg");
    
                $entityManager->persist($editorial);
                $entityManager->persist($llibre);
                $entityManager->flush();
            }
            return new Response("Llibre amb Editorial inserint llibres amb isbn: " . $isbn);
        }catch(\Exception $e){
            return new Response("Error inserint llibre amb Editorial amb isbn: " . $isbn);
        }
        
    }

    /**
    * @Route("/llibre/inserir", name="inserir_llibre")
    */
    public function inserir(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();

        $llibresAdd = array (
            "llibre1" => array (   
                "isbn" => 'A111B3',
                "titol" => 'El joc d\'Ender',
                "autor" => 'Orson Scott Card',
                "pagines" => 350,
                "imatge" => 'eljocdender.jpg'
            ),
            "llibre2" => array (   
                "isbn" => 'A111B4',
                "titol" => 'El nom del vent',
                "autor" => 'Patrick Rothfuss',
                "pagines" => 662,
                "imatge" => 'elnomdelvent.jpg'
            ),
            "llibre3" => array (   
                "isbn" => 'A111B5',
                "titol" => 'The final empire',
                "autor" => 'Brandon Sanderson',
                "pagines" => 541,
                "imatge" => 'theFinalEmpire.jpg'
            )
          );
        
        try{
            $isbnLlibres = "";
            foreach($llibresAdd as $llibreAdd){
                $llibre = new Llibre();
                $llibre->setIsbn($llibreAdd['isbn']);
                $llibre->setTitol($llibreAdd['titol']);
                $llibre->setAutor($llibreAdd['autor']);
                $llibre->setPagines($llibreAdd['pagines']);
                $llibre->setImatge($llibreAdd['imatge']);

                $isbnLlibres .=$llibreAdd['isbn']." ";

                $entityManager->persist($llibre);
            }
            $entityManager->flush();
            return new Response("Llibres inserits amb isbn " . $isbnLlibres);
        }catch(\Exception $e){
            return new Response("Error inserint llibres amb isbn " . $isbnLlibres);
        }
        
    }

    /**
    * @Route("/llibre/{isbn}", name="fitxa_llibre")
    */
    public function fitxa($isbn, ManagerRegistry $doctrine)
    {
        $repositori = $doctrine->getRepository(Llibre::class);
        $llibre = $repositori->find($isbn);

        if($llibre){
            return $this->render('fitxa_llibre.html.twig',
                            array('llibre' => $llibre));
        }else{
            return $this->render('fitxa_llibre.html.twig',
                            array('llibre' => NULL));
        }

        
    }

    
}
?>