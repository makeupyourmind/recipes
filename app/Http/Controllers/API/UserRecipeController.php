<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Model\Recipes;
use App\Model\Categories;

class UserRecipeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recipes =  Recipes::with(['category', 'user'])->paginate(4);
        $categories = Categories::all();
        $data = [
            'categories' => $categories,
            'recipes' => $recipes
        ];
        return view('pages.index')->with($data);
    }

    public function search(Request $request){
        if(!$request->category_id){
            $recipes = Recipes::with(['category', 'user'])
                                                         ->paginate(4);
        }
        else{
            $recipes = Recipes::with(['category', 'user'])->whereHas('category', function($q) use ($request){
                                                                            $q->where('id', '=', $request->category_id);
                                                                    })
                                                          ->paginate(4); 
        }
        $categories = Categories::all();
        $data = [
            'recipes'  => $recipes,
            'categories'   => $categories
        ];

        $recipes->withPath("/category?category_id="."$request->category_id");

        return view('pages.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $recipe = Recipes::find($id);
        $categories = Categories::all();
        $data = [
            'recipe'  => $recipe,
            'categories'   => $categories
        ];
        return view('pages.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
