<!-- resources/views/articles/create.blade.php -->
 @extends('layouts.app')
 
@section('content')
    {{ html()->modelForm($article, 'POST', route('articles.store'))->open() }}
    @include('articles.form')
    {{ html()->submit('Создать') }}
    {{ html()->closeModelForm() }}
@endsection

