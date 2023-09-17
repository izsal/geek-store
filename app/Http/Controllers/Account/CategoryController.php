<?php

namespace App\Http\Controllers\Account;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;



class CategoryController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get categories
        $categories = Category::when(request()->q, function ($categories) {
            $categories = $categories->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        $categories->appends(['q' => request()->q]);

        return inertia('Account/Categories/Index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Account/Categories/Create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * validate
         */
        $this->validate($request, [
            'image'         => 'required|image|mimes:jpeg,jpg,png|max:2000',
            'name'          => 'required|unique:categories',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/categories', $image->hashName());

        //create category
        Category::create([
            'image'         => $image->hashName(),
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-')
        ]);

        //redirect
        return redirect()->route('account.categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return inertia('Account/Categories/Edit', [
            'category' => $category,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        /**
         * validate
         */
        $this->validate($request, [
            'name'          => 'required|unique:categories,name,' . $category->id,
        ]);

        //check image update
        if ($request->file('image')) {

            //remove old image
            Storage::disk('local')->delete('public/categories/' . basename($category->image));

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/categories', $image->hashName());

            //update category with new image
            $category->update([
                'image' => $image->hashName(),
                'name' => $request->name,
                'slug'          => Str::slug($request->name, '-')
            ]);
        }

        //update category without image
        $category->update([
            'name'          => $request->name,
            'slug'          => Str::slug($request->name, '-')
        ]);

        //redirect
        return redirect()->route('account.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find by ID
        $category = Category::findOrFail($id);

        //remove image
        Storage::disk('local')->delete('public/categories/' . basename($category->image));

        //delete
        $category->delete();

        //redirect
        return redirect()->route('account.categories.index');
    }
}
