<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class PageController extends Controller
{
  public function home(Request $request)
  {
    return view('pages.home');
  }

  public function access(Request $request)
  {
    return view('pages.access');
  }

  public function download(Request $request)
  {
    return view('pages.download');
  }

  public function locationsList(Request $request)
  {
    return view('pages.locations.list');
  }

  public function locationsMap(Request $request)
  {
    return view('pages.locations.map');
  }

  public function location(Request $request, $slug)
  {
    return view('pages.locations.show.' . $slug);
  }

  public function offline(Request $request)
  {
    return view('pages.offline');
  }
}