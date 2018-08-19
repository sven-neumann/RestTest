<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Author controller.
 *
 * @Route("author")
 */
class AuthorController extends Controller
{


    /**
     * Lists all author entities.
     *
     * @Route("/", name="author_index", methods={"GET"}) // ADD Version requirement if needed: requirements={"version"="v2"}
     */
    public function indexAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();

        $authors = $em->getRepository('AppBundle:Author')->findAll();

        // map objects to array
        $response = array_map(function ($author) {
            return $author->toArray();
        }, $authors);


        return new JsonResponse($response);
    }


    /**
     * Creates a new author entity.
     *
     * @Route("/", name="author_new", methods={"POST"})
     * @Security("request.headers.get('rtToken') matches '/RestTest/i'")
     */
    public function newAction(Request $request)
    {

        $author = new Author();
        $author->setName($request->get('name'));
        $author->setAge($request->get('age'));


        $em = $this->getDoctrine()->getManager();
        $em->persist($author);
        $em->flush();

        return new JsonResponse($author->toArray());


    }


    /**
     * Finds and displays a author entity.
     *
     * @Route("/{id}", name="author_show", methods={"GET"})
     */
    public function showAction(Author $author)
    {
        return new JsonResponse($author->toArray());
    }

    /**
     * modif an existing author
     *
     * @Route("/{id}", name="author_edit", methods={"PUT"})
     * @Security("request.headers.get('rtToken') matches '/RestTest/i'")
     */
    public function editAction(Request $request, Author $author)
    {
        $author->setName($request->get('name'));
        $author->setAge($request->get('age'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($author);
        $em->flush();


        return new JsonResponse($author->toArray());

    }

    /**
     * Deletes a author entity.
     *
     * @Route("/{id}", name="author_delete", methods={"DELETE"})
     * @Security("request.headers.get('rtToken') matches '/RestTest/i'")
     */
    public
    function deleteAction(Request $request, Author $author)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($author);
        $em->flush();

        return new Response();
    }

}
