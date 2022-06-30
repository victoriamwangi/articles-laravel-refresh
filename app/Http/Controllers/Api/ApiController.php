<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ApiController extends Controller
{

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


        return response()->json(['message' => 'true', 'articles' => $article]);
    }
}
