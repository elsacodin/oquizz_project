<?php
namespace OQuiz\Models;

use OQuiz\Util\DBConnection;

/**
 *
 */
class QuizModel
{
    private $id;
    private $title;
    private $description;
    private $id_author;

    private $author;


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
     * Get the value of Title
     *
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Get the value of Description
     *
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get the value of Author
     *
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of Id
     *
     * @param mixed id
     *
     * @return self
     */
    private function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set the value of Title
     *
     * @param mixed title
     *
     * @return self
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Set the value of Description
     *
     * @param mixed description
     *
     * @return self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Set the value of Author
     *
     * @param mixed author
     *
     * @return self
     */
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }


    static public function find($id)
    {
        $db = DBConnection::getInstance();
        $sql = 'SELECT q.*, concat(a.first_name, concat(" ", a.last_name)) as author
                        FROM quizzes q, users a
                        WHERE q.id_author = a.id AND q.id = :id';
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetchObject(static::class);
    }

    static public function findAll()
    {
        $db = DBConnection::getInstance();
        $sql = 'SELECT q.*, concat(a.first_name, concat(" ", a.last_name)) as author
                        FROM quizzes q, users a
                        WHERE q.id_author = a.id';
        $query = $db->query($sql);
        return $query->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

    static public function findByUser($id)
    {
        $db = DBConnection::getInstance();
        $sql = 'SELECT q.*, concat(a.first_name, concat(" ", a.last_name)) as author
                        FROM quizzes q, users a
                        WHERE q.id_author = a.id AND a.id = :id';
        $query = $db->prepare($sql);
        $query->bindValue(':id', $id);
        $query->execute();
        return $query->fetchAll(\PDO::FETCH_CLASS, static::class);
    }

}
