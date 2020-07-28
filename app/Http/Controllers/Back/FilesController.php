<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// use App\User;
use App\Role;

use Validator;
use Redirect;
use Session;
use Input;
use View;
use Hash;
// use File;
use Auth;
use DB;
use App\File;

class FilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Session::flash('message', 'Bienvenue sur la page du formulaire!');
        // \Toastr::success('Document mis en ligne<br/> avec succès', 'Succès', ['timeout' => 0]);
        // $files = DB::table('files')->get();
        $files = File::all();
        // dd($files[0]);
        return View::make('back.files.index')
            ->with('files', $files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!\Entrust::can('create-user')) {
            Session::flash('error', 'Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.');
            return Redirect::back();
        }*/
        return View::make('back.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {    
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function getAllFiles()
    {
        // return 'abc';

        $files = $users = DB::table('files')->get()->toJson();
        return $files;
        // $sth = mysqli_query("SELECT ...");
        // $rows = array();
        // while($r = mysqli_fetch_assoc($sth)) {
        //     $rows[] = $r;
        // }
        // print json_encode($rows);

    }
}