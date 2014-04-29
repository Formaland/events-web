<?php

namespace Pfe\Bundle\SeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

/**
 * Seo
 *
 * @ORM\Table(name="pfe_seo_translation")
 * @ORM\Entity(repositoryClass="Pfe\Bundle\SeoBundle\Entity\Repository\SeoTranslationRepository")
 * 
 */
class SeoTranslation implements OneLocaleInterface {

    use Translation;

    /**
     * @ORM\column(name="title", type="string", length=255,nullable=true) 
     */
    protected $title;

    /**
     * @ORM\column(name="description", type="string", length=160,nullable=true) 
     */
    protected $description;

    /**
     * @ORM\column(name="priority", type="string", length=4,nullable=true) 
     */
    protected $priority;

    /**
     * @ORM\column(name="change_frequency", type="string", length=10,nullable=true) 
     */
    protected $change_frequency;

    /**
     * @ORM\column(name="meta_keywords", type="text",nullable=true)
     */
    protected $meta_keywords;

    public function __toString() {
        return "{Title = $this->title,"
                . " Description = $this->description,"
                . " priority = $this->priority,"
                . " Change_frequency = $this->change_frequency,"
                . " Meta_keywords = $this->meta_keywords }";
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    public function getChange_frequency() {
        return $this->change_frequency;
    }

    public function getMeta_keywords() {
        return $this->meta_keywords;
    }

    public function setChange_frequency($change_frequency) {
        $this->change_frequency = $change_frequency;
        return $this;
    }

    public function setMeta_keywords($meta_keywords) {
        $this->meta_keywords = $meta_keywords;
        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Seo
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Seo
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Seo
     */
    public function setPriority($priority) {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority() {
        return $this->priority;
    }

    /**
     * Set change_frequency
     *
     * @param string $changeFrequency
     * @return Seo
     */
    public function setChangeFrequency($changeFrequency) {
        $this->change_frequency = $changeFrequency;

        return $this;
    }

    /**
     * Get change_frequency
     *
     * @return string 
     */
    public function getChangeFrequency() {
        return $this->change_frequency;
    }

    /**
     * Set meta_keywords
     *
     * @param string $metaKeywords
     * @return Seo
     */
    public function setMetaKeywords($metaKeywords) {
        $this->meta_keywords = $metaKeywords;

        return $this;
    }

    /**
     * Get meta_keywords
     *
     * @return string 
     */
    public function getMetaKeywords() {
        return $this->meta_keywords;
    }

}
