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
}