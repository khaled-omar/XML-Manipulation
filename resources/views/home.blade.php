@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 col-md-offset-0">
      <div class="panel panel-default">
        <div class="panel-heading">Admin Panel</div>

        <div class="panel-body">
         <div role="tabpanel">
           <!-- Nav tabs -->
           <ul class="nav nav-tabs" role="tablist">
             <li role="presentation" class="active">
               <a href="#Members" aria-controls="home" role="tab" data-toggle="tab">Members</a>
             </li>
             <li role="presentation">
               <a href="#Rules" aria-controls="tab" role="tab" data-toggle="tab">Rules</a>
             </li>
           </ul>

           <!-- Tab panes -->
           <div class="tab-content">
             <div role="tabpanel" class="tab-pane active" id="Members">
               @if(Session::has('msg'))
               <div style="margin-top: 10px;margin-bottom:0" class="alert alert-success">
                <em> {!! session('msg') !!}</em>
              </div>
              @endif
              <a style="margin:15px 15px 0" class="btn btn-primary btn-sm pull-right" href="{{url('/')}}" role="button">Add New User</a>
              
              <table class="table table-striped table-hover">
                <thead>
                  <tr>
                    <th>#ID</th>
                    <th>#Name</th>
                    <th>#fitness</th>
                    <th>#tallness</th>
                    <th>#speed</th>
                    <th>#weight</th>
                    <th>#Recommendation</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($members as $member)
                  <tr>
                    <td>{{$member->id}}</td>
                    <td>{{$member->name}}</td>
                    <td>{{$member->fitness}}</td>
                    <td>{{$member->tallness}}</td>
                    <td>{{$member->speed}}</td>
                    <td>{{$member->weight}}</td>
                    <td>{{$member->recommendation}}</td>
                    <th style="width:7%;">
                      <a class="btn btn-sm btn-success" href="{{url('Members/edit/'.$member->id)}}" role="button">Update</a>
                    </th>
                    <th>
                      <form action="{{url('Members/'.$member->id)}}" method="POST" role="form">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                      </form>
                    </tr>
                    @endforeach


                  </tbody>
                </table>
              </div>
              <div role="tabpanel" class="tab-pane" id="Rules">
                @if(Session::has('msg'))
                <div style="margin-top: 10px;margin-bottom:0" class="alert alert-success">
                  <em> {!! session('msg') !!}</em>
                </div>
                @endif
                <a style="margin:15px 15px 0" class="btn btn-primary btn-sm pull-right" href="{{url('Rules/Create')}}" role="button">Add New Rule</a>
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#Name</th>
                      <th>#Game</th>
                      <th>#fitness</th>
                      <th>#speed</th>
                      <th>#tallness</th>
                      <th>#weight</th>
                      <th></th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @for ($i = 0; $i < count($Rules); $i++)
                    <tr>
                      <td>{{$Rules[$i]['Name']}}</td>
                      <td>{{$Rules[$i]['game']}}</td>
                      <td>{{$Rules[$i]['fitness']}}</td>
                      <td>{{$Rules[$i]['speed']}}</td>
                      <td>{{$Rules[$i]['tallness']}}</td>
                      <td>{{$Rules[$i]['weight']}}</td>

                      <th style="width:7%;">
                        
                        <a class="btn btn-sm btn-success" href="{{url('Rules/edit/'.$Rules[$i]['Name'])}}" role="button">Update</a>
                      </th>
                      <th>
                        <form action="{{url('Rules/'.$Rules[$i]['Name'])}}" method="POST" role="form">
                          {{csrf_field()}}
                          <input type="hidden" name="_method" value="delete">
                          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>

                      </th>
                    </tr>
                    @endfor

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
