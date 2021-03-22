<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Repository\FigureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
    /**
     * @Route("/figure", name="figure")
     * @param FigureRepository $repo
     * @return Response
     */
    public function index(FigureRepository $repo): Response
    {
        $figures = $repo->findAll();

        return $this->render('figure/index.html.twig', [
            'title'=> 'Liste de nos figures',
            'figures' => $figures,
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {

        return $this->render('figure/home.html.twig', [
            "title" => "Welcome to TrickSnow"
        ]);
    }

    /**
     * @Route("/figure/{id}", name="figure_detail")
     * @param Figure $figure
     * @return Response
     */
    public function show(Figure $figure): Response
    {
        $discussion = $figure->getDiscussions()->toArray();


        return $this->render('figure/show.html.twig', [
            'figure' => $figure,
            'discussions'=> $discussion
        ]);
    }

}
