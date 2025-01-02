<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class Plantillas2Controller extends AbstractController
{
    #[Route('/pedirDatos')]
    public function formulario() {
        return $this->render("pedirDatos.html.twig");
    }

    #[Route('/procesarDatos',name:'calcImc')]
    public function procesaMacros()
    {
        if(isset($_POST["peso"]) && !empty($_POST["peso"] && $_POST["estatura"]) && !empty($_POST["estatura"])) {
            $estatura=$_POST["estatura"];
            $peso=$_POST["peso"];

            if ($peso > 300 || $estatura < 1.3) {
                $error= 'Estas demasiado grande, introduce un peso real';
                return $this->render('mostrar_resultado.html.twig', [
                    'imc' => null,
                    'error' => $error
                ]); 
            }
            $estatura= $estatura/100;
            $imc = ($peso/($estatura*$estatura));
        }else{
            if (empty($_POST["peso"])|| empty($_POST["estatura"])) {
                $error = 'Por favor, introduce valores numéricos válidos.';
                return $this->render('mostrar_resultado.html.twig', [
                    'imc' => null,
                    'error' => $error
                ]);
            }
        }
        return $this->render('mostrar_resultado.html.twig', [
            'imc' => round($imc,2),
            'error' => null
        ]);
    }
}
