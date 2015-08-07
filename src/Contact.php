<?php
class Contact
{
    private $name;
    private $phone;
    private $address;

    function __construct($contact_name, $contact_phone, $contact_address)
    {
        $this->name = $contact_name;
        $this->phone = $contact_phone;
        $this->address = $contact_address;
    }

    // Getters/Setters------------------------------------------

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function setPhone($new_phone)
    {
        $this->phone = $new_phone;
    }

    function getPhone()
    {
        return $this->phone;
    }

    function setAddress($new_address)
    {
        $this->address = $new_address;
    }

    function getAddress()
    {
        return $this->address;
    }

    // Other Functions------------------------------------------

    function save()
    {
        array_push($_SESSION['list_of_contacts'], $this);
    }

    static function getAll()
    {
        return $_SESSION['list_of_contacts'];
    }

    static function deleteAll()
    {
        return $_SESSION['list_of_contacts'] = array();
    }
}
?>
