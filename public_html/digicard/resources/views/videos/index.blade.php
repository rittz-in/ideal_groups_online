@extends('layouts.app')
@section('customer_name', $username)
@section('brand_name', $BrandName)
@section('content')

<link rel="stylesheet" href="{{ asset('assets/update_style.css') }}">

<div class="pull-right mb-2 d-flex justify-content-end">
    <a class="btn Submit_btn" href="{{ route('videos.create') }}"> Add New Video</a>
</div>
<div class="card mb-4">
    <div class="card-header">
        {{ __('Videos') }}
    </div>

    <div class="card-body">

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Video Link</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($videos->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">No data found</td>
                </tr>
            @else
                @foreach ($videos as $video)
                <tr>
                    <td>{{ $video->title }}</td>
                    <td><a href="{{ $video->youtube_link }}" target="_blank">{{ $video->youtube_link }}</a></td>
                    <td>
                        <form action="{{ route('videos.destroy', $video->id) }}" method="POST">
                            <a class="btn" href="{{ route('videos.edit', $video->id) }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn videolink_delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

    </div>

    <div class="card-footer">
        {{ $videos->links() }}
    </div>
</div>
@endsection