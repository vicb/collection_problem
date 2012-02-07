<?php

namespace Ibrows\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Ibrows\TaskBundle\Repository\TagRepository")
 * @ORM\Table(name="tag")
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @var Task $task
     * 
     * @ORM\ManyToOne(targetEntity="Task", inversedBy="tags")
     * @ORM\JoinColumn(name="task_id", referencedColumnName="id")
     */
    protected $task;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    protected $name;
    
    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }
    
    public function getTask() {
        return $this->task;
    }
    
    public function setTask(Task $task) {
        $this->task = $task;
        return $this;
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
    
    public function __toString() {
        return $this->getName();
    }

}