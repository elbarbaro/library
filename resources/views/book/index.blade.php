@extends('layout.master')

@section('data')
<div class="col s3">
    <form action="{{action('BookController@search', ['page' => $books->currentPage()])}}">
        <h5 class="title">Filters</h5>
        <button class="btn" type="submit">Search</button>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">Categories</div>
                <ul class="collection collapsible-body">
                @foreach($categories as $cat)
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="categoryId[]" value="{{$cat->id}}"/>
                            <span>{{$cat->name}}</span>
                        </label>
                    </li>
                @endforeach
                </ul>
            </li>
            <li>
                <div class="collapsible-header">Authors</div>
                <ul class="collection collapsible-body">
                @foreach($authors as $author)
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="author[]" value="{{$author}}"/>
                            <span>{{$author}}</span>
                        </label>
                    </li>
                @endforeach
                </ul>
            </li>
            <li>
                <div class="collapsible-header">Status</div>
                <ul class="collection collapsible-body">
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="status[]" value="1"/>
                            <span>Available</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="status[]" value="0"/>
                            <span>Not available</span>
                        </label>
                    </li>
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="borrow" value="1"/>
                            <span>Borrowed</span>
                        </label>
                    </li>
                </ul>
            </li>
        </ul>
    </form>
</div>
<div class="col s9">
    <div class="content">
        <ul class="collection">
            @if($books->count() > 0)
            @foreach($books as $book)
            <li class="collection-item">
                <div class="row">
                    <div class="col s9">
                        <h5 class="title"><a href="{{action('BookController@show', $book->id)}}">{{$book->name}}<a></h5>
                        <p class="black-text">{{$book->author}} <br>
                            <span>{{$book->published_date}}</span>
                        </p>
                        <span class="new badge left" style="margin-left:0" data-badge-caption="{{$book->category->name}}"></span>
                    </div>
                    <div class="col s3 right-align">
                        <a class="btn-flat" href="/books/{{$book->id}}/edit"><i class="material-icons">edit</i></a>
                        <form style="display: inline-block" action="{{action('BookController@destroy', $book->id)}}" method="post">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button class="btn-flat" type="submit"><i class="material-icons">delete</i></button>
                        </form>
                        <div class="input-field">
                            @if($book->user)
                            <span class="new badge brown" data-badge-caption="Borrowed"></span>
                            @else
                            <a class="bagde modal-trigger" href="#modal1" data-id="{{$book->id}}" data-status="{{$book->status}}">{{$book->status?'Available':'Not available'}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
            @else
            <p class="center-align">No results found</p>
            @endif
        </ul>
    {{ $books->links() }}
    </div>
    <div id="modal1" class="modal">
        <div class="modal-content">
            <h4>Modify status</h4>
            <div class="switch">
                <label>
                Not available
                <input type="checkbox" id="inputStatus">
                <span class="lever"></span>
                Available
                </label>
            </div>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
            <a href="#!" class="waves-effect waves-green btn-flat" id="btnSave">Save</a>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('js/request.js')}}"></script>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.collapsible');
        var elemsModal = document.querySelectorAll('.modal');
        var instances = M.Collapsible.init(elems, { accordion: false });

        var onOpenStartCallback = function(elemModal) {
            var inputStatus = document.getElementById('inputStatus');
            var btnSave = document.getElementById('btnSave');
            var status = this._openingTrigger.dataset.status;
            var id = this._openingTrigger.dataset.id;
            inputStatus.checked = (status === '1' ? true : false);

            var success = result => {
                console.log(result);
                inputStatus.checked = result.status;
                this._openingTrigger.dataset.status = result.status?'1':'0';
                this._openingTrigger.innerText=result.status?'Available':'Not available';
                this.close();
                M.toast({html: 'Status updated correctly'});
            }

            var error = error => {
                this.close();
                console.error(error);
                M.toast({html: 'Error'});
            }

            btnSave.onclick = function(e) {
                put("{{url('api/books/status')}}", {id: id}, success, error);
            }
        }

        var instancesModal = M.Modal.init(elemsModal, {
            onOpenStart: onOpenStartCallback
        });

        var status = "{{session('status')}}";
        if(status) M.toast({html: status});
    });
</script>
@endpush