<?php

namespace Instacount\InstacountBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Campaign")
 */
class Campaign
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
       /**
     * @ORM\Column(type="date")
     */
    protected $start_date;
       /**
     * @ORM\Column(type="date")
     */
    protected $end_date;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $tag;

    /**
 	* @ORM\ManyToOne(targetEntity="User", inversedBy="user")
 	* @ORM\JoinColumn(name="user_id", referencedColumnName="id")
 	*/
	protected $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $positions=null;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $facebook_url;

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
     * Set start_date
     *
     * @param \DateTime $startDate
     * @return Campaign
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;
    
        return $this;
    }

    /**
     * Get start_date
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set end_date
     *
     * @param \DateTime $endDate
     * @return Campaign
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;
    
        return $this;
    }

    /**
     * Get end_date
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Campaign
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set user
     *
     * @param \Instacount\InstacountBundle\Entity\User $user
     * @return Campaign
     */
    public function setUser(\Instacount\InstacountBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Instacount\InstacountBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set tag
     *
     * @param string $tag
     * @return Campaign
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    
        return $this;
    }

    /**
     * Get tag
     *
     * @return string 
     */
    public function getTag()
    {
        return $this->tag;
    }
    
        public function __toString()
{
    return $this->getName();
}


    /**
     * Set positions
     *
     * @param string $positions
     * @return Campaign
     */
    public function setPositions($positions)
    {
        $this->positions = $positions;
    
        return $this;
    }

    /**
     * Get positions
     *
     * @return string 
     */
    public function getPositions()
    {
        return $this->positions;
    }

    /**
     * Set facebook_url
     *
     * @param string $facebookUrl
     * @return Campaign
     */
    public function setFacebookUrl($facebookUrl)
    {
        $this->facebook_url = $facebookUrl;
    
        return $this;
    }

    /**
     * Get facebook_url
     *
     * @return string 
     */
    public function getFacebookUrl()
    {
        return $this->facebook_url;
    }
}