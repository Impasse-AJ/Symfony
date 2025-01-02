<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EjemploFormularioSymfony extends AbstractController{
    
    #[Route('/mostrarform')]
    public function mostrar_formulario() {
        return $this->render("mostrarform.html.twig");
    }

    #[Route('/procesa', name:'procesa')]
    public function procesa() {

        // Compruebo si me llegan los parámetros y están rellenos
        if(isset($_POST["num1"]) && isset($_POST["num2"]) && !empty($_POST["num1"]) && !empty($_POST["num2"])) {

            // Calculo el nº aleatorio
            $res = rand($_POST["num1"],$_POST["num2"]);    

        } else {

            // En caso contrario, muestro un error
            $res = "Ha habido un error";
            
        }
        return $this->render("procesa.html.twig", ["res" => $res]);
    }
 }