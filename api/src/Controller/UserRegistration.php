<?php
/**
 * Created by IntelliJ IDEA.
 * User: james
 * Date: 15/07/18
 * Time: 7:33 PM
 */

namespace App\Controller;

use App\Entity\AppUser;
use App\Model\UserManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserRegistration
{

    private $encoder;
    /**
     * @var UserManagerInterface
     */
    private $userManager;


    public function __construct(UserPasswordEncoderInterface $encoder, UserManagerInterface $userManager)
    {
        $this->encoder = $encoder;
        $this->userManager = $userManager;
    }

    public function __invoke(AppUser $data): AppUser
    {
        $data->setUsername($data->getEmail());
        $this->userManager->updateUser($data);
        return $data;
    }

}
