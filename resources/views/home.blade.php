@extends('layout')

@section('main')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@guest
<form method="POST" action="/addTask">
    @csrf
    <input type="name" name="name" id="name" class="form-control" placeholder="Enter your name"><br>
    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email"><br>
    <textarea name="task" id="task" class="form-control" placeholder="Task"></textarea><br>
    <button type="submit" class="btn btn-success">Add task</button>
</form>
@endguest

<table class="table">
    <thead>
      <tr>
        <th scope="col">№</th>
        <th scope="col">@sortablelink('name', 'User')</th>
        <th scope="col">@sortablelink('email', 'Email')</th>
        <th scope="col">Task</th>
        <th scope="col">@sortablelink('status', 'Status')</th>
      </tr>
    </thead>
    <tbody>
        @if ($itemsArray->count() == 0)
        <tr>
            <td colspan="5">No tasks to display.</td>
        </tr>
        @endif
        @foreach ($itemsArray as $item)
        <tr>
            <th scope="row">{{ (($itemsArray->currentPage() - 1 ) * $itemsArray->perPage() ) + $loop->iteration }}
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>
                    @guest {{ $item->task }} @endguest       
                    @auth
                    <form method="POST" action="/changeTask">
                        @csrf
                        <input type="hidden" class="form-control" id="id" name="id" value={{ $item->id }}>
                        <textarea name="task" id="task" class="form-control">{{ $item->task }}</textarea><br>
                        <button type="submit" class="btn btn-success">Save change</button>
                    </form>
                    @endauth
                </td>
                <td>
                    @if ($item->status===0)
                        <p>In progress</p>                     
                    @else
                        <p>Done!</p>
                    @endif
                </td>
            </th>
        </tr> 
        @endforeach
    </tbody>
  </table>

  <div class="d-flex justify-content-center">
      
    {{ $itemsArray->appends(\Request::except('/'))->render('pagination::bootstrap-4')}}
     
  </div>

@endsection

