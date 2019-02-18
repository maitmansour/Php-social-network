<?php
/*
 *Entity Utilisateur
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
/** 
 * @Entity
 * @Table(name="fredouil.utilisateur")
 */
class utilisateur
{
    
    /** @Id @Column(type="integer")
     *  @GeneratedValue
     */
    private $id;
    
    /** @Column(type="string", length=45) */
    private $identifiant;
    
    /** @Column(type="string", length=45) */
    private $pass;
    
    /** @Column(type="string", length=45) */
    private $nom;
    
    /** @Column(type="string", length=45) */
    private $prenom;
    
    /** @Column(type="string", length=100) */
    private $statut;
    
    /** @Column(type="string", length=200) */
    private $avatar;
    
    /** @Column(type="datetime") */
    private $date_de_naissance;


    /**
     * Set identifiant
     *
     * @param string $identifiant
     *
     * @return Utilisateur
     */
    public function setIdentifiant($identifiant)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Get identifiant
     *
     * @return string
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Set pass
     *
     * @param string $pass
     *
     * @return Utilisateur
     */
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get pass
     *
     * @return string
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set dateDeNaissance
     *
     * @param \DateTime $dateDeNaissance
     *
     * @return Utilisateur
     */
    public function setDateDeNaissance($dateDeNaissance)
    {
        $this->date_de_naissance = $dateDeNaissance;

        return $this;
    }

    /**
     * Get dateDeNaissance
     *
     * @return \DateTime
     */
    public function getDateDeNaissance()
    {
        return $this->date_de_naissance->format('d-m-Y'); ;
    }

    /**
     * Set statut
     *
     * @param string $statut
     *
     * @return Utilisateur
     */
    public function setStatut($statut)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut
     *
     * @return string
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     *
     * @return Utilisateur
     */
    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;

        return $this;
    }

    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
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
}



?>
