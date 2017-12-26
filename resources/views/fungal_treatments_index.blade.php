@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Fungal treatments <a class="button button-primary pull-right"><i class="fa fa-plus"></i> Add treatment</a></div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Food</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($objects as $object)
                            <tr>
                                <td>{{$object->time}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No fungal treatments found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
            <!--
            <div class="panel panel-default">
                <div class="panel-heading">Cravings</div>
                    <h3>Upload cravings</h3>
                   <form method="POST" action="/cravings/upload" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" name="cravings">
                        <button class="button button-primary" type="submit">upload</button>
                   </form>
            </div>
            -->
        </div>
    </div>
</div>
@endsection
