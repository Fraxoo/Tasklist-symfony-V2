<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(EntityManagerInterface $em, TaskRepository $taskRepository, Request $req): Response
    {

        $folderIdRaw = $req->query->get('folder');
        $folderId = ctype_digit((string) $folderIdRaw) ? (int) $folderIdRaw : null;

        $priority = $req->query->get('priority');
        $status = $req->query->get('status');


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'priorities' => $em->getRepository(Priority::class)->findAll(),
            'folders' => $em->getRepository(Folder::class)->findAll(),
            'tasks' => $taskRepository->findForHome($folderId, $status, $priority)
        ]);
    }
}
