<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ArticleController extends Controller
{
    use ValidatesRequests;
    
    public function index()
    {
        $articles = Article::paginate();

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('articles.index', compact('articles'));
    }

    //Обработка get параметров
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    //Отображение формы создания статьи
    public function create()
    {
        // Передаем в шаблон вновь созданный объект. Он нужен для вывода формы
        $article = new Article();
        return view('articles.create', compact('article'));
    }

    //Обработка данных формы
    public function store(CreateArticleRequest $request)
    {
        // Проверка введенных данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        /* $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:10',
        ]); */

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($request->validated());
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }

    //Отображение формы редактирования статьи
    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    //Обработка запроса редактирования статьи
    public function update(UpdateArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        /* $data = $this->validate($request, [
            // У обновления немного измененная валидация
            // В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться, что имя уже существует
            'name' => 'required|unique:articles,name,' . $article->id,
            'body' => 'required|min:10',
        ]); */

        $article->fill($request->validated());
        $article->save();
        return redirect()
            ->route('articles.index');
    }
    public function destroy ($id) {
        $article = Article::find($id);
        if($article) {
            $article->delete();
        }
        return redirect()->route('articles.index');
    }
}