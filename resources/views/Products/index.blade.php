@extends('layouts.app')
@section('content')


    <thead>
        <tr>
            <th>name</th>
            <th>description</th>
            <th>starter_bid</th>
            <th>category</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td data-label="Name">{{ $product->name }}</td>
                <td data-label="Description">{{ $product->description }}</td>
                <td data-label="Starter Bid">{{ $product->starter_bid }}</td>
                <td data-label="Category">{{ $product->category }}</td>
            </tr>
        @endforeach
@endsection