<?php namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Log;
use View;
use Redirect;
use Session;

class LogsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $log = Log::findOrFail($id);

        return View::make('back.logs.show')
            ->with('log', $log);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $log = Log::findOrFail($id);

        $log->delete();

        Session::flash('success', 'Log supprimé avec succès!');
        return redirect::to('back/index');
    }
}
