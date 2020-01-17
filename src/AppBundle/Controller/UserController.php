<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @var Request $request
     * @Route("/users", name="users_list")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        return $this->render('user/list.html.twig', [
            'users' => $users,
        ]);
    }

    /**
     * @var User $user
     * @Route("/users/{id}", name="single_user")
     * @return Response
     */
    public function singleUserAction(User $user)
    {
        return $this->render('user/single.html.twig', [
            'user' => $user,
        ]);
    }
}
