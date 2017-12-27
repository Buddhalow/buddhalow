@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Cravings</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Time</th>
                                <th>Status</th>
                                <th>Food</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($cravings as $craving)
                            <tr>
                                <td>{{$craving->time}}</td>
                                <td>{{$craving->status}}</td>
                                <td>{{$craving->food}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No cravings found</td>
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
