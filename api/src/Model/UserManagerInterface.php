<?php
/**
 * Created by IntelliJ IDEA.
 * User: james
 * Date: 15/07/18
 * Time: 7:43 PM
 */

namespace App\Model;

use App\Model\ExtendedUserInterface;

/**
 * Interface to be implemented by user managers. This adds an additional level
 * of abstraction between your application, and the actual repository.
 *
 * All changes to users should happen through this interface.
 *
 * The class also contains ACL annotations which will only work if you have the
 * SecurityExtraBundle installed, otherwise they will simply be ignored.
 *
 * @author Gordon Franke <info@nevalon.de>
 * @author Thibault Duplessis <thibault.duplessis@gmail.com>
 * @author Johannes M. Schmitt <schmittjoh@gmail.com>
 */
interface UserManagerInterface
{
    /**
     * Creates an empty user instance.
     *
     * @return ExtendedUserInterface
     */
    public function createUser();

    /**
     * Deletes a user.
     *
     * @param ExtendedUserInterface $user
     */
    public function deleteUser(ExtendedUserInterface $user);

    /**
     * Finds one user by the given criteria.
     *
     * @param array $criteria
     *
     * @return ExtendedUserInterface|null
     */
    public function findUserBy(array $criteria);

    /**
     * Find a user by its username.
     *
     * @param string $username
     *
     * @return ExtendedUserInterface|null
     */
    public function findUserByUsername($username);

    /**
     * Finds a user by its email.
     *
     * @param string $email
     *
     * @return ExtendedUserInterface|null
     */
    public function findUserByEmail($email);

    /**
     * Finds a user by its username or email.
     *
     * @param string $usernameOrEmail
     *
     * @return ExtendedUserInterface|null
     */
    public function findUserByUsernameOrEmail($usernameOrEmail);

    /**
     * Finds a user by its confirmationToken.
     *
     * @param string $token
     *
     * @return ExtendedUserInterface|null
     */
    public function findUserByConfirmationToken($token);

    /**
     * Returns a collection with all user instances.
     *
     * @return \Traversable
     */
    public function findUsers();

    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass();

    /**
     * Reloads a user.
     *
     * @param ExtendedUserInterface $user
     */
    public function reloadUser(ExtendedUserInterface $user);

    /**
     * Updates a user.
     *
     * @param ExtendedUserInterface $user
     */
    public function updateUser(ExtendedUserInterface $user);

    /**
     * Updates the canonical username and email fields for a user.
     *
     * @param ExtendedUserInterface $user
     */
    public function updateCanonicalFields(ExtendedUserInterface $user);

    /**
     * Updates a user password if a plain password is set.
     *
     * @param ExtendedUserInterface $user
     */
    public function updatePassword(ExtendedUserInterface $user);
}

