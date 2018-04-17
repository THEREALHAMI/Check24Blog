<?php


namespace Controller;

use Check24Framework\ControllerInterface;
use Check24Framework\DiContainer;
use Check24Framework\Request;
use Factory\Comment;

class AddComment implements ControllerInterface
{
    private $diContainer;
    public function __construct(DiContainer $diContainer)
    {
        $this->diContainer = $diContainer;
    }
    public function action(Request $request)
    {

        $name= $request->getFromPost('name');
        $mail = $request->getFromPost('mail');
        $url = $request->getFromPost('url');
        $bemerkung = $request->getFromPost('bemerkung');
        $ID =$request->getFromQuery('ID');

        $comment = Comment::create();
        $comment->addToDatabase($name,$mail,$url,$bemerkung,$ID);

        header("location:/detail?ID=".$ID,true,301);
    }
}