@extends('layouts.app')

@section('content')

        <div class="container">
            <h1>Query By Range</h1>
            <form name="rangeForm" action="{{ route('item.getRange') }}" method="get" onsubmit="return dateValidate()">
                @csrf
                <label for="startDate">Select Start Date:</label><br/>
                <input type="date" id="startDate" name="startDate" <?php if($startDate) echo "value=$startDate"; ?> ><br>
                <label for="endDate">Select End Date:</label><br>
                <input type="date" id="endDate" name="endDate" <?php if($endDate) echo "value=$endDate"; ?> ><br>

                 <input type="submit" value="Submit">
            </form>
             <table id="currentTable">
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Food</td>
                        <td>HouseHols</td>
                        <td>Personal</td>
                        <td>Biils</td>
                        <td>Miscellaneous</td>
                        <td>Total Expenses</td>
                    </tr>
                </thead>
                <tbody>
                
                    @foreach($array as $item)
                    <tr>
                        <td>{{$item ->date}}</td>
                        <td>{{$item ->food}}</td>
                        <td>${{$item ->houseHold}}</td>
                        <td>${{$item ->personal}}</td>
                        <td>${{$item ->bills}}</td>
                        <td>${{$item ->misc}}</td>
                        <td>${{$item ->total}}</td>
                    </tr>
                @endforeach
                    <tr id="avgRow">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Average per day: </td>
                        <td>${{$avg}}</td>
                    </tr>
                </tbody>
             </table>

              <div class="stats">
                <button onclick='drawBarChart(<?php echo json_encode($array); ?> )'>Show Bar Chart</button>
                <canvas id="barChart" height="100"></canvas>
             </div>
        </div>
           
@endsection