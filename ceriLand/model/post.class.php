
<?php
/*
 *Entity Post
 *AIT MANSOUR & BELGHARBI
 *M1 ILSEN
 */

/** 
 * @Entity
 * @Table(name="fredouil.post")
 */
class post{

    /** @Id @Column(type="integer")
     *  @GeneratedValue
     */ 
    private $id;

    /** @Column(type="string") */ 
    private $texte;
        
    /** @Column(type="datetime") */ 
    private $date;

    /** @Column(type="string", length=45) */ 
    private $image;

	


    /**
     * Set texte
     *
     * @param string $texte
     *
     * @return Post
     */
    public function setTexte($texte)
    {
        $this->texte = $texte;

        return $this;
    }

    /**
     * Get texte
     *
     * @return string
     */
    public function getTexte()
    {
        return $this->texte;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \String
     */
    public function getDate()
    {
        return $this->date->format('d-m-Y');
    }
    /**
     * Get Hour
     *
     * @return \String
     */
    public function getHour()
    {
        return $this->date->format('H:i');
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Post
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
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
