<?php

namespace Pfe\Bundle\SeoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Seo
 *
 * @ORM\Table(name="pfe_seo")
 * @ORM\Entity(repositoryClass="Pfe\Bundle\SeoBundle\Entity\Repository\SeoRepository")
 */
class Seo {

    use Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     */
    protected $id;
    protected $translations;

    /**
     * @ORM\Column(name="token", type="string", length=255, unique=true, nullable=false)
     */
    protected $token;

    /**
     * @var datetime $createdAt
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime")
     */
    protected $created;

    /**
     * @var datetime $updatedAt
     *
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    protected $update;

    /**
     * @ORM\ManyToOne(targetEntity="Ws\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="createdby", referencedColumnName="id", nullable=true)
     */
    protected $createdBy;

    /**
     * @ORM\ManyToOne(targetEntity="Ws\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="updatedBy", referencedColumnName="id", nullable=true)
     */
    protected $updatedBy;

    public function __construct() {

        $this->translations = new ArrayCollection();

        $date = new DateTime();
        $token = sha1(uniqid(rand(1111, 9999) . $date->format('Y-m-d H:i:s'), true));
        $this->setToken($token);
    }

    public function __toString() {
        $translations = $this->getTranslations();
        $trans = $translations['fr'];

        return "Seo{id= $this->id,"
                . " slug = $this->slug,"
                . " Trans = $trans }";
    }

    /**
     * Set createdBy
     *
     * @param User $createdBy
     * @return Page
     */
    public function setCreatedBy(User $createdBy = null) {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return User
     */
    public function getCreatedBy() {
        return $this->createdBy;
    }

    /**
     * Set updatedBy
     *
     * @param User $updatedBy
     * @return Page
     */
    public function setUpdatedBy(User $updatedBy = null) {
        $this->updatedBy = $updatedBy;

        return $this;
    }

    /**
     * Get updatedBy
     *
     * @return User
     */
    public function getUpdatedBy() {
        return $this->updatedBy;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Seo
     */
    public function setToken($token) {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken() {
        return $this->token;
    }

    /**
     * Set created
     *
     * @param DateTime $created
     * @return Seo
     */
    public function setCreated($created) {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return DateTime
     */
    public function getCreated() {
        return $this->created;
    }

    /**
     * Set update
     *
     * @param DateTime $update
     * @return Seo
     */
    public function setUpdate($update) {
        $this->update = $update;

        return $this;
    }

    /**
     * Get update
     *
     * @return DateTime
     */
    public function getUpdate() {
        return $this->update;
    }

    public function getTranslation($locale) {
        if (!$this->translations[$locale]) {
            $h = new HttpException(404, 'Page not found.', null, array(), 0);
            throw $h;
        }
        return $this->translations[$locale];
    }

    public function getTranslations() {
        return $this->translations;
    }

    public function setTranslations($translations) {
        $this->translations = $translations;
    }

}
