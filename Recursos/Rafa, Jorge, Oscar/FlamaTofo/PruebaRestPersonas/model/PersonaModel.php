<?php


class PersonaModel implements JsonSerializable
{

    private $id;
    private $Nombre;
    private $Edad;

    /**
     * PersonaModel constructor.
     * @param $id
     * @param $Nombre
     * @param $Edad
     */
    public function __construct($id, $Nombre, $Edad)
    {
        $this->id = $id;
        $this->Nombre = $Nombre;
        $this->Edad = $Edad;
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
    public function getEdad()
    {
        return $this->Edad;
    }

    /**
     * @param mixed $Edad
     */
    public function setEdad($Edad)
    {
        $this->Edad = $Edad;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * @param mixed $Nombre
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }


    //Needed if the properties of the class are private.
    //Otherwise json_encode will encode blank objects
    function jsonSerialize()
    {
        return array(
            'Nombre' => $this->Nombre,
            'Edad' => $this->Edad,

        );
    }

    public function __sleep(){
        return array('Nombre' , 'Edad');
    }
}