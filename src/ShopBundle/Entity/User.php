<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="js_users")
 * @ORM\Entity(repositoryClass="ShopBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=255)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="adrres", type="string", length=255)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="Feedback", mappedBy="user")
     **/
    private $feedbacks;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->feedbacks = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set userName
     *
     * @param string $userName
     * @return User
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return User
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string 
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Add feedbacks
     *
     * @param \ShopBundle\Entity\Feedback $feedbacks
     * @return User
     */
    public function addFeedback(\ShopBundle\Entity\Feedback $feedbacks)
    {
        $this->feedbacks[] = $feedbacks;

        return $this;
    }

    /**
     * Remove feedbacks
     *
     * @param \ShopBundle\Entity\Feedback $feedbacks
     */
    public function removeFeedback(\ShopBundle\Entity\Feedback $feedbacks)
    {
        $this->feedbacks->removeElement($feedbacks);
    }

    /**
     * Get feedbacks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFeedbacks()
    {
        return $this->feedbacks;
    }
}
