<?php
 
namespace App\Entity;
 
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
 
/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @ORM\Table(name="currencyDict")
 * @ApiResource(
 *   normalizationContext={"groups" = {"read"}},
 *   attributes={"route_prefix"="/calculator"},
 *   itemOperations={"get"},
 *   collectionOperations={"get"}
 * )
 */

class CurrencyDict

{
    /**
       * @ORM\Id
       * @ORM\GeneratedValue(strategy="AUTO")
       * @ORM\Column(type="integer")
       * @Groups({"read"})
     * ID of record
      */
    private ?int $id = null;

    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */
    public float $unit_sgd_pln  ;
 
    /**
     * @ORM\Column(type="float")
     * @Groups({"read"})
     */ 
    
    public float $unit_pln_sgd   ;
   /**
     * @ORM\Column(length=70)
     * @Assert\NotBlank()
     * @Groups({"read"})
     */
    public string $desc;
 
    /******** METHODS ********/
 
    public function getId()
    {
        return $this->id;
    }
  
    public function __toString()
    {
        return $this->desc;
    }
  
 
}