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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="outgoing_friendship")
     * @ORM\JoinColumn(nullable=true)
     */
    private $fromUser;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="incoming_friendship")
     * @ORM\JoinColumn(nullable=true)
     */
    private $toUser;

    /**
     * @var bool
     * @ORM\Column(name="approved", type="boolean", )
     */
    private $approved = false;

    public function __construct()
    {
        $this->fromUser = new ArrayCollection();
        $this->toUser = new ArrayCollection();
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
     * @return ArrayCollection
     */
    public function getFromUser()
    {
        return $this->fromUser;
    }

    /**
     * @param ArrayCollection $fromUser
     */
    public function setFromUser($fromUser)
    {
        $this->fromUser = $fromUser;
    }

    /**
     * @return ArrayCollection
     */
    public function getToUser()
    {
        return $this->toUser;
    }

    /**
     * @param ArrayCollection $toUser
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