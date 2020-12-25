<?php


namespace App\Models;


class FormEntry
{
    private $displayName;
    private $requestName;
    private $type;
    private $currentValue;
    private $isReadOnly;
    private $possibleValues;
    private $prefix;

    /**
     * FormEntry constructor.
     * @param $displayName string the name of the form-item to be displayed
     * @param $requestName string the name of the id and the request-parameter
     * @param $type string either PUT or POST
     * @param $currentValue mixed the actual content - can be null
     * @param $isReadOnly bool - if the input field is read-only
     * @param $possibleValues array - if a select-tag is used, you can specify an array of possible values
     * @param $prefix string - if a prefix for all displayed possibleValues should be used (only for displaying them - not for the request parameter names)
     */
    public function __construct($displayName, $requestName, $type, $currentValue = null, $isReadOnly = false, $possibleValues = null, $prefix="")
    {
        $this->displayName = $displayName;
        $this->requestName = $requestName;
        $this->type = $type;
        $this->currentValue = $currentValue;
        $this->isReadOnly = $isReadOnly;
        $this->possibleValues = $possibleValues;
        $this->prefix = $prefix;
    }

    /**
     * @return mixed|string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param mixed|string $prefix
     */
    public function setPrefix($prefix): void
    {
        $this->prefix = $prefix;
    }

    /**
     * @return mixed|null
     */
    public function getPossibleValues(): ?array
    {
        return $this->possibleValues;
    }

    /**
     * @param mixed|null $possibleValues
     */
    public function setPossibleValues(?array $possibleValues): void
    {
        $this->possibleValues = $possibleValues;
    }

    /**
     * @return false|mixed
     */
    public function getIsReadOnly(): bool
    {
        return $this->isReadOnly;
    }

    /**
     * @param boolean $isReadOnly
     */
    public function setIsReadOnly($isReadOnly): void
    {
        $this->isReadOnly = $isReadOnly;
    }

    /**
     * @return mixed
     */
    public function getCurrentValue()
    {
        return $this->currentValue;
    }

    /**
     * @param mixed $currentValue
     */
    public function setCurrentValue($currentValue)
    {
        $this->currentValue = $currentValue;
    }

    /**
     * @return mixed
     */
    public function getDisplayName(): string
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
    public function getRequestName(): string
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
    public function getType(): string
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
