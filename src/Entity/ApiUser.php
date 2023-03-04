<?php
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
/**
* @ORM\Entity
* @ORM\Table(name="apiuser")
*/
class ApiUser implements UserInterface
{
   /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
   private $id;
   /**
    * @ORM\Column(type="string", unique=true)
    */
   private $username;
   /**
    * @ORM\Column(type="string", unique=true)
    */
   private $email;
   /**
    * @ORM\Column(type="string")
    */
   private $password;
   /**
    * @ORM\Column(type="json_array")
    */
   private $roles = array();
   /**
    * @ORM\Column(type="string", unique=true)
    */
   private $apiToken;
   public function getId()
   {
       return $this->id;
   }
   public function getUsername()
   {
       return $this->username;
   }
   public function setUsername($username)
   {
       $this->username = $username;
   }
   public function getEmail()
   {
       return $this->email;
   }
   public function setEmail($email)
   {
       $this->email = $email;
   }
   public function getPassword()
   {
       return $this->password;
   }
   public function setPassword($password)
   {
       $this->password = $password;
   }
   /**
    * Returns the roles or permissions granted to the user for security.
    */
   public function getRoles()
   {
       $roles = $this->roles;
       // guarantees that a user always has at least one role for security
       if (empty($roles)) {
           $roles[] = 'ROLE_USER';
       }
       return array_unique($roles);
   }
   public function setRoles($roles)
   {
       $this->roles = $roles;
   }
   /**
    * Returns the salt that was originally used to encode the password.
    */
   public function getSalt()
   {
       return;
   }
   /**
    * Removes sensitive data from the user.
    */
   public function eraseCredentials()
   {
       // if you had a plainPassword property, you'd nullify it here
       // $this->plainPassword = null;
   }
   /**
    * @param string $apiToken
    */
   public function setApiToken($apiToken)
   {
       $this->apiToken = $apiToken;
   }
}