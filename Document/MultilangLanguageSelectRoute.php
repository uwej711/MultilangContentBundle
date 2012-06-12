<?php

namespace Symfony\Cmf\Bundle\MultilangContentBundle\Document;

use Symfony\Cmf\Bundle\RoutingExtraBundle\Document\Route;
use Symfony\Cmf\Component\Routing\RouteAwareInterface;

use Doctrine\ODM\PHPCR\Mapping\Annotations as PHPCRODM;
use Knp\Menu\NodeInterface;

/**
 * Route to use in multilanguage sites when the language is not known (e.g.
 * for /)
 *
 * The children of this route must carry all locales that should be available.
 *
 * @PHPCRODM\Document
 */
class MultilangLanguageSelectRoute extends Route implements RouteAwareInterface
{
    /** @PHPCRODM\Children */
    protected $routes;

    /**
     * Default the controller to explicitly reference the LanguageSelectorController service
     *
     * If you need something different, call setDefault('_controller' ... after creating
     * the object.
     */
    public function __construct()
    {
        parent::__construct();
        $this->setDefault('_controller', 'symfony_cmf_multilang_content.language_selector_controller:defaultLanguageAction');
    }

    /**
     * @return array of route objects that point to this content
     */
    public function getRoutes()
    {
        if (is_array($this->routes)) {
            return $this->routes;
        }

        return $this->routes->toArray();
    }

    public function getRouteContent()
    {
        return $this;
    }
}
