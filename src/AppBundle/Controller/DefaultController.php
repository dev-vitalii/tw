<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Twit;
use AppBundle\Form\TwitFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @var Request $request
     * @Route("/", name="homepage")
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $twits = $em->getRepository('AppBundle:Twit')->findAllMyTwits($this->getUser());
        return $this->render('default/index.html.twig', [
            'twits' => $twits,
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @var Request $request
     * @Route("/new", name="new")
     * @return Response
     */
    public function newTwitAction(Request $request)
    {
        $form = $this->createForm(TwitFormType::class);
        $form->handleRequest($request);
        if ($form->isValid()) {
            /** @var Twit $twit */
            $twit = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $twit->setCreatedAt(new \DateTime());
            $twit->setUser($this->getUser());
            $em->persist($twit);
            $em->flush();
            return $this->redirectToRoute('homepage', []);
        }
        return $this->render('default/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
