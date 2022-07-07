<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Helpers\Utils;
use Illuminate\Support\Facades\Validator;


class ApiController extends Controller
{
    public function create(Request $request)
    {
        $article = new Article();
        $user_id = Utils::get_user($request);
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',

        ]);
        $article = new Article;
        $article->title = $request->title;
        $article->description = $request->description;
        $article->user_id = $user_id;
        // dd($article);
        $article->save();
        return response()->json(['success' => true, "message" => "article created successfully"]);
    }

    public function editArticle()
    {
    }
    public function deleteArticle(Request $request)
    {
        dd($request->id);

        $article = Article::where('id', $request->id);
        // dd($article);
        $article->delete();

        return response()->json(['success' => true, 'message' => "article deleted successfully"]);
    }

    public function getArticles(Request $request)
    {
        $articles = Article::all();

        return response()->json(['message' => 'true', 'articles' => $articles]);
    }

    public function getArticle(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $article = Article::where('id', $request->id)->get();

        if (is_null($article)) {
            return response()->json(['message' => 'false']);
        } else {
            return response()->json(['message' => 'true', 'articles' => $article]);
        }
    }
    // public function destroy(Article $article)
    // {
    //     $article->delete();
    //     return response()->json(['message' => 'Article deleted successfuly', 'article' => $article]);
    // }\

    public function alluser(Request $request)
    {
        $users = User::all();
        return response()->json(['users' =>  $users]);
    }
    public function singleuser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $user = User::where('id', $request->id)->get();

        if (is_null($user)) {
            return response()->json(['message' => 'false']);
        } else {
            return response()->json(['message' => 'true', 'users' => $user]);
        }
    }

    public function delete(Request $id)
    {

        $article = Article::find($id)->delete();
        if ($article) {
            $data = [
                'status' => '1',
                'msg' => 'success'
            ];
        } else {
            $data = [
                'status' => '0',
                'msg' => 'fail'
            ];
            return response()->json($data);
        }
    }
}
