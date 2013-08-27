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
}