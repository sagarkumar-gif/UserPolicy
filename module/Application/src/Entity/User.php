<?php
namespace Application\Entity;

class User implements UserInterface
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $firstname;

    /**
     * @var string
     */
    public $lastname;

    /**
     * @var integer
     */       
    public $policynumber;

    /**
     * @var date
     */  
    public $startdate;

    /**
     * @var date
     */  
    public $enddate;

    /**
     * @var integer
     */  
    public $premium;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return integer
     */
    public function getpolicynumber()
    {
        return $this->policynumber;
    }

    /**
     * @param integer $policynumber
     *
     * @return self
     */
    public function setpolicynumber($policynumber)
    {
        $this->policynumber = $policynumber;
        return $this;
    }

    /**
     * @return date
     */
    public function getstartdate()
    {
        return $this->startdate;
    }

    /**
     * @param date $startdate
     *
     * @return self
     */
    public function setstartdate($startdate)
    {
        $this->startdate = $startdate;
        return $this;
    }

    /**
     * @return date
     */
    public function getenddate()
    {
        return $this->enddate;
    }

    /**
     * @param date $enddate
     *
     * @return self
     */
    public function setenddate($enddate)
    {
        $this->enddate = $enddate;
        return $this;
    }

    /**
     * @return integer
     */
    public function getpremium()
    {
        return $this->premium;
    }

    /**
     * @param integer $premium
     *
     * @return self
     */
    public function setpremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }
}