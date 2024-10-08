@extends('layouts.app')

@section('content')

<style>
    .pagination {
        justify-content: center
    }

</style>

<body>
    <div class="container mt-5 bg-white">
        <div class="pt-4">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="#" class="nav-link active">Food</a>
                </li>
                <li class="nav-item">
                    <a href="{{route('food-types.index')}}" class="nav-link">Food Type</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-lg-12 margin-tb mt-3">
                <div class="mb-2">
                    <a class="btn btn-success" href="{{route('foods.create')}}"> Create Food</a>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        <table class="table table-bordered">
            <tr style="text-align:center">
                <th>Food.No</th>
                <th>@sortablelink('name')</th>
                <th>@sortablelink('typeId')</th>
                <th>@sortablelink('price')</th>
                <th>Food Image</th>
                <th width="280px">Action</th>
            </tr>
            @foreach($foods as $key => $food)
            <tr style="text-align:center">
                <td>{{$key + $foods->firstItem()}}</td>
                <td>{{$food->name}}</td>
                <td>{{$food->type_name}}</td>
                <td>$ {{$food->price}}</td>
                <td><img width="100px" height="100px" src="{{url('/uploads/foods')}}/{{$food->food_image}}" alt="{{$food->name}}"></td>
                <td>
                    <form action="{{ route('foods.destroy',$food->id) }}" method="Post">
                        <a class="btn btn-primary" href="{{ route('foods.edit',$food->id) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
        <div class="text-center p-3">
            {{-- {!! $foods->links() !!} --}}
            {!! $foods->appends(\Request::except('page'))->render() !!}
        </div>
    </div>

    @endsection
