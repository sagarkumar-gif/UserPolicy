<?php 
namespace Application\Entity;

interface UserInterface
{
    public function getId();
    public function setId($id);

    public function getFirstname();
    public function setFirstname($firstname);

    public function getLastname();
    public function setLastname($lastname);

    public function getpolicynumber();
    public function setpolicynumber($policynumber);

    public function getstartdate();
    public function setstartdate($startdate);

    public function getenddate();
    public function setenddate($enddate);

    public function getpremium();
    public function setpremium($premium);
}
