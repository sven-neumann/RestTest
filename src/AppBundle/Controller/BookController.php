<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Book controller.
 *
 * @Route("book")
 */
class BookController extends Controller
{
    /**
     * Lists all book entities.
     *
     * @Route("/", name="book_index", methods={"GET"}) // ADD Version requirement if needed: requirements={"version"="v2"}
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();


        // for test: only search for authorId
        // otherwise check for columns and filter, $columns = $em->getClassMetadata('AppBundle:Book')->getColumnNames();

        $authorId = $request->get('author_id');

        if (!empty($authorId)) {
            $books = $em->getRepository('AppBundle:Book')->findBy(['authorId' => $authorId]);
        } else {
            $books = $em->getRepository('AppBundle:Book')->findAll();
        }


        // map objects to array
        $response = array_map(function ($book) {
            return $book->toArray();
        }, $books);

        return new JsonResponse($response);
    }

    /**
     * Creates a new book entity.
     *
     * @Route("/", name="book_new", methods={"POST"})
     * @Security("request.headers.get('rtToken') matches '/RestTest/i'")
     */
    public function newAction(Request $request)
    {
        $book = new Book();
        $book->setName($request->get('name'));
        $book->setGenre($request->get('genre'));
        $book->setAuthorId($request->get('author_id'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();

        return new JsonResponse($book->toArray());
    }

    /**
     * Finds and displays a book entity.
     *
     * @Route("/{id}", name="book_show", methods={"GET"})
     */
    public function showAction(Book $book)
    {
        return new JsonResponse($book->toArray());
    }

    /**
     * modify an existing book
     *
     * @Route("/{id}", name="book_edit", methods={"PUT"})
     * @Security("request.headers.get('rtToken') matches '/RestTest/i'")
     */
    public function editAction(Request $request, Book $book)
    {
        $book->setName($request->get('name'));
        $book->setGenre($request->get('genre'));
        $book->setAuthorId($request->get('author_id'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($book);
        $em->flush();


        return new JsonResponse($book->toArray());

    }

    /**
     * Deletes a book entity.
     *
     * @Route("/{id}", name="book_delete", methods={"DELETE"})
     * @Security("request.headers.get('rtToken') matches '/RestTest/i'")
     */
    public function deleteAction(Request $request, Book $book)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();

        return new Response();
    }

}
