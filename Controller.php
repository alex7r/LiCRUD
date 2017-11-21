<?php
/**
 * Copyright (c) 2017. Alexandr Kosarev, @kosarev.by
 */

namespace LiCRUD;

use App\Http\Controllers\Controller as LController;
use Illuminate\Http\Request;
use Session;
use Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class Controller extends LController
{
    protected $class;
    protected $routes;

    protected function getLayout($action = 'index')
    {
        switch ($action){
            case 'show':
                return 'LiCRUD::show';
            case 'edit':
                return 'LiCRUD::edit';
            case 'create':
                return 'LiCRUD::create';
            default:
                return 'LiCRUD::index';
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = ($this->class)::all();

        return view($this->getLayout('index'),['items' => $articles, 'routes'=>$this->routes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new $this->class();

        return view($this->getLayout('create'),['item'=>$item, 'routes'=>$this->routes]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the validation
        if ($validator->fails()) {
            return Redirect::to($this->routes.'/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $article = new $this->class();
            $article->fillByInput();
            $article->save();

            // redirect
            Session::flash('message', 'Successfully created Article!');
            return Redirect::to($this->routes);
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
        $item = ($this->class)::find($id);

        return view($this->getLayout('show'), ['item' => $item, 'routes'=>$this->routes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = ($this->class)::find($id);

        return view($this->getLayout('edit'), ['item' => $article, 'routes'=>$this->routes]);
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
        $rules = array(
            'title'       => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to($this->routes.'/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $item = ($this->class)::find($id);
            $item->fillByInput();
            $item->save();

            // redirect
            Session::flash('message', 'Successfully updated article!');
            return Redirect::to($this->routes);
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
        $article = ($this->class)::find($id);
        $article->delete();

        // redirect
        Session::flash('message', 'Successfully deleted the article!');
        return Redirect::to($this->routes);
    }
}