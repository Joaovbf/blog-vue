@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Postagens</div>
        <div id="blog" class="card-body">
            <blog v-bind:authenticated="true"
                  v-bind:initialposts="{{ json_encode($posts) }}"></blog>
        </div>
    </div>
</div>
@endsection
