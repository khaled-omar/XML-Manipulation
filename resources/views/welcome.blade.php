@extends('layouts.app')

@section('content')
<div class="container " id="demo">
    <div class="row" >
        <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default" >

                <div class="panel-body" >



                    <form action="{{url('Members')}}" method="POST" role="form" >
                        <legend>Check Your matching sport type now ..</legend>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                        @endif
                        {{csrf_field()}}
                        <div class="form-group  ">
                            <label for="">Name:</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Input field" value="{{old('name')}}" >
                        </div>
                        <div class="form-group">
                            <label for="input">Fitness:</label>
                            <select name="fitness" id="fitness" class="form-control" >
                                <option value="">-- Select One --</option>
                                <option value="high">High</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="speed">Speed:</label>
                            <select name="speed" id="speed" class="form-control">
                                <option value="">-- Select One --</option>
                                <option value="high">High</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tallness">Tallness:</label>
                            <select name="tallness" id="tallness" class="form-control">
                                <option value="">-- Select One --</option>
                                <option value="high">High</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="weight">Weight:</label>
                            <select name="weight" id="weight" class="form-control">
                                <option value="">-- Select One --</option>
                                <option value="high">High</option>
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
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
                        <button type="submit" class="btn btn-primary ">Save</button>

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
                $.post('checkRecommendation',{name:name,fitness:fitness,speed:Speed,weight:weight,tallness:tallness},function(data){
                    $('#Recs').append('<option value='+data[0][0]+'>'+data[0][0]+'</option>')
                    console.log(data[0][0]);
                })
            });
        });

    </script>
@stop
