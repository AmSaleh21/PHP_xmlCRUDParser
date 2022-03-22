<?php

class EmployeeDTO
{
    private string $name = "Not-Existed";
    private string $phone = "-";
    private string $address = "-";
    private string $email = "-";
    private int $position = 0;

    

    /**
     * Get the value of name
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of phone
     *
     * @return  string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @param  string  $phone
     */
    public function setPhone(string $phone)
    {
        $this->phone = $phone;
    }

    /**
     * Get the value of address
     *
     * @return  string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @param  string  $address
     */
    public function setAddress(string $address)
    {
        $this->address = $address;
    }

    /**
     * Get the value of email
     *
     * @return  string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string  $email
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    /**
     * Get the value of position
     *
     * @return  int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set the value of position
     *
     * @param  int  $position
     */
    public function setPosition(int $position)
    {
        $this->position = $position;
    }
}
