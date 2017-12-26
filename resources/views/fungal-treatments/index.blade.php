@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Fungaltreatments</div>
                    <div class="panel-body">
                        <a href="{{ url('/dashboard/fungal-treatments/create') }}" class="btn btn-success btn-sm" title="Add New FungalTreatment">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        <form method="GET" action="{{ url('/dashboard/fungal-treatments') }}" accept-charset="UTF-8" class="navbar-form navbar-right" role="search">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>

                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th>#</th><th>Terbinafine Gel Applied</th><th>Loceryl Applied</th><th>Vaseline Gel Applied</th><th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($fungaltreatments as $item)
                                    <tr>
                                        <td>{{ $loop->iteration or $item->id }}</td>
                                        <td>{{ $item->terbinafine_gel_applied }}</td><td>{{ $item->loceryl_applied }}</td><td>{{ $item->vaseline_gel_applied }}</td>
                                        <td>
                                            <a href="{{ url('/dashboard/fungal-treatments/' . $item->id) }}" title="View FungalTreatment"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/dashboard/fungal-treatments/' . $item->id . '/edit') }}" title="Edit FungalTreatment"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/dashboard/fungal-treatments' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-xs" title="Delete FungalTreatment" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $fungaltreatments->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
