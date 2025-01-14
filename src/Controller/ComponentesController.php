<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
// ===== MUCHO CUIDADO, si no incluyes la entidad y el componente Doctrine, no funcionará =====
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Equipo;

class ComponentesController extends AbstractController
{

	#[Route('/equipo/{id}')]
	public function mostrar_equipo(EntityManagerInterface $entityManager, $id = null)
	{
		if ($id === null) {
			$mensaje = "No se ha seleccionado ningun id, porfavor envie un parametro valido";
			return $this->render('equipo.html.twig', ['mensaje' => $mensaje]);
		}
		$equipo = $entityManager->find(Equipo::class, $id);
		if (!$equipo) {
			$mensaje = "Equipo no encontrado";
			return $this->render('equipo.html.twig', ['mensaje' => $mensaje]);
		} else {
			$nombre = $equipo->getNombre();
			$funda = $equipo->getFundacion();
			$ciudad = $equipo->getCiudad();
			$socios = $equipo->getSocios();
			$num_jugadores = $equipo->getJugadores();
			$lista= null;
			if ($num_jugadores === null || $num_jugadores->isEmpty()) {
				$lista = "<p>No hay jugadores registrados en este equipo.</p>";
			}			
			else{
				$lista = "<ul>";
				foreach ($num_jugadores as $jugador) {
					$lista .= "<li>" . htmlspecialchars($jugador->getNombre()) . " " .
						htmlspecialchars($jugador->getApellidos()) . " " . htmlspecialchars($jugador->getEdad()) . "</li>";
				}
				$lista .= "</ul>";
				
			}
			return $this->render('equipo.html.twig', ['mensaje' => null, 'id' => $id, 'nombre' => $nombre, 'funda' => $funda, 'ciudad' => $ciudad, 'socios' => $socios, 'jugadores' => $lista]);
		}
	}
}
