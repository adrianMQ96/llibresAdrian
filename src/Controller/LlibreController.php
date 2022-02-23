<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
class LlibreController{

    private $llibres = array(
        array("isbn" => "A111B3", "titol" => "El joc d'Ender",
                "autor" =>"Orson Scott Card", "pàgines" => 350),
        array("isbn" => "A111B4", "titol" => "El nom del vent",
                "autor" =>"Patrick Rothfuss", "pàgines" => 662),
        array("isbn" => "A111B3", "titol" => "The final empire",
                "autor" =>"Brandon Sanderson", "pàgines" => 541)
    );

    /**
    * @Route("/llibre/{isbn}", name="fitxa_llibre")
    */
    public function fitxa($isbn){
        $resultat = array_filter($this->llibres,function($llibre) use ($isbn){
            return $llibre["isbn"] == $isbn;
        });
        if (count($resultat) > 0){
            $resposta = "";
            $resultat = array_shift($resultat);
            $resposta .= "<ul>
            <li>".$resultat["isbn"]."</li><li>".$resultat["titol"]."</li>
            </ul>";
            return new Response("<html><body>$resposta</body></html>");
        }
        return new Response("Llibre no trobat");
    }
}
?>