<?php

namespace Pfe\Bundle\EventBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use A2lix\I18nDoctrineBundle\Doctrine\ORM\Util\Translatable;

/**
 * Event
 *
 * @ORM\Table(name="ws_event")
 * @ORM\Entity(repositoryClass="Pfe\Bundle\EventBundle\Entity\Repository\EventRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Event
{
    use Translatable;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    private $translations;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", nullable=false, unique=true)
     */
    private $token;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="createdAt", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updatedAt", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=255)
     */
    private $city;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="end_date", type="datetime")
     */
    private $endDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="postal_code", type="integer")
     */
    private $postalCode;

    /**
     * @var integer
     *
     * @ORM\Column(name="number_place", type="integer")
     */
    private $numberPlace;

    /**
    * @ORM\ManyToMany(targetEntity="Category", inversedBy="events")
    * @ORM\JoinTable(name="pfe_event_has_categories")
    */
    private $categories;

    /**
     * @var Booking
     *
     * @ORM\OneToMany(targetEntity="Pfe\Bundle\BookingBundle\Entity\Booking", mappedBy="event",  cascade={"remove"})
     */
    private $booking;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->categories = new ArrayCollection();

        $date = new \DateTime();
        $this->token = base_convert(sha1(uniqid(mt_rand(1, 999) . $date->format('Y-m-d H:i:s'), true)), 16, 36);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set token
     *
     * @param string $token
     * @return Event
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Get token
     *
     * @return string 
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Event
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Event
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Get adress
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Event
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Event
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Event
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Event
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set logo
     *
     * @param string $image
     * @return Event
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Event
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Event
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set postalCode
     *
     * @param integer $postalCode
     * @return Event
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get postalCode
     *
     * @return integer 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set numberPlace
     *
     * @param integer $numberPlace
     * @return Event
     */
    public function setNumberPlace($numberPlace)
    {
        $this->numberPlace = $numberPlace;

        return $this;
    }

    /**
     * Get numberPlace
     *
     * @return integer 
     */
    public function getNumberPlace()
    {
        return $this->numberPlace;
    }


    /*     * ***********   START UPLOAD IMAGE   ******* */

    public function getAbsolutePath()
    {
        return null === $this->image ? null : $this->getUploadRootDir().'/'.$this->image;
    }

    public function getWebPath()
    {
        return null === $this->image ? null : $this->getUploadDir().'/'.$this->image;
    }

    protected function getUploadRootDir()
    {
        // le chemin absolu du répertoire où les documents uploadés doivent être sauvegardés
        return __DIR__.'../../../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // on se débarrasse de « __DIR__ » afin de ne pas avoir de problème lorsqu'on affiche
        // le document/image dans la vue.
        return 'uploads/events';
    }

    /**
     * @Assert\File(maxSize="6M")
     */
    public $file;

    public function getFile() {
        return $this->file;
    }

    public function setFile(UploadedFile $file = null) {
        // check if we have an old image
        if (isset($file)){
            // store the old name to delete after the update
            $this->file = $file;
        } else {
            $this->file = null;
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {


        if (null !== $this->image) {
            $this->setFile($this->image);
            $this->image = sha1(uniqid(mt_rand(), true)).'.'.$this->image->guessExtension();
        }


    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // la propriété « file » peut être vide si le champ n'est pas requis
        if (null === $this->image) {
            return;
        }

        $this->getFile()->move($this->getUploadRootDir(), $this->image);
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    /*     * ***********   END UPLOAD FILE   *********** */

    /**
     * Add categories
     *
     * @param \Pfe\Bundle\EventBundle\Entity\Category $categories
     * @return Event
     */
    public function addCategory(\Pfe\Bundle\EventBundle\Entity\Category $categories)
    {
        $this->categories[] = $categories;

        return $this;
    }

    /**
     * Remove categories
     *
     * @param \Pfe\Bundle\EventBundle\Entity\Category $categories
     */
    public function removeCategory(\Pfe\Bundle\EventBundle\Entity\Category $categories)
    {
        $this->categories->removeElement($categories);
    }

    /**
     * Get categories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set booking
     *
     * @param \Pfe\Bundle\BookingBundle\Entity\Booking $booking
     * @return Event
     */
    public function setBooking(\Pfe\Bundle\BookingBundle\Entity\Booking $booking = null)
    {
        $this->booking = $booking;

        return $this;
    }

    /**
     * Get booking
     *
     * @return \Pfe\Bundle\BookingBundle\Entity\Booking 
     */
    public function getBooking()
    {
        return $this->booking;
    }
}
