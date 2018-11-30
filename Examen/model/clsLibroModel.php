<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 30/11/18
 * Time: 9:26
 */
class clsLibroModel implements JsonSerializable
{

    private $titulo;
    private $numpag;
    private $capitulos;
    private $id;

    public function __construct($tit, $pag, $cap, $nId)
    {
        $this->titulo=$tit;
        $this->numpag=$pag;
        $this->capitulos=$cap;
        $this->id=$nId;
    }


    function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'titulo' => $this->titulo,
            'numpag' => $this->numpag,
            'capitulos' => $this->capitulos
        );
    }

    public function __sleep(){
        return array('id', 'titulo' , 'numpag' , 'capitulos' );
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getNumpag()
    {
        return $this->numpag;
    }

    /**
     * @param mixed $numpag
     */
    public function setNumpag($numpag)
    {
        $this->numpag = $numpag;
    }

    /**
     * @return mixed
     */
    public function getCapitulos()
    {
        return $this->capitulos;
    }

    /**
     * @param mixed $capitulos
     */
    public function setCapitulos($capitulos)
    {
        $this->capitulos = $capitulos;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



}