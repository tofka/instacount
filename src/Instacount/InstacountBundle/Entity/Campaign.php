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
     * @ORM\Column(type="datetime")
     */
    protected $start_date;
       /**
     * @ORM\Column(type="datetime")
     */
    protected $end_date;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
 	* @ORM\ManyToOne(targetEntity="User", inversedBy="user")
 	* @ORM\JoinColumn(name="user_id", referencedColumnName="id")
 	*/
	protected $user;
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
}