<?php
namespace Application\Entity;

class User implements UserInterface
{
	public $id;
	public $firstname;
	public $lastname;		
	public $policynumber;
	public $startdate;
    public $enddate;
    public $premium;

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        return $this;
    }

    public function getLastname()
    {
        return $this->lastname;
    }
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        return $this;
    }

    public function getpolicynumber()
    {
        return $this->policynumber;
    }
    public function setpolicynumber($policynumber)
    {
        $this->policynumber = $policynumber;
        return $this;
    }

    public function getstartdate()
    {
        return $this->startdate;
    }
    public function setstartdate($startdate)
    {
        $this->startdate = $startdate;
        return $this;
    }

    public function getenddate()
    {
        return $this->enddate;
    }
    public function setenddate($enddate)
    {
        $this->enddate = $enddate;
        return $this;
    }

    public function getpremium()
    {
        return $this->premium;
    }
    public function setpremium($premium)
    {
        $this->premium = $premium;

        return $this;
    }
 
}