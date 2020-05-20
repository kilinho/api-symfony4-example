<?php declare(strict_types=1);

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document(
 *     repositoryClass="App\Repository\ResultGameRepository"
 * )
 */
final class ResultGame
{
    /**
     * @MongoDB\Id(strategy="AUTO")
     */
    protected $id;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $gameId;

    /**
     * @MongoDB\Field(type="string")
     */
    protected $resultGameId;

    /**
     * @MongoDB\EmbedOne(targetDocument="User")
     */
    protected $user;

    /**
     * @MongoDB\Field(type="int")
     */
    protected $score;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $finishedAt;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->gameId;
    }

    /**
     * @param mixed $gameId
     */
    public function setGameId($gameId): void
    {
        $this->gameId = $gameId;
    }

    /**
     * @return mixed
     */
    public function getResultGameId()
    {
        return $this->resultGameId;
    }

    /**
     * @param mixed $resultGameId
     */
    public function setResultGameId($resultGameId): void
    {
        $this->resultGameId = $resultGameId;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getScore()
    {
        return $this->score;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score): void
    {
        $this->score = $score;
    }

    /**
     * @return mixed
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * @param \DateTime $finishedAt
     */
    public function setFinishedAt(\DateTime $finishedAt): void
    {
        $this->finishedAt = $finishedAt;
    }
}