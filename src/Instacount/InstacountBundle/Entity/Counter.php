<?php

namespace Instacount\InstacountBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Counter")
 */

class Counter
{
	 /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
      /**
     * @ORM\Column(type="integer")
     */
    protected $count;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $fb_like;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $fb_were_here;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $fb_talking;




       /**
     * @ORM\Column(type="datetime")
     */
    protected $timestamp;

    /**
    * @ORM\ManyToOne(targetEntity="Campaign", inversedBy="campaign")
    * @ORM\JoinColumn(name="campaign_id", referencedColumnName="id")
    */
    protected $campaign;
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
     * Set count
     *
     * @param integer $count
     * @return Counter
     */
    public function setCount($count)
    {
        $this->count = $count;
    
        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Counter
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;
    
        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set campaign
     *
     * @param \Instacount\InstacountBundle\Entity\Campaign $campaign
     * @return Counter
     */
    public function setCampaign(\Instacount\InstacountBundle\Entity\Campaign $campaign = null)
    {
        $this->campaign = $campaign;
    
        return $this;
    }

    /**
     * Get campaign
     *
     * @return \Instacount\InstacountBundle\Entity\Campaign 
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Set fb_like
     *
     * @param integer $fbLike
     * @return Counter
     */
    public function setFbLike($fbLike)
    {
        $this->fb_like = $fbLike;
    
        return $this;
    }

    /**
     * Get fb_like
     *
     * @return integer 
     */
    public function getFbLike()
    {
        return $this->fb_like;
    }

    /**
     * Set fb_were_here
     *
     * @param integer $fbWereHere
     * @return Counter
     */
    public function setFbWereHere($fbWereHere)
    {
        $this->fb_were_here = $fbWereHere;
    
        return $this;
    }

    /**
     * Get fb_were_here
     *
     * @return integer 
     */
    public function getFbWereHere()
    {
        return $this->fb_were_here;
    }

    /**
     * Set fb_talking
     *
     * @param integer $fbTalking
     * @return Counter
     */
    public function setFbTalking($fbTalking)
    {
        $this->fb_talking = $fbTalking;
    
        return $this;
    }

    /**
     * Get fb_talking
     *
     * @return integer 
     */
    public function getFbTalking()
    {
        return $this->fb_talking;
    }
}