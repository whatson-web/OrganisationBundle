<?php

namespace WH\OrganisationBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Organisation
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="APP\OrganisationBundle\Entity\OrganisationRepository")
 */
abstract class Organisation
{


    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * Raison sociale
     * @var string
     *
     * @ORM\Column(name="social_reason", type="string", length=255, nullable=true)
     */
    protected $socialReason;

    /**
     * Type dd'organisation : Entreprise, ou particulier
     * @var string
     *
     * @ORM\Column(name="organisation_type", type="string", length=255)
     */
    protected $organisationType;


    /**
     * @var string
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=255, nullable=true)
     */
    protected $lastname;

    /**
     * Civilité
     *
     * @var string
     * @ORM\Column(name="civility", type="string", length=255, nullable=true)
     */
    protected $civility;


    /**
     * @var string
     * @ORM\Column(name="function", type="string", length=255, nullable=true)
     */
    protected $function;


    /**
     * @var String
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    protected $comment;

    /**
     * Numéro de tva
     * @var string
     *
     * @ORM\Column(name="tva_number", type="string", length=255, nullable=true)
     */
    protected $tva_number;


    /**
     * Numéro de siret
     * @var string
     *
     * @ORM\Column(name="siret_number", type="string", length=255, nullable=true)
     */
    protected $siret_number;

    /**
     * Numéro de siren
     * @var string
     *
     * @ORM\Column(name="siren_number", type="string", length=255, nullable=true)
     */
    protected $siren_number;

    /**
     * code de ape
     * @var string
     *
     * @ORM\Column(name="code_ape", type="string", length=255, nullable=true)
     */
    protected $code_ape;

    /**
     * Forme Juridique
     * @ORM\ManyToOne(targetEntity="APP\OrganisationBundle\Entity\LegalForm")
     */
    protected $LegalForm;


    /**
     * @var String
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     */
    protected $mobile;


    /**
     * @var String
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    protected $phone;

    /**
     * @var String
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    protected $email;


    /**
     * @var String
     * @ORM\Column(name="adress", type="text", length=255, nullable=true)
     */
    protected $adress;

    /**
     * @var String
     * @ORM\Column(name="adress_cplt", type="text", length=255, nullable=true)
     */
    protected $adressCplt;

    /**
     * @var String
     * @ORM\Column(name="zip_code", type="text", length=255, nullable=true)
     */
    protected $zipCode;

    /**
     * @var String
     * @ORM\Column(name="town", type="text", length=255, nullable=true)
     */
    protected $town;

    /**
     * @ORM\Column(name="iframeGoogleMap", type="text", nullable=true)
     */
    protected $iframeGoogleMap;

    /**
     * @var String
     * @ORM\Column(name="country", type="text", length=255, nullable=true)
     */
    protected $country;

    /**
     *
     * States : Collection
     *
     * @ORM\ManyToMany(targetEntity="APP\OrganisationBundle\Entity\CustomerState", cascade={"persist"})
     * @ORM\OrderBy({"name" = "ASC"})
     */
    protected $states;


    /**
     * @var \DateTime
     * @ORM\Column(name="created", type="datetime", nullable=true)
     */
    protected $created;


    /**
     * @var string
     * @ORM\Column(name="def", type="boolean", nullable=true)
     */
    protected $default;

