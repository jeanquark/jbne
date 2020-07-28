<?php namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Page;

use Validator;
use Redirect;
use Input;
use View;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::orderBy('id', 'desc')->get();

        return View::make('back.pages.index')
            ->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*if (!\Entrust::can('create-page')) {
            \Toastr::error('Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.', 'Erreur');
            return Redirect::back();
        }*/

        return View::make('back.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title' => ['required', 'min:2', 'max:32'],
            'slug'  => ['required', 'min:2', 'max:32', 'alpha_dash'],
            'description' => ['min:2', 'max:64'],
            'content' => []
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //return Redirect::route('home');
            //\Toastr::error('Erreur de validation.', 'Erreur');
            Session::flash('error', 'Erreur de validation.');
            return Redirect::to('back/pages/create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $data = Input::all();
            $page = Page::create($data);
            $page->translate('fr')->content = $data['content'];
            $page->save();

            Session::flash('success', 'Nouvelle page créée avec succès!');
            return Redirect::route('back.pages.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = Page::findOrFail($id);

        return View::make('back.pages.show')
            ->with('page', $page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*if (!\Entrust::can('edit-page')) {
            \Toastr::error('Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.', 'Erreur');
            return Redirect::back();
        }*/

        $page = Page::findOrFail($id);

        return View::make('back.pages.edit')
            ->with('page', $page);
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
        //dd('abc');
        $rules = array(
            'title' => ['required', 'min:2', 'max:32'],
            'slug'  => ['required', 'min:2', 'max:32', 'alpha_dash'],
            'description' => ['min:2', 'max:64'],
            'content_fr' => []
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            //dd('def');
            //\Toastr::error('Voir les erreurs de validation.', 'Erreurs');
            Session::flash('error', 'Erreur de validation.');

            return Redirect::to('back/pages/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } else {

            $data = Input::all();

            $page = Page::findOrFail($id);
            $page->update($data);

            $page->translate('fr')->content = $data['content_fr'];
            $page->translate('fr')->is_published = true;

            // Check if translation exists in en:
            if ($page->hasTranslation('en')) {
                // Update translation if content_en is not empty
                if ($data['content_en'] != '') {
                    $page->translate('en')->content = $data['content_en'];
                    if (!$data['published_en']) {
                        $page->translate('en')->is_published = false;
                    } else {
                        $page->translate('en')->is_published = true;
                    }
                } else {
                    $page->deleteTranslations('en');
                }
            } elseif ($data['content_en'] != '') {
                $page->fill([
                    'en'  => ['content' => $data['content_en'], 'is_published' => false],
                ]);
            } 

            $page->save();

            Session::flash('success', 'Page éditée avec succès!');
            return Redirect::route('back.pages.index');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*if (!\Entrust::can('delete-page')) {
            \Toastr::error('Pas autorisé à effectuer cette action. Pour obtenir une autorisation, contactez le webmaster.', 'Erreur');
            return Redirect::back();
        }*/

        $page = Page::findOrFail($id);

        $page->delete();

        Session::flash('success', 'Page supprimée avec succès!');
        return redirect::to('back/pages');
    }
}
