<?php

namespace App\Controller;

use App\Entity\Folder;
use App\Entity\Priority;
use App\Entity\Status;
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
        $folderId = (is_string($folderIdRaw) && ctype_digit($folderIdRaw)) ? (int) $folderIdRaw : null;

        $statusIdRaw = $req->query->get('status');
        $statusId = (is_string($statusIdRaw) && ctype_digit($statusIdRaw)) ? (int) $statusIdRaw : null;

        $priorityIdRaw = $req->query->get('priority');
        $priorityId = (is_string($priorityIdRaw) && ctype_digit($priorityIdRaw)) ? (int) $priorityIdRaw : null;

        $folder = $folderId ? $em->getRepository(Folder::class)->find($folderId) : null;
        $status = $statusId ? $em->getRepository(Status::class)->find($statusId) : null;
        $priority = $priorityId ? $em->getRepository(Priority::class)->find($priorityId) : null;


        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'priorities' => $em->getRepository(Priority::class)->findAll(),
            'folders' => $em->getRepository(Folder::class)->findAll(),
            'tasks' => $taskRepository->findForHome($folder, $status, $priority),
            'status' => $em->getRepository(Status::class)->findAll()
        ]);
    }
}
