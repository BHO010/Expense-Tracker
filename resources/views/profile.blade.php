@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">

           <div class="container">
               <div class="row justify-content-center">
                   <div class="col-md-3">
                       <img class="rounded-circle" width="150" src="/storage/{{ $profile->image }}">
                   </div>
                   <div class="col-md-9">
                       <h3>{{ $user->name }}</h3>
                       <span><strong>Total expenses $</strong>{{$total}}</span>
                       <div class="pt-3">{{$profile->description}}</div>
                       <div class="pt-3"><a href="/statistic/day">Query by Day</a></div>
                       <div class="pt-3"><a href="/statistic/range">Query by Range</a></div>

                   </div>
               </div>
               </div>
           </div>
           <br>
           <h1>Expenses Today</h1>
           <h2>{{$date}}</h2>
             <table id="currentTable">
                <thead>
                    <tr>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Expenses</td>
                        <td>Delete</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$item ->category}}</td>
                        <td>{{$item ->name}}</td>
                        <td>${{$item ->expense}}</td>
                        <td id="btnRow">
                          <form action="{{ route('item.destroy', $item) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-primary">Delete</button>
                          </form>
                          <div class="pt-3" style="margin-right:5%"><a href="/item/{{$item->id}}/edit">Edit Item</a></div>
                        </td>
                    </tr>
                @endforeach
                    <tr id="totalRow">
                        <td></td>
                        <td>Total: </td>
                        <td>${{$currentTotal}}</td>
                        <td></td>
                    </tr>
                </tbody>
             </table>

             <div class="stats">
                <button onclick="drawChart({{$items}})">Show Pie Chart</button>
                <div class="chart">
                    <canvas id="myChart" width="400" height="400"></canvas>
                </div>
             </div>
            
       </div>
   </div>
</div>
@endsection

