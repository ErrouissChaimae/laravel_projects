<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = DB::table('articles')->get();
        
        // Récupérer les articles avec une quantité nulle
        $stockVide = Article::where('quantite', 0)->get();
        
        // Récupérer les articles avec une quantité inférieure à 20
        $stockPresqueVide = Article::where('quantite', '<', 20)->where('quantite', '>', 0)->get();
    
        return view('articles.index', compact('articles', 'stockVide', 'stockPresqueVide'));
    }
   

    public function create()
    {
        return view('articles.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'libele' => 'required|unique:articles',
        'prix' => 'required',
        'quantite' => 'required',
        'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = time().'.'.$request->photo->extension();
    $request->photo->move(public_path('images'), $imageName);

    Article::create([
        'libele' => $request->libele,
        'prix' => $request->prix,
        'quantite' => $request->quantite,
        'photo' => $imageName,
    ]);

    return response()->json(['success' => true]);
}

    
    public function edit($id)
    {
        $article = DB::table('articles')->where('id_article', $id)->first();
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'libele' => 'required|unique:articles,libele,'.$id.',id_article',
            'prix' => 'required',
            'quantite' => 'required',
            'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $data = [
            'libele' => $request->get('libele'),
            'prix' => $request->get('prix'),
            'quantite' => $request->get('quantite'),
            'updated_at' => now(),
        ];
    
        if ($request->hasFile('photo')) {
            $imageName = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('images'), $imageName);
            $data['photo'] = $imageName;
        }
    
        try {
            DB::table('articles')->where('id_article', $id)->update($data);
            return response()->json(['success' => true, 'message' => 'Article updated successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
    

    public function destroy($id)
    {
        DB::table('articles')->where('id_article', $id)->delete();

        return redirect('/articles')->with('success', 'Article deleted!');
    }

    public function rechercher(Request $request)
{
    $search = $request->input('search');

    $stockVide = Article::where('quantite', 0)->get();
    
    $stockPresqueVide = Article::where('quantite', '<', 20)->get();

    $articles = Article::where('libele', 'like', '%' . $search . '%')
                        ->orWhere('id_article', 'like', '%' . $search . '%')
                        ->get();

    return view('articles.index', compact('articles', 'stockVide', 'stockPresqueVide'));
}


}
