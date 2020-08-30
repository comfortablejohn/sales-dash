@extends('layouts.app')

@section('body')
    <div class="header">
        <nav class="header__nav">
            <ul>
                <li><a href="/dashboard">Dashboard</a></li>
                <li><a href="/data">Data Grid</a></li>
            </ul>
        </nav>
        <div class="header__logo">
            <h3>AG Sales</h3>
        </div>
    </div>
    <div class="container">
        <div id="app"></div>
    </div>
@endsection
