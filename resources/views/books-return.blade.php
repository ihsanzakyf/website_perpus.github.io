@extends('layouts.main-layouts')

@section('title', 'Pengembalian Buku')
    
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-md-3">
    <h1>Form Pengembalian Buku</h1>

    <div class="mt-5">
        @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('message')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <form action="books-return" method="post">
        @csrf
        <div class="mb-3">
            <label for="user" class="form-label">User</label>
            <select name="user_id" id="user" class="form-select userbox">
                <option value="">--Silahkan Pilih User--</option>
                @foreach ($user as $item)
                    <option value="{{$item->id}}">{{ $item->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="user" class="form-label">Book</label>
            <select name="book_id" id="book" class="form-select">
                <option value="">--Silahkan Pilih--</option>
                @foreach ($books as $item)
                    <option value="{{ $item->id }}">{{ $item->book_code }} | {{ $item->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </form>
</div>

    






<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.userbox').select2();
    });
</script>
@endsection
