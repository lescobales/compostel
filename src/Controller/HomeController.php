<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Form\CommentType;
use App\Repository\CommentsRepository;
use App\Repository\EtapeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public function __construct(private EtapeRepository $etapeRepository,
                                private CommentsRepository $commentRepository,
                                private EntityManagerInterface $commentManager){

    }
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        $etapes = $this->etapeRepository->findAll();

        return $this->render('home/index.html.twig', [
            'etapes' => $etapes,
        ]);
    }
    #[Route('/{id}', name: 'app_home_show')]
    public function show($id, Request $request): Response
    {
        $comment = new Comments();
        $form = $this->createForm(CommentType::class,$comment);
        $form->handleRequest($request);
        $etape = $this->etapeRepository->find($id);
        $scandir = scandir("./etapes/E$id");
        if($form->isSubmitted() && $form->isValid()){
            $comment->setEtape($etape);
            $this->commentManager->persist($comment);
            $this->commentManager->flush();
            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/show.html.twig', [
            'etape' => $etape,
            'scandir' => $scandir,
            'form' => $form->createView()
        ]);
    }
}
