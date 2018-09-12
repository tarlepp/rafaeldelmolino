<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BarRepository")
 */
class Bar
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @OneToMany(targetEntity="Foo", mappedBy="bar")
     */
    private $foos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $clonedFrom = null;

    public function __construct()
    {
        $this->foos = new ArrayCollection();
    }

    public function __clone()
    {
        if ($this->id) {
            $this->setClonedFrom($this->id);
            $this->id = null;

            $foosClone = new ArrayCollection();

            foreach ($this->getFoos() as $foo) {
                /** @var Foo $fooClone */
                $fooClone = clone $foo;
                $fooClone->setBar($this);
                $foosClone->add($fooClone);
            }

            $this->foos = $foosClone;
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getFoos()
    {
        return $this->foos;
    }

    public function setFoos($foos): self
    {
        $this->foos = $foos;

        return $this;
    }

    public function addFoo(Foo $foo): self
    {
        $this->foos->add($foo);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getClonedFrom(): ?int
    {
        return $this->clonedFrom;
    }

    /**
     * @param mixed $clonedFrom
     *
     * @return \App\Entity\Bar
     */
    public function setClonedFrom(?int $clonedFrom): self
    {
        $this->clonedFrom = $clonedFrom;

        return $this;
    }
}
