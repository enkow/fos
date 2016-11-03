<?php
/**
 * Admin controller class.
 *
 * @copyright (c) 2016 Grzegorz Stefański
 */

namespace AppBundle\Controller;

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
 * Class AdminController.
 *
 * @Route(service="app.admin_controller")
 *
 * @package AppBundle\Controller
 * @author Grzegorz Stefański <grzesiekk94@gmail.com>
 */
class AdminController
{
    private $translator;
    private $templating;
    private $session;
    private $router;

    /**
     * TasksController constructor.
     *
     * @param Translator $translator Translator
     * @param EngineInterface $templating Templating engine
     * @param Session $session Session
     * @param RouterInterface $router
     */
    public function __construct(
        TranslatorInterface $translator,
        EngineInterface $templating,
        Session $session,
        RouterInterface $router
    ) {
        $this->translator = $translator;
        $this->templating = $templating;
        $this->session = $session;
        $this->router = $router;
    }

    /**
     * Index action.
     *
     * @Route("/", name="homepage")
     *
     * @throws NotFoundHttpException
     * @return Response A Response instance
     */
    public function indexAction()
    {
        return $this->templating->renderResponse(
            'AppBundle:Admin:index.html.twig'
        );
    }
}
