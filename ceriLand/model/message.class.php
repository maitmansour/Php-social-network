<?php
/*
 *Entity Message
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
/** 
 * @Entity
 * @Table(name="fredouil.message")
 */
class message
{
    
    /** @Id @Column(type="integer")
     *  @GeneratedValue
     */
    private $id;
    
    
    /**
     * @ManyToOne(targetEntity="utilisateur")
     * @JoinColumn(name="emetteur", referencedColumnName="id")
     */
    private $emetteur;
    
    
    /**
     * @ManyToOne(targetEntity="utilisateur")
     * @JoinColumn(name="destinataire", referencedColumnName="id")
     */
    private $destinataire;
    
    /**
     * @ManyToOne(targetEntity="utilisateur")
     * @JoinColumn(name="parent", referencedColumnName="id")
     */
    private $parent;
    
    /**
     * @ManyToOne(targetEntity="post")
     * @JoinColumn(name="post", referencedColumnName="id")
     */
    private $post;
    
    /** @Column(type="integer", length=45) */
    private $aime;



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
     * Set emetteur
     *
     * @param integer $emetteur
     *
     * @return Message
     */
    public function setEmetteur($emetteur)
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    /**
     * Get emetteur
     *
     * @return integer
     */
    public function getEmetteur()
    {
        return $this->emetteur;
    }

    /**
     * Set destinataire
     *
     * @param integer $destinataire
     *
     * @return Message
     */
    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;

        return $this;
    }

    /**
     * Get destinataire
     *
     * @return integer
     */
    public function getDestinataire()
    {
        return $this->destinataire;
    }

    /**
     * Set parent
     *
     * @param integer $parent
     *
     * @return Message
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return integer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set post
     *
     * @param integer $post
     *
     * @return Message
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return integer
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set aime
     *
     * @param integer $aime
     *
     * @return Message
     */
    public function setAime($aime)
    {
        $this->aime = $aime;

        return $this;
    }

    /**
     * Get aime
     *
     * @return integer
     */
    public function getAime()
    {
        return $this->aime;
    }
}

?>