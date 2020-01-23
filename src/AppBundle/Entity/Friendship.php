<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Twit
 *
 * @ORM\Table(name="friendhip")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FriendshipRepository")
 */
class Friendship
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="outgoingFriendships")
     * @ORM\JoinColumn(nullable=true)
     */
    private $fromUser;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="incomingFriendships")
     * @ORM\JoinColumn(nullable=true)
     */
    private $toUser;

    /**
     * @var bool
     * @ORM\Column(name="approved", type="boolean", )
     */
    private $approved = false;

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
     * @return User
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @param User $fromUser
     */
    public function setFromUser($fromUser)
    {
        $this->fromUser = $fromUser;
    }

    /**
     * @return User
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * @param User $toUser
     */
    public function setToUser($toUser)
    {
        $this->toUser = $toUser;
    }

    /**
     * @return bool
     */
    public function isApproved()
    {
        return $this->approved;
    }

    /**
     * @param bool $approved
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;
    }
}