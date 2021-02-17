@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form name="itemForm" action="{{ route('item.store') }}" enctype="multipart/form-data" method="post" onsubmit="return validate()">
                    @csrf
                    <div class="form-group row">
                        <label for="category">Category</label><br>
                        <select name="category" id="category">
                            <option value="food">Food</option>
                            <option value="houseHold">HouseHold</option>
                            <option value="personal">Personal</option>
                            <option value="bills">Bills</option>
                            <option value="misc">Misc</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="item">Item name</label>
                        <input class="form-control" type="text" name="item" id="item">
                    </div>

                    <div class="form-group row">
                        <label for="expense">Expense</label>
                        <input class="form-control" type="text" name="expense" id="expense">
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Post!</button>
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection



