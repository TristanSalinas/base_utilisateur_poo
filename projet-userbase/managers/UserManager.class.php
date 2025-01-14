<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../models/User.class.php';



class UserManager
{
  /** @var User[] */
  private array $users;

  private PDO $db;

  public function __construct()
  {
    $users = [];
    $this->initDb();
  }

  /**
   * load database user in this instance users array
   */
  public function loadUsers(): void
  {
    $query = $this->db->prepare('SELECT * FROM users');
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $this->users = array_map(function ($userInfo) {
      $user =  new User(
        $userInfo['username'],
        $userInfo['email'],
        $userInfo['password'],
        $userInfo['role'],
      );
      $user->setId($userInfo['id']);
      return $user;
    }, $result);
  }
  /**
   * Save user in database
   */
  public function saveUser(User $user): void
  {
    $query = $this->db->prepare(
      'INSERT INTO users (username, email, password, role)
          VALUES (:username, :email, :password, :role)'
    );
    $parameters = [
      'username' => $user->getUsername(),
      'email' => $user->getEmail(),
      'password' => $user->getPassword(),
      'role' => $user->getRole(),
    ];
    $query->execute($parameters);
  }
  /**
   * Delete user in database
   */
  public function deleteUser(int $id): void
  {
    $query = $this->db->prepare(
      'DELETE FROM users WHERE id = :id'
    );
    $parameters = ['id' => $id];
    $query->execute($parameters);
  }

  /**
   * connect this instance db to the dataBase
   */
  private function initDb(): void
  {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $host = $_ENV['DB_HOST'];
    $port = $_ENV['DB_PORT'];
    $user = $_ENV['DB_USERNAME'];
    $password = $_ENV['DB_PASSWORD'];
    $dbname = $_ENV['DB_NAME'];

    $connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

    try {
      $this->db = new PDO(
        $connexionString,
        $user,
        $password
      );
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  }
  /**
   * Get the value of users
   */
  public function getUsers()
  {
    return $this->users;
  }

  /**
   * Set the value of users
   *
   * @return  self
   */
  public function setUsers($users)
  {
    $this->users = $users;

    return $this;
  }
}