    /**
     *
     * States : Collection
     *
     * @ORM\ManyToOne(targetEntity="APP\CmsBundle\Entity\Page", cascade={"persist", "remove"})
     */
    protected $page;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->default              = false;
        $this->states               = new ArrayCollection();
        $this->created              = new \DateTime();
        $this->organisationType     = 'part';

    }


    /**
     * Set id
     *
     * @return integer
     */
    public function setId($id)
    {
        $this->id = $id;
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Get socialReason
     *
     * @return string 
     */
    public function getSocialReason()
    {
        return $this->socialReason;
    }


    /**
     * Set socialReason
     *
     * @param string $socialReason
     * @return Organisation
     */
    public function setSocialReason($socialReason)
    {
        $this->socialReason = $socialReason;

        return $this;
    }

    /**
     * Set tva_number
     *
     * @param string $tvaNumber
     * @return Organisation
     */
    public function setTvaNumber($tvaNumber)
    {
        $this->tva_number = $tvaNumber;

        return $this;
    }

    /**
     * Get tva_number
     *
     * @return string 
     */
    public function getTvaNumber()
    {
        return $this->tva_number;
    }

    /**
     * Set siret_number
     *
     * @param string $siretNumber
     * @return Organisation
     */
    public function setSiretNumber($siretNumber)
    {
        $this->siret_number = $siretNumber;

        return $this;
    }

    /**
     * Get siret_number
     *
     * @return string 
     */
    public function getSiretNumber()
    {
        return $this->siret_number;
    }

    /**
     * Set siren_number
     *
     * @param string $sirenNumber
     * @return Organisation
     */
    public function setSirenNumber($sirenNumber)
    {
        $this->siren_number = $sirenNumber;

        return $this;
    }

    /**
     * Get siren_number
     *
     * @return string 
     */
    public function getSirenNumber()
    {
        return $this->siren_number;
    }

    /**
     * Set code_ape
     *
     * @param string $codeApe
     * @return Organisation
     */
    public function setCodeApe($codeApe)
    {
        $this->code_ape = $codeApe;

        return $this;
    }

    /**
     * Get code_ape
     *
     * @return string 
     */
    public function getCodeApe()
    {
        return $this->code_ape;
    }

    /**
     * Set LegalForm
     *
     * @param \APP\OrganisationBundle\Entity\LegalForm $legalForm
     * @return Organisation
     */
    public function setLegalForm(\APP\OrganisationBundle\Entity\LegalForm $legalForm = null)
    {
        $this->LegalForm = $legalForm;

        return $this;
    }

    /**
     * Get LegalForm
     *
     * @return \APP\OrganisationBundle\Entity\LegalForm
     */
    public function getLegalForm()
    {
        return $this->LegalForm;
    }

    /**
     * Set adress
     *
     * @param string $adress
     * @return Organisation
     */
    public function setAdress($adress)
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * Get adress
     *
     * @return string 
     */
    public function getAdress()
    {
        return $this->adress;
    }

    /**
     * Set adressCplt
     *
     * @param string $adressCplt
     * @return Organisation
     */
    public function setAdressCplt($adressCplt)
    {
        $this->adressCplt = $adressCplt;

        return $this;
    }

    /**
     * Get adressCplt
     *
     * @return string 
     */
    public function getAdressCplt()
    {
        return $this->adressCplt;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     * @return Organisation
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string 
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set town
     *
     * @param string $town
     * @return Organisation
     */
    public function setTown($town)
    {
        $this->town = $town;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getTown()
    {
        return $this->town;
    }

    /**
     * @param $iframeGoogleMap
     * @return $this
     */
    public function setIframeGoogleMap($iframeGoogleMap)
    {
        $this->iframeGoogleMap = $iframeGoogleMap;

        return $this;
    }

    /**
     * Get town
     *
     * @return string
     */
    public function getIframeGoogleMap()
    {
        return $this->iframeGoogleMap;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Organisation
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }


    /**
     * Set mobile
     *
     * @param string $mobile
     * @return Organisation
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile
     *
     * @return string 
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Organisation
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Organisation
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Organisation
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Organisation
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set function
     *
     * @param string $function
     * @return Organisation
     */
    public function setFunction($function)
    {
        $this->function = $function;

        return $this;
    }

    /**
     * Get function
     *
     * @return string 
     */
    public function getFunction()
    {
        return $this->function;
    }

 
    /**
     * Set comment
     *
     * @param string $comment
     * @return Organisation
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set civility
     *
     * @param string $civility
     * @return Organisation
     */
    public function setCivility($civility)
    {
        $this->civility = $civility;

        return $this;
    }

    /**
     * Get civility
     *
     * @return string 
     */
    public function getCivility()
    {
        return $this->civility;
    }


    /**
     * Set organisationType
     *
     * @param string $organisationType
     * @return Organisation
     */
    public function setOrganisationType($organisationType)
    {
        $this->organisationType = $organisationType;

        return $this;
    }

    /**
     * Get organisationType
     *
     * @return string 
     */
    public function getOrganisationType()
    {
        return $this->organisationType;
    }

 
    /**
     * @return string
     */
    public function getName() {



        if($this->organisationType == 'part') {

            $name = $this->firstname.' '.$this->lastname;

        }else{

            $name = $this->socialReason;

        }

        if(empty($this->firstname) && empty($this->lastname) && empty($this->socialReason)) $name = $this->email;

        return $name;

    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Organisation
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }


    /**
     * Add states
     *
     * @param \APP\OrganisationBundle\Entity\CustomerState $states
     * @return Organisation
     */
    public function addState(\APP\OrganisationBundle\Entity\CustomerState $states)
    {
        $this->states[] = $states;

        return $this;
    }

    /**
     * Remove states
     *
     * @param \APP\OrganisationBundle\Entity\CustomerState $states
     */
    public function removeState(\APP\OrganisationBundle\Entity\CustomerState $states)
    {
        $this->states->removeElement($states);
    }

    /**
     * Get states
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * Set page
     *
     * @param \APP\CmsBundle\Entity\Page $page
     * @return Organisation
     */
    public function setPage(\APP\CmsBundle\Entity\Page $page = null)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return \APP\CmsBundle\Entity\Page 
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set default
     *
     * @param boolean $default
     * @return Organisation
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function getDefault()
    {
        return $this->default;
    }

}
