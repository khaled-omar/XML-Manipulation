@extends('layouts.app')

@section('content')
<div class="container " id="demo">
    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >

                <div class="panel-body" >

                    <form action="{{url('Rules/'.$Rule['Name'])}}" method="POST" role="form" >
                        <legend>Edit Your Own Rule now  ..</legend>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('msg'))
                        <div class="alert alert-success">
                            {{ session('msg') }}
                        </div>
                        @endif
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group ">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$Rule['Name']}}" >
                        </div>
                        <div class="form-group  ">
                            <label for="game">Game:</label>
                            <input type="text" class="form-control" name="game" id="game" placeholder="Enter game" value="{{$Rule['game']}}" >
                        </div>
                        <div class="form-group">
                            <label for="input">Fitness:</label>
                            <select name="fitness" id="fitness" class="form-control" >

                                <option value="{{$Rule['fitness']}}">{{$Rule['fitness']}}</option>
                                @if($Rule['fitness']!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($Rule['fitness']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($Rule['fitness']!='low' )
                                <option value="low">Low</option>
                                @endif
                                
                                
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="speed">Speed:</label>
                            <select name="speed" id="speed" class="form-control">
                                <option value="{{$Rule['speed']}}">{{$Rule['speed']}}</option>
                                @if($Rule['speed']!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($Rule['speed']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($Rule['speed']!='low' )
                                <option value="low">Low</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tallness">Tallness:</label>
                            <select name="tallness" id="tallness" class="form-control">
                                <option value="{{$Rule['tallness']}}">{{$Rule['tallness']}}</option>
                                @if($Rule['tallness']!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($Rule['tallness']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($Rule['tallness']!='low' )
                                <option value="low">Low</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight:</label>
                            <select name="weight" id="weight" class="form-control">
                               
                                <option value="{{$Rule['weight']}}">{{$Rule['weight']}}</option>

                                @if($Rule['weight']!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($Rule['weight']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($Rule['weight']!='low' )
                                <option value="low">Low</option>
                                @endif
                            </select>
                        </div>
                        <button type="reset" class="btn btn-danger ">Clear</button> 
                        <button type="submit" class="btn btn-primary ">Edit</button>

                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection

