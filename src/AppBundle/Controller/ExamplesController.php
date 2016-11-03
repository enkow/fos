<?php
/**
 * Examples controller class.
 *
 * @copyright (c) 2016 Grzegorz Stefański
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Example;
use AppBundle\Form\ExampleType;
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
 * Class ExamplesController.
 *
 * @Route(service="app.examples_controller")
 *
 * @package AppBundle\Controller
 * @author Grzegorz Stefański <grzesiekk94@gmail.com>
 */
class ExamplesController
{
    private $translator;
    private $templating;
    private $session;
    private $router;
    private $model;
    private $formFactory;

    /**
     * ExamplesController constructor.
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
     * @Route("/examples", name="examples")
     * @Route("/examples/")
     *
     * @throws NotFoundHttpException
     * @return Response A Response instance
     */
    public function indexAction()
    {
        $examples = $this->model->findAll();
        return $this->templating->renderResponse(
            'AppBundle:Examples:index.html.twig',
            array('examples' => $examples)
        );
    }

    /**
     * View action.
     *
     * @Route("/examples/view/{id}", name="examples-view")
     * @Route("/examples/view/{id}/")
     * @ParamConverter("example", class="AppBundle:Example")
     *
     * @param Example $example Example entity
     * @throws NotFoundHttpException
     * @return Response A Response instance
     */
    public function viewAction(Example $example = null)
    {
        if (!$example) {
            $this->session->getFlashBag()->set(
                'warning',
                $this->translator->trans('example.not.exists')
            );
            return new RedirectResponse(
                $this->router->generate('examples')
            );
        }
        return $this->templating->renderResponse(
            'AppBundle:Examples:view.html.twig',
            array('example' => $example)
        );
    }

    /**
     * Add action.
     *
     * @Route("/examples/add", name="examples-add")
     * @Route("/examples/add/")
     *
     * @param Request $request
     * @return Response A Response instance
     */
    public function addAction(Request $request)
    {
        $exampleForm = $this->formFactory->create(
            ExampleType::class,
            null,
            array(
                'validation_groups' => 'example-default'
            )
        );

        $exampleForm->handleRequest($request);

        if ($exampleForm->isValid()) {
            $example = $exampleForm->getData();
            $this->model->save($example);
            $this->session->getFlashBag()->set(
                'success',
                $this->translator->trans('example.added')
            );
            return new RedirectResponse(
                $this->router->generate('examples')
            );
        }

        return $this->templating->renderResponse(
            'AppBundle:Examples:add.html.twig',
            array('form' => $exampleForm->createView())
        );
    }

    /**
     * Edit action.
     *
     * @Route("/examples/edit/{id}", name="examples-edit")
     * @Route("/examples/edit/{id}/")
     * @ParamConverter("example", class="AppBundle:Example")
     *
     * @param Example $example Example entity
     * @param Request $request
     * @return Response A Response instance
     */
    public function editAction(Request $request, Example $example = null)
    {
        if (!$example) {
            $this->session->getFlashBag()->set(
                'warning',
                $this->translator->trans('example.not.exists')
            );
            return new RedirectResponse(
                $this->router->generate('examples')
            );
        }

        $exampleForm = $this->formFactory->create(
            ExampleType::class,
            $example,
            array(
                'validation_groups' => 'example-default'
            )
        );

        $exampleForm->handleRequest($request);

        if ($exampleForm->isValid()) {
            $example = $exampleForm->getData();
            $this->model->save($example);
            $this->session->getFlashBag()->set(
                'success',
                $this->translator->trans('example.edited')
            );
            return new RedirectResponse(
                $this->router->generate('examples')
            );
        }

        return $this->templating->renderResponse(
            'AppBundle:Examples:edit.html.twig',
            array('form' => $exampleForm->createView())
        );

    }

    /**
     * Delete action.
     *
     * @Route("/examples/delete/{id}", name="examples-delete")
     * @Route("/examples/delete/{id}/")
     * @ParamConverter("example", class="AppBundle:Example")
     *
     * @param Example $example Example entity
     * @param Request $request
     * @return Response A Response instance
     */
    public function deleteAction(Request $request, Example $example = null)
    {
        if (!$example) {
            $this->session->getFlashBag()->set(
                'warning',
                $this->translator->trans('example.not.exists')
            );
            return new RedirectResponse(
                $this->router->generate('examples')
            );
        }

        $this->model->delete($example);
        $this->session->getFlashBag()->set(
            'success',
            $this->translator->trans('example.deleted')
        );
        return new RedirectResponse(
            $this->router->generate('examples')
        );
    }
}
