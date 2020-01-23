<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Twit", mappedBy="user")
     * @ORM\JoinColumn(nullable=true)
     */
    private $twits;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Friendship", mappedBy="fromUser")
     * @ORM\JoinColumn(nullable=true)
     */
    private $outgoingFriendships;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Friendship", mappedBy="toUser")
     * @ORM\JoinColumn(nullable=true)
     */
    private $incomingFriendships;

    public function __construct()
    {
        parent::__construct();
        $this->twits = new ArrayCollection();
        $this->outgoingFriendships = new ArrayCollection();
        $this->incomingFriendships = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @return ArrayCollection|Twit[]
     */
    public function getTwits()
    {
        return $this->twits;
    }

    /**
     * @param Twit $twit
     */
    public function addTwit(Twit $twit)
    {
        if ($this->twits->contains($twit)) {
            return;
        }
        $this->twits[] = $twit;
    }

    /**
     * @param Twit $twit
     */
    public function removeTwit(Twit $twit)
    {
        if (!$this->twits->contains($twit)) {
            return;
        }
        $this->twits->removeElement($twit);
    }

    /**
     * @return ArrayCollection|User[]
     */
    public function getOutgoingFriendships()
    {
        return $this->outgoingFriendships;
    }

    /**
     * @param User $user
     */
    public function addOutgoingFriendships($user)
    {
        if ($this->outgoingFriendships->contains($user)) {
            return;
        }
        $this->outgoingFriendships[] = $user;
    }

    /**
     * @param User $user
     */
    public function removeOutgoingFriendships($user)
    {
        if (!$this->outgoingFriendships->contains($user)) {
            return;
        }
        $this->outgoingFriendships->removeElement($user);
    }

    /**
     * @return ArrayCollection
     */
    public function getIncomingFriendships()
    {
        return $this->incomingFriendships;
    }

    /**
     * @param User $user
     */
    public function addIncomingFriendships($user)
    {
        if ($this->incomingFriendships->contains($user)) {
            return;
        }
        $this->incomingFriendships[] = $user;
    }

    /**
     * @param User $user
     */
    public function removeIncomingFriendships($user)
    {
        if (!$this->incomingFriendships->contains($user)) {
            return;
        }
        $this->incomingFriendships->removeElement($user);
    }

}

