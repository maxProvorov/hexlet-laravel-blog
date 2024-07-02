<!-- resources/views/articles/create.blade.php -->
 @extends('layouts.app')
 
@section('content')
{{ html()->modelForm($article, 'PATCH', route('articles.update', $article))->open() }}
    @include('articles.form')
    {{ html()->submit('Обновить')->class('btn btn-primary') }}
{{ html()->closeModelForm() }}
@endsection
