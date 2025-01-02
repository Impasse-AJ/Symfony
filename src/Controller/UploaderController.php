<?php
// src/Controller/UploaderController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class UploaderController extends AbstractController
{
    #[Route('/caracola', name: 'formulario_uploader')]
    public function formularioUploader()
    {
        return $this->render('formulario_uploader.html.twig');
    }

    #[Route('/', name: 'procesa_subida')]
    public function procesaSubida(Request $request)
    {
        $archivo = $request->files->get('archivo');
        $mensaje = '';
        
        if ($archivo) {
            // Validar tipo de archivo
            $tiposPermitidos = ['image/jpeg', 'image/png', 'image/gif', 'application/pdf'];
            if (!in_array($archivo->getMimeType(), $tiposPermitidos)) {
                $mensaje = 'Solo se permiten imágenes (JPEG, PNG, GIF) o documentos PDF.';
                return $this->render('resultado_uploader.html.twig', ['mensaje' => $mensaje]);
            }

            // Mover archivo a la carpeta de destino
            $carpetaDestino = $this->getParameter('kernel.project_dir') . '/public/uploads';
            try {
                $nombreArchivo = uniqid() . '.' . $archivo->guessExtension();
                $archivo->move($carpetaDestino, $nombreArchivo);
                $mensaje = 'Archivo subido con éxito: ' . $nombreArchivo;
            } catch (FileException $e) {
                $mensaje = 'Hubo un error al subir el archivo: ' . $e->getMessage();
            }
        } else {
            $mensaje = 'No se recibió ningún archivo.';
        }

        return $this->render('resultado_uploader.html.twig', ['mensaje' => $mensaje]);
    }
}