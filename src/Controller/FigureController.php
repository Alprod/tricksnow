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
     */
    public function index(): Response
    {
        return $this->render('figure/index.html.twig', [
            'controller_name' => 'FigureController',
        ]);
    }

    /**
     * @Route("/", name="home")
     * @param FigureRepository $repo
     * @return Response
     */
    public function home(FigureRepository $repo): Response
    {
        $figures = $repo->findAll();

        return $this->render('figure/home.html.twig', [
            "title" => "Welcome to TrickSnow",
            "figures" => $figures
        ]);
    }

    /**
     * @Route("/figure/{id}", name="figure_detail")
     * @param $id
     * @return Response
     */
    public function show($id): Response
    {
        $repo = $this->getDoctrine()->getRepository(Figure::class);
        $figure = $repo->find($id);

        return $this->render('figure/show.html.twig', [
            'figure' => $figure
        ]);
    }

}
