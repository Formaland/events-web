<?php

namespace Pfe\Bundle\CustomerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Customer
 *
 * @ORM\Table(name="ws_customer")
 * @ORM\Entity(repositoryClass="Pfe\Bundle\CustomerBundle\Entity\Repository\CustomerRepository")
 */
class Customer extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", nullable=false, unique=true)
     */
    protected $token;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    protected $createdAt;

    /**
     * @var DateTime
     *
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    protected $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", nullable=false)
     */
    protected $first_name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", nullable=false)
     */
    protected $Last_name;

    /**
     * @var string
     *
     * @ORM\Column(name="civility", type="string")
     */
    protected $civility;

    /**
     * @var Date
     *
     * @ORM\Column(name="birth_date", type="date")
     */
    protected $birth_date;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string")
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(name="postal_code", type="string")
     */
    protected $postal_code;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string")
     */
    protected $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string")
     */
    protected $country;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_number", type="integer")
     */
    protected $phone_number;

    public function __construct()
    {
        parent::__construct();

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
     * @return Customer
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
     * @param string $Last_name
     */
    public function setLastName($Last_name)
    {
        $this->Last_name = $Last_name;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->Last_name;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param \Pfe\Bundle\CustomerBundle\Entity\Date $birth_date
     */
    public function setBirthDate($birth_date)
    {
        $this->birth_date = $birth_date;
    }

    /**
     * @return \Pfe\Bundle\CustomerBundle\Entity\Date
     */
    public function getBirthDate()
    {
        return $this->birth_date;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $civility
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;
    }

    /**
     * @return string
     */
    public function getCivility()
    {
        return $this->civility;
    }

    /**
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param \Pfe\Bundle\CustomerBundle\Entity\DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \Pfe\Bundle\CustomerBundle\Entity\DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $first_name
     */
    public function setFirstName($first_name)
    {
        $this->first_name = $first_name;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * @param string $phone_number
     */
    public function setPhoneNumber($phone_number)
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param string $postal_code
     */
    public function setPostalCode($postal_code)
    {
        $this->postal_code = $postal_code;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * @param \Pfe\Bundle\CustomerBundle\Entity\DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return \Pfe\Bundle\CustomerBundle\Entity\DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }


}
