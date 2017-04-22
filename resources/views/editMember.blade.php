@extends('layouts.app')

@section('content')
<div class="container " id="demo">
    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >

                <div class="panel-body" >

                    <form action="{{url('Members/'.$member->id)}}" method="POST" role="form" >
                        <legend>Edit Your Own member now  ..</legend>
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
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter name" value="{{$member->name}}" >
                        </div>

                        <div class="form-group">
                            <label for="input">Fitness:</label>
                            <select name="fitness" id="fitness" class="form-control" >

                                <option value="{{$member['fitness']}}">{{$member->fitness}}</option>
                                @if($member->fitness!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($member->fitness!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($member->fitness!='low' )
                                <option value="low">Low</option>
                                @endif
                                
                                
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="speed">Speed:</label>
                            <select name="speed" id="speed" class="form-control">
                                <option value="{{$member['speed']}}">{{$member['speed']}}</option>
                                @if($member->fitness!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($member['speed']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($member['speed']!='low' )
                                <option value="low">Low</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tallness">Tallness:</label>
                            <select name="tallness" id="tallness" class="form-control">
                                <option value="{{$member['tallness']}}">{{$member['tallness']}}</option>
                                @if($member['tallness']!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($member['tallness']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($member['tallness']!='low' )
                                <option value="low">Low</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight:</label>
                            <select name="weight" id="weight" class="form-control">

                                <option value="{{$member['weight']}}">{{$member['weight']}}</option>

                                @if($member['weight']!='high' )
                                <option value="high">High</option>
                                @endif

                                @if($member['weight']!='medium' )
                                <option value="medium">Medium</option>
                                @endif
                                @if($member['weight']!='low' )
                                <option value="low">Low</option>
                                @endif
                            </select>
                        </div>
                        <button type="submit" id="getRecommendations" class="btn btn-success">Get Recommedations</button></br></br>
                        <div class="form-group">
                            <label for="recommendation">Your Recommedations:</label>
                            <select name="recommendation" id="Recs" class="form-control">
                                <option value="">-- Select One --</option>
                                
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
@section('Scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
            // body...
            $('#getRecommendations').click(function(event){
                event.preventDefault();
                var name = $('#name').val();
                var fitness = $('#fitness').val();
                var Speed = $('#speed').val();
                var tallness = $('#tallness').val();
                var weight = $('#weight').val();
                alert(name+fitness+Speed+tallness+weight);
                $.post('/checkRecommendation',{name:name,fitness:fitness,speed:Speed,weight:weight,tallness:tallness},function(data){
                    $('#Recs').append('<option value='+data[0][0]+'>'+data[0][0]+'</option>')
                    console.log(data[0][0]);
                })
            });
        });

    </script>
    @stop

