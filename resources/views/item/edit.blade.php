@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-4">
                <form name="itemForm" action="{{ route('item.update', $item) }}" enctype="multipart/form-data" method="post" onsubmit="return validate()">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="category">Category</label><br>
                        <select name="category" id="category">
                            <option value="food" <?php if ($item->category == 'food') echo "selected='selected'";?> >Food</option>
                            <option value="houseHold" <?php if ($item->category == 'houseHold') echo "selected='selected'";?> >HouseHold</option>
                            <option value="personal"<?php if ($item->category == 'personal') echo "selected='selected'";?> >Personal</option>
                            <option value="bills"<?php if ($item->category == 'bills') echo "selected='selected'";?> >Bills</option>
                            <option value="misc"<?php if ($item->category == 'misc') echo "selected='selected'";?> >Misc</option>
                        </select>
                    </div>

                    <div class="form-group row">
                        <label for="item">Item name</label>
                        <input class="form-control" type="text" name="item" id="item" value={{$item->name}}>
                    </div>

                    <div class="form-group row">
                        <label for="expense">Expense</label>
                        <input class="form-control" type="text" name="expense" id="expense" value={{$item->expense}}>
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn btn-primary">Update!</button>
                    </div>
                </form>
            </div>
            <div class="col-4"></div>
        </div>
    </div>
@endsection