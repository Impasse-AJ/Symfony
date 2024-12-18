<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class PlantillasController extends AbstractController
{
    #[Route('/factorial/{num}', name: 'factorial')]
    public function factorial($num = null)
    {
        if ($num === null || !is_numeric($num) || $num < 0) {
            $resultado = -1;
        } else {
            $factorial = 1;
            for ($i = 1; $i <= $num; $i++) {
                $factorial *= $i;
            }
            $resultado = $factorial;
        }

        return $this->render('factorial.html.twig', [
            'resultado' => $resultado,
        ]);
    }

    #[Route('/converter/{temperature}', name: 'converter')]
    public function converter($temperature = null)
    {
        // Manejar el caso en que no se proporciona ninguna temperatura
        if ($temperature === null  || $temperature > 10000) {
            $error= 'El numero introducido no es valido o es demasiado grande.';
            return $this->render('converter.html.twig', [
                'temperature' => null,
                'error' => $error
            ]);
        }

        return $this->render('converter.html.twig', [
            'temperature' => $temperature,
            'error' => null
        ]);
    }
}
