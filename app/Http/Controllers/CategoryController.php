<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\SaveCategoryRequest;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        return view('teachers.categories.index',[
            'categories' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveCategoryRequest $request, Category $category)
    {
        $category->create($request->validated());
        Alert::success('Success', __("messages.category_created"));
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        abort('404');
//        dd($category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('teachers.categories.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(SaveCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());
        Alert::success('Success', __("messages.category_updated"));
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (count($category->courses) == 0){
            $category->delete();
            Alert::success('Success', __("messages.category_deleted"));
        } else
            Alert::error('Error', __("messages.category_not_deleted"));
        return redirect()->route('categories.index');
    }
}
