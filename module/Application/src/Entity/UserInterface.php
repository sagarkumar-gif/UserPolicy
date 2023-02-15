<?php 
namespace Application\Entity;

interface UserInterface
{
    
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     *
     * @return self
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getFirstname();

    /**
     * @param string $firstname
     *
     * @return self
     */
    public function setFirstname($firstname);

    /**
     * @return string
     */
    public function getLastname();

    /**
     * @param string $lastname
     *
     * @return self
     */
    public function setLastname($lastname);

    /**
     * @return int
     */
    public function getpolicynumber();

    /**
     * @param int $policynumber
     *
     * @return self
     */
    public function setpolicynumber($policynumber);

    /**
     * @return date
     */
    public function getstartdate();

    /**
     * @param date $startdate
     *
     * @return self
     */
    public function setstartdate($startdate);

    /**
     * @return date
     */
    public function getenddate();

    /**
     * @param date $enddate
     *
     * @return self
     */
    public function setenddate($enddate);

    /**
     * @return int
     */
    public function getpremium();

    /**
     * @param int $premium
     *
     * @return self
     */
    public function setpremium($premium);
}