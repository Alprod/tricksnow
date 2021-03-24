<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Form\FigureType;
use App\Repository\FigureRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FigureController extends AbstractController
{
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
     * @Route("/figure/new", name="new_figure")
     * @Route("/figure/{id}/edit", name="edit_figure")
     * @param Request $request
     * @param Figure|null $figure
     * @return Response
     */
    public function form(Request $request, Figure $figure = null): Response
    {
        if (!$figure){
            $figure = new Figure();
        }

        $form = $this->createForm(FigureType::class, $figure);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $user = $em->getRepository(UserRepository::class)->findBy(130);

            $figure->setAuthor($user);
            if (!$figure->getId()){
                $figure->setUpdateAt(new \DateTime('now'));
            }
            $em = $this->getDoctrine()->getManager();
            $em->persist($figure);
            $em->flush();

            return $this->redirectToRoute('figure_detail', ["id" => $figure->getId()]);
        }

        return $this->render('figure/create_figure.html.twig', [
            'formFigure' => $form->createView(),
            'editMode' => $figure->getId() !== null
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
        /*$em =$this->getDoctrine()->getManager();
        $em->getRepository(MessageRepository::class)->findByDiscussion();
        dump($discussion);*/
        return $this->render('figure/show.html.twig', [
            'figure' => $figure,
            'discussions'=> $discussion
        ]);
    }

}
