<?php namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use View;
use Session;
use Auth;
use Input;
use App\File;
use App\Activity;
use App\Agenda;
use App\Team;
use App\Trainee;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
        // dd(\App::environment());
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::where('is_published', '=', true)->orderBy('id', 'desc')->get();
        $agendas = Agenda::where('is_published', '=', true)->orderBy('id', 'desc')->get();
        $team_members = Team::where('is_published', '=', true)->orderBy('order_of_appearance', 'asc')->get();
        $trainees = Trainee::where('is_published', '=', true)->orderBy('order_of_appearance', 'asc')->get();
        // dd($team_members);

        return View::make('index')
            ->with('activities', $activities)
            ->with('agendas', $agendas)
            ->with('team_members', $team_members)
            ->with('trainees', $trainees);
    }

    /**
     * Show the file download page.
     *
     * @return \Illuminate\Http\Response
     */
    public function files()
    {
        // dd('abc');
        if (!Auth::guard('member')->check()) {
            return redirect('home');
        }
        // Session::flash('success', 'Page afffichée avec succès');
        return View::make('files');
    }

    /**
     * Add to download count.
     *
     */
    public function addToDownloadCount() {

        $fileName = Input::get('file_name');

        $file = File::where('name', '=', $fileName)->firstOrFail();

        $file->clicks = $file->clicks + 1;

        $file->save();
    }


    /**
     * Show the dynamic trainee page.
     *
     * @return \Illuminate\Http\Response
     */
    public function trainees(Request $request, Trainee $trainee) {
        dd($request);
    }
}
