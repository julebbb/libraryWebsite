<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use App\Form\BookType;
use App\Entity\Book;
use Symfony\Component\HttpFoundation\Request;
use Proxies\__CG__\App\Entity\Picture;
use Doctrine\Common\Persistence\ObjectManager;

class HomeController extends AbstractController
{
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(BookRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    /**
     * @Route("/", name= "home")
     * @return Response
     */
    public function index(Request $resquest): Response
    {

        //Show books
        $books = $this->repository->findAllVisible();
        $categories = [];
        $pictures= [];
        foreach ($books as $key => $value ) {
            if (!is_null($value->getPicture())) {
                 $pictures[] = array(
                "src" => $value->getPicture()->getSrc(),
                "alt" => $value->getPicture()->getAlt()
            );
            } else {
                $pictures[] = array(
                    "src" => null,
                    "alt" => null
                );
            }
           
            $categories[] = array(
                "name" => $value->getCategory()->getName()
            );
        

        }

        $book = new Book();
        $picture = new Picture();

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($resquest);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($this->em->persist($book));
            // $this->em->flush();
            // $this->addFlash('success', "Bien crée avec succès !");

            // return $this->redirectToRoute('home');

        }


        return $this->render('pages/home.html.twig', [
            "newBook" => $book,
            "form" => $form->createView(),
            'books' => $books,
            'pictures' => $pictures,
            'categories' => $categories
        ]);
    }

}