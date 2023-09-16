<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Facades\Storage;

class ColorController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get colors
        $colors = Color::when(request()->q, function ($colors) {
            $colors = $colors->where('name', 'like', '%' . request()->q . '%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $colors->appends(['q' =>  request()->q]);

        //render with inertia
        return inertia('Account/Colors/Index', [
            'colors' => $colors,
        ]);
    }

    /**
     * create
     *
     * @return void
     */
    public function create()
    {
        //render with inertia
        return inertia('Account/Colors/Create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        /**
         * validate request
         */
        $this->validate($request, [
            'name'  => 'required',
            'image' => 'required|mimes:png,jpg',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/colors', $image->hashName());

        //create color
        $color = Color::create([
            'name'  => $request->name,
            'image' => $image->hashName(),
        ]);

        //redirect 
        return redirect()->route('account.colors.index');
    }

    /**
     * edit
     *
     * @param  mixed $id
     * @return void
     */
    public function edit($id)
    {
        //get color
        $color = Color::findOrFail($id);

        //render with inertia
        return inertia('Account/Colors/Edit', [
            'color'  => $color,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Color $color)
    {
        /**
         * validate request
         */
        $this->validate($request, [
            'name'      => 'required',
        ]);

        //check image update
        if ($request->file('image')) {

            //remove old image
            Storage::disk('local')->delete('public/colors/' . basename($color->image));

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/colors', $image->hashName());

            //update color with new image
            $color->update([
                'image' => $image->hashName(),
                'name' => $request->name,
            ]);
        }

        //update color without image
        $color->update([
            'name'          => $request->name,
        ]);

        //redirect
        return redirect()->route('account.colors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find color by ID
        $color = Color::findOrFail($id);

        //remove image from server
        Storage::disk('local')->delete('public/colors/' . basename($color->image));

        //delete color
        $color->delete();

        //redirect
        return redirect()->route('account.colors.index');
    }
}
