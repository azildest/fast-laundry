
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      @foreach ($breadcrumbs as $breadcrumb)
        @if ($loop->last)
          <li class="breadcrumb-item active" aria-current="page">{{ $breadcrumb['title'] }}</li>
        @else
          <li class="breadcrumb-item">
            <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['title'] }}</a>
          </li>
        @endif
      @endforeach
    </ol>
  </nav>  

  {{-- INI BUAT DI PAGE NANTI
  resources/views/somepage.blade.php
@extends('layouts.app')

@section('content')
    @php
        $breadcrumbs = [
            ['title' => 'Home', 'url' => route('home')],
            ['title' => 'Category', 'url' => route('category.index')],
            ['title' => 'Item', 'url' => route('item.show', $item->id)],
        ];
    @endphp

    @component('layouts.components.breadcrumb', ['breadcrumbs' => $breadcrumbs])
    @endcomponent

    <!-- The rest of your page content -->
    <h1>{{ $item->name }}</h1>
    <p>{{ $item->description }}</p>
@endsection --}}
