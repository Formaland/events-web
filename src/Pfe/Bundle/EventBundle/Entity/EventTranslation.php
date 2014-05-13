<?php

namespace Pfe\Bundle\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use A2lix\I18nDoctrineBundle\Doctrine\Interfaces\OneLocaleInterface;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translation;

/**
 * Event
 *
 * @ORM\Table(name="ws_event_translation")
 * @ORM\Entity(repositoryClass="Pfe\Bundle\EventBundle\Entity\Repository\EventTranslationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class EventTranslation implements OneLocaleInterface
{
    use Translation;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
