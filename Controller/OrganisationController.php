<?php

namespace WH\OrganisationBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use APP\OrganisationBundle\Entity\Organisation;
use WH\OrganisationBundle\Form\OrganisationType;


/**
 * Organisation controller.
 *
 * @Route("/organisation")
 */
class OrganisationController extends Controller
{

    /**
     *
     * @param         $page
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page, Request $request)
    {

        $session = $this->get('session');

        $em = $this->getDoctrine()->getManager();

        $data = $session->get('dataOrgaSearch');

        if (!$data) {
            $data = array();
        }


        $form = $this->_returnFormSearch($data);

        if ($request->getMethod() == 'POST') {

            $form->handleRequest($request);

            $data = $form->getData();

            // set and get session attributes
            $session->set('dataOrgaSearch', $data);

            return $this->redirect($request->headers->get('referer'));

        }

        $max = $request->query->get('max');

        $max = ($max) ? $max : 50;

        //Liste
        $entities = $em->getRepository('APPOrganisationBundle:Organisation')->getAll($page, $max, $data);

        //Pagination
        $pagination = array(
            'page' => $page,
            'route' => 'whad_organisation',
            'pages_count' => ceil(count($entities) / $max),
            'route_params' => array(),
            'max' => $max
        );

        //=====================================================

        return $this->render(
            'APPOrganisationBundle:Organisation:admin/index.html.twig',
            array(
                'entities' => $entities,
                'form' => $form->createView(),
                'pagination' => $pagination

            )
        );
    }

    private function _returnFormSearch($data)
    {

        $em = $this->getDoctrine()->getManager();

        $form = $this->createFormBuilder($data)
            ->add(
                'search',
                'text',
                array(
                    'label' => 'Nom, prénom, email : ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'zipCode',
                'text',
                array(
                    'label' => 'Code postal : ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'town',
                'text',
                array(
                    'label' => 'Ville : ',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control'
                    )
                )
            )
            ->add(
                'state',
                'entity',
                array(
                    'label' => 'Etat : ',
                    'class' => 'WHOrganisationBundle:CustomerState',
                    'property' => 'name',
                    'required' => false,
                    'data' => (!empty($data['state'])) ? $em->getReference(
                            "WHOrganisationBundle:CustomerState",
                            $data['state']->getId()
                        ) : null

                )
            )

            ->getForm();


        return $form;

    }

    /**
     * @param $type
     * @param Request $request
     * @return JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function createAction($type, Request $request)
    {

        $entity = new Organisation();

        $form = $this->createForm(new OrganisationType(), $entity);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Organisation créée');

            $response = new JsonResponse();

            $url = ($this->get('request')->request->get('submited') == 'edit') ? $this->generateUrl(
                'whad_organisation_update',
                array('id' => $entity->getId())
            ) : $this->generateUrl('whad_organisation');

            $response->setData(
                array(
                    'valid' => true,
                    'redirect' => $url,
                    'Organisation' => array(
                        'id' => $entity->getId(),
                        'text' => $entity->getSocialReason()
                    )
                )
            );

            return $response;


        }

        return $this->render(
            'WHOrganisationBundle:Organisation:admin/create.html.twig',
            array(
                'form' => $form->createView(),
                'type' => $type,

            )
        );


    }

    /**
     * SHOW ACTION
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APPOrganisationBundle:Organisation')->find($id);

        $employes = array();

        if ($entity->getOrganisationType() == 'prof') {

            $employes = $em->getRepository('APPOrganisationBundle:Organisation')->getAll(
                1,
                10,
                array('employeur' => $id)
            );


        }

        return $this->render(
            'WHOrganisationBundle:Organisation:admin/show.html.twig',
            array(
                'entity' => $entity,
                'employes' => $employes
            )
        );

    }

    /**
     * EDIT ACTION
     * @param $id
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Symfony\Component\HttpKernel\Exception\NotFoundHttpException
     */
    public function updateAction($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APPOrganisationBundle:Organisation')->find($id);

        if (!$entity) throw $this->createNotFoundException('Cette organisation est inconnue.');

        $form = $this->createForm(new OrganisationEditType(), $entity);

        if ($request->isMethod('POST')) {


            $form->handleRequest($request);

            $em->persist($entity);
            $em->flush();

            //Supprimer les contacts vides
            $contacts = $em->getRepository('WHOrganisationBundle:Contact')->findBy(array('value' => ''));

            foreach ($contacts as $a) $em->remove($a);

            //Supprimer les adresses vides
            $adress = $em->getRepository('WHOrganisationBundle:Adress')->findBy(array('name' => ''));

            foreach ($adress as $a) $em->remove($a);

            $em->flush();

            //Fin de traitement
            $request->getSession()->getFlashBag()->add('success', 'Organisation modifiée');

            return $this->redirect($this->generateUrl('whad_organisation_show', array('id' => $entity->getId())));

        }


        return $this->render(
            'WHOrganisationBundle:Organisation:admin/update.html.twig',
            array(
                'form' => $form->createView(),
                'entity' => $entity,
                'breadcrumb' => array(
                    array(
                        'txt' => 'User',
                        'route' => 'user'
                    )
                )
            )
        );


    }


    /**
     * Deletes a Organisation entity.
     *
     * @Route("/{id}", name="organisation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('APPOrganisationBundle:Organisation')->find($id);

        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('whad_organisation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('APPOrganisationBundle:Organisation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Organisation entity.');
            }

            $em->remove($entity);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Organisation supprimée');

            return $this->redirect($this->generateUrl('whad_organisation'));

        }

        return $this->render(
            'WHOrganisationBundle:Organisation:admin/delete.html.twig',
            array(
                'entity' => $entity,
                'form' => $form->createView()
            )
        );


    }


    /**
     * @return JsonResponse
     */
    public function searchAjaxAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $data = array();

        $data['search'] = $request->query->get('q');

        $entities = $em->getRepository('APPOrganisationBundle:Organisation')->getAll(1, 100, $data);

        $tab = array();

        foreach ($entities as $k => $t) {

            $tab[] = array(
                'name' => $t->getName(),
                'email' => $t->getEmail(),
                'id' => $t->getId()
            );

        }

        $response = new JsonResponse();

        $response->setData($tab);

        return $response;

    }

}
