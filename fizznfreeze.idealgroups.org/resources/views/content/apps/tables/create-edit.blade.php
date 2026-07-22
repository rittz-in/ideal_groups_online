@extends('layouts/layoutMaster')

@section('title', $page_data['page_title'])

@section('content')

    @if ($page_data['form_title'] == 'Add New Table')
        <form action="{{ route('app-tables-store') }}" method="POST" enctype="multipart/form-data">
            @csrf
        @else
            <form action="{{ route('app-tables-update', encrypt($table->id)) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    @endif

    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>{{ $page_data['form_title'] }}</h4>
                        <a href="{{ route('app-tables-list') }}" class="col-md-2 btn btn-primary float-end">Tables List</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="table_number">
                                    Table Number</label>
                                <input type="text" id="table_number" class="form-control" placeholder="Table Number"
                                    name="table_number" value="{{ old('table_number') ?? ($table != '' ? $table->table_number : '') }}">
                                <span class="text-danger">
                                    @error('table_number')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="name">
                                    Name</label>
                                <input type="text" id="name" class="form-control" placeholder="Name"
                                    name="name" value="{{ old('name') ?? ($table != '' ? $table->name : '') }}">
                                <span class="text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>

                            <div class="col-md-6 col-sm-12 mb-1">
                                <label class="form-label" for="status">
                                    Status</label>
                                <div class="form-check form-check-success form-switch">
                                    <input type="checkbox" name="status" value="active"
                                        {{ $table != '' && $table->status == 'active' ? 'checked' : '' }}
                                        class="form-check-input" id="status" />
                                </div>
                                <span class="text-danger">
                                    @error('status')
                                        {{ $message }}
                                    @enderror
                                </span>
                            </div>
                           
                        </div>

                        <div class="col-12">
                            <button type="submit" name="submit" value="submit" class="btn btn-primary me-1">Submit
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    </form>
@endsection
