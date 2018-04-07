<?php

/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 27-Mar-18
 * Time: 16:12
 */
abstract class DisplayVisitor
{
    abstract function visitBook(Book $book);
    abstract function visitUser(User $user);
}

class DetailVisitor extends ItemVisitor
{
    function visitBook(Book $book){
        //html????
    }
    function visitUser(User $user){
        //html????
    }
}

class SimpleVisitor extends ItemVisitor
{
    function visitBook(Book $book){
        //html????
    }
    function visitUser(User $user){
        //html????
    }
}
