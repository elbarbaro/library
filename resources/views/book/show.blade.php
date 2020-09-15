@extends('layout.master')

@section('data')
<div class="col s12">
    <a class="btn-flat" href="{{url()->previous()}}">Back</a>
    <div class="collection-item">
        <h5 class="title">{{$book->name}}</h5>
        <p class="black-text">{{$book->author}} <br>
            <span>{{$book->published_date}}</span>
        </p>
        <span class="new badge left" style="margin-left:0" data-badge-caption="{{$book->category->name}}"></span>
    </div>
</div>
<div class="row">
    <div class="col s5 left-align">
    @if($book->user)
        <h5>This book was borrowed to {{$book->user->user}}</h5>
    @else
        <h5>Borrow</h5>
        <form action="{{action('BorrowController@store')}}" method="post">
        {{ csrf_field() }}
            <input type="hidden" name="id" value="{{$book->id}}">
            <div class="input-field">
                <label for="user">User</label>
                <input type="text" name="puser" id="user" required>
            </div>
            <input class="btn" type="submit" value="Register">
        </form>
    @endif
    </div>
</div>
@endsection