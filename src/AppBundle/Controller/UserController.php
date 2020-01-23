<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Friendship;
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
        $currentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        $outgoingFriendshipUserIds = [];
        if ($currentUser) {
            $outgoingFriendship = $em->getRepository('AppBundle:Friendship')->findBy([
                'fromUser' => $currentUser,
            ]);
            //normalize - I have no idea how t can get users only
            $outgoingFriendshipUserIds = array_map(function ($friendship) { return $friendship->getToUser()->getId(); }, $outgoingFriendship);
        }
        return $this->render('user/list.html.twig', [
            'users' => $users,
            'current_user' => $currentUser ?? null,
            'outgoing_friendship' => $outgoingFriendshipUserIds,
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

    /**
     * @var User $user
     * @Route("/ask-for-friendship/{id}", name="friendship_request")
     * @return Response
     */
    public function friendshipRequestAction(User $user)
    {
        /** @var User $currentUser */
        $currentUser = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $friendship = $em->getRepository('AppBundle:Friendship')->findOneBy([
            'fromUser' => $currentUser,
            'toUser' => $user,
        ]);
        //if there is no outgoing friendship for current user, create it
        if (!$friendship) {
            $friendship = new Friendship();
            $friendship->setFromUser($currentUser);
            $friendship->setToUser($user);
            $em->persist($friendship);
        } else {
            //withdraw friendship
            $em->remove($friendship);
        }
        $em->flush();
        return $this->redirectToRoute('users_list', []);
    }
}
