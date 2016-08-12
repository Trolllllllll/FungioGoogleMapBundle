<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Form\Type;

use Fungio\GoogleMap\Helper\Places\AutocompleteHelper;
use Fungio\GoogleMap\Places\Autocomplete;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Google Map places autocomplete type.
 *
 * @author GeLo <geloen.eric@gmail.com>
 * @author Pierrick AUBIN <pierrick.aubin@siqual.fr>
 */
class PlacesAutocompleteType extends AbstractType
{
    /** @var \Fungio\GoogleMap\Helper\Places\AutocompleteHelper */
    protected $autocompleteHelper;

    /** @var \Symfony\Component\HttpFoundation\Request */
    protected $request;

    /**
     * Creates a places autocomplete form type.
     *
     * @param AutocompleteHelper $autocompleteHelper
     * @param RequestStack $requestStack
     */
    public function __construct(AutocompleteHelper $autocompleteHelper, RequestStack $requestStack)
    {
        $this->setAutocompleteHelper($autocompleteHelper);
        $this->setRequest($requestStack->getCurrentRequest());
    }

    /**
     * Gets the autocomplete helper.
     *
     * @return \Fungio\GoogleMap\Helper\Places\AutocompleteHelper The autocomplete helper.
     */
    public function getAutocompleteHelper()
    {
        return $this->autocompleteHelper;
    }

    /**
     * Sets the autocomplete helper.
     *
     * @param \Fungio\GoogleMap\Helper\Places\AutocompleteHelper $autocompleteHelper The autocomplete helper.
     */
    public function setAutocompleteHelper(AutocompleteHelper $autocompleteHelper)
    {
        $this->autocompleteHelper = $autocompleteHelper;
    }

    /**
     * Gets the http request.
     *
     * @return \Symfony\Component\HttpFoundation\Request The http request.
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Sets the http request.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request The http request.
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $autocomplete = new Autocomplete();

        if ($options['prefix'] !== null) {
            $autocomplete->setPrefixJavascriptVariable($options['prefix']);
        }

        if ($options['bound'] !== null) {
            if (is_array($options['bound'])) {
                call_user_func_array([$autocomplete, 'setBound'], $options['bound']);
            } else {
                $autocomplete->setBound($options['bound']);
            }
        }

        if (!empty($options['types'])) {
            $autocomplete->setTypes($options['types']);
        }

        if (!empty($options['component_restrictions'])) {
            $autocomplete->setComponentRestrictions($options['component_restrictions']);
        }

        if ($options['attr']) {
            foreach ($options['attr'] as $name => $value) {
                $autocomplete->setInputAttribute($name, $value);
            }
        }

        $autocomplete->setAsync($options['async']);
        $autocomplete->setLanguage($options['language']);

        $builder->setAttribute('autocomplete', $autocomplete);
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $autocomplete = $form->getConfig()->getAttribute('autocomplete');
        $autocomplete->setInputId($view->vars['id']);
        $autocomplete->setValue($view->vars['value']);
        $autocomplete->setInputAttribute('name', $view->vars['full_name']);

        $view->vars['html'] = $this->getAutocompleteHelper()->renderHtmlContainer($autocomplete);
        $view->vars['javascripts'] = $this->getAutocompleteHelper()->renderJavascripts($autocomplete);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'prefix'                 => null,
            'bound'                  => null,
            'types'                  => [],
            'component_restrictions' => [],
            'async'                  => false,
            'language'               => $this->getRequest()->getLocale(),
        ]);

        $resolver->setAllowedTypes('prefix', ['string', 'null']);
        $resolver->setAllowedTypes('bound', ['Fungio\GoogleMap\Base\Bound', 'array', 'null']);
        $resolver->setAllowedTypes('types', ['array']);
        $resolver->setAllowedTypes('component_restrictions', ['array']);
        $resolver->setAllowedTypes('async', ['bool']);
        $resolver->setAllowedTypes('language', ['string']);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return TextType::class;
    }
}
