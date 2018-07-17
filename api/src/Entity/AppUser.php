<?php

namespace App\Entity;

use App\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use App\Controller\UserRegistration;

/**
 * @ApiResource(
 *      collectionOperations={
 *     "get",
 *     "post",
 *      "special"={
 *          "method"="POST",
 *          "path"="/user/registration",
 *          "controller"=UserRegistration::class
 *      }
 *     },
 *     normalizationContext={"groups"={"read"}},
 *     denormalizationContext={"groups"={"write"}}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\AppUserRepository")
 */

class AppUser extends BaseUser
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    protected $id;

    /**
     * @ORM\Column(type="string",unique=true)
     */
    protected $username;

    /**
     * @ORM\Column(type="string",nullable=true)
     * @Groups({"read"})
     */
    protected $usernameCanonical;

    /**
     * @var string
     * @ORM\Column(type="string",unique=true)
     * @Groups({"read", "write"})
     */
    protected $email;
    /**
     * @var string|null
     * @ORM\Column(type="string",nullable=true)
     * @Groups({"read"})
     */
    protected $emailCanonical;
    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $enabled;
    /**
     * The salt to use for hashing.
     *
     * @var string|null
     * @ORM\Column(type="string",nullable=true)
     */
    protected $salt;
    /**
     * Encrypted password. Must be persisted.
     *
     * @var string
     * @ORM\Column(type="string")
     * @Groups({"read"})
     */
    protected $password;
    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $lastLogin;
    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string|null
     * @ORM\Column(type="string",nullable=true)
     */
    protected $confirmationToken;
    /**
     * @var \DateTime|null
     * @ORM\Column(type="datetime",nullable=true)
     */
    protected $passwordRequestedAt;
    /**
     * Random string sent to the user email address in order to verify it.
     *
     * @var string|null
     * @Groups({"write"})
     */
    protected $plainPassword;
    /**
     * @var array
     * @ORM\Column(type="array")
     */
    protected $roles;

}
