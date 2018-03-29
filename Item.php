<?php

/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 27-Mar-18
 * Time: 16:09
 */
abstract class Item
{
    private $owner;
    private $location;

    abstract function accept(Visitor $visitor);

    /**
     * @return mixed
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    protected function setOwner($owner_in){
        $this->owner =$owner_in;
    }


    protected function setLocation($location_in){
        $this->location =$location_in;
    }
}

class Book extends Item
{
    private $title;
    private $author;
    private $isbn;


    public function __construct($title_in, $author_in, $isbn_in, $owner_in, $location_in)
    {
        $this->title = $title_in;
        $this->author = $author_in;
        $this->isbn = $isbn_in;
        $this->setOwner($owner_in);
        $this->setLocation($location_in);
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @return mixed
     */
    public function getISBN()
    {
        return $this->isbn;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    function accept(Visitor $visitor)
    {
        $visitor->visitBook(this);
    }
}