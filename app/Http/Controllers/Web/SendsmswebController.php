<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;


class SendsmswebController extends Controller
{
    public function index()
    {
       return Inertia::render('Sms/SendsmsIndex');
    }
}
