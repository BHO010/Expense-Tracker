@extends('layouts.app')

@section('content')

        <div class="container">
           <h1>Query By Date</h1>
            <form action="{{ route('item.getDay') }}" method="get">
             @csrf
                <label for="date">Select Date:</label><br/>
                <input type="date" id="date" name="date" <?php if($date) echo "value=$date"; ?> >

                 <input type="submit" value="Submit">
            </form>

             <table id="currentTable">
                <thead>
                    <tr>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Expenses</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item ->category}}</td>
                        <td>{{$item ->name}}</td>
                        <td>${{$item ->expense}}</td>
                    </tr>
                @endforeach
                    <tr id="totalRow">
                        <td></td>
                        <td>Total: </td>
                        <td>${{$currentTotal}}</td>
                    </tr>
                </tbody>
             </table>

             <div class="stats">
                <button onclick="drawChart({{$items}})">Show Pie Chart</button>
                <canvas id="myChart" height="100"></canvas>
             </div>
        </div>
           
@endsection
