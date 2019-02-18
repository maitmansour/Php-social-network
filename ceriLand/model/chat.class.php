<?php
/*
 *Entity Chat
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */
/** 
 * @Entity
 * @Table(name="fredouil.chat")
 */
class chat{

	/** @Id @Column(type="integer")
     *  @GeneratedValue
     */ 
    private $id;

    /** @OneToOne(targetEntity="utilisateur")
    * @JoinColumn(name="emetteur", referencedColumnName="id")
     */  
    private $emetteur;
        
    /** @OneToOne(targetEntity="post")
    * @JoinColumn(name="post", referencedColumnName="id")
    */ 
    private $post;




    /**
     * Set post
     *
     * @param integer $post
     *
     * @return Chat
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
     * Set emetteur
     *
     * @param integer $emetteur
     *
     * @return Chat
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


}

