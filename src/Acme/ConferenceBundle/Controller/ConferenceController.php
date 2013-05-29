<?php

namespace Acme\ConferenceBundle\Controller;

use Acme\ConferenceBundle\Entity\Conference;
use Acme\ConferenceBundle\Form\ConferenceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

class ConferenceController extends Controller
{
    /**
     * @Route("/", name="conference_list")
     * @Method("GET")
     * @Template()
     */
    public function listAction()
    {
        $conferences = $this
            ->getDoctrine()
            ->getRepository('AcmeConferenceBundle:Conference')
            ->findAll()
        ;

        return array(
            'conferences' => $conferences
        );
    }

    /**
     * @Route("/create", name="conference_create")
     * @Method("GET|POST")
     * @Template()
     */
    public function createAction(Request $request)
    {
        $conference = new Conference();
        $form = $this->createForm(new ConferenceType(), $conference);

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $this->get('acme_conference.geocoder')->encode($conference);
                $em = $this->getDoctrine()->getManager();
                $em->persist($conference);
                $em->flush();

                return $this->redirect($this->generateUrl('conference_list'));
            }
        }

        return array(
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/{slug}", name="conference_edit")
     * @Method("GET|POST")
     * @Template()
     */
    public function editAction(Request $request, $slug)
    {
        $conference = $this->getConference($slug);

        $form = $this->createForm(new ConferenceType(), $this->getConference($slug));

        if ($request->isMethod('POST')) {
            $form->bind($request);

            if ($form->isValid()) {
                $this->get('acme_conference.geocoder')->encode($conference);
                $em = $this->getDoctrine()->getManager();
                $em->flush();

                return $this->redirect($this->generateUrl('conference_list'));
            }
        }

        return array(
            'form'       => $form->createView(),
            'conference' => $conference
        );
    }

    /**
     * @Route("/{slug}/delete", name="conference_delete")
     * @Method("POST")
     * @Template()
     */
    public function deleteAction(Request $request, $slug)
    {
        $conference = $this->getConference($slug);

        $em = $this->getDoctrine()->getManager();
        $em->remove($conference);
        $em->flush();

        return $this->redirect($this->generateUrl('conference_list'));
    }

    private function getConference($slug)
    {
        $conference = $this
            ->getDoctrine()
            ->getRepository('AcmeConferenceBundle:Conference')
            ->findOneBySlug($slug)
        ;

        if (null === $conference) {
            throw $this->createNotFoundException(sprintf('No conference found for slug "%s".', $slug));
        }

        return $conference;
    }
}
