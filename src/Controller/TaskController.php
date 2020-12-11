<?php

namespace App\Controller;

use App\Repository\TaskRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="tasks_index")
     */
    public function index(TaskRepository $repo): Response
    {

        $tasks = $repo->findAll();

        return $this->render('task/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    /**
     * @Route("/tasks/{slug}", name="task_show")
     */
    public function show($slug, TaskRepository $repo){
        $task = $repo->findOneBySlug($slug);

        return $this->render('task/show.html.twig', [
            'task'=>$task
        ]);
    }
}
