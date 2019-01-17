<?php

namespace App\Controller;

use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;
use App\Repository\UserRepository;
use App\Form\BookType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Picture;


class BookController extends AbstractController
{

    private $repository;

    private $repositoryUser;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @param BookRepository $repository
     * @param UserRepository $repositoryUser
     * @param ObjectManager $em
     */
    public function __construct(BookRepository $repository, ObjectManager $em, UserRepository $repositoryUser)
    {
        $this->repository = $repository;
        $this->repositoryUser = $repositoryUser;
        $this->em = $em;
    }

    /**
     * @Route("/", name= "home")
     * @param Request $resquest
     * @return Response
     */
    public function index(Request $resquest) : Response
    {

        //Show books
        $books = $this->repository->findAllVisible();
        $categories = [];
        $pictures = [];

        $title = "index";

        //Show picture and category
        foreach ($books as $key => $value) {
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
            'categories' => $categories,
            'title' => $title,
        ]);
    }


    /**
     * @Route("/{id}", name="book_show", methods={"GET", "UPDATE"})
     */
    public function show(Request $request, Book $book): Response
    {
        $category = $book->getCategory();
        $picture = $book->getPicture(); 
        $user = $book->getIdUser();

        $users = $this->repositoryUser->findAllVisible();

        $title = "book";

        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_index', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('book/show.html.twig', [
            'book' => $book,
            'category' => $category,
            'picture' => $picture,
            'user' => $user,
            'users' => $users,
            'form' => $form->createView(),
            'title' => $title,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="book_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Book $book): Response
    {
        $form = $this->createForm(BookType::class, $book);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('book_index', [
                'id' => $book->getId(),
            ]);
        }

        return $this->render('book/edit.html.twig', [
            'book' => $book,
            'form' => $form->createView(),
        ]);
    }
    

    /**
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete'.$book->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($book);
            $entityManager->flush();
        }

        return $this->redirectToRoute('book_index');
    }
}
