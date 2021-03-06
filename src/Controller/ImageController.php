<?php
// src/Controller/ProductController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;

class ImageController extends Controller
{
    /**
     * @Route("/image", name="Liste_Image", methods="GET")
     */
    public function index(ImageRepository $ImageRepository): Response
    {
         return $this->render('image/image_list.html.twig',['images' => $ImageRepository->findAll()]);
    }
    
    /**
     * @Route("/image/new", name="image_new")
     */
    public function new(Request $request): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            /** @var Symfony\Component\HttpFoundation\File\UploadedFile $file */
            $file = $image->getImage();
            
            $fileName = $this->generateUniqueFileName().'.'.$file->guessExtension();

            // moves the file to the directory where brochures are stored
            $file->move(
                $this->getParameter('image_directory'),
                $fileName
            );

            // updates the 'brochure' property to store the PDF file name
            // instead of its contents
            $image->setImage($fileName);

            // ... persist the $product variable or any other work
            $file = $this->getDoctrine()->getManager();
            $file->persist($image);
            $file->flush();
            return $this->redirect($this->generateUrl('Liste_Image'));
        }

        return $this->render('image/new.html.twig', array(
            'form' => $form->createView(),
        ));
    }
    

    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid());
    }
}