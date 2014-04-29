<?php

namespace Pfe\Bundle\SeoBundle\Seo;

interface SeoMetaInterface
{
    /**
     * @param string $title
     *
     * @return SeoInterface
     */
    public function setTitle($title);

    /**
     * @param string $title
     *
     * @return SeoInterface
     */
    public function addTitle($title);

    /**
     * @return string
     */
    public function getTitle();

    /**
     * @param string $type
     * @param string $name
     * @param string $value
     * @param array  $extras
     *
     * @return mixed
     */
    public function addMeta($type, $name, $value, array $extras = array());

    /**
     * @param string $type
     * @param string $name
     *
     * @return bool
     */
    public function hasMeta($type, $name);

    /**
     * @return array
     */
    public function getMetas();

    /**
     * @param array $metas
     *
     * @return SeoInterface
     */
    public function setMetas(array $metas);

    /**
     * @param array $attributes
     *
     * @return SeoInterface
     */
    public function setHtmlAttributes(array $attributes);

    /**
     * @param string $name
     * @param string $value
     *
     * @return SeoInterface
     */
    public function addHtmlAttributes($name, $value);

    /**
     * @return array
     */
    public function getHtmlAttributes();

    /**
     * @param array $attributes
     *
     * @return SeoInterface
     */
    public function setHeadAttributes(array $attributes);

    /**
     * @param string $name
     * @param string $value
     *
     * @return SeoInterface
     */
    public function addHeadAttribute($name, $value);

    /**
     * @return array
     */
    public function getHeadAttributes();

    /**
     * @param string $link
     *
     * @return SeoInterface
     */
    public function setLinkCanonical($link);

    /**
     * @return string
     */
    public function getLinkCanonical();

    /**
     * @param string $separator
     *
     * @return SeoInterface
     */
    public function setSeparator($separator);

    /**
     * @param array $langAlternates
     * @return SeoInterface
     */
    public function setLangAlternates(array $langAlternates);

    /**
     * @param string $href
     * @param string $hrefLang
     *
     * @return SeoInterface
     */
    public function addLangAlternate($href, $hrefLang);

    /**
     * @return array
     */
    public function getLangAlternates();
}
