<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // $data = [];
        $user = Auth::user();

        // $article = Article::with("user")->get();
        // dd($article);

        // create roles
        // Role::create([
        //     'name' => "author"
        // ]);

        $user->assignRole('author');
        $articles = Article::leftJoin('users as u', 'articles.user_id', 'u.id')
            ->select(
                'articles.*',
                'u.name as author'

            );

        if ($request->filter != "") {
            switch ($request->filter) {
                case 'own':
                    $articles->where('articles.user_id', Auth::id());
                    break;
                default:
                    break;
            }
        }
        $data['articles'] = $articles
            ->orderByDesc('id')->paginate(5);
        // dd($data);
        return view('articles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {

            $article = new Article();
            $article->title = $request->title;
            $article->user_id = Auth::id();
            $article->description = $request->description;
            $article->image_path = $request->image_path;
            $article->save();
            DB::commit();
            flash('Article created successfully')->success();
            return redirect()->route('articles');
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollback();
            flash('Something went wrong')->error();
            return back();
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
        $article = Article::find($id);
        // dd($article);
        return view('articles.show', ['article' => $article,]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        // dd($article);
        return view('articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $articlePost = Article::find($request->id);
        // dd($articlePost);

        $articlePost->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        $articlePost->save();
        return redirect()->route('articles.show', ["article" => $articlePost->id]);
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
