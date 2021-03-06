<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 */
class Categoria
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
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Publicacion", mappedBy="categoria")
     */
    private $publicacion;

    public function __construct()
    {
        $this->publicacion = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Publicacion[]
     */
    public function getPublicacion(): Collection
    {
        return $this->publicacion;
    }

    public function addPublicacion(Publicacion $publicacion): self
    {
        if (!$this->publicacion->contains($publicacion)) {
            $this->publicacion[] = $publicacion;
            $publicacion->setCategoria($this);
        }

        return $this;
    }

    public function removePublicacion(Publicacion $publicacion): self
    {
        if ($this->publicacion->contains($publicacion)) {
            $this->publicacion->removeElement($publicacion);
            // set the owning side to null (unless already changed)
            if ($publicacion->getCategoria() === $this) {
                $publicacion->setCategoria(null);
            }
        }

        return $this;
    }
}
