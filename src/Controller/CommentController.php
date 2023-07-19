<?php

namespace App\Controller;

use App\Entity\Etape;
use App\Repository\EtapeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommentController extends AbstractController
{
    public function __construct(private EtapeRepository $etapeRepository){

    }
    #[Route('/comment/{id}', name: 'app_comment')]
    public function index($id): Response
    {
        $etape = $this->etapeRepository->find($id);
        if($etape){
            $comments = $etape->getComments();
        return $this->render('comment/index.html.twig', [
            'comments' => $comments,
        ]);
        }
        return $this->redirectToRoute('app_home');        
    }
}
