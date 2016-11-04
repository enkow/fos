<?php
/**
 * Grafs controller class.
 *
 * @copyright (c) 2016 Grzegorz Stefański
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Graf;
use AppBundle\Form\GrafType;
use Doctrine\Common\Persistence\ObjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Symfony\Component\Form\FormFactory;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class GrafsController.
 *
 * @Route(service="app.grafs_controller")
 *
 * @package AppBundle\Controller
 * @author Grzegorz Stefański <grzesiekk94@gmail.com>
 */
class GrafsController
{
    private $translator;
    private $templating;
    private $session;
    private $router;
    private $model;
    private $formFactory;

    /**
     * GrafsController constructor.
     *
     * @param Translator $translator Translator
     * @param EngineInterface $templating Templating engine
     * @param Session $session Session
     * @param RouterInterface $router
     * @param ObjectRepository $model Model object
     * @param FormFactory $formFactory Form factory
     */
    public function __construct(
        TranslatorInterface $translator,
        EngineInterface $templating,
        Session $session,
        RouterInterface $router,
        ObjectRepository $model,
        FormFactory $formFactory
    ) {
        $this->translator = $translator;
        $this->templating = $templating;
        $this->session = $session;
        $this->router = $router;
        $this->model = $model;
        $this->formFactory = $formFactory;
    }

    /**
     * Index action.
     *
     * @Route("/grafs", name="grafs")
     * @Route("/grafs/")
     *
     * @throws NotFoundHttpException
     * @return Response A Response instance
     */
    public function indexAction()
    {
        $grafs = $this->model->findAll();
        //dump($grafs);exit;
        return $this->templating->renderResponse(
            'AppBundle:Grafs:index.html.twig',
            array('grafs' => $grafs)
        );
    }

    /**
     * View action.
     *
     * @Route("/grafs/view/{id}", name="grafs-view")
     * @Route("/grafs/view/{id}/")
     * @ParamConverter("graf", class="AppBundle:Graf")
     *
     * @param Graf $graf Graf entity
     * @throws NotFoundHttpException
     * @return Response A Response instance
     */
    public function viewAction(Graf $graf = null)
    {
        if (!$graf) {
            $this->session->getFlashBag()->set(
                'warning',
                $this->translator->trans('graf.not.exists')
            );
            return new RedirectResponse(
                $this->router->generate('grafs')
            );
        }
        return $this->templating->renderResponse(
            'AppBundle:Grafs:view.html.twig',
            array('graf' => $graf)
        );
    }

    /**
     * Add action.
     *
     * @Route("/grafs/add", name="grafs-add")
     * @Route("/grafs/add/")
     *
     * @param Request $request
     * @return Response A Response instance
     */
    public function addAction(Request $request)
    {
        $grafForm = $this->formFactory->create(
            GrafType::class,
            null,
            array(
                'validation_groups' => 'graf-default'
            )
        );

        $grafForm->handleRequest($request);

        if ($grafForm->isValid()) {
            $graf = $grafForm->getData();
            $this->model->save($graf);
            $this->session->getFlashBag()->set(
                'success',
                $this->translator->trans('graf.added')
            );
            return new RedirectResponse(
                $this->router->generate('grafs')
            );
        }

        return $this->templating->renderResponse(
            'AppBundle:Grafs:add.html.twig',
            array('form' => $grafForm->createView())
        );
    }

    /**
     * Edit action.
     *
     * @Route("/grafs/edit/{id}", name="grafs-edit")
     * @Route("/grafs/edit/{id}/")
     * @ParamConverter("graf", class="AppBundle:Graf")
     *
     * @param Graf $graf Graf entity
     * @param Request $request
     * @return Response A Response instance
     */
    public function editAction(Request $request, Graf $graf = null)
    {
        if (!$graf) {
            $this->session->getFlashBag()->set(
                'warning',
                $this->translator->trans('graf.not.exists')
            );
            return new RedirectResponse(
                $this->router->generate('grafs')
            );
        }

        $grafForm = $this->formFactory->create(
            GrafType::class,
            $graf,
            array(
                'validation_groups' => 'graf-default'
            )
        );

        $grafForm->handleRequest($request);

        if ($grafForm->isValid()) {
            $graf = $grafForm->getData();
            $this->model->save($graf);
            $this->session->getFlashBag()->set(
                'success',
                $this->translator->trans('graf.edited')
            );
            return new RedirectResponse(
                $this->router->generate('grafs')
            );
        }

        return $this->templating->renderResponse(
            'AppBundle:Grafs:edit.html.twig',
            array('form' => $grafForm->createView())
        );

    }

    /**
     * Delete action.
     *
     * @Route("/grafs/delete/{id}", name="grafs-delete")
     * @Route("/grafs/delete/{id}/")
     * @ParamConverter("graf", class="AppBundle:Graf")
     *
     * @param Graf $graf Graf entity
     * @param Request $request
     * @return Response A Response instance
     */
    public function deleteAction(Request $request, Graf $graf = null)
    {
        if (!$graf) {
            $this->session->getFlashBag()->set(
                'warning',
                $this->translator->trans('graf.not.exists')
            );
            return new RedirectResponse(
                $this->router->generate('grafs')
            );
        }

        $this->model->delete($graf);
        $this->session->getFlashBag()->set(
            'success',
            $this->translator->trans('graf.deleted')
        );
        return new RedirectResponse(
            $this->router->generate('grafs')
        );
    }
}
