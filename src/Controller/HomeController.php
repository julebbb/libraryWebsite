<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class HomeController extends AbstractController
{
    private $repository;


    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }
    /**
     * @Route("/", name= "home")
     * @return Response
     */
    public function index(): Response
    {
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

        return $this->render('pages/home.html.twig', [
            'books' => $books,
            'pictures' => $pictures,
            'categories' => $categories
        ]);
    }

}