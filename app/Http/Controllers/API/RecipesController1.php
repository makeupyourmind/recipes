<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use Validator;
use App\Model\Recipes;
use Storage;
use Intervention\Image\Facades\Image;

class RecipesController1 extends BaseController
{

    public function index(){
        $recipes =  Recipes::paginate(1);
        return view('pages.admin.index')->withRecipes($recipes);
    }

    public function store(Request $request){
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

        $recipe = Recipes::create([
            'name' => $request->name,
            'cooking' => $request->cooking,
            'nutritionalValue' => $request->nutritionalValue,
            'description' => $request->description,
            'ingredients' => $request->ingredients,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id
        ]);

        return $this->sendResponse($recipe->id, 'Successfully created');
    }

    public function show($id){
        $recipe = Recipes::with('user')->find($id);
        return view('pages.admin.show')->withRecipe($recipe);
    }

    public function uploadImage(Request $request, $id){
        if ($request->hasFile('photo')) {
            // return 'ok';
            $image = $request->file('photo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            $recipe = Recipes::find($id);
            
            Storage::disk('public_uploads')->delete('receipts'.'/'.$recipe->image);

            $recipe->update(['image' => $fileName]);

            Storage::disk('public_uploads')->put('receipts'.'/'.$fileName, $img);
        }
        return $this->sendResponse($fileName, 'Ok updated');
    }

    public function put(Request $request, $id){
        Recipes::find($id)->update($request->all());
        return $this->sendResponse($id, 'Successfully updated');
    }

    public function getByCategory(Request $request, $id){
        $recipe = Recipes::with(['category'])->whereHas('category', function($q) use ($id){
                                                    $q->where('id', '=', $id);
                                               })
                                            ->get();
        return $this->sendResponse($recipe, 'Ok got by category');
    }

    public function destroy($id){
        Recipes::find($id)->delete();
        return redirect('/panel');
    }
}
