<?php 

namespace App\View;

abstract class View{
    abstract public static  function render(array $data = []);
} 