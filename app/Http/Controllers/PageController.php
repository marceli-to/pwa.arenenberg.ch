<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function home(Request $request)
  {
    return view('pages.home');
  }

  public function locations(Request $request)
  {
    return view('pages.locations');
  }
}