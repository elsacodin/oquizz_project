<?php
namespace OQuiz\Models;

use OQuiz\Util\DBConnection;

class UserModel
{
    private $id;
    private $email;
    private $first_name;
    private $last_name;
    private $isLogged = false;

    function __construct()
    {
        if (!session_id()) {
            session_start();
        }

        if(isset($_SESSION['user']) && $_SESSION['user']->isLogged()) {
            $this->id = $_SESSION['user']->getId();
            $this->first_name = $_SESSION['user']->getFirstName();
            $this->last_name = $_SESSION['user']->getLastName();
            $this->email = $_SESSION['user']->getEmail();
            $this->isLogged = $_SESSION['user']->isLogged();
        }
    }

    /**
     * Get the value of Id
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of Email
     *
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of First Name
     *
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->first_name;
    }

    /**
     * Get the value of Last Name
     *
     * @return mixed
     */
    public function getLastName()
    {
        return $this->last_name;
    }

    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function isLogged() { return $this->isLogged; }

    public function logOut()
    {
        $this->isLogged = false;
        session_unset();
        session_destroy();
    }

    static public function register($userData) {
        $db = DBConnection::getInstance();

        $datas = [
            'id' => NULL,
            'first_name' => trim($userData['first_name']),
            'last_name' => trim($userData['last_name']),
            'email' => $userData['email'],
            'password' => password_hash($userData['password'], PASSWORD_DEFAULT),
        ];

        $names = implode(', ', array_keys($datas));
        $placeholders = implode(',', array_fill(0, count($datas), '?'));

        $stmt = "INSERT INTO users ($names) VALUES ($placeholders)";
        $query = $db->prepare($stmt);
        return $query->execute(array_values($datas));
    }

    static public function isEmailExists($email) {
        $db = DBConnection::getInstance();

        $stmt = 'SELECT id FROM users WHERE email = :userEmail';
        $query = $db->prepare($stmt);
        $query->bindValue(':userEmail', $email);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC);
    }

    static public function findByEmail($email) {
        $db = DBConnection::getInstance();

        $stmt = 'SELECT * FROM users WHERE email = :userEmail LIMIT 1';
        $query = $db->prepare($stmt);
        $query->bindValue(':userEmail', $email);
        $query->execute();
        return $query->fetchObject(static::class);
    }

    static public function auth($email, $password)
    {
        $user = static::findByEmail($email);

        if ($user) {
            if (password_verify($password, $user->password)) {
                $user->isLogged = true;
                $_SESSION['user'] = $user;
                return true;
            }
        }
        return false;
    }
}
