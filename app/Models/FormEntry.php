<?php


namespace App\Models;


class FormEntry
{
    private $displayName;
    private $requestName;
    private $type;
    private $currentValue;

    /**
     * FormEntry constructor.
     * @param $displayName string the name of the form-item to be displayed
     * @param $requestName string the name of the id and the request-parameter
     * @param $type string either PUT or POST
     * @param $currentValue string the actual content - can be null
     */
    public function __construct($displayName, $requestName, $type, $currentValue)
    {
        $this->displayName = $displayName;
        $this->requestName = $requestName;
        $this->type = $type;
        $this->currentValue = $currentValue;
    }

    /**
     * @return string
     */
    public function getCurrentValue():?string
    {
        return $this->currentValue;
    }

    /**
     * @param string $currentValue
     */
    public function setCurrentValue(string $currentValue): void
    {
        $this->currentValue = $currentValue;
    }

    /**
     * @return mixed
     */
    public function getDisplayName():string
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName): void
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getRequestName():string
    {
        return $this->requestName;
    }

    /**
     * @param mixed $requestName
     */
    public function setRequestName($requestName): void
    {
        $this->requestName = $requestName;
    }

    /**
     * @return mixed
     */
    public function getType():string
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

}
