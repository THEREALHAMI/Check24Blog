<?php


namespace Controller;

use Check24Framework\ControllerInterface;
use Check24Framework\Request;

class AddComment implements ControllerInterface
{
    private $comment;
    public function __construct( $comment)
    {
        $this->comment = $comment;
    }
    public function action(Request $request)
    {

        $name= $request->getFromPost('name');
        $mail = $request->getFromPost('mail');
        $url = $request->getFromPost('url');
        $bemerkung = $request->getFromPost('bemerkung');
        $ID =$request->getFromQuery('ID');

        $this->comment->addToDatabase($name,$mail,$url,$bemerkung,$ID);

        header("location:/detail?ID=".$ID,true,301);
    }
}