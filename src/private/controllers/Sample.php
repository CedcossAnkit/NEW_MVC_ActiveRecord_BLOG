<?php

namespace App\Controllers;

use App\Libraries\Controller;

class Sample extends Controller
{
    public function index()
    {
        $this->view('sample');
    }

    public function hello()
    {
        echo "hello";
    }
}
