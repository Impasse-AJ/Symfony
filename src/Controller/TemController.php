<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/conversor')]
class TemController extends AbstractController
{

    #[Route('/factorial/{num}')]
    public function factorial($num = null)
    {
        $factorial = 1;
        if ($num == null) {
            return new Response("<html><body>ERES IDIOTA</body></html>");
        } else {
            for ($i = 1; $i <= $num; $i++) {
                $factorial = $factorial * $i;
            }
            return new Response('<html><body>El factorial de ' . $num . ' es ' . $factorial . '</body></html>');
        }
    }

    #[Route('/celsius/{grados}')]
    public function calcularFaren($grados = null)
    {

        if ($grados == null || $grados < -273.15) {
            return $this->redirectToRoute(route: 'error');
        } else {
            $faren = ($grados * 9 / 5) + 32;
            return new Response('<html><body>Conversion grados Fahrenheit: ' . $faren . '</body></html>');
        }
    }

    #[Route('/fahrenhit/{faren}')]
    public function calcularCelsius($faren = null)
    {
        if ($faren == null || $faren < -459.67) {
            return $this->redirectToRoute(route: 'error');
        }
        $celsius = ($faren - 32) * 5 / 9;
        return new Response('<html><body>Conversion grados Celsius: ' . $celsius . 'º</body></html>');
    }

    #[Route('/error', name: 'error')]
    public function controlErrores()
    {
        return new Response('<html><body>ERROR: Temperatura por debajo de los 0 grados</body></html>');
    }
}
