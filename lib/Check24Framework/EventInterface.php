<?php


namespace Check24Framework;


interface EventInterface
{
    const PRERENDER = 'prerender';
    const POSTRENDER = 'postrender';

    public function register($any);

    public function execute();

}