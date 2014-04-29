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
}
