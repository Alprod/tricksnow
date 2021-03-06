<?php

namespace App\Controller;

use App\Entity\Figure;
use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\FigureRepository;
use App\Repository\ImageRepository;
use App\Service\FileUploaderImage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/image")
 */
class ImageController extends AbstractController
{
    /**
     * @Route("/", name="image_index", methods={"GET"})
     * @param ImageRepository $imageRepository
     * @return Response
     */
    public function index(ImageRepository $imageRepository): Response
    {
        return $this->render('image/index.html.twig', [
            'images' => $imageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="image_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $figureId = $request->request->get('figure');
        $em = $this->getDoctrine()->getManager();
        $figure = $em->getRepository(FigureRepository::class)->find($figureId);

        $image = new Image();
        $image->setFigures($figure);
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute('image_index');
        }

        return $this->render('image/new.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="image_show", methods={"GET"})
     * @param Image $image
     * @return Response
     */
    public function show(Image $image): Response
    {
        return $this->render('image/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="image_edit", methods={"GET","POST"})
     * @param Request $request
     * @param FileUploaderImage $fileUploader
     * @param Image $image
     * @return Response
     */
    public function edit(Request $request,FileUploaderImage $fileUploader, Image $image): Response
    {
        $figureId = $request->request->get('figure');
        $em = $this->getDoctrine()->getManager();
        $figure = $em->getRepository(FigureRepository::class)->find($figureId);
        $image->setFigures($figure);
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $linkFile */
            $linkFile = $form->get('link')->getData();

            if($linkFile) {
                $linkFileName = $fileUploader->upload($linkFile,'image/edit.html.twig');
                $image->setLink($linkFileName);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('figure_detail', ["id"=>$image->getFigures()->getId()]);
        }

        return $this->render('image/edit.html.twig', [
            'image' => $image,
            'form' => $form->createView(),
            'error'=> false
        ]);
    }

    /**
     * @Route("/{id}", name="image_delete", methods={"DELETE"})
     * @param Request $request
     * @param Image $image
     * @return Response
     */
    public function delete(Request $request, Image $image): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('figure_detail', ['id' => $image->getFigures()->getId()]);
    }
}
