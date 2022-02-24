<?php
namespace App\Service;
class DBProvaLlibres
{
    private $llibres = array(
        array("isbn" => "A111B3", "titol" => "El joc d'Ender",
                "autor" =>"Orson Scott Card", "pagines" => 350, "imatge" => "eljocdender.jpg"),
        array("isbn" => "A111B4", "titol" => "El nom del vent",
                "autor" =>"Patrick Rothfuss", "pagines" => 662, "imatge" => "elnomdelvent.jpg"),
        array("isbn" => "A111B5", "titol" => "The final empire",
                "autor" =>"Brandon Sanderson", "pagines" => 541, "imatge" => "theFinalEmpire.jpg")
    );
public function get()
{
return $this->llibres;
}
}
?>