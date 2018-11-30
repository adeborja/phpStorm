<?php

/**
 * Created by PhpStorm.
 * User: adeborja
 * Date: 30/11/18
 * Time: 9:28
 */
class clsCapituloModel implements JsonSerializable
{

    private $titulo;
    private $paginaInicio;
    private $paginaFin;
    private $id;
    private $idLibro;

    public function __construct($tit, $pagIni, $pagFin, $nId, $nIdLibro)
    {
        $this->titulo=$tit;
        $this->paginaInicio=$pagIni;
        $this->paginaFin=$pagFin;
        $this->id=$nId;
        $this->idLibro=$nIdLibro;
    }

    function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'idLibro' => $this->idLibro,
            'titulo' => $this->titulo,
            'paginaInicio' => $this->paginaInicio,
            'paginaFin' => $this->paginaFin
        );
    }

    public function __sleep(){
        return array('id','idLibro', 'titulo' , 'paginaInicio' , 'paginaFin' );
    }/**
 * @return mixed
 */
public function getTitulo()
{
    return $this->titulo;
}/**
 * @param mixed $titulo
 */
public function setTitulo($titulo)
{
    $this->titulo = $titulo;
}/**
 * @return mixed
 */
public function getPaginaInicio()
{
    return $this->paginaInicio;
}/**
 * @param mixed $paginaInicio
 */
public function setPaginaInicio($paginaInicio)
{
    $this->paginaInicio = $paginaInicio;
}/**
 * @return mixed
 */
public function getPaginaFin()
{
    return $this->paginaFin;
}/**
 * @param mixed $paginaFin
 */
public function setPaginaFin($paginaFin)
{
    $this->paginaFin = $paginaFin;
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

    /**
     * @return mixed
     */
    public function getIdLibro()
    {
        return $this->idLibro;
    }

    /**
     * @param mixed $idLibro
     */
    public function setIdLibro($idLibro)
    {
        $this->idLibro = $idLibro;
    }


}