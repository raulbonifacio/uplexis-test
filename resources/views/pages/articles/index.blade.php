@extends('layouts/app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('fetch-articles') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <div class="input-group">
                            <input id="search" class="form-control" value="{{ old('search', $search ?? '') }}" type="text" name="search" placeholder="Put your keywords in here to capture...">
                            <div class="input-group-append">
                                <button id="capture" class="btn btn-primary" >
                                    Capture
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div id="spinner" class="text-center collapse my-3">
                    <div class="spinner-border mx-auto" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <br>
                    <span class="text-muted">
                        Capturing articles...
                    </span>
                </div>
                @isset($search)
                    <div class="alert alert-success">
                        Articles captured: {{ count($capturedArticles)}}
                        <br>
                        Duplicates: {{ $duplicates }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $error)
                            <p>
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-12">
                <table class="table table-lg border rounded table-hover">
                    <thead>
                        <tr>
                            <th>
                                <h4>
                                    Articles
                                </h4>
                            </th>
                            <th>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr class="table-light article">
                                <td>
                                    <a href="{{ $article->link }}">{{$article->title}}</a>
                                </td>
                                <td class="text-left">
                                    <form class="article-remover" action="{{route('remove-article', ['id' => $article->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm"> Remove </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        @if(!count($articles))
                            <tr>
                                <td class="text-muted">
                                    Ops! Looks like no articles were captured yet.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection