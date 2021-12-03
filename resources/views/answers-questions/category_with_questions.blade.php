@extends('layout.app')

@section('content')
<div clas="category">
    <div class="max-with">
        <x-questions-section :questions="$questions" :text="'Саволҳо аз ' . $category->name"></x-questions-section>
    </div>
</div>
@endsection