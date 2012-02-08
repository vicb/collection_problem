<?php

namespace Ibrows\TaskBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="Ibrows\TaskBundle\Repository\TaskRepository")
 * @ORM\Table(name="task")
 */
class Task {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\generatedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=300, nullable=true)
     */
    protected $description;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection $tags
     * 
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="task")
     */
    protected $tags;

    public function __construct() {
        $this->tags = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getTags() {
        return $this->tags;
    }

    public function setTags(\Doctrine\Common\Collections\Collection $tags) {
        foreach($tags as $tag) {
            if($tag instanceof Tag) {
                $tag->setTask($this);
            }
        }
        $this->tags = $tags;
        return $this;
    }

    public function addTag(Tag $tag) {
        $tag->setTask($this);
        $this->tags[] = $tag;
        return $this;
    }
    
    public function removeTag(Tag $tag) {
        $this->tags->removeElement($tag);
        return $this;
    }
    
    public function __toString() {
        return $this->getDescription();
    }

}