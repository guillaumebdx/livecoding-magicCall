<?php
require_once 'connec.php';
require_once 'Bribe.php';

class BribeModel
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO(DSN, USER, PASS);
    }

    public function __call($name, $arguments)
    {
        $attribut  = $this->retrieveAttribut($name);
        $query     = $this->createQuery($arguments, $attribut);
        $statement = $this->pdo->prepare($query);

        $i = 0;
        foreach ($arguments[0] as $argument) {
            $statement->bindValue(':argument' . $i, $argument);
            $i++;
        }
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Bribe');
    }

    private function createQuery($arguments, $attribut)
    {
        $query = 'SELECT * FROM bribe WHERE ';
        $i = 0;
        foreach ($arguments[0] as $argument) {
            $query .= $attribut . ' = :argument' . $i;
            if ($i !== count($arguments[0]) -1) {
                $query .= ' OR ';
            }
            $i++;
        }
        return $query;
    }

    private function retrieveAttribut($name)
    {
        return strtolower(substr($name, 6));
    }

    public function findAllBribes()
    {
        $query = 'SELECT * FROM bribe';
        $statement = $this->pdo->query($query);
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Bribe');
    }

    public function findByFirstLetter($letter): array
    {
        $query = 'SELECT * FROM bribe WHERE name LIKE :letter';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':letter', $letter . '%', PDO::PARAM_STR);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_CLASS, 'Bribe');
    }

    public function findOneById(int $id): Bribe
    {
        $query = 'SELECT * FROM bribe WHERE id=:id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        $statement->setFetchMode(PDO::FETCH_CLASS, 'Bribe');
        return $statement->fetch();
    }

}