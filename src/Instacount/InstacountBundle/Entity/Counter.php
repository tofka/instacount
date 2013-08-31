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
}