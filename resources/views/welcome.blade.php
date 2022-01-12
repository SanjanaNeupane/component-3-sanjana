@extends('layouts.app')

@section('content')

<div>
    {{-- <router-link to='/editor'>Editor</router-link>
    <router-link to='/register'>register</router-link>
    <router-link to='/logout'>logout</router-link> --}}

    <nav-component></nav-component>
</div>
<div>
    <router-view>

    </router-view>
</div>


@endsection
<script>
var sideNav = document.getElementById("side-nav");

function toggle_nav() {
    sideNav.classList.toggle("active");   
}

function subnavtoggle(x) {
    x.classList.toggle("nav-open");
}
</script>
