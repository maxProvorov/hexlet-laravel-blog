<!-- resources/views/articles/index.blade.php -->

@extends('layouts.app')

@section('title', 'Список статей')
<a href="{{route('articles.create')}}">New</a>
@section('content')
    @foreach ($articles as $article)
        <a href="{{ route('articles.show', $article->id) }}"><h2>{{$article->name}}</h2></a>
        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
        <a href="{{ route('articles.edit', $article->id) }}"><span>Edit</span></a>
        {{ html()->modelForm($article, 'DELETE', route('articles.destroy', $article))->open() }}
            {{ html()->submit('Удалить')}}
        {{ html()->closeModelForm() }}
    @endforeach
@endsection