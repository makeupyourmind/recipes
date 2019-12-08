<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Model\Recipes;
use App\Model\Categories;

class RecipesController
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
        return view('pages.admin.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::all();

        return view('pages.admin.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cooking' => 'required',
            'nutritionalValue' => 'required',
            'description' => 'required',
            'ingredients' => 'required',
            'category_id' => 'required',
            'user_id' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $recipes = Recipes::create([
            'name' => $request->name,
            'cooking' => $request->cooking,
            'nutritionalValue' => $request->nutritionalValue,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('recipes.show', $recipes->id);//редиректим на шоу и отрпавляем id поста
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function show(Recipes $recipes, $id)
    {
        $recipe = Recipes::find($id);
        $categories = Categories::all();
        $data = [
            'recipe'  => $recipe,
            'categories'   => $categories
        ];
        return view('pages.admin.show')->with($data);
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

        $recipes->withPath("/recipes/category?category_id="."$request->category_id");

        return view('pages.admin.index')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipes $recipes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipes $recipes, $id)
    {
        $recipe = Recipes::find($id)->update($request->all());

        return redirect()->route('recipes.show', $id);//редиректим на шоу и отрпавляем id поста
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipes  $recipes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipes $recipes, $id)
    {
        Recipes::find($id)->delete();
        return redirect('/recipes');
    }
}
