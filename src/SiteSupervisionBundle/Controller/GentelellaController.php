<?php

/*
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 */

namespace SiteSupervisionBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * GentelellaController.
 */
class GentelellaController extends Controller
{
    /**
     * Render Gentelella page.
     *
     * @Route("gentelella/{page}", name="app_gentelella", defaults={"page": "index"})
     *
     * @param Request $request
     * @param string  $page
     *
     * @return Response
     */
    public function gentelellaAction(Request $request, $page)
    {
        $user = $this->getUser();
        $role = $this->container->get('security.role_hierarchy');
        dump($role);
        if(in_array("ROLE_SUPER_ADMIN", $user->getRoles())){
            //return $this->redirectToRoute('customer_index');
        }
        

        $templateName = basename(sprintf('gentelella/%s.html.twig', $page));
        if ($templateName !== sprintf('%s.html.twig', $page)) {
            throw $this->createNotFoundException('Page not found');
        }
        if (!$this->get('templating')->exists(sprintf('gentelella/%s', $templateName))) {
            throw $this->createNotFoundException(
                sprintf(
                    'Page "%s" not found',
                    $page
                )
            );
        }
        //$this->container->get('userbundle_service');
        return $this->render(sprintf('gentelella/%s.html.twig', $page));
    }

    /**
     * @Route("/", name="app_homepage")
     *
     * @param Request $request Request
     *
     * @return Response
     */
    public function homepageAction(Request $request)
    {
        return $this->render('pages/dashboard.html.twig', []);
    }
}
