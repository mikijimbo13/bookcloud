<?php

/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 27-Mar-18
 * Time: 16:12
 */
abstract class ItemVisitor
{
    abstract function visitBook(Book $book);
}

class DetailVisitor extends ItemVisitor
{
    function visitBook(Book $book){
        //html????
    }
}

class SimpleVisitor extends ItemVisitor
{
    function visitBook(Book $book){
        //html????
    }
}