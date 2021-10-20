<?php

class Bribe
{
    private int $id;

    private int $payment;

    private string $name;

    public function isInTrouble(): bool
    {
        return $this->payment > 500;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getPayment(): int
    {
        return $this->payment;
    }

    /**
     * @param int $payment
     */
    public function setPayment(int $payment): void
    {
        $this->payment = $payment;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }



}